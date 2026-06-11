<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class MigrateDniFromPassword extends Command
{
    protected $signature = 'users:migrate-dni 
                            {--dry-run : Simular sin guardar cambios}
                            {--default-password=password : Contraseña por defecto para usuarios migrados}';

    protected $description = 'Migra DNIs que están en la columna password a la columna dni';

    public function handle()
    {
        $dryRun = $this->option('dry-run');
        $defaultPassword = $this->option('default-password');

        $this->info('🔍 Buscando usuarios con DNI en password...');
        $this->newLine();

        // Obtener todos los usuarios
        $users = User::all();
        $migrated = 0;
        $skipped = 0;

        foreach ($users as $user) {
            // Si ya tiene DNI, saltar
            if (!empty($user->dni)) {
                $skipped++;
                continue;
            }

            // Intentar detectar si el password parece un DNI (solo números, 7-9 dígitos)
            // Como está hasheado, vamos a preguntar al usuario
            $this->warn("Usuario: {$user->name} ({$user->email})");
            $this->line("Password hash: {$user->password}");

            if ($this->confirm('¿Este usuario tiene DNI en lugar de contraseña?', false)) {
                $dni = $this->ask('Ingresa el DNI para este usuario');

                if ($dni) {
                    if ($dryRun) {
                        $this->info("  [DRY RUN] Se asignaría DNI: {$dni}");
                        $this->info("  [DRY RUN] Se resetearía password a: {$defaultPassword}");
                    } else {
                        $user->dni = $dni;
                        $user->password = Hash::make($defaultPassword);
                        $user->save();

                        $this->info("  ✅ DNI migrado: {$dni}");
                        $this->info("  ✅ Password reseteado a: {$defaultPassword}");
                    }
                    $migrated++;
                } else {
                    $this->warn("  ⏭️  Saltado (no se ingresó DNI)");
                    $skipped++;
                }
            } else {
                $skipped++;
            }

            $this->newLine();
        }

        $this->newLine();
        $this->info("📊 Resumen:");
        $this->table(
            ['Estado', 'Cantidad'],
            [
                ['Migrados', $migrated],
                ['Saltados', $skipped],
                ['Total', $users->count()],
            ]
        );

        if ($dryRun) {
            $this->warn('⚠️  Modo DRY RUN - No se guardaron cambios');
            $this->info('Ejecuta sin --dry-run para aplicar los cambios');
        }

        return 0;
    }
}
