<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateSqliteToMysql extends Command
{
    protected $signature = 'migrate:sqlite-to-mysql';
    protected $description = 'Migra todos los datos desde el SQLite local hacia MySQL remoto';

    protected $tables = [
        'users',
        'password_reset_tokens',
        'sessions',
        'cursos',
        'modulos',
        'leccions',
        'recursos',
        'sedes',
        'curso_user',
        'leccion_user',
        'modulo_user',
        'exams',
        'exam_questions',
        'exam_attempts',
        'exam_answers',
        'invoices',
        'invoice_items',
        'curso_teacher',
    ];

    public function handle(): int
    {
        $sqlitePath = database_path('database.sqlite');

        if (!file_exists($sqlitePath)) {
            $this->error("No se encontro SQLite en: {$sqlitePath}");
            return Command::FAILURE;
        }

        $sqlite = new \SQLite3($sqlitePath);
        $sqlite->busyTimeout(5000);
        $sqlite->exec('PRAGMA journal_mode=WAL');

        DB::connection('mysql')->unprepared('SET FOREIGN_KEY_CHECKS=0');
        DB::connection('mysql')->unprepared('SET UNIQUE_CHECKS=0');

        $totalRows = 0;

        foreach ($this->tables as $table) {
            $exists = $sqlite->querySingle(
                "SELECT COUNT(*) FROM sqlite_master WHERE type='table' AND name='" . addslashes($table) . "'"
            );
            if (!$exists) {
                $this->warn("  Saltando '{$table}' (no existe en SQLite)");
                continue;
            }

            $count = $sqlite->querySingle("SELECT COUNT(*) FROM \"{$table}\"");
            $this->line("Migrando <fg=cyan>{$table}</> ({$count} filas)...");

            if ($count === 0) {
                $this->info("  Vacía, saltando.");
                continue;
            }

            $stmt = $sqlite->query("SELECT * FROM \"{$table}\"");
            $columns = [];
            for ($i = 0; $i < $stmt->numColumns(); $i++) {
                $columns[] = $stmt->columnName($i);
            }

            try {
                $batch = [];
                $batchSize = 200;
                $migrated = 0;

                while ($row = $stmt->fetchArray(SQLITE3_ASSOC)) {
                    $rowData = [];
                    foreach ($columns as $col) {
                        $rowData[$col] = $row[$col];
                    }
                    $batch[] = $rowData;

                    if (count($batch) >= $batchSize) {
                        DB::connection('mysql')->table($table)->insertOrIgnore($batch);
                        $migrated += count($batch);
                        $batch = [];
                    }
                }

                if (!empty($batch)) {
                    DB::connection('mysql')->table($table)->insertOrIgnore($batch);
                    $migrated += count($batch);
                }

                $this->info("  <fg=green>OK</> {$migrated} filas procesadas");
                $totalRows += $migrated;
            } catch (\Exception $e) {
                $this->error("  ERROR: " . $e->getMessage());
            }
        }

        DB::connection('mysql')->unprepared('SET FOREIGN_KEY_CHECKS=1');
        DB::connection('mysql')->unprepared('SET UNIQUE_CHECKS=1');

        $sqlite->close();

        $this->newLine();
        $this->info("Migracion completada. Total: {$totalRows} filas procesadas (duplicados ignorados)");

        return Command::SUCCESS;
    }
}
