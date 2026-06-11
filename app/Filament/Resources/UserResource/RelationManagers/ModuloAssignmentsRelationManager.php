<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ModuloAssignmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'assignedModulos';

    public function form(Form $form): Form
    {
        return $form->schema($this->getPivotFormSchema())->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->with('curso'))
            ->columns([
                Tables\Columns\TextColumn::make('curso.title')
                    ->label('Curso')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Módulo')
                    ->searchable()
                    ->wrap(),
                Tables\Columns\BadgeColumn::make('pivot.display_status')
                    ->label('Estado')
                    ->colors([
                        'success' => fn (string $state): bool => in_array($state, ['unlocked'], true),
                        'warning' => fn (string $state): bool => in_array($state, ['scheduled', 'pending'], true),
                        'danger' => fn (string $state): bool => in_array($state, ['revoked'], true),
                        'gray' => fn (string $state): bool => in_array($state, ['locked', 'expired'], true),
                    ])
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'unlocked' => 'Disponible',
                        'scheduled' => 'Programado',
                        'locked' => 'Bloqueado',
                        'pending' => 'Pendiente',
                        'expired' => 'Finalizado',
                        'revoked' => 'Revocado',
                        default => 'Pendiente',
                    }),
                Tables\Columns\TextColumn::make('pivot.available_from')
                    ->label('Disponible desde')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('pivot.available_until')
                    ->label('Disponible hasta')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('pivot.assigned_at')
                    ->label('Liberado')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('pivot.payment_reference')
                    ->label('Referencia de pago')
                    ->limit(25)
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('pivot.status')
                    ->label('Estado')
                    ->options([
                        'unlocked' => 'Disponible',
                        'scheduled' => 'Programado',
                        'locked' => 'Bloqueado',
                        'revoked' => 'Revocado',
                    ]),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->label('Asignar módulo')
                    ->preloadRecordSelect()
                    ->recordSelectOptionsQuery(function (Builder $query): Builder {
                        $user = $this->getOwnerRecord();
                        $cursos = $user->cursos()->pluck('cursos.id');

                        return $query
                            ->whereIn('curso_id', $cursos)
                            ->orderBy('curso_id')
                            ->orderBy('order');
                    })
                    ->recordSelectSearchColumns(['title'])
                    ->form(array_merge(
                        [
                            Forms\Components\Placeholder::make('info')
                                ->label(null)
                                ->content('Los módulos disponibles dependen de los cursos asignados al alumno.'),
                        ],
                        $this->getPivotFormSchema()
                    ))
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['released_by'] = auth()->id();

                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Editar')
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['released_by'] = auth()->id();

                        return $data;
                    })
                    ->form($this->getPivotFormSchema()),
                Tables\Actions\DetachAction::make()
                    ->label('Quitar')
                    ->requiresConfirmation()
                    ->modalHeading('Revocar módulo')
                    ->modalSubheading('El módulo dejará de estar asociado al alumno inmediatamente.'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make()
                        ->label('Quitar selección')
                        ->requiresConfirmation(),
                ]),
            ]);
    }

    /**
     * Campos pivote reutilizables para las acciones de Attach/Edit.
     *
     * @return array<int, Forms\Components\Component>
     */
    protected function getPivotFormSchema(): array
    {
        return [
            Forms\Components\Select::make('status')
                ->label('Estado')
                ->options([
                    'unlocked' => 'Disponible',
                    'scheduled' => 'Programado',
                    'locked' => 'Bloqueado',
                    'revoked' => 'Revocado',
                ])
                ->default('unlocked')
                ->required(),
            Forms\Components\DateTimePicker::make('available_from')
                ->label('Disponible desde')
                ->seconds(false),
            Forms\Components\DateTimePicker::make('available_until')
                ->label('Disponible hasta')
                ->seconds(false)
                ->helperText('Opcional. Define la fecha límite en la que el acceso se revoca automáticamente.'),
            Forms\Components\TextInput::make('payment_reference')
                ->label('Referencia de pago')
                ->maxLength(120)
                ->columnSpanFull(),
            Forms\Components\Textarea::make('notes')
                ->label('Notas internas')
                ->rows(3)
                ->maxLength(500)
                ->helperText('Visible solo para el staff. Úsalo para registrar la cuota asociada o comentarios.'),
        ];
    }
}
