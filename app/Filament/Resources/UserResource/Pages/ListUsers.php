<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\Curso;
use Filament\Actions;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->visible(fn(): bool => auth()->user()?->role === 'admin'),

            Actions\Action::make('asignar_profesor_curso')
                ->label('Asignar Profesor a Curso')
                ->icon('heroicon-o-academic-cap')
                ->color('success')
                ->form([
                    Forms\Components\Select::make('profesor_id')
                        ->label('Profesor')
                        ->options(
                            \App\Models\User::where('role', 'profesor')
                                ->orderBy('name')
                                ->get()
                                ->mapWithKeys(fn($user) => [$user->id => "{$user->name} ({$user->email})"])
                        )
                        ->searchable()
                        ->required()
                        ->live()
                        ->afterStateUpdated(function ($state, Forms\Set $set) {
                            if ($state) {
                                $profesor = \App\Models\User::find($state);
                                $assignedIds = $profesor->teachingCourses()->pluck('cursos.id')->toArray();
                                $set('_assigned_count', count($assignedIds));
                            }
                        }),

                    Forms\Components\Placeholder::make('_assigned_info')
                        ->label('Cursos ya asignados')
                        ->content(function (Forms\Get $get) {
                            $profesorId = $get('profesor_id');
                            if (!$profesorId) {
                                return 'Selecciona un profesor primero';
                            }
                            $profesor = \App\Models\User::find($profesorId);
                            $count = $profesor->teachingCourses()->count();
                            return $count > 0
                                ? "{$count} curso(s) asignado(s)"
                                : 'Sin cursos asignados';
                        }),

                    Forms\Components\CheckboxList::make('curso_ids')
                        ->label('Cursos a asignar')
                        ->options(function (Forms\Get $get) {
                            $profesorId = $get('profesor_id');
                            if (!$profesorId) {
                                return [];
                            }

                            $profesor = \App\Models\User::find($profesorId);
                            $assignedIds = $profesor->teachingCourses()->pluck('cursos.id')->toArray();

                            return Curso::whereNotIn('id', $assignedIds)
                                ->orderBy('title')
                                ->pluck('title', 'id');
                        })
                        ->searchable()
                        ->bulkToggleable()
                        ->columns(2)
                        ->required(),
                ])
                ->action(function (array $data): void {
                    $profesor = \App\Models\User::find($data['profesor_id']);
                    $profesor->teachingCourses()->attach($data['curso_ids']);

                    Notification::make()
                        ->success()
                        ->title('Cursos asignados')
                        ->body('Se asignaron ' . count($data['curso_ids']) . ' curso(s) a ' . $profesor->name)
                        ->send();
                })
                ->modalHeading('Asignar Cursos a Profesor')
                ->modalSubmitActionLabel('Asignar')
                ->modalWidth('3xl'),
        ];
    }
}
