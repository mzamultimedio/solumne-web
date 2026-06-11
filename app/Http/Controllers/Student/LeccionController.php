<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Leccion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LeccionController extends Controller
{
    public function show(Leccion $leccion): View
    {
        $leccion->load('modulo.curso', 'recursos', 'modulo.exam.questions');

        $curso = $leccion->modulo->curso;
        $user = Auth::user();

        if (!$user->cursos->contains($curso)) {
            abort(403, 'No estás inscrito en este curso.');
        }

        if ($user->hasModuleAssignmentsForCurso($curso)) {
            $accessibleModuloIds = $user->accessibleModuloIdsForCurso($curso);

            if (! $accessibleModuloIds->contains($leccion->modulo_id)) {
                abort(403, 'No tienes acceso a este módulo.');
            }
        }

        $exam = $leccion->modulo->exam;
        $attempt = null;

        if ($exam) {
            $attempt = $exam->attempts()->where('user_id', $user->id)->with('answers')->first();
        }

        return view('student.leccion.show', [
            'leccion' => $leccion,
            'exam' => $exam,
            'examAttempt' => $attempt,
        ]);
    }

    public function complete(Leccion $leccion): RedirectResponse
    {
        $user = Auth::user();
        $user->completedLecciones()->toggle($leccion->id);

        return back()->with('success', 'Estado de la lección actualizado.');
    }
}
