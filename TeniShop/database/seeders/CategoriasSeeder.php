<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    DB::table('categorias')->insert([
        [
            'nombre'      => 'Running',
            'descripcion' => 'Zapatos diseñados para correr y entrenamientos de alto impacto.',
            'genero'      => 'unisex',
            'imagen'      => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600',
        ],
        [
            'nombre'      => 'Casual',
            'descripcion' => 'Calzado cómodo para el uso diario y actividades informales.',
            'genero'      => 'unisex',
            'imagen'      => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?w=600',
        ],
        [
            'nombre'      => 'Formal',
            'descripcion' => 'Zapatos elegantes para ocasiones de negocios y eventos.',
            'genero'      => 'hombre',
            'imagen'      => 'https://images.unsplash.com/photo-1614252235316-8c857d38b5f4?w=600',
        ],
        [
            'nombre'      => 'Deportivo Mujer',
            'descripcion' => 'Calzado deportivo diseñado especialmente para mujer.',
            'genero'      => 'mujer',
            'imagen'      => 'https://images.unsplash.com/photo-1560769629-975ec94e6a86?w=600',
        ],
        [
            'nombre'      => 'Infantil',
            'descripcion' => 'Zapatos cómodos y resistentes para los más pequeños.',
            'genero'      => 'nino',
            'imagen'      => 'https://images.unsplash.com/photo-1519689680058-324335c77eba?w=600',
        ],
    ]);
}
}
