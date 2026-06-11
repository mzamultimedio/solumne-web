<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recurso extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'leccion_id',
        'display_name',
        'file_path',
        'file_size',
        'file_type', // <-- CAMPO AÑADIDO
    ];

    /**
     * Ensure legacy registros without file_type still report a usable type.
     */
    public function getFileTypeAttribute($value): ?string
    {
        if ($value) {
            return $value;
        }

        $path = $this->attributes['file_path'] ?? null;
        if (! $path) {
            return null;
        }

        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        return match ($extension) {
            'jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp' => 'image',
            'mp4', 'mov', 'avi', 'mkv', 'webm', 'm4v' => 'video',
            'mp3', 'wav', 'ogg', 'm4a', 'aac', 'flac' => 'audio',
            'pdf' => 'pdf',
            default => 'other',
        };
    }

    /**
     * Get the leccion that owns the recurso.
     */
    public function leccion(): BelongsTo
    {
        return $this->belongsTo(Leccion::class);
    }
}
