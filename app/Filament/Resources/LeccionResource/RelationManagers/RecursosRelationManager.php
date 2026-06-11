<?php

namespace App\Filament\Resources\LeccionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class RecursosRelationManager extends RelationManager
{
    protected static string $relationship = 'recursos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('display_name')
                    ->label('Nombre visible')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('file_path')
                    ->label('Archivo')
                    ->required()
                    ->disk('public')
                    ->directory('recursos')
                    ->visibility('public')
                    ->acceptedFileTypes([
                        'application/pdf',
                        'image/jpeg',
                        'image/png',
                        'image/webp',
                        'video/mp4',
                        'audio/mpeg',
                        'audio/mp3',
                        'audio/ogg',
                        'audio/wav',
                    ])
                    ->downloadable()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('display_name')
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('display_name')
                    ->label('Nombre')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('file_type')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn (?string $state) => strtoupper($state ?? 'N/D')),
                Tables\Columns\TextColumn::make('file_size')
                    ->label('Tamaño')
                    ->formatStateUsing(fn (?int $state) => $state ? number_format($state / 1024, 1) . ' KB' : 'N/D')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Subido')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Nuevo recurso'),
            ])
            ->actions([
                Tables\Actions\Action::make('download')
                    ->label('Descargar')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn ($record) => Storage::disk('public')->url($record->file_path))
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make()
                    ->label('Editar'),
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
        return $this->hydrateFileMeta($data);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $this->hydrateFileMeta($data);
    }

    protected function hydrateFileMeta(array $data): array
    {
        if (! isset($data['file_path'])) {
            return $data;
        }

        $disk = Storage::disk('public');

        if (! $disk->exists($data['file_path'])) {
            return $data;
        }

        $mime = $disk->mimeType($data['file_path']) ?? '';
        $data['file_size'] = $disk->size($data['file_path']);
        $data['file_type'] = $this->determineFileType($mime);

        return $data;
    }

    protected function determineFileType(string $mimeType): string
    {
        if (str_starts_with($mimeType, 'image/')) {
            return 'image';
        }

        if (str_starts_with($mimeType, 'video/')) {
            return 'video';
        }

        if (str_starts_with($mimeType, 'audio/')) {
            return 'audio';
        }

        if ($mimeType === 'application/pdf') {
            return 'pdf';
        }

        return 'other';
    }
}
