<?php

namespace App\Models;

use App\Models\Curso;
use App\Models\Modulo;
use App\Models\Pivots\ModuloUser;
use App\Models\Invoice;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\ExamAttempt;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'dni',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function cursos(): BelongsToMany
    {
        return $this->belongsToMany(Curso::class, 'curso_user');
    }

    public function teachingCourses(): BelongsToMany
    {
        return $this->belongsToMany(Curso::class, 'curso_teacher', 'user_id', 'curso_id');
    }

    public function completedLecciones(): BelongsToMany
    {
        return $this->belongsToMany(Leccion::class, 'leccion_user')->withTimestamps();
    }

    public function assignedModulos(): BelongsToMany
    {
        return $this->belongsToMany(Modulo::class, 'modulo_user')
            ->using(ModuloUser::class)
            ->withPivot([
                'assigned_at',
                'status',
                'available_from',
                'available_until',
                'released_by',
                'payment_reference',
                'notes',
                'revoked_at',
            ])
            ->withTimestamps();
    }

    public function examAttempts(): HasMany
    {
        return $this->hasMany(ExamAttempt::class);
    }

    public function moduleAssignmentsForCurso(Curso $curso): Collection
    {
        return $this->assignedModulos()
            ->where('modulos.curso_id', $curso->id)
            ->get()
            ->mapWithKeys(fn(Modulo $modulo): array => [
                $modulo->id => $modulo->pivot,
            ]);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function hasModuleAssignmentsForCurso(Curso $curso): bool
    {
        return $this->assignedModulos()
            ->where('modulos.curso_id', $curso->id)
            ->exists();
    }

    public function accessibleModuloIdsForCurso(Curso $curso): Collection
    {
        $assignments = $this->moduleAssignmentsForCurso($curso);

        return $assignments
            ->filter(fn(ModuloUser $pivot): bool => $pivot->is_accessible)
            ->keys();
    }

    public function canAccessModulo(Modulo $modulo): bool
    {
        $assignment = $this->assignedModulos()
            ->where('modulos.id', $modulo->id)
            ->first();

        if (!$assignment) {
            return !$this->hasModuleAssignmentsForCurso($modulo->curso);
        }

        return (bool) $assignment->pivot->is_accessible;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->role, ['admin', 'gestor', 'profesor'], true);
    }
}
