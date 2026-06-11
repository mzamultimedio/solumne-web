<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Filament\Resources\InvoiceResource;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class InvoicesRelationManager extends RelationManager
{
    protected static string $relationship = 'invoices';

    protected static ?string $title = 'Facturas';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Facturas del alumno')
            ->columns([
                Tables\Columns\TextColumn::make('numero')->label('N°')->sortable(),
                Tables\Columns\TextColumn::make('fecha_emision')->label('Emisión')->date()->sortable(),
                Tables\Columns\TextColumn::make('alumno_curso')->label('Curso')->limit(30)->searchable(),
                Tables\Columns\TextColumn::make('cuota_nro')->label('Cuota')->searchable(),
                Tables\Columns\TextColumn::make('monto_total')->label('Monto')->money('ars', locale: 'es_AR')->sortable(),
            ])
            ->filters([])
            ->headerActions([
                Tables\Actions\Action::make('crear')
                    ->label('Crear factura')
                    ->icon('heroicon-o-plus')
                    ->url(fn () => InvoiceResource::getUrl('create', ['user_id' => $this->ownerRecord->id])),
            ])
            ->actions([
                Tables\Actions\Action::make('pdf')
                    ->label('PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn ($record) => route('invoices.pdf', $record))
                    ->openUrlInNewTab(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }
}
