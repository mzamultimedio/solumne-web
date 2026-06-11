<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\CursoResource;
use App\Models\Curso;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentCourses extends BaseWidget
{
    protected static ?int $sort = 5;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Cursos Recientes';

    public function table(Table $table): Table
    {
        $user = auth()->user();

        $query = Curso::query()
            ->withCount(['modulos', 'alumnos'])
            ->latest()
            ->limit(5);

        // Si es profesor, mostrar solo sus cursos
        if ($user?->role === 'profesor') {
            $cursoIds = $user->teachingCourses()->pluck('cursos.id')->toArray();
            $query->whereIn('id', $cursoIds);

            // Cambiar título del widget
            static::$heading = 'Mis Cursos';
        }

        return $table
            ->query($query)
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('')
                    ->disk('public')
                    ->circular()
                    ->size(45)
                    ->defaultImageUrl(url('/images/default-course.png')),
                Tables\Columns\TextColumn::make('title')
                    ->label('Curso')
                    ->wrap()
                    ->searchable()
                    ->weight('bold')
                    ->color('gray'),
                Tables\Columns\TextColumn::make('modulos_count')
                    ->label('Módulos')
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-o-rectangle-stack')
                    ->sortable(),
                Tables\Columns\TextColumn::make('alumnos_count')
                    ->label('Alumnos')
                    ->badge()
                    ->color('success')
                    ->icon('heroicon-o-users')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->since()
                    ->sortable()
                    ->color('gray'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('edit')
                        ->label('Editar')
                        ->icon('heroicon-o-pencil-square')
                        ->color('warning')
                        ->url(fn(Curso $record) => CursoResource::getUrl('edit', ['record' => $record])),
                    Tables\Actions\Action::make('view')
                        ->label('Ver alumnos')
                        ->icon('heroicon-o-users')
                        ->color('info')
                        ->url(fn(Curso $record) => CursoResource::getUrl('edit', ['record' => $record]) . '?activeRelationManager=0'),
                ]),
            ])
            ->emptyStateHeading(auth()->user()?->role === 'profesor' ? 'Sin cursos asignados' : 'Aún no hay cursos')
            ->emptyStateDescription(auth()->user()?->role === 'profesor'
                ? 'Contacta al administrador para que te asigne cursos.'
                : 'Crea tu primer curso para empezar.')
            ->emptyStateIcon('heroicon-o-academic-cap')
            ->striped();
    }
}
