<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'letra',
        'numero',
        'user_id',
        'curso_id',
        'alumno_nombre',
        'alumno_curso',
        'receptor_documento',
        'receptor_condicion_iva',
        'receptor_domicilio',
        'emisor_razon_social',
        'emisor_domicilio',
        'emisor_condicion_iva',
        'emisor_cuit',
        'emisor_ing_brutos',
        'emisor_inicio_actividades',
        'fecha_emision',
        'fecha_pago',
        'forma_pago',
        'cuota_nro',
        'monto_total',
    ];

    protected $attributes = [
        'emisor_domicilio' => 'n/a',
        'emisor_condicion_iva' => 'n/a',
        'emisor_cuit' => 'n/a',
        'emisor_ing_brutos' => 'n/a',
        'receptor_condicion_iva' => 'n/a',
        'receptor_domicilio' => 'n/a',
        'forma_pago' => 'n/a',
    ];

    protected $casts = [
        'emisor_inicio_actividades' => 'date',
        'fecha_emision' => 'date',
        'fecha_pago' => 'date',
        'monto_total' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::creating(function (Invoice $invoice): void {
            if (blank($invoice->numero)) {
                $invoice->numero = static::nextNumero();
            }
        });

        static::saved(function (Invoice $invoice): void {
            $total = $invoice->items()->selectRaw('SUM(importe - descuento) as total')->value('total') ?? 0;

            $subtotalUpdates = $invoice->items->map(function ($item) {
                $item->subtotal = ($item->importe - $item->descuento);
                return $item;
            });

            foreach ($subtotalUpdates as $item) {
                if ($item->isDirty('subtotal')) {
                    $item->saveQuietly();
                }
            }

            if (round((float) $invoice->monto_total, 2) !== round((float) $total, 2)) {
                $invoice->forceFill(['monto_total' => $total])->saveQuietly();
            }
        });
    }

    public static function nextNumero(): int
    {
        return DB::transaction(function (): int {
            $max = DB::table('invoices')->lockForUpdate()->max('numero');

            return ((int) $max) + 1;
        }, 3);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class)->orderBy('position');
    }
}
