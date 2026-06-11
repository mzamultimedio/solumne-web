<?php

namespace App\Console\Commands;

use App\Models\Recurso;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class FixRecursosFileTypes extends Command
{
    protected $signature = 'recursos:fix-types {--dry-run : Simular sin guardar cambios}';
    protected $description = 'Actualiza file_type NULL en recursos existentes detectando desde extensión';

    public function handle(): int
    {
        $dryRun = $this->option('dry-run');

        if ($dryRun) {
            $this->warn('🔍 MODO DRY-RUN: No se guardarán cambios');
            $this->newLine();
        }

        $recursos = Recurso::whereNull('file_type')->get();

        if ($recursos->isEmpty()) {
            $this->info('✅ Todos los recursos ya tienen file_type definido');
            return Command::SUCCESS;
        }

        $this->info("📦 Encontrados {$recursos->count()} recursos sin file_type");
        $this->newLine();

        $bar = $this->output->createProgressBar($recursos->count());
        $bar->start();

        $stats = [
            'pdf' => 0,
            'video' => 0,
            'audio' => 0,
            'image' => 0,
            'other' => 0,
        ];

        foreach ($recursos as $recurso) {
            // El accessor ya detecta el tipo automáticamente
            $detectedType = $recurso->file_type;

            if (!$dryRun) {
                // Actualizar directamente en DB sin disparar eventos
                $recurso->update(['file_type' => $detectedType]);
            }

            $stats[$detectedType] = ($stats[$detectedType] ?? 0) + 1;
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        // Mostrar estadísticas
        $this->info('📊 Tipos detectados:');
        foreach ($stats as $type => $count) {
            if ($count > 0) {
                $emoji = match ($type) {
                    'pdf' => '📄',
                    'video' => '🎬',
                    'audio' => '🎵',
                    'image' => '🖼️',
                    default => '📎',
                };
                $this->line("  {$emoji} {$type}: {$count}");
            }
        }

        $this->newLine();

        if ($dryRun) {
            $this->warn('⚠️  Cambios NO guardados (dry-run)');
            $this->info('Ejecuta sin --dry-run para aplicar cambios');
        } else {
            $this->info('✅ file_type actualizado en ' . $recursos->count() . ' recursos');
        }

        return Command::SUCCESS;
    }
}
