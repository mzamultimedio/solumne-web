<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use Filament\Resources\Pages\CreateRecord;

class CreateInvoice extends CreateRecord
{
    protected static string $resource = InvoiceResource::class;

    public function getTitle(): string
    {
        return 'Crear factura';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['monto_total'] = InvoiceResource::sumItems($data['items'] ?? []);

        $data['items'] = collect($data['items'] ?? [])
            ->map(function ($item) {
                $item['subtotal'] = InvoiceResource::calcSubtotal($item['importe'] ?? 0, $item['descuento'] ?? 0);
                return $item;
            })
            ->toArray();

        return $data;
    }
}
