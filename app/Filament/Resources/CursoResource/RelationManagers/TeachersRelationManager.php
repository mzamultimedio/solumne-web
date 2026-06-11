<?php

namespace App\Filament\Resources\CursoResource\RelationManagers;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class TeachersRelationManager extends RelationManager
{
    protected static string $relationship = 'teachers';

    protected static ?string $title = 'Docentes Asignados';

    protected static ?string $modelLabel = 'Docente';

    protected static ?string $pluralModelLabel = 'Docentes';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->icon('heroicon-o-user')
                    ->description(fn(User $record): string => $record->email),

                Tables\Columns\TextColumn::make('dni')
                    ->label('DNI')
                    ->placeholder('Sin DNI'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Asignado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\Action::make('asignar')
                    ->label('Asignar Docentes')
                    ->icon('heroicon-o-user-plus')
                    ->color('primary')
                    ->form([
                        Forms\Components\Select::make('teacher_ids')
                            ->label('Seleccionar profesores')
                            ->multiple()
                            ->options(function () {
                                // Obtener IDs de profesores ya asignados a este curso
                                $assignedIds = $this->getOwnerRecord()->teachers()->pluck('users.id')->toArray();

                                // Retornar profesores NO asignados
                                return User::where('role', 'profesor')
                                    ->whereNotIn('id', $assignedIds)
                                    ->orderBy('name')
                                    ->get()
                                    ->mapWithKeys(fn($user) => [
                                        $user->id => "{$user->name} ({$user->email})"
                                    ]);
                            })
                            ->searchable()
                            ->preload()
                            ->required()
                            ->helperText('Solo se muestran usuarios con rol Profesor'),
                    ])
                    ->action(function (array $data): void {
                        $curso = $this->getOwnerRecord();
                        $curso->teachers()->attach($data['teacher_ids']);

                        $count = count($data['teacher_ids']);
                        Notification::make()
                            ->success()
                            ->title('Docentes asignados')
                            ->body("Se asignaron {$count} docente(s) al curso.")
                            ->send();
                    })
                    ->modalHeading('Asignar Docentes al Curso')
                    ->modalSubmitActionLabel('Asignar seleccionados'),
            ])
            ->actions([
                Tables\Actions\DetachAction::make()
                    ->label('Desasignar')
                    ->icon('heroicon-o-x-mark'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Sin docentes asignados')
            ->emptyStateDescription('Asigna profesores para que puedan gestionar este curso.')
            ->emptyStateIcon('heroicon-o-user-group');
    }
}
