<?php

namespace App\Filament\Resources\ModuloResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExamRelationManager extends RelationManager
{
    protected static string $relationship = 'exam';

    protected static ?string $title = 'Examen';

    protected static ?string $recordTitleAttribute = 'title';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Título del examen')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label('Descripción breve')
                    ->rows(2)
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('instructions')
                    ->label('Instrucciones para los alumnos')
                    ->columnSpanFull(),
                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\Toggle::make('is_published')
                        ->label('Publicar examen')
                        ->helperText('Los alumnos sólo podrán ver el examen cuando esté publicado.'),
                    Forms\Components\DateTimePicker::make('available_from')
                        ->label('Disponible desde')
                        ->seconds(false),
                    Forms\Components\DateTimePicker::make('due_at')
                        ->label('Fecha límite')
                        ->seconds(false),
                ]),
                Forms\Components\Section::make('Preguntas')
                    ->schema([
                        Repeater::make('questions')
                            ->relationship()
                            ->orderColumn('order')
                            ->schema([
                                Forms\Components\TextInput::make('prompt')
                                    ->label('Pregunta')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('description')
                                    ->label('Detalle u orientación')
                                    ->rows(2),
                                Forms\Components\TextInput::make('points')
                                    ->label('Puntos')
                                    ->numeric()
                                    ->default(1)
                                    ->minValue(0)
                                    ->step(0.5),
                            ])
                            ->itemLabel(fn (array $state): ?string => $state['prompt'] ?? null)
                            ->reorderable()
                            ->collapsible(),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) => $query->withCount('questions'))
            ->columns([
                TextColumn::make('title')->label('Título'),
                TextColumn::make('is_published')->label('Publicado')->formatStateUsing(fn (bool $state) => $state ? 'Sí' : 'No'),
                TextColumn::make('questions_count')->label('Preguntas')->counts('questions'),
                TextColumn::make('due_at')->label('Fecha límite')->dateTime(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Crear examen')
                    ->visible(fn () => ! $this->getOwnerRecord()->exam),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Editar'),
                Tables\Actions\DeleteAction::make()->label('Eliminar')->requiresConfirmation(),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
