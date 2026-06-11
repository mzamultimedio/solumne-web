<?php

namespace App\Filament\Resources\CursoResource\RelationManagers;

use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class AlumnosRelationManager extends RelationManager
{
    protected static string $relationship = 'alumnos';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pivot.created_at')
                    ->label('Inscrito')
                    ->dateTime()
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->label('Inscribir alumno')
                    ->preloadRecordSelect()
                    ->recordSelectSearchColumns(['name', 'email'])
                    ->recordSelectOptionsQuery(function ($query) {
                        return $query->where('role', 'alumno');
                    }),
            ])
            ->actions([
                Tables\Actions\DetachAction::make()
                    ->label('Quitar')
                    ->requiresConfirmation(),
                Tables\Actions\Action::make('asignar-modulos')
                    ->label('Asignar módulos')
                    ->icon('heroicon-o-queue-list')
                    ->form(function () {
                        $curso = $this->getOwnerRecord();

                        return [
                            Forms\Components\CheckboxList::make('modulos')
                                ->label('Selecciona los módulos disponibles')
                                ->options($curso->modulos()->orderBy('order')->pluck('title', 'id'))
                                ->columns(2)
                                ->helperText('Los módulos no seleccionados quedarán ocultos para el alumno.'),
                        ];
                    })
                    ->fillForm(function ($record) {
                        $curso = $this->getOwnerRecord();

                        $assigned = $record->assignedModulos()
                            ->where('modulos.curso_id', $curso->id)
                            ->wherePivot('status', 'unlocked')
                            ->pluck('modulos.id')
                            ->toArray();

                        return ['modulos' => $assigned];
                    })
                    ->action(function ($record, array $data) {
                        $curso = $this->getOwnerRecord();
                        $moduleIds = $curso->modulos()->pluck('id')->toArray();
                        $selected = collect($data['modulos'] ?? [])
                            ->map(fn ($id) => (int) $id)
                            ->filter()
                            ->values()
                            ->all();

                        $existingAssignments = $record->assignedModulos()
                            ->whereIn('modulo_id', $moduleIds)
                            ->get()
                            ->keyBy('id');

                        $now = now();
                        $syncPayload = collect($moduleIds)->mapWithKeys(function ($moduleId) use ($selected, $existingAssignments, $now) {
                            $isSelected = in_array((int) $moduleId, $selected, true);
                            $pivot = $existingAssignments->get($moduleId)?->pivot;

                            return [
                                $moduleId => [
                                    'status' => $isSelected ? 'unlocked' : 'locked',
                                    'assigned_at' => $isSelected
                                        ? ($pivot?->assigned_at ?? $now)
                                        : null,
                                    'available_from' => $isSelected
                                        ? ($pivot?->available_from ?? $now)
                                        : null,
                                    'available_until' => $pivot?->available_until,
                                    'released_by' => $isSelected
                                        ? auth()->id()
                                        : $pivot?->released_by,
                                    'payment_reference' => $pivot?->payment_reference,
                                    'notes' => $pivot?->notes,
                                    'revoked_at' => $isSelected ? null : ($pivot?->revoked_at),
                                ],
                            ];
                        })->toArray();

                        if (! empty($syncPayload)) {
                            $record->assignedModulos()->sync($syncPayload, false);
                        }

                        Notification::make()
                            ->success()
                            ->title('Asignaciones actualizadas')
                            ->body('Los módulos disponibles para el alumno se actualizaron correctamente.')
                            ->send();
                    })
                    ->modalSubmitActionLabel('Guardar'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
