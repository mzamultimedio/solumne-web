<?php

namespace App\Filament\Resources\ModuloResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExamAttemptsRelationManager extends RelationManager
{
    protected static string $relationship = 'examAttempts';

    protected static ?string $title = 'Entregas del examen';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Alumno')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state) => $state === 'graded' ? 'success' : 'warning')
                    ->formatStateUsing(fn (string $state) => $state === 'graded' ? 'Calificado' : 'Enviado'),
                TextColumn::make('score')
                    ->label('Puntaje')
                    ->formatStateUsing(fn ($state) => $state ?? '—'),
                TextColumn::make('submitted_at')
                    ->label('Enviado')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('graded_at')
                    ->label('Calificado')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Action::make('ver')
                    ->label('Ver respuestas')
                    ->icon('heroicon-o-eye')
                    ->modalContent(fn ($record) => view('filament.modulo.exam-attempt-answers', ['attempt' => $record]))
                    ->modalSubmitAction(false),
                Action::make('evaluar')
                    ->label('Evaluar')
                    ->icon('heroicon-o-check-circle')
                    ->form(function ($record) {
                        $components = [];
                        foreach ($record->answers()->with('question')->get() as $answer) {
                            $components[] = Forms\Components\Textarea::make('answer_' . $answer->id)
                                ->label($answer->question->prompt)
                                ->default($answer->answer_text)
                                ->disabled()
                                ->dehydrated(false);
                            $components[] = Forms\Components\TextInput::make('points_' . $answer->id)
                                ->label('Puntaje otorgado')
                                ->numeric()
                                ->minValue(0)
                                ->step(0.5)
                                ->default($answer->points_awarded);
                        }

                        $components[] = Forms\Components\TextInput::make('score')
                            ->label('Calificación total')
                            ->numeric()
                            ->minValue(0)
                            ->step(0.5)
                            ->default($record->score);

                        $components[] = Forms\Components\Textarea::make('feedback')
                            ->label('Retroalimentación general')
                            ->rows(4)
                            ->default($record->feedback);

                        return $components;
                    })
                    ->action(function ($record, array $data) {
                        $answers = $record->answers()->get();
                        foreach ($answers as $answer) {
                            $key = 'points_' . $answer->id;
                            if (array_key_exists($key, $data)) {
                                $answer->update(['points_awarded' => $data[$key]]);
                            }
                        }

                        $record->update([
                            'score' => $data['score'] ?? null,
                            'feedback' => $data['feedback'] ?? null,
                            'status' => 'graded',
                            'graded_at' => now(),
                        ]);
                    })
                    ->modalButton('Guardar calificación')
                    ->visible(fn ($record) => $record->status !== 'graded'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
            ]);
    }
}
