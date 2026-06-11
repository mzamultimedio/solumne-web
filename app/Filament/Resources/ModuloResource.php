<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ModuloResource\Pages;
use App\Filament\Resources\ModuloResource\RelationManagers\ExamAttemptsRelationManager;
use App\Filament\Resources\ModuloResource\RelationManagers\ExamRelationManager;
use App\Filament\Resources\ModuloResource\RelationManagers\LeccionesRelationManager;
use App\Models\Modulo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ModuloResource extends Resource
{
    protected static ?string $model = Modulo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Gestión Académica';

    protected static ?string $navigationLabel = 'Módulos';

    protected static ?int $navigationSort = 2;

    protected static bool $shouldRegisterNavigation = true;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información del Módulo')
                    ->description('Organiza el contenido de tus cursos.')
                    ->icon('heroicon-o-rectangle-stack')
                    ->schema([
                        Forms\Components\Select::make('curso_id')
                            ->label('Curso al que pertenece')
                            ->relationship('curso', 'title')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpanFull()
                            ->native(false),
                        Forms\Components\TextInput::make('title')
                            ->label('Título del Módulo')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2)
                            ->placeholder('Ej: Introducción, Unidad 1, etc.'),
                        Forms\Components\TextInput::make('order')
                            ->label('Orden')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->columnSpan(1)
                            ->helperText('Define la posición del módulo en el curso.'),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('curso_id') // Agrupar visualmente por curso primero
            ->modifyQueryUsing(fn($query) => $query->withCount('lecciones'))
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Módulo')
                    ->searchable()
                    ->weight('bold')
                    ->description(fn(Modulo $record): string => $record->curso->title ?? 'Sin curso asignado')
                    ->icon('heroicon-o-rectangle-stack'),
                Tables\Columns\TextColumn::make('lecciones_count')
                    ->label('Lecciones')
                    ->badge()
                    ->color(fn($state): string => $state > 0 ? 'info' : 'gray')
                    ->sortable(),
                Tables\Columns\TextInputColumn::make('order')
                    ->label('Orden')
                    ->sortable()
                    ->type('number')
                    ->alignCenter()
                    ->rules(['numeric', 'min:0']),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->since()
                    ->sortable()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('curso_id')
                    ->label('Filtrar por Curso')
                    ->relationship('curso', 'title')
                    ->searchable()
                    ->preload()
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->label('Editar')
                        ->icon('heroicon-o-pencil-square')
                        ->color('warning'),
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
            ->emptyStateHeading('No hay módulos')
            ->emptyStateDescription('Crea módulos para organizar tus lecciones.')
            ->emptyStateIcon('heroicon-o-rectangle-stack')
            ->emptyStateActions([
                Tables\Actions\Action::make('crear')
                    ->label('Crear módulo')
                    ->icon('heroicon-o-plus')
                    ->url(static::getUrl('create')),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            LeccionesRelationManager::class,
            ExamRelationManager::class,
            ExamAttemptsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListModulos::route('/'),
            'create' => Pages\CreateModulo::route('/create'),
            'edit' => Pages\EditModulo::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (auth()->user()?->role === 'profesor') {
            $query->whereHas('curso', function ($q) {
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
