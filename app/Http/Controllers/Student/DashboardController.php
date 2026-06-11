<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Invoice;
use App\Models\Leccion;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $cursos = $user->cursos()->with(['modulos.lecciones'])->latest()->get();

        // Calcular estadísticas
        $totalLecciones = 0;
        $leccionesCompletadas = $user->completedLecciones()->count();
        $cursosData = [];

        foreach ($cursos as $curso) {
            $cursoLecciones = 0;
            $cursoCompletadas = 0;

            foreach ($curso->modulos as $modulo) {
                $moduloLecciones = $modulo->lecciones->count();
                $cursoLecciones += $moduloLecciones;
                $cursoCompletadas += $user->completedLecciones()
                    ->whereIn('leccion_id', $modulo->lecciones->pluck('id'))
                    ->count();
            }

            $totalLecciones += $cursoLecciones;

            $cursosData[$curso->id] = [
                'total' => $cursoLecciones,
                'completadas' => $cursoCompletadas,
                'progreso' => $cursoLecciones > 0 ? round(($cursoCompletadas / $cursoLecciones) * 100) : 0,
            ];
        }

        // Próximos exámenes (con fecha límite futura)
        $proximosExamenes = Exam::whereHas('modulo.curso', function ($q) use ($user) {
            $q->whereHas('alumnos', fn($q2) => $q2->where('user_id', $user->id));
        })
            ->where('is_published', true)
            ->where('due_at', '>', now())
            ->orderBy('due_at')
            ->limit(3)
            ->get();

        // Facturas pendientes (últimas 3)
        $facturasPendientes = Invoice::where('alumno_id', $user->id)
            ->latest('fecha_emision')
            ->limit(3)
            ->get();

        // Progreso general
        $progresoGeneral = $totalLecciones > 0
            ? round(($leccionesCompletadas / $totalLecciones) * 100)
            : 0;

        return view('student.dashboard', [
            'cursos' => $cursos,
            'cursosData' => $cursosData,
            'stats' => [
                'totalCursos' => $cursos->count(),
                'totalLecciones' => $totalLecciones,
                'leccionesCompletadas' => $leccionesCompletadas,
                'progresoGeneral' => $progresoGeneral,
            ],
            'proximosExamenes' => $proximosExamenes,
            'facturasPendientes' => $facturasPendientes,
        ]);
    }
}