<?php

namespace App\Models;

use App\Models\Pivots\ModuloUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Exam;
use App\Models\ExamAttempt;

class Modulo extends Model
{
    use HasFactory;

    protected $fillable = [
        'curso_id',
        'title',
        'order',
    ];

    /**
     * Get the curso that owns the modulo.
     */
    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class);
    }

    /**
     * Get the lecciones for the modulo.
     */
    public function lecciones(): HasMany
    {
        return $this->hasMany(Leccion::class)->orderBy('order');
    }

    public function estudiantes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'modulo_user')
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

    public function exam(): HasOne
    {
        return $this->hasOne(Exam::class);
    }

    public function examAttempts(): HasManyThrough
    {
        return $this->hasManyThrough(ExamAttempt::class, Exam::class);
    }
}
