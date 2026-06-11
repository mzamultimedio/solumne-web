<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions;

class EditInvoice extends EditRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()->label('Ver'),
            Actions\DeleteAction::make()->label('Eliminar'),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
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

    public function getTitle(): string
    {
        return 'Editar factura';
    }
}
