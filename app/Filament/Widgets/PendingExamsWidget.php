<?php

namespace App\Filament\Widgets;

use App\Models\ExamAttempt;
use App\Models\Modulo;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PendingExamsWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = [
        'md' => 1,
        'lg' => 1,
    ];

    protected static ?string $heading = 'Exámenes por Calificar';

    public function table(Table $table): Table
    {
        $user = auth()->user();

        $query = ExamAttempt::query()
            ->where('status', 'submitted')
            ->with(['user', 'exam.modulo.curso'])
            ->latest()
            ->limit(5);

        // Si es profesor, filtrar solo sus cursos
        if ($user?->role === 'profesor') {
            $cursoIds = $user->teachingCourses()->pluck('cursos.id')->toArray();
            $moduloIds = Modulo::whereIn('curso_id', $cursoIds)->pluck('id')->toArray();

            $query->whereHas('exam', function ($q) use ($moduloIds) {
                $q->whereIn('modulo_id', $moduloIds);
            });
        }

        return $table
            ->query($query)
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Alumno')
                    ->searchable()
                    ->icon('heroicon-o-user')
                    ->iconColor('info'),
                Tables\Columns\TextColumn::make('exam.modulo.curso.title')
                    ->label('Curso')
                    ->limit(20)
                    ->tooltip(fn($record) => $record->exam?->modulo?->curso?->title),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Enviado')
                    ->since()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('grade')
                    ->label('Calificar')
                    ->icon('heroicon-o-check-circle')
                    ->color('warning')
                    ->url(fn(ExamAttempt $record) => "/admin/modulos/{$record->exam->modulo_id}/edit"),
            ])
            ->emptyStateHeading('¡Todo al día!')
            ->emptyStateDescription('No hay exámenes pendientes de calificar.')
            ->emptyStateIcon('heroicon-o-check-badge')
            ->striped()
            ->paginated(false);
    }
}
