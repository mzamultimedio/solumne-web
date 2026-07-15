<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\InvoiceResource;
use App\Models\Invoice;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PendingInvoicesWidget extends BaseWidget
{
    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = [
        'md' => 1,
        'lg' => 1,
    ];

    protected static ?string $heading = 'Facturas Pendientes';

    public static function canView(): bool
    {
        return in_array(auth()->user()?->role, ['admin', 'gestor'], true);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Invoice::query()
                    ->whereNull('fecha_pago')
                    ->with('user')
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('numero')
                    ->label('#')
                    ->searchable()
                    ->icon('heroicon-o-document-text')
                    ->iconColor('warning'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Alumno')
                    ->limit(15)
                    ->tooltip(fn($record) => $record->user?->name),
                Tables\Columns\TextColumn::make('monto_total')
                    ->label('Monto')
                    ->money('ARS')
                    ->color('success'),
                Tables\Columns\TextColumn::make('fecha_emision')
                    ->label('Fecha')
                    ->date('d/m')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Ver')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->url(fn(Invoice $record) => InvoiceResource::getUrl('view', ['record' => $record])),
            ])
            ->emptyStateHeading('Sin pendientes')
            ->emptyStateDescription('Todas las facturas están pagadas.')
            ->emptyStateIcon('heroicon-o-banknotes')
            ->striped()
            ->paginated(false);
    }
}
