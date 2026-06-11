<?php

namespace Database\Seeders;

use App\Models\Sede;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SedeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sede::create([
            'name' => 'Sede Central Mendoza',
            'facebook_url' => 'https://facebook.com/instituto-solumne',
            'instagram_url' => 'https://instagram.com/instituto-solumne',
        ]);

        Sede::create([
            'name' => 'Anexo San Rafael',
            'facebook_url' => 'https://facebook.com/instituto-solumne-sr',
            'instagram_url' => null,
        ]);
    }
}