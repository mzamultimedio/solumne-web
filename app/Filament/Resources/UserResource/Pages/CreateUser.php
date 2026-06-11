<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['role'] = $this->resolveRole($data['role'] ?? 'alumno');

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        unset($data['password_confirmation']);

        return $data;
    }

    protected function resolveRole(string $role): string
    {
        if (auth()->user()?->role === 'gestor') {
            return 'alumno';
        }

        return $role;
    }
}
