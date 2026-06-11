<?php

namespace App\Models\Pivots;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Carbon;

class ModuloUser extends Pivot
{
    protected $table = 'modulo_user';

    protected $casts = [
        'assigned_at' => 'datetime',
        'available_from' => 'datetime',
        'available_until' => 'datetime',
        'revoked_at' => 'datetime',
    ];

    protected $appends = [
        'is_accessible',
        'display_status',
    ];

    protected static function booted(): void
    {
        static::saving(function (ModuloUser $pivot): void {
            $now = Carbon::now();

            if ($pivot->status === 'unlocked') {
                if (blank($pivot->assigned_at)) {
                    $pivot->assigned_at = $now;
                }

                if (blank($pivot->available_from) || $pivot->available_from->greaterThan($pivot->assigned_at)) {
                    $pivot->available_from = $pivot->assigned_at;
                }

                $pivot->revoked_at = null;
            }

            if ($pivot->status === 'scheduled') {
                if (blank($pivot->available_from)) {
                    $pivot->available_from = $now->copy()->addDay();
                }

                $pivot->revoked_at = null;
            }

            if ($pivot->status === 'revoked' && blank($pivot->revoked_at)) {
                $pivot->revoked_at = $now;
            }

            if (
                in_array($pivot->status, ['locked', 'scheduled'], true)
                && $pivot->available_until instanceof Carbon
                && $pivot->available_from instanceof Carbon
                && $pivot->available_until->lessThan($pivot->available_from)
            ) {
                $pivot->available_until = $pivot->available_from;
            }
        });
    }

    protected function isAccessible(): Attribute
    {
        return Attribute::get(function (): bool {
            if ($this->status === 'revoked') {
                return false;
            }

            if ($this->available_until instanceof Carbon && $this->available_until->isPast()) {
                return false;
            }

            if ($this->available_from instanceof Carbon && $this->available_from->isFuture()) {
                return false;
            }

            return in_array($this->status, ['unlocked', 'scheduled'], true);
        });
    }

    protected function displayStatus(): Attribute
    {
        return Attribute::get(function (): string {
            if ($this->status === 'revoked') {
                return 'revoked';
            }

            if ($this->available_from instanceof Carbon && $this->available_from->isFuture()) {
                return 'scheduled';
            }

            if ($this->available_until instanceof Carbon && $this->available_until->isPast()) {
                return 'expired';
            }

            return $this->status ?? 'locked';
        });
    }
}
