<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'modulo_id',
        'title',
        'description',
        'instructions',
        'is_published',
        'available_from',
        'due_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'available_from' => 'datetime',
        'due_at' => 'datetime',
    ];

    public function modulo(): BelongsTo
    {
        return $this->belongsTo(Modulo::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(ExamQuestion::class)->orderBy('order');
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(ExamAttempt::class);
    }
}
