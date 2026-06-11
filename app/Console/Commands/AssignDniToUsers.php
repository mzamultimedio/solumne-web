<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AssignDniToUsers extends Command
{
    protected $signature = 'users:assign-dni 
                            {--email= : Email del usuario específico}
                            {--dni= : DNI a asignar}
                            {--reset-password= : Nueva contraseña (opcional)}
                            {--list : Listar usuarios sin DNI}';

    protected $description = 'Asigna DNI a usuarios específicos o lista usuarios sin DNI';

    public function handle()
    {
        // Opción: Listar usuarios sin DNI
        if ($this->option('list')) {
            $this->listUsersWithoutDni();
            return 0;
        }

        $email = $this->option('email');
        $dni = $this->option('dni');
        $newPassword = $this->option('reset-password');

        // Si no se proporcionan opciones, modo interactivo
        if (!$email || !$dni) {
            return $this->interactiveMode();
        }

        // Buscar usuario
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("❌ Usuario no encontrado: {$email}");
            return 1;
        }

        // Asignar DNI
        $user->dni = $dni;

        // Resetear contraseña si se proporciona
        if ($newPassword) {
            $user->password = Hash::make($newPassword);
        }

        $user->save();

        $this->info("✅ DNI asignado exitosamente");
        $this->table(
            ['Campo', 'Valor'],
            [
                ['Usuario', $user->name],
                ['Email', $user->email],
                ['DNI', $user->dni],
                ['Password', $newPassword ? "Reseteado a: {$newPassword}" : 'Sin cambios'],
            ]
        );

        return 0;
    }

    protected function listUsersWithoutDni()
    {
        $users = User::whereNull('dni')->orWhere('dni', '')->get();

        if ($users->isEmpty()) {
            $this->info('✅ Todos los usuarios tienen DNI asignado');
            return;
        }

        $this->warn("⚠️  Usuarios sin DNI: {$users->count()}");
        $this->newLine();

        $this->table(
            ['ID', 'Nombre', 'Email', 'Rol', 'Registrado'],
            $users->map(fn($u) => [
                $u->id,
                $u->name,
                $u->email,
                $u->role,
                $u->created_at->format('d/m/Y'),
            ])
        );

        $this->newLine();
        $this->info('💡 Para asignar DNI a un usuario:');
        $this->line('   php artisan users:assign-dni --email=usuario@email.com --dni=12345678 --reset-password=nuevapass');
    }

    protected function interactiveMode()
    {
        $this->info('🔧 Modo Interactivo - Asignar DNI');
        $this->newLine();

        // Listar usuarios sin DNI
        $users = User::whereNull('dni')->orWhere('dni', '')->get();

        if ($users->isEmpty()) {
            $this->info('✅ Todos los usuarios tienen DNI asignado');
            return 0;
        }

        $this->warn("Usuarios sin DNI: {$users->count()}");
        $this->newLine();

        // Mostrar opciones
        $options = $users->mapWithKeys(function ($user) {
            return [$user->id => "{$user->name} ({$user->email})"];
        })->toArray();

        $userId = $this->choice('Selecciona un usuario', $options);
        $user = User::find($userId);

        if (!$user) {
            $this->error('Usuario no encontrado');
            return 1;
        }

        $this->info("Usuario seleccionado: {$user->name}");
        $this->newLine();

        // Pedir DNI
        $dni = $this->ask('Ingresa el DNI');

        if (!$dni) {
            $this->error('DNI requerido');
            return 1;
        }

        // Preguntar si resetear password
        $resetPassword = $this->confirm('¿Resetear contraseña?', true);
        $newPassword = null;

        if ($resetPassword) {
            $newPassword = $this->ask('Nueva contraseña', 'password');
        }

        // Confirmar
        $this->newLine();
        $this->table(
            ['Campo', 'Valor'],
            [
                ['Usuario', $user->name],
                ['Email', $user->email],
                ['DNI', $dni],
                ['Password', $newPassword ? "Se reseteará a: {$newPassword}" : 'Sin cambios'],
            ]
        );

        if (!$this->confirm('¿Confirmar cambios?', true)) {
            $this->warn('Operación cancelada');
            return 0;
        }

        // Aplicar cambios
        $user->dni = $dni;
        if ($newPassword) {
            $user->password = Hash::make($newPassword);
        }
        $user->save();

        $this->info('✅ Cambios guardados exitosamente');

        // Preguntar si continuar con otro usuario
        if ($this->confirm('¿Asignar DNI a otro usuario?', false)) {
            return $this->interactiveMode();
        }

        return 0;
    }
}
