<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CursoController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $cursos = $user->cursos()->with('modulos')->get();

        // Calcular progreso para cada curso
        $cursosData = [];
        foreach ($cursos as $curso) {
            $totalLecciones = $curso->modulos->sum(function ($modulo) {
                return $modulo->lecciones()->count();
            });

            $leccionesDelCursoIds = $curso->modulos->flatMap(function ($modulo) {
                return $modulo->lecciones->pluck('id');
            });

            $leccionesCompletadas = $user->completedLecciones()
                ->whereIn('leccion_id', $leccionesDelCursoIds)
                ->count();

            $cursosData[$curso->id] = [
                'total' => $totalLecciones,
                'completadas' => $leccionesCompletadas,
                'progreso' => $totalLecciones > 0 ? round(($leccionesCompletadas / $totalLecciones) * 100) : 0,
            ];
        }

        return view('student.curso.index', compact('cursos', 'cursosData'));
    }

    public function show(Curso $curso): View
    {
        $user = Auth::user();
        if (!$user->cursos->contains($curso)) {
            abort(403);
        }

        // Cargamos de forma eficiente todas las relaciones que necesitamos
        $curso->load([
            'modulos.lecciones',
            'modulos.exam',
        ]);

        $moduleAssignments = $user->moduleAssignmentsForCurso($curso);
        $usaAsignaciones = $moduleAssignments->isNotEmpty();

        $curso->modulos->each(function ($modulo) use ($moduleAssignments, $usaAsignaciones) {
            $assignment = $moduleAssignments->get($modulo->id);

            if ($assignment) {
                $modulo->setRelation('accessAssignment', $assignment);
            }

            $isAccessible = $assignment
                ? (bool) $assignment->is_accessible
                : !$usaAsignaciones;

            $modulo->setAttribute('access_is_accessible', $isAccessible);
            $modulo->setAttribute('access_status', $assignment?->display_status ?? ($usaAsignaciones ? 'pending' : 'unlocked'));
            $modulo->setAttribute('access_available_from', $assignment?->available_from);
            $modulo->setAttribute('access_available_until', $assignment?->available_until);
            $modulo->setAttribute('access_notes', $assignment?->notes);
            $modulo->setAttribute('access_payment_reference', $assignment?->payment_reference);
        });

        $modulosVisibles = $curso->modulos
            ->filter(fn($modulo) => (bool) $modulo->getAttribute('access_is_accessible'))
            ->values();

        $modulosBloqueados = $curso->modulos
            ->reject(fn($modulo) => (bool) $modulo->getAttribute('access_is_accessible'))
            ->values();

        // --- LÓGICA DE PROGRESO ---
        // Obtenemos todas las IDs de las lecciones de este curso
        $leccionesDelCursoIds = $modulosVisibles->flatMap(function ($modulo) {
            return $modulo->lecciones->pluck('id');
        });

        $totalLecciones = $leccionesDelCursoIds->count();

        // Obtenemos solo las lecciones completadas por el usuario que pertenecen a este curso
        $leccionesCompletadas = $user->completedLecciones()
            ->whereIn('leccion_id', $leccionesDelCursoIds)
            ->count();

        // Calculamos el porcentaje
        $progreso = ($totalLecciones > 0) ? ($leccionesCompletadas / $totalLecciones) * 100 : 0;

        // Pasamos las IDs de las lecciones completadas para los checks en la vista
        $leccionesCompletadasIds = $user->completedLecciones->pluck('id');

        $examAttempts = [];
        $examIds = $modulosVisibles->pluck('exam.id')->filter()->values();
        if ($examIds->isNotEmpty()) {
            $attempts = $user->examAttempts()->whereIn('exam_id', $examIds)->get()->keyBy('exam_id');
            foreach ($modulosVisibles as $modulo) {
                if ($modulo->exam) {
                    $examAttempts[$modulo->id] = $attempts->get($modulo->exam->id);
                }
            }
        }

        return view('student.curso.show', [
            'curso' => $curso,
            'modulosVisibles' => $modulosVisibles,
            'modulosBloqueados' => $modulosBloqueados,
            'progreso' => $progreso,
            'leccionesCompletadasIds' => $leccionesCompletadasIds,
            'examAttempts' => $examAttempts,
            'usaAsignaciones' => $usaAsignaciones,
        ]);
    }
}
