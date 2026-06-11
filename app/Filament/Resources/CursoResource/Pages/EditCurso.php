<?php

namespace App\Filament\Resources\CursoResource\Pages;

use App\Filament\Resources\CursoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCurso extends EditRecord
{
    protected static string $resource = CursoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (($data['title'] ?? null) !== $this->record->title) {
            $data['slug'] = CursoResource::generateUniqueSlug($data['title'], $this->record);
        }

        return $data;
    }
}
