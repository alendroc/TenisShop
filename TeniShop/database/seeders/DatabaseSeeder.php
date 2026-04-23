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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

         $this->call([
        CategoriasSeeder::class,
        MarcasSeeder::class,
        ZapatosSeeder::class,       // depende de categorias y marcas
        TallaZapatosSeeder::class, // depende de zapatos
        ImagenSeeder::class,        // depende de zapatos
    ]);
    }
}
