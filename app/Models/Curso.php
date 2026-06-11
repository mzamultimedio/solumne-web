<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use App\Models\Exam;
use App\Models\Invoice;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image_path',
    ];

    /**
     * Get the modulos for the curso.
     */
    public function modulos(): HasMany
    {
        return $this->hasMany(Modulo::class)->orderBy('order');
    }

    /**
     * The alumnos that belong to the curso.
     */
    public function alumnos(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'curso_user');
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'curso_teacher', 'curso_id', 'user_id');
    }

    public function exams(): HasManyThrough
    {
        return $this->hasManyThrough(Exam::class, Modulo::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
