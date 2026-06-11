<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecursoResource\Pages;
use App\Models\Recurso;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RecursoResource extends Resource
{
    protected static ?string $model = Recurso::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-clip';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('leccion_id')
                    ->label('Lección')
                    ->relationship('leccion', 'title')
                    ->searchable()
                    ->preload()
                    ->required(),
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

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->modifyQueryUsing(fn ($query) => $query->with('leccion.modulo.curso'))
            ->columns([
                Tables\Columns\TextColumn::make('leccion.title')
                    ->label('Lección')
                    ->sortable(),
                Tables\Columns\TextColumn::make('leccion.modulo.title')
                    ->label('Módulo')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('leccion.modulo.curso.title')
                    ->label('Curso')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('display_name')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('file_path')
                    ->label('Ruta')
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
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecursos::route('/'),
            'create' => Pages\CreateRecurso::route('/create'),
            'edit' => Pages\EditRecurso::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->role === 'admin';
    }

    public static function canView(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canCreate(): bool
    {
        return static::canViewAny();
    }

    public static function canEdit(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canDelete(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canDeleteAny(): bool
    {
        return static::canViewAny();
    }

    public static function applyFileMetadata(array $data): array
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
        $data['file_type'] = static::determineFileType($mime);

        return $data;
    }

    protected static function determineFileType(string $mimeType): string
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
