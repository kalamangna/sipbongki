<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Import Data dari sipbongki.sql (Kecuali User)
        |--------------------------------------------------------------------------
        */

        $this->call([
            SqlImportSeeder::class,
        ]);

        /*
        |--------------------------------------------------------------------------
        | User Admin Default
        |--------------------------------------------------------------------------
        */

        User::updateOrCreate(
            ['username' => 'bongki'],
            [
                'name' => 'Administrator Bongki',
                'password' => bcrypt('Bongki@7307'),
                'role' => 'admin',
            ]
        );
    }
}