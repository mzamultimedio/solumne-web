<?php

namespace App\Filament\Widgets;

use App\Models\Curso;
use App\Models\ExamAttempt;
use App\Models\Invoice;
use App\Models\Leccion;
use App\Models\Modulo;
use App\Models\Recurso;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AcademyStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $user = auth()->user();

        // Si es profesor, mostrar solo estadísticas de sus cursos
        if ($user?->role === 'profesor') {
            return $this->getProfesorStats($user);
        }

        // Admin/Gestor: estadísticas completas
        return $this->getAdminStats();
    }

    protected function getProfesorStats(User $profesor): array
    {
        // Obtener IDs de cursos que el profesor gestiona
        $cursoIds = $profesor->teachingCourses()->pluck('cursos.id')->toArray();

        // Si no tiene cursos asignados
        if (empty($cursoIds)) {
            return [
                Stat::make('Cursos Asignados', '0')
                    ->description('Contacta al administrador')
                    ->icon('heroicon-o-academic-cap')
                    ->color('warning'),
            ];
        }

        // Alumnos de sus cursos
        $totalAlumnos = User::where('role', 'alumno')
            ->whereHas('cursos', fn($q) => $q->whereIn('cursos.id', $cursoIds))
            ->count();

        // Cursos asignados
        $totalCursos = count($cursoIds);

        // Módulos de sus cursos
        $moduloIds = Modulo::whereIn('curso_id', $cursoIds)->pluck('id')->toArray();

        // Exámenes pendientes de calificar en sus cursos
        $examenesPendientes = ExamAttempt::whereHas('exam', function ($q) use ($moduloIds) {
            $q->whereIn('modulo_id', $moduloIds);
        })->where('status', 'submitted')->count();

        // Lecciones de sus cursos
        $totalLecciones = Leccion::whereIn('modulo_id', $moduloIds)->count();

        // Recursos de sus cursos
        $leccionIds = Leccion::whereIn('modulo_id', $moduloIds)->pluck('id')->toArray();
        $totalRecursos = Recurso::whereIn('leccion_id', $leccionIds)->count();

        return [
            Stat::make('Mis Cursos', $totalCursos)
                ->description('Cursos que gestiono')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->icon('heroicon-o-academic-cap')
                ->color('info'),

            Stat::make('Mis Alumnos', number_format($totalAlumnos))
                ->description('Inscriptos en mis cursos')
                ->descriptionIcon('heroicon-m-users')
                ->icon('heroicon-o-users')
                ->color('success'),

            Stat::make('Exámenes por Revisar', number_format($examenesPendientes))
                ->description($examenesPendientes > 0 ? 'Pendientes de calificar' : 'Todo al día ✓')
                ->descriptionIcon($examenesPendientes > 0 ? 'heroicon-m-clock' : 'heroicon-m-check-circle')
                ->icon('heroicon-o-clipboard-document-check')
                ->color($examenesPendientes > 0 ? 'danger' : 'success'),

            Stat::make('Lecciones', number_format($totalLecciones))
                ->description('En mis cursos')
                ->descriptionIcon('heroicon-m-play-circle')
                ->icon('heroicon-o-play-circle')
                ->color('warning'),

            Stat::make('Recursos', number_format($totalRecursos))
                ->description('Archivos subidos')
                ->descriptionIcon('heroicon-m-document-arrow-down')
                ->icon('heroicon-o-folder-open')
                ->color('gray'),
        ];
    }

    protected function getAdminStats(): array
    {
        // Alumnos
        $totalAlumnos = User::where('role', 'alumno')->count();
        $alumnosNuevos = User::where('role', 'alumno')
            ->where('created_at', '>=', now()->subDays(30))
            ->count();

        // Cursos
        $totalCursos = Curso::count();
        $cursosConAlumnos = Curso::has('alumnos')->count();

        // Exámenes pendientes de calificar
        $examenesPendientes = ExamAttempt::where('status', 'submitted')->count();

        // Facturas pendientes
        $facturasPendientes = Invoice::where('paid_at', null)->count();
        $montoPendiente = Invoice::where('paid_at', null)->sum('monto_total');

        // Lecciones
        $totalLecciones = Leccion::count();

        // Recursos
        $totalRecursos = Recurso::count();

        return [
            Stat::make('Alumnos', number_format($totalAlumnos))
                ->description($alumnosNuevos > 0 ? "+{$alumnosNuevos} este mes" : 'Total inscriptos')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->icon('heroicon-o-users')
                ->color('info')
                ->chart($this->getAlumnosChart()),

            Stat::make('Cursos Activos', number_format($cursosConAlumnos) . '/' . number_format($totalCursos))
                ->description('Con alumnos inscriptos')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->icon('heroicon-o-academic-cap')
                ->color('warning'),

            Stat::make('Exámenes por Revisar', number_format($examenesPendientes))
                ->description($examenesPendientes > 0 ? 'Pendientes de calificar' : 'Todo al día ✓')
                ->descriptionIcon($examenesPendientes > 0 ? 'heroicon-m-clock' : 'heroicon-m-check-circle')
                ->icon('heroicon-o-clipboard-document-check')
                ->color($examenesPendientes > 0 ? 'danger' : 'success'),

            Stat::make('Facturas Pendientes', number_format($facturasPendientes))
                ->description($montoPendiente > 0 ? '$' . number_format($montoPendiente, 0, ',', '.') . ' por cobrar' : 'Sin pendientes')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->icon('heroicon-o-banknotes')
                ->color($facturasPendientes > 0 ? 'warning' : 'success'),

            Stat::make('Lecciones', number_format($totalLecciones))
                ->description('Contenido disponible')
                ->descriptionIcon('heroicon-m-play-circle')
                ->icon('heroicon-o-play-circle')
                ->color('success'),

            Stat::make('Recursos', number_format($totalRecursos))
                ->description('Archivos subidos')
                ->descriptionIcon('heroicon-m-document-arrow-down')
                ->icon('heroicon-o-folder-open')
                ->color('gray'),
        ];
    }

    protected function getAlumnosChart(): array
    {
        // Últimos 7 días de inscripciones
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $data[] = User::where('role', 'alumno')
                ->whereDate('created_at', now()->subDays($i))
                ->count();
        }
        return $data;
    }
}
