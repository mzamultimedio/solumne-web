<?php

namespace App\Filament\Resources\ModuloResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class LeccionesRelationManager extends RelationManager
{
    protected static string $relationship = 'lecciones';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('video_url')
                    ->label('URL del video')
                    ->url()
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->placeholder('https://'),
                Forms\Components\RichEditor::make('text_content')
                    ->label('Contenido')
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'bulletList',
                        'orderedList',
                        'link',
                        'blockquote',
                        'codeBlock',
                        'redo',
                        'undo',
                    ]),
                Forms\Components\TextInput::make('order')
                    ->label('Orden')
                    ->numeric()
                    ->default(fn (): int => (int) $this->getOwnerRecord()->lecciones()->max('order') + 1)
                    ->minValue(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
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
                Tables\Columns\TextColumn::make('video_url')
                    ->label('Video')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->wrap(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Nueva lección'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Editar'),
                Tables\Actions\Action::make('manage')
                    ->label('Gestionar recursos')
                    ->icon('heroicon-o-folder-open')
                    ->url(fn ($record) => \App\Filament\Resources\LeccionResource::getUrl('edit', ['record' => $record]))
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
        $data['order'] = $data['order'] ?? ((int) $this->getOwnerRecord()->lecciones()->max('order') + 1);

        return $data;
    }
}
