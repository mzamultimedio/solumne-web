<?php

namespace App\Filament\Resources\LeccionResource\Pages;

use App\Filament\Resources\LeccionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLeccion extends EditRecord
{
    protected static string $resource = LeccionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
