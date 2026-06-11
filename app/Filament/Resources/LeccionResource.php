<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeccionResource\Pages;
use App\Filament\Resources\LeccionResource\RelationManagers\RecursosRelationManager;
use App\Models\Curso;
use App\Models\Leccion;
use App\Models\Modulo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class LeccionResource extends Resource
{
    protected static ?string $model = Leccion::class;

    protected static ?string $navigationIcon = 'heroicon-o-play-circle';

    protected static ?string $navigationGroup = 'Gestión Académica';

    protected static ?string $navigationLabel = 'Lecciones';

    protected static ?string $pluralModelLabel = 'Lecciones';

    protected static ?string $modelLabel = 'Lección';

    protected static ?int $navigationSort = 3;

    protected static bool $shouldRegisterNavigation = true;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Ubicación de la Lección')
                    ->description('Selecciona dónde aparecerá esta lección.')
                    ->icon('heroicon-o-map-pin')
                    ->schema([
                        Forms\Components\Select::make('curso_filter')
                            ->label('Filtrar por Curso')
                            ->options(Curso::query()->pluck('title', 'id'))
                            ->default(fn($record) => $record?->modulo?->curso_id)
                            ->live()
                            ->afterStateUpdated(fn(Set $set) => $set('modulo_id', null))
                            ->dehydrated(false)
                            ->searchable()
                            ->preload()
                            ->columnSpan(1),

                        Forms\Components\Select::make('modulo_id')
                            ->label('Asignar al Módulo')
                            ->options(fn(Get $get) => Modulo::query()
                                ->where('curso_id', $get('curso_filter'))
                                ->pluck('title', 'id'))
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live()
                            ->helperText(fn(Get $get) => $get('curso_filter') ? 'Selecciona un módulo del curso elegido.' : 'Primero selecciona un curso para ver sus módulos.')
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('order')
                            ->label('Orden')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->columnSpan(1),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Contenido')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Título de la Lección')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ej: Cómo empezar...'),

                        Forms\Components\TextInput::make('video_url')
                            ->label('URL del Video (YouTube/Vimeo)')
                            ->placeholder('https://youtube.com/watch?v=...')
                            ->url()
                            ->maxLength(255)
                            ->prefixIcon('heroicon-o-video-camera')
                            ->helperText('Pega el enlace directo al video. Si no hay video, deja en blanco.'),

                        Forms\Components\RichEditor::make('text_content')
                            ->label('Contenido de Texto')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'h2',
                                'h3',
                                'bulletList',
                                'orderedList',
                                'link',
                                'codeBlock',
                                'blockquote',
                                'redo',
                                'undo'
                            ])
                            ->placeholder('Escribe aquí el contenido teórico de la lección...')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Lección')
                    ->searchable()
                    ->weight('bold')
                    ->icon('heroicon-o-play-circle')
                    ->iconColor('primary')
                    ->wrap(),

                Tables\Columns\TextColumn::make('modulo.title')
                    ->label('Módulo')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->description(fn(Leccion $record): string => $record->modulo->curso->title ?? 'Sin Curso'),

                Tables\Columns\IconColumn::make('video_url')
                    ->label('Video')
                    ->boolean()
                    ->trueIcon('heroicon-o-video-camera')
                    ->falseIcon('heroicon-o-document-text')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->alignCenter(),

                Tables\Columns\TextInputColumn::make('order')
                    ->label('Orden')
                    ->sortable()
                    ->type('number')
                    ->alignCenter()
                    ->rules(['numeric', 'min:0']),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('curso')
                    ->label('Filtrar por Curso')
                    ->relationship('modulo.curso', 'title')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->label('Editar')
                        ->icon('heroicon-o-pencil-square'),
                    Tables\Actions\DeleteAction::make()
                        ->icon('heroicon-o-trash'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->striped()
            ->emptyStateHeading('No hay lecciones')
            ->emptyStateDescription('Empieza creando contenido para tus módulos.')
            ->emptyStateIcon('heroicon-o-academic-cap')
            ->emptyStateActions([
                Tables\Actions\Action::make('crear')
                    ->label('Crear lección')
                    ->icon('heroicon-o-plus')
                    ->url(static::getUrl('create')),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RecursosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeccions::route('/'),
            'create' => Pages\CreateLeccion::route('/create'),
            'edit' => Pages\EditLeccion::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (auth()->user()?->role === 'profesor') {
            $query->whereHas('modulo.curso', function ($q) {
                $q->whereHas('teachers', function ($q2) {
                    $q2->where('users.id', auth()->id());
                });
            });
        }

        return $query;
    }

    public static function canViewAny(): bool
    {
        return in_array(auth()->user()?->role, ['admin', 'profesor'], true);
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
}
