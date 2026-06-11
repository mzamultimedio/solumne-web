<?php

namespace App\Services;

use App\Models\Curso;
use App\Models\Sede;
use App\Support\Ai\AiChatLogRepository;
use App\Support\Ai\AiInstructionRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class AiAssistantService
{
    public function __construct(
        private readonly AiInstructionRepository $instructions,
        private readonly AiChatLogRepository $logs,
    ) {
    }

    public function respond(string $message): string
    {
        $sessionId = session()->getId();
        $context = session()->get('ai.conversation', []);

        $context[] = [
            'role' => 'user',
            'content' => trim($message),
        ];

        $responseText = $this->generateResponse($context);

        $context[] = [
            'role' => 'assistant',
            'content' => $responseText,
        ];

        if (count($context) > 5) {
            $context = array_slice($context, -5);
        }

        session()->put('ai.conversation', $context);

        $this->logs->append($sessionId, [
            'prompt' => $message,
            'response' => $responseText,
            'context' => $context,
        ]);

        return $responseText;
    }

    private function generateResponse(array $context): string
    {
        try {
            if (! Config::get('services.gemini.key')) {
                return 'El asistente no está disponible porque falta la configuración de la API.';
            }

            $payload = $this->buildPayload($context);

            $response = Http::timeout(20)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->post(
                    sprintf(
                        'https://generativelanguage.googleapis.com/v1beta/models/%s:generateContent?key=%s',
                        Config::get('services.gemini.model'),
                        Config::get('services.gemini.key')
                    ),
                    $payload
                );

            if (! $response->successful()) {
                Log::warning('Gemini API error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return 'Lo siento, ahora mismo no puedo responder. Intenta nuevamente en unos segundos.';
            }

            $data = $response->json();

            $text = Arr::get($data, 'candidates.0.content.parts.0.text');

            if (! $text) {
                Log::warning('Gemini API empty response', ['payload' => $data]);

                return 'No he recibido una respuesta válida. ¿Puedes reformular tu pregunta?';
            }

            return trim($text);
        } catch (Throwable $exception) {
            Log::error('Gemini API call failed', ['exception' => $exception]);

            return 'Se produjo un error al contactar con el asistente. Intenta nuevamente más tarde.';
        }
    }

    private function buildPayload(array $context): array
    {
        $instructions = $this->instructions->get();
        $databaseSnapshot = $this->databaseSnapshot();

        $contents = collect($context)
            ->map(function (array $message, int $index) use ($context, $databaseSnapshot) {
                $text = $message['content'];

                if ($index === array_key_last($context) && $message['role'] === 'user') {
                    $text .= "\n\nContexto de base de datos (JSON):\n" . $databaseSnapshot;
                }

                return [
                    'role' => $message['role'] === 'assistant' ? 'model' : 'user',
                    'parts' => [
                        ['text' => $text],
                    ],
                ];
            })
            ->values()
            ->all();

        return [
            'system_instruction' => [
                'role' => 'system',
                'parts' => [
                    ['text' => $instructions],
                ],
            ],
            'contents' => $contents,
            'generationConfig' => [
                'temperature' => 0.7,
                'topP' => 0.95,
                'maxOutputTokens' => 1024,
            ],
        ];
    }

    private function databaseSnapshot(): string
    {
        $snapshot = [
            'timestamp' => now()->toIso8601String(),
            'courses' => $this->courseSummary(),
            'sedes' => $this->sedeSummary(),
            'metadata' => [
                'timezone' => config('app.timezone'),
                'generated_in' => config('app.name'),
            ],
        ];

        return json_encode($snapshot, JSON_UNESCAPED_UNICODE);
    }

    private function courseSummary(): Collection
    {
        return Curso::query()
            ->select(['id', 'title', 'slug', 'description', 'created_at'])
            ->with(['modulos' => function ($query) {
                $query->select(['id', 'curso_id', 'title', 'order'])
                    ->with(['lecciones' => function ($leccionQuery) {
                        $leccionQuery->select(['id', 'modulo_id', 'title', 'order'])
                            ->orderBy('order')
                            ->limit(10);
                    }, 'exam' => function ($examQuery) {
                        $examQuery->select(['id', 'modulo_id', 'title', 'available_from', 'due_at', 'is_published']);
                    }])
                    ->orderBy('order');
            }])
            ->orderByDesc('created_at')
            ->limit(10)
            ->get()
            ->map(function ($curso) {
                return [
                    'id' => $curso->id,
                    'title' => $curso->title,
                    'slug' => $curso->slug,
                    'summary' => Str::limit(strip_tags($curso->description), 200),
                    'created_at' => optional($curso->created_at)->toDateString(),
                    'modules' => $curso->modulos->map(function ($modulo) {
                        return [
                            'id' => $modulo->id,
                            'title' => $modulo->title,
                            'order' => $modulo->order,
                            'lessons' => $modulo->lecciones->map(fn ($leccion) => [
                                'id' => $leccion->id,
                                'title' => $leccion->title,
                                'order' => $leccion->order,
                            ]),
                        ];
                    }),
                    'exam' => $curso->modulos->map(fn ($modulo) => $modulo->exam)->filter()->map(function ($exam) {
                        return [
                            'modulo_id' => $exam->modulo_id,
                            'title' => $exam->title,
                            'available_from' => optional($exam->available_from)->toIso8601String(),
                            'due_at' => optional($exam->due_at)->toIso8601String(),
                            'is_published' => $exam->is_published,
                            'questions' => $exam->questions()->orderBy('order')->limit(5)->get(['id', 'prompt', 'points'])->map(fn ($question) => [
                                'id' => $question->id,
                                'prompt' => Str::limit(strip_tags($question->prompt), 120),
                                'points' => $question->points,
                            ]),
                        ];
                    })->values(),
                ];
            });
    }

    private function sedeSummary(): Collection
    {
        return Sede::query()
            ->select(['id', 'name', 'facebook_url', 'instagram_url'])
            ->get()
            ->map(fn ($sede) => [
                'id' => $sede->id,
                'name' => $sede->name,
                'facebook_url' => $sede->facebook_url,
                'instagram_url' => $sede->instagram_url,
            ]);
    }
}
