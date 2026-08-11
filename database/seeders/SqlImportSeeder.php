<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SqlImportSeeder extends Seeder
{
    /**
     * Run the database seeds from sipbongki.sql (excluding users, migrations, and sessions).
     */
    public function run(): void
    {
        $sqlPath = base_path('sipbongki.sql');

        if (!File::exists($sqlPath)) {
            $this->command->error("File sipbongki.sql tidak ditemukan di root project.");
            return;
        }

        $sqlContent = File::get($sqlPath);

        // Turn off foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Split by semicolons
        $statements = preg_split('/;\s*$/m', $sqlContent);

        $excludedTables = ['users', 'migrations', 'sessions'];

        foreach ($statements as $statement) {
            $statement = trim($statement);
            if (empty($statement)) {
                continue;
            }

            // Check if statement inserts into excluded tables
            $shouldExclude = false;
            foreach ($excludedTables as $table) {
                if (preg_match('/INSERT\s+INTO\s+[`"]?' . $table . '[`"]?/i', $statement)) {
                    $shouldExclude = true;
                    break;
                }
            }

            if ($shouldExclude) {
                continue;
            }

            // Execute SQL statement
            try {
                DB::unprepared($statement);
            } catch (\Throwable $e) {
                // Log or ignore minor syntax mismatch if needed
            }
        }

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info("Data dari sipbongki.sql berhasil di-seed (kecuali tabel users, migrations, dan sessions).");
    }
}
