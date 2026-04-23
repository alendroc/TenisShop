<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TallaZapatosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tallas para cada zapato (zapato_id 1 al 8)
        $tallas = [
            ['us' => 7.0, 'eu' => 40.0],
            ['us' => 8.0, 'eu' => 41.0],
            ['us' => 9.0, 'eu' => 42.0],
            ['us' => 10.0, 'eu' => 43.0],
            ['us' => 11.0, 'eu' => 44.0],
        ];

        $stocks = [
            1 => [5, 8, 10, 6, 3],
            2 => [4, 7, 9,  5, 2],
            3 => [6, 6, 8,  4, 4],
            4 => [3, 9, 7,  5, 1],
            5 => [2, 5, 6,  8, 3],
            6 => [7, 8, 5,  3, 6],
            7 => [4, 6, 8,  5, 2],
            8 => [0, 0, 0,  0, 0], // agotado
        ];

        $rows = [];
        foreach ($stocks as $zapato_id => $stockPorTalla) {
            foreach ($tallas as $i => $talla) {
                $rows[] = [
                    'zapato_id' => $zapato_id,
                    'talla_us'  => $talla['us'],
                    'talla_eu'  => $talla['eu'],
                    'stock'     => $stockPorTalla[$i],
                ];
            }
        }

        DB::table('talla_zapatos')->insert($rows);
    }
}
