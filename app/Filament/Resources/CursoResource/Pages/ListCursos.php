<?php

namespace App\Filament\Resources\CursoResource\Pages;

use App\Filament\Resources\CursoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCursos extends ListRecords
{
    protected static string $resource = CursoResource::class;

    protected function getHeaderActions(): array
    {
        if (!CursoResource::canCreate()) {
            return [];
        }

        return [
            Actions\CreateAction::make()
                ->label('Nuevo curso'),
        ];
    }
}
