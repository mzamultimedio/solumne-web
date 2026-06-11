<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->visible(fn (): bool => auth()->id() !== $this->record->id),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (auth()->user()?->role === 'gestor') {
            $data['role'] = 'alumno';
        }

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        unset($data['password_confirmation']);

        return $data;
    }
}
