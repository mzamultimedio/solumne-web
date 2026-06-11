<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Leccion extends Model
{
    use HasFactory;

    protected $fillable = [
        'modulo_id',
        'title',
        'video_url',
        'text_content',
        'order',
    ];

    public function modulo(): BelongsTo
    {
        return $this->belongsTo(Modulo::class);
    }

    public function recursos(): HasMany
    {
        return $this->hasMany(Recurso::class);
    }

    public function completedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'leccion_user')->withTimestamps();
    }
}