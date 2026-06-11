<?php

namespace App\Filament\Resources\RecursoResource\Pages;

use App\Filament\Resources\RecursoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRecurso extends CreateRecord
{
    protected static string $resource = RecursoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return RecursoResource::applyFileMetadata($data);
    }
}
