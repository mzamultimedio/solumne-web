<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ExamAttempt;
use App\Models\Modulo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ExamController extends Controller
{
    public function show(Modulo $modulo): View
    {
        $user = Auth::user();
        $curso = $modulo->curso;

        if (! $user->cursos->contains($curso)) {
            abort(403);
        }

        if ($user->hasModuleAssignmentsForCurso($curso)) {
            $accessibleModuloIds = $user->accessibleModuloIdsForCurso($curso);

            if (! $accessibleModuloIds->contains($modulo->id)) {
                abort(403);
            }
        }

        $modulo->load(['exam.questions' => fn ($query) => $query->orderBy('order')]);
        $exam = $modulo->exam;

        $attempt = null;
        if ($exam) {
            $attempt = $exam->attempts()->where('user_id', $user->id)->with('answers.question')->first();
        }

        return view('student.exam.show', [
            'modulo' => $modulo,
            'exam' => $exam,
            'attempt' => $attempt,
        ]);
    }

    public function submit(Request $request, Modulo $modulo): RedirectResponse
    {
        $user = Auth::user();
        $curso = $modulo->curso;

        if (! $user->cursos->contains($curso)) {
            abort(403);
        }

        if ($user->hasModuleAssignmentsForCurso($curso)) {
            $accessibleModuloIds = $user->accessibleModuloIdsForCurso($curso);

            if (! $accessibleModuloIds->contains($modulo->id)) {
                abort(403);
            }
        }

        $modulo->load(['exam.questions' => fn ($query) => $query->orderBy('order')]);
        $exam = $modulo->exam;

        if (! $exam || ! $exam->is_published) {
            return back()->with('error', 'El examen aún no está disponible.');
        }

        if ($exam->questions->isEmpty()) {
            return back()->with('error', 'Este examen no tiene preguntas configuradas todavía.');
        }

        $attempt = ExamAttempt::firstOrNew([
            'exam_id' => $exam->id,
            'user_id' => $user->id,
        ]);

        if ($attempt->exists && $attempt->status === 'graded') {
            return back()->with('error', 'Este examen ya fue calificado. Contacta a tu profesor si necesitas hacer cambios.');
        }

        $rules = [];
        $attributes = [];
        foreach ($exam->questions as $index => $question) {
            $rules['answers.' . $question->id] = ['required', 'string', 'max:5000'];
            $attributes['answers.' . $question->id] = 'Pregunta ' . ($index + 1);
        }

        $validated = $request->validate($rules, [], $attributes);
        $answersInput = $validated['answers'];

        $attempt->fill([
            'status' => 'submitted',
            'submitted_at' => now(),
            'score' => null,
            'feedback' => null,
            'graded_at' => null,
        ]);
        $attempt->save();

        $attempt->answers()->delete();

        $payload = [];
        foreach ($exam->questions as $question) {
            $payload[] = [
                'exam_question_id' => $question->id,
                'answer_text' => trim($answersInput[$question->id]),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        $attempt->answers()->createMany($payload);

        return redirect()
            ->route('student.modulo.exam.show', $modulo)
            ->with('success', 'Tus respuestas fueron enviadas correctamente.');
    }
}
