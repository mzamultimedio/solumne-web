<?php

namespace App\Filament\Resources\SedeResource\Pages;

use App\Filament\Resources\SedeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditSede extends EditRecord
{
    protected static string $resource = SedeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['image_path']) && $this->record->image_path && $data['image_path'] !== $this->record->image_path) {
            Storage::disk('public')->delete($this->record->image_path);
        }

        return $data;
    }
}
