<?php

namespace App\Filament\Pages;

use App\Models\Curso;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Livewire\Attributes\Url;

class AsignarProfesorCurso extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    protected static ?string $navigationLabel = 'Asignar Profesor';

    protected static ?string $title = 'Asignar Cursos a Profesores';

    protected static ?string $navigationGroup = 'Gestión de Usuarios';

    protected static ?int $navigationSort = 6;

    protected static string $view = 'filament.pages.asignar-profesor-curso';

    #[Url]
    public ?int $profesor_id = null;

    public array $curso_ids = [];

    public string $searchProfesor = '';
    public string $searchCurso = '';

    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'admin';
    }

    public function getProfesores()
    {
        $query = User::where('role', 'profesor')->orderBy('name');

        if ($this->searchProfesor) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->searchProfesor}%")
                    ->orWhere('email', 'like', "%{$this->searchProfesor}%");
            });
        }

        return $query->get();
    }

    public function getCursosDisponibles()
    {
        if (!$this->profesor_id) {
            return collect();
        }

        $profesor = User::find($this->profesor_id);
        $assignedIds = $profesor->teachingCourses()->pluck('cursos.id')->toArray();

        $query = Curso::whereNotIn('id', $assignedIds)->orderBy('title');

        if ($this->searchCurso) {
            $query->where('title', 'like', "%{$this->searchCurso}%");
        }

        return $query->get();
    }

    public function selectAll(): void
    {
        $this->curso_ids = $this->getCursosDisponibles()->pluck('id')->map(fn($id) => (string) $id)->toArray();
    }

    public function deselectAll(): void
    {
        $this->curso_ids = [];
    }

    public function asignar(): void
    {
        if (empty($this->profesor_id)) {
            Notification::make()
                ->danger()
                ->title('Error')
                ->body('Selecciona un profesor')
                ->send();
            return;
        }

        if (empty($this->curso_ids)) {
            Notification::make()
                ->danger()
                ->title('Error')
                ->body('Selecciona al menos un curso')
                ->send();
            return;
        }

        $profesor = User::find($this->profesor_id);
        $profesor->teachingCourses()->attach($this->curso_ids);

        $count = count($this->curso_ids);

        Notification::make()
            ->success()
            ->title('¡Cursos asignados!')
            ->body("Se asignaron {$count} curso(s) a {$profesor->name}")
            ->duration(5000)
            ->send();

        // Limpiar selección
        $this->curso_ids = [];
        $this->searchCurso = '';
    }

    public function quitarCurso(int $cursoId): void
    {
        if (!$this->profesor_id) {
            return;
        }

        $profesor = User::find($this->profesor_id);
        $profesor->teachingCourses()->detach($cursoId);
        $curso = Curso::find($cursoId);

        Notification::make()
            ->warning()
            ->title('Curso quitado')
            ->body("Se quitó '{$curso->title}' de {$profesor->name}")
            ->send();
    }

    public function quitarTodos(): void
    {
        if (!$this->profesor_id) {
            return;
        }

        $profesor = User::find($this->profesor_id);
        $count = $profesor->teachingCourses()->count();
        $profesor->teachingCourses()->detach();

        Notification::make()
            ->warning()
            ->title('Cursos quitados')
            ->body("Se quitaron {$count} curso(s) de {$profesor->name}")
            ->send();
    }

    public function getProfesorStats(): array
    {
        if (!$this->profesor_id) {
            return [];
        }

        $profesor = User::find($this->profesor_id);
        $cursoIds = $profesor->teachingCourses()->pluck('cursos.id')->toArray();

        if (empty($cursoIds)) {
            return [
                'cursos' => 0,
                'alumnos' => 0,
                'modulos' => 0,
            ];
        }

        $alumnosCount = User::where('role', 'alumno')
            ->whereHas('cursos', fn($q) => $q->whereIn('cursos.id', $cursoIds))
            ->count();

        $modulosCount = \App\Models\Modulo::whereIn('curso_id', $cursoIds)->count();

        return [
            'cursos' => count($cursoIds),
            'alumnos' => $alumnosCount,
            'modulos' => $modulosCount,
        ];
    }
}
