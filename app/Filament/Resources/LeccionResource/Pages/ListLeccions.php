<?php

namespace App\Filament\Resources\LeccionResource\Pages;

use App\Filament\Resources\LeccionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLeccions extends ListRecords
{
    protected static string $resource = LeccionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
