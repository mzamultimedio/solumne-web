<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Models\Curso;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class TeachingCoursesRelationManager extends RelationManager
{
    protected static string $relationship = 'teachingCourses';

    protected static ?string $title = 'Cursos que Enseña';

    protected static ?string $modelLabel = 'Curso asignado';

    protected static ?string $pluralModelLabel = 'Cursos asignados';

    public static function canViewForRecord($ownerRecord, string $pageClass): bool
    {
        return $ownerRecord->role === 'profesor';
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('')
                    ->disk('public')
                    ->circular()
                    ->size(40)
                    ->defaultImageUrl(fn() => 'https://ui-avatars.com/api/?name=C&background=random'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Curso')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->description(fn(Curso $record): string => $record->modulos()->count() . ' módulos'),

                Tables\Columns\TextColumn::make('alumnos_count')
                    ->counts('alumnos')
                    ->label('Alumnos')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('pivot.created_at')
                    ->label('Asignado')
                    ->since()
                    ->sortable(),
            ])
            ->filters([])
            ->headerActions([
                Tables\Actions\Action::make('asignar_curso')
                    ->label('Asignar Curso')
                    ->icon('heroicon-o-academic-cap')
                    ->color('primary')
                    ->form(function () {
                        $owner = $this->getOwnerRecord();

                        // Obtener IDs de cursos ya asignados
                        $assignedIds = $owner->teachingCourses()->pluck('cursos.id')->toArray();

                        return [
                            Forms\Components\Select::make('curso_ids')
                                ->label('Seleccionar cursos')
                                ->multiple()
                                ->options(function () use ($assignedIds) {
                                    return Curso::whereNotIn('id', $assignedIds)
                                        ->orderBy('title')
                                        ->pluck('title', 'id');
                                })
                                ->searchable()
                                ->required()
                                ->native(false)
                                ->helperText(function () use ($assignedIds) {
                                    $count = Curso::whereNotIn('id', $assignedIds)->count();
                                    return "Selecciona los cursos que este profesor podrá gestionar ({$count} disponibles)";
                                }),
                        ];
                    })
                    ->action(function (array $data): void {
                        $user = $this->getOwnerRecord();
                        $user->teachingCourses()->attach($data['curso_ids']);

                        $count = count($data['curso_ids']);
                        Notification::make()
                            ->success()
                            ->title('Cursos asignados')
                            ->body("Se asignaron {$count} curso(s) al profesor.")
                            ->send();
                    })
                    ->modalHeading('Asignar Cursos al Profesor')
                    ->modalSubmitActionLabel('Asignar seleccionados'),
            ])
            ->actions([
                Tables\Actions\DetachAction::make()
                    ->label('Quitar')
                    ->icon('heroicon-o-x-mark')
                    ->requiresConfirmation()
                    ->modalHeading('¿Quitar asignación?')
                    ->modalDescription('El profesor ya no podrá gestionar este curso.'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make()
                        ->label('Quitar seleccionados'),
                ]),
            ])
            ->emptyStateHeading('Sin cursos asignados')
            ->emptyStateDescription('Este profesor aún no tiene cursos asignados para gestionar.')
            ->emptyStateIcon('heroicon-o-academic-cap');
    }
}
