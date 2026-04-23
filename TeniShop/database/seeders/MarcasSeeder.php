<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    DB::table('marcas')->insert([
        [
            'nombre'      => 'Nike',
            'pais_origen' => 'Estados Unidos',
            'logo'        => 'https://upload.wikimedia.org/wikipedia/commons/a/a6/Logo_NIKE.svg',
        ],
        [
            'nombre'      => 'Adidas',
            'pais_origen' => 'Alemania',
            'logo'        => 'https://upload.wikimedia.org/wikipedia/commons/2/20/Adidas_Logo.svg',
        ],
        [
            'nombre'      => 'New Balance',
            'pais_origen' => 'Estados Unidos',
            'logo'        => 'https://upload.wikimedia.org/wikipedia/commons/e/ea/New_Balance_logo.svg',
        ],
        [
            'nombre'      => 'Puma',
            'pais_origen' => 'Alemania',
            'logo'        => 'https://upload.wikimedia.org/wikipedia/commons/8/88/Puma_Logo.svg',
        ],
        [
            'nombre'      => 'Vans',
            'pais_origen' => 'Estados Unidos',
            'logo'        => 'https://upload.wikimedia.org/wikipedia/commons/9/91/Vans-logo.svg',
        ],
    ]);
}
}
