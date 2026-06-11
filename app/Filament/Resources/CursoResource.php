<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CursoResource\Pages;
use App\Filament\Resources\CursoResource\RelationManagers\AlumnosRelationManager;
use App\Filament\Resources\CursoResource\RelationManagers\ModulosRelationManager;
use App\Filament\Resources\CursoResource\RelationManagers\TeachersRelationManager;
use App\Models\Curso;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CursoResource extends Resource
{
    protected static ?string $model = Curso::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Cursos';

    protected static ?string $modelLabel = 'Curso';

    protected static ?string $pluralLabel = 'Cursos';

    protected static ?string $navigationGroup = 'Gestión Académica';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información del curso')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->reactive()
                            ->disabled(fn() => auth()->user()?->role === 'profesor')
                            ->afterStateUpdated(function (Set $set, ?string $state): void {
                                $set('slug', Str::slug($state ?? ''));
                            }),
                        Forms\Components\Textarea::make('description')
                            ->label('Descripción')
                            ->required()
                            ->rows(6)
                            ->disabled(fn() => auth()->user()?->role === 'profesor')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Imagen de portada')
                            ->image()
                            ->imageEditor()
                            ->directory('cursos')
                            ->disk('public')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->imagePreviewHeight('200')
                            ->downloadable()
                            ->disabled(fn() => auth()->user()?->role === 'profesor'),
                        Forms\Components\Hidden::make('slug')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn($query) => $query->withCount(['modulos', 'alumnos']))
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\ViewColumn::make('image_path')
                    ->label('')
                    ->view('filament.tables.columns.course-image')
                    ->grow(false),
                TextColumn::make('title')
                    ->label('Curso')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->wrap()
                    ->description(fn(Curso $record): string => Str::limit($record->description ?? '', 80)),
                TextColumn::make('modulos_count')
                    ->label('Módulos')
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-o-rectangle-stack')
                    ->sortable()
                    ->alignCenter(),
                TextColumn::make('alumnos_count')
                    ->label('Alumnos')
                    ->badge()
                    ->color(fn($state): string => $state > 0 ? 'success' : 'gray')
                    ->icon('heroicon-o-users')
                    ->sortable()
                    ->alignCenter(),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->since()
                    ->sortable()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                Tables\Filters\Filter::make('con_alumnos')
                    ->label('Con alumnos inscriptos')
                    ->query(fn($query) => $query->has('alumnos')),
                Tables\Filters\Filter::make('sin_alumnos')
                    ->label('Sin alumnos')
                    ->query(fn($query) => $query->doesntHave('alumnos')),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->icon('heroicon-o-pencil-square'),
                    Tables\Actions\Action::make('ver_alumnos')
                        ->label('Ver alumnos')
                        ->icon('heroicon-o-users')
                        ->color('info')
                        ->url(fn(Curso $record) => static::getUrl('edit', ['record' => $record]) . '?activeRelationManager=1'),
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
            ->emptyStateHeading(fn(): string => auth()->user()?->role === 'profesor'
                ? 'Sin cursos asignados'
                : 'No hay cursos')
            ->emptyStateDescription(fn(): string => auth()->user()?->role === 'profesor'
                ? 'Aún no tienes cursos asignados. Contacta al administrador para que te asigne cursos.'
                : 'Crea tu primer curso para empezar.')
            ->emptyStateIcon('heroicon-o-academic-cap')
            ->emptyStateActions([
                Tables\Actions\Action::make('crear')
                    ->label('Crear curso')
                    ->icon('heroicon-o-plus')
                    ->url(static::getUrl('create'))
                    ->visible(fn(): bool => static::canCreate()),
            ]);
    }

    public static function getRelations(): array
    {
        $relations = [
            ModulosRelationManager::class,
            AlumnosRelationManager::class,
        ];

        if (auth()->user()?->role === 'admin') {
            $relations[] = TeachersRelationManager::class;
        }

        return $relations;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCursos::route('/'),
            'create' => Pages\CreateCurso::route('/create'),
            'edit' => Pages\EditCurso::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'description'];
    }

    public static function generateUniqueSlug(string $title, ?Curso $record = null): string
    {
        $slug = Str::slug($title);
        $slug = $slug !== '' ? $slug : Str::random(8);
        $baseSlug = $slug;
        $counter = 1;

        while (
            Curso::query()
                ->where('slug', $slug)
                ->when($record, fn($query) => $query->whereKeyNot($record->getKey()))
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (auth()->user()?->role === 'profesor') {
            $query->whereHas('teachers', function ($q) {
                $q->where('users.id', auth()->id());
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
        return auth()->user()?->role === 'admin';
    }

    public static function canEdit(Model $record): bool
    {
        return static::canViewAny(); // Profesores necesitan entrar a 'Editar' para gestionar módulos
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->role === 'admin';
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()?->role === 'admin';
    }
}
