<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers\CursosRelationManager;
use App\Filament\Resources\UserResource\RelationManagers\ModuloAssignmentsRelationManager;
use App\Filament\Resources\UserResource\RelationManagers\InvoicesRelationManager;
use App\Filament\Resources\UserResource\RelationManagers\TeachingCoursesRelationManager;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Usuarios';

    protected static ?string $navigationGroup = 'Gestión de Usuarios';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información Personal')
                    ->description('Datos básicos del usuario')
                    ->icon('heroicon-o-user-circle')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre completo')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ej: Juan Pérez'),
                        Forms\Components\TextInput::make('email')
                            ->label('Correo electrónico')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->placeholder('ejemplo@correo.com')
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('dni')
                            ->label('DNI / Documento')
                            ->maxLength(20)
                            ->placeholder('12345678')
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('role')
                            ->label('Rol')
                            ->required()
                            ->options([
                                'admin' => 'Administrador',
                                'gestor' => 'Gestor',
                                'profesor' => 'Profesor',
                                'alumno' => 'Alumno',
                            ])
                            ->default('alumno')
                            ->disabled(fn(): bool => auth()->user()?->role !== 'admin')
                            ->native(true),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Credenciales de Acceso')
                    ->description('Contraseña para iniciar sesión')
                    ->icon('heroicon-o-lock-closed')
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->label('Contraseña')
                            ->password()
                            ->required(fn(string $operation): bool => $operation === 'create')
                            ->rule('confirmed')
                            ->dehydrated(fn(?string $state): bool => filled($state))
                            ->maxLength(255)
                            ->placeholder('Mínimo 8 caracteres'),
                        Forms\Components\TextInput::make('password_confirmation')
                            ->label('Confirmar contraseña')
                            ->password()
                            ->required(fn(string $operation): bool => $operation === 'create')
                            ->dehydrated(false)
                            ->placeholder('Repetir contraseña'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        $table = $table
            ->modifyQueryUsing(fn($query) => $query->withCount('cursos'))
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Usuario')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn(User $record): string => $record->email)
                    ->icon('heroicon-o-user-circle')
                    ->iconColor('info'),
                Tables\Columns\TextColumn::make('dni')
                    ->label('DNI')
                    ->searchable()
                    ->sortable()
                    ->placeholder('Sin DNI')
                    ->icon('heroicon-o-identification')
                    ->iconColor('gray')
                    ->copyable()
                    ->copyMessage('DNI copiado')
                    ->copyMessageDuration(1500),
                Tables\Columns\TextColumn::make('role')
                    ->label('Rol')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'admin' => 'danger',
                        'gestor' => 'warning',
                        'profesor' => 'info',
                        default => 'success',
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'admin' => 'heroicon-o-shield-check',
                        'gestor' => 'heroicon-o-briefcase',
                        'profesor' => 'heroicon-o-presentation-chart-line',
                        default => 'heroicon-o-academic-cap',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'admin' => 'Administrador',
                        'gestor' => 'Gestor',
                        'profesor' => 'Profesor',
                        default => 'Alumno',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('cursos_count')
                    ->counts('cursos')
                    ->label('Cursos')
                    ->badge()
                    ->color(fn($state): string => $state > 0 ? 'info' : 'gray')
                    ->icon('heroicon-o-academic-cap')
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Registrado')
                    ->since()
                    ->sortable()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->label('Filtrar por rol')
                    ->options([
                        'admin' => 'Administrador',
                        'gestor' => 'Gestor',
                        'profesor' => 'Profesor',
                        'alumno' => 'Alumno',
                    ])
                    ->native(false),
                Tables\Filters\Filter::make('con_cursos')
                    ->label('Con cursos asignados')
                    ->query(fn($query) => $query->has('cursos')),
                Tables\Filters\Filter::make('sin_cursos')
                    ->label('Sin cursos')
                    ->query(fn($query) => $query->doesntHave('cursos')),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('asignar_cursos')
                        ->label('Asignar cursos')
                        ->icon('heroicon-o-academic-cap')
                        ->color('success')
                        ->visible(fn(User $record): bool => $record->role === 'profesor')
                        ->form(function (User $record) {
                            $assignedIds = $record->teachingCourses()->pluck('cursos.id')->toArray();

                            return [
                                Forms\Components\Select::make('curso_ids')
                                    ->label('Cursos')
                                    ->multiple()
                                    ->options(
                                        \App\Models\Curso::whereNotIn('id', $assignedIds)
                                            ->orderBy('title')
                                            ->pluck('title', 'id')
                                    )
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->helperText('Cursos que el profesor podrá gestionar'),
                            ];
                        })
                        ->action(function (User $record, array $data): void {
                            $record->teachingCourses()->attach($data['curso_ids']);

                            Notification::make()
                                ->success()
                                ->title('Cursos asignados')
                                ->body('Se asignaron ' . count($data['curso_ids']) . ' curso(s) al profesor.')
                                ->send();
                        })
                        ->modalHeading(fn(User $record) => "Asignar cursos a {$record->name}")
                        ->modalSubmitActionLabel('Asignar'),
                    Tables\Actions\ViewAction::make()
                        ->icon('heroicon-o-eye')
                        ->visible(fn(): bool => auth()->user()?->role === 'admin'),
                    Tables\Actions\EditAction::make()
                        ->icon('heroicon-o-pencil-square')
                        ->visible(fn(): bool => auth()->user()?->role === 'admin'),
                    Tables\Actions\DeleteAction::make()
                        ->icon('heroicon-o-trash')
                        ->visible(fn(User $record): bool => auth()->user()?->role === 'admin' && auth()->id() !== $record->id),
                ]),
            ])
            ->striped()
            ->emptyStateHeading('No hay usuarios')
            ->emptyStateDescription('Crea tu primer usuario para empezar.')
            ->emptyStateIcon('heroicon-o-users')
            ->emptyStateActions([
                Tables\Actions\Action::make('crear')
                    ->label('Crear usuario')
                    ->icon('heroicon-o-plus')
                    ->url(static::getUrl('create'))
                    ->visible(fn(): bool => auth()->user()?->role === 'admin'),
            ]);

        if (auth()->user()?->role === 'admin') {
            $table->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
        } else {
            $table->bulkActions([]);
        }

        return $table;
    }

    public static function getRelations(): array
    {
        if (auth()->user()?->role !== 'admin') {
            return [];
        }

        return [
            TeachingCoursesRelationManager::class, // Cursos que enseña (solo visible para profesores)
            CursosRelationManager::class,
            ModuloAssignmentsRelationManager::class,
            InvoicesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return in_array(auth()->user()?->role, ['admin', 'gestor'], true);
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
        return auth()->user()?->role === 'admin';
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->role === 'admin' && auth()->id() !== $record->id;
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()?->role === 'admin';
    }
}
