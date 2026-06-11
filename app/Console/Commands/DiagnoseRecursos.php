<?php

namespace App\Console\Commands;

use App\Models\Recurso;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DiagnoseRecursos extends Command
{
    protected $signature = 'recursos:diagnose';
    protected $description = 'Diagnostica problemas con recursos (symlinks, permisos, file_type)';

    public function handle(): int
    {
        $this->info('🔍 Diagnóstico de Recursos');
        $this->newLine();

        // 1. Verificar symlink
        $this->checkSymlink();
        $this->newLine();

        // 2. Verificar file_type
        $this->checkFileTypes();
        $this->newLine();

        // 3. Verificar archivos físicos
        $this->checkPhysicalFiles();
        $this->newLine();

        // 4. Verificar permisos
        $this->checkPermissions();

        $this->newLine();
        $this->info('✅ Diagnóstico completado');

        return Command::SUCCESS;
    }

    private function checkSymlink(): void
    {
        $this->line('📁 <fg=yellow>Verificando symlink storage...</>');

        $link = public_path('storage');
        $target = storage_path('app/public');

        if (!file_exists($link)) {
            $this->error('  ❌ Symlink NO existe: ' . $link);
            $this->warn('  → Ejecuta: php artisan storage:link');
            return;
        }

        if (!is_link($link)) {
            $this->error('  ❌ public/storage existe pero NO es un symlink');
            $this->warn('  → Elimínalo y ejecuta: php artisan storage:link');
            return;
        }

        $actualTarget = readlink($link);
        if ($actualTarget !== $target) {
            $this->warn('  ⚠️  Symlink apunta a: ' . $actualTarget);
            $this->warn('  ⚠️  Debería apuntar a: ' . $target);
            $this->warn('  → Ejecuta: php artisan storage:link --force');
            return;
        }

        $this->info('  ✅ Symlink correcto: ' . $link . ' → ' . $target);
    }

    private function checkFileTypes(): void
    {
        $this->line('🏷️  <fg=yellow>Verificando file_type en base de datos...</>');

        $total = Recurso::count();
        $sinTipo = Recurso::whereNull('file_type')->count();

        $this->info("  Total recursos: {$total}");

        if ($sinTipo > 0) {
            $this->warn("  ⚠️  Recursos sin file_type: {$sinTipo}");
            $this->line('  → El accessor del modelo detectará el tipo automáticamente');
            $this->line('  → Para persistir en DB, ejecuta: php artisan recursos:fix-types');
        } else {
            $this->info('  ✅ Todos los recursos tienen file_type definido');
        }

        // Mostrar distribución de tipos
        $tipos = Recurso::selectRaw('file_type, COUNT(*) as count')
            ->groupBy('file_type')
            ->get();

        if ($tipos->isNotEmpty()) {
            $this->line('  Distribución de tipos:');
            foreach ($tipos as $tipo) {
                $label = $tipo->file_type ?? 'NULL (detectado automáticamente)';
                $this->line("    • {$label}: {$tipo->count}");
            }
        }
    }

    private function checkPhysicalFiles(): void
    {
        $this->line('📦 <fg=yellow>Verificando archivos físicos...</>');

        $recursos = Recurso::all();
        $missing = 0;
        $found = 0;

        foreach ($recursos as $recurso) {
            if (!Storage::disk('public')->exists($recurso->file_path)) {
                $missing++;
                if ($missing <= 5) { // Solo mostrar los primeros 5
                    $this->warn("  ❌ Falta: {$recurso->file_path} (ID: {$recurso->id})");
                }
            } else {
                $found++;
            }
        }

        if ($missing > 5) {
            $this->warn("  ... y " . ($missing - 5) . " archivos más");
        }

        $this->info("  ✅ Archivos encontrados: {$found}");
        if ($missing > 0) {
            $this->error("  ❌ Archivos faltantes: {$missing}");
        }
    }

    private function checkPermissions(): void
    {
        $this->line('🔐 <fg=yellow>Verificando permisos...</>');

        $storagePath = storage_path('app/public');
        $recursosPath = storage_path('app/public/recursos');

        if (!is_readable($storagePath)) {
            $this->error('  ❌ storage/app/public NO es legible');
            $this->warn('  → Ejecuta: chmod -R 775 storage');
            return;
        }

        if (!is_readable($recursosPath)) {
            $this->error('  ❌ storage/app/public/recursos NO es legible');
            $this->warn('  → Ejecuta: chmod -R 775 storage/app/public/recursos');
            return;
        }

        $this->info('  ✅ Permisos correctos en storage');
    }
}
