<?php

namespace App\Filament\Resources\CursoResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ModulosRelationManager extends RelationManager
{
    protected static string $relationship = 'modulos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('order')
                    ->label('Orden')
                    ->numeric()
                    ->minValue(0)
                    ->default(fn (): int => (int) $this->getOwnerRecord()->modulos()->max('order') + 1),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->modifyQueryUsing(fn ($query) => $query->withCount('lecciones'))
            ->defaultSort('order')
            ->reorderable('order')
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->label('#')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('lecciones_count')
                    ->label('Lecciones')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Nuevo módulo'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Editar'),
                Tables\Actions\Action::make('manage')
                    ->label('Gestionar lecciones')
                    ->icon('heroicon-o-squares-2x2')
                    ->url(fn ($record) => \App\Filament\Resources\ModuloResource::getUrl('edit', ['record' => $record]))
                    ->openUrlInNewTab(),
                Tables\Actions\DeleteAction::make()
                    ->label('Eliminar'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['order'] = $data['order'] ?? ((int) $this->getOwnerRecord()->modulos()->max('order') + 1);

        return $data;
    }
}
