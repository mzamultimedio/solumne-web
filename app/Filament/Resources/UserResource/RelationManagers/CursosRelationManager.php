<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Models\Curso;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class CursosRelationManager extends RelationManager
{
    protected static string $relationship = 'cursos';

    protected static ?string $title = 'Cursos Inscripto (Alumno)';

    public function table(Table $table): Table
    {
        // Obtener IDs de cursos ya asignados
        $assignedIds = $this->getOwnerRecord()
            ->cursos()
            ->pluck('cursos.id')
            ->toArray();

        // Cursos disponibles
        $availableCourses = Curso::whereNotIn('id', $assignedIds)
            ->orderBy('title')
            ->pluck('title', 'id')
            ->toArray();

        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Curso')
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('pivot.created_at')
                    ->label('Asignado')
                    ->since()
                    ->sortable(),
            ])
            ->filters([])
            ->headerActions([
                Tables\Actions\Action::make('asignar_curso')
                    ->label('Asignar curso')
                    ->icon('heroicon-o-plus')
                    ->color('primary')
                    ->form([
                        Forms\Components\Select::make('curso_ids')
                            ->label('Seleccionar cursos')
                            ->multiple()
                            ->options($availableCourses)
                            ->searchable()
                            ->required(),
                    ])
                    ->action(function (array $data): void {
                        $user = $this->getOwnerRecord();
                        $user->cursos()->attach($data['curso_ids']);

                        Notification::make()
                            ->success()
                            ->title('Cursos asignados')
                            ->body('Se asignaron ' . count($data['curso_ids']) . ' curso(s).')
                            ->send();
                    })
                    ->modalHeading('Asignar Cursos')
                    ->modalSubmitActionLabel('Asignar')
                    ->disabled(empty($availableCourses)),
            ])
            ->actions([
                Tables\Actions\DetachAction::make()
                    ->label('Quitar')
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
