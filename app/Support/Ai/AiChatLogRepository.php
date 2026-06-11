<?php

namespace App\Support\Ai;

use Illuminate\Support\Facades\Storage;

class AiChatLogRepository
{
    private const DIRECTORY = 'ai/logs';

    public function append(string $sessionId, array $entry): void
    {
        $path = $this->pathFor($sessionId);

        $entries = [];

        if (Storage::disk('local')->exists($path)) {
            $raw = Storage::disk('local')->get($path);

            try {
                $entries = json_decode($raw, true, flags: JSON_THROW_ON_ERROR);
            } catch (\JsonException) {
                $entries = [];
            }
        }

        $entries[] = [
            'timestamp' => now()->toIso8601String(),
            'entry' => $entry,
        ];

        Storage::disk('local')->put($path, json_encode($entries, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    private function pathFor(string $sessionId): string
    {
        return sprintf('%s/%s.json', self::DIRECTORY, $sessionId);
    }
}
