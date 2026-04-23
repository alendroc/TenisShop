<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    DB::table('imagen_zapatos')->insert([
        // Zapato 1 - Nike Pegasus
        ['zapato_id' => 1, 'url' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?w=600', 'orden' => 1],
        ['zapato_id' => 1, 'url' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600',    'orden' => 2],
        ['zapato_id' => 1, 'url' => 'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?w=600', 'orden' => 3],

        // Zapato 2 - Adidas Ultraboost
        ['zapato_id' => 2, 'url' => 'https://images.unsplash.com/photo-1587563871167-1ee9c731aefb?w=600', 'orden' => 1],
        ['zapato_id' => 2, 'url' => 'https://images.unsplash.com/photo-1556906781-9a412961a28c?w=600',    'orden' => 2],
        ['zapato_id' => 2, 'url' => 'https://images.unsplash.com/photo-1608231387042-66d1773d3028?w=600', 'orden' => 3],

        // Zapato 3 - New Balance 574
        ['zapato_id' => 3, 'url' => 'https://images.unsplash.com/photo-1539185441755-769473a23570?w=600', 'orden' => 1],
        ['zapato_id' => 3, 'url' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?w=600', 'orden' => 2],
        ['zapato_id' => 3, 'url' => 'https://images.unsplash.com/photo-1560769629-975ec94e6a86?w=600',    'orden' => 3],

        // Zapato 4 - Vans Old Skool
        ['zapato_id' => 4, 'url' => 'https://images.unsplash.com/photo-1561861422-a549073e547a?w=600', 'orden' => 1],
        ['zapato_id' => 4, 'url' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?w=600','orden' => 2],
        ['zapato_id' => 4, 'url' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600',   'orden' => 3],

        // Zapato 5 - Puma Future Rider
        ['zapato_id' => 5, 'url' => 'https://images.unsplash.com/photo-1531310197839-ccf54634509e?w=600', 'orden' => 1],
        ['zapato_id' => 5, 'url' => 'https://images.unsplash.com/photo-1614252235316-8c857d38b5f4?w=600', 'orden' => 2],
        ['zapato_id' => 5, 'url' => 'https://images.unsplash.com/photo-1543163521-1bf539c55dd2?w=600',    'orden' => 3],

        // Zapato 6 - Nike Free Run (Mujer)
        ['zapato_id' => 6, 'url' => 'https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?w=600', 'orden' => 1],
        ['zapato_id' => 6, 'url' => 'https://images.unsplash.com/photo-1560769629-975ec94e6a86?w=600',    'orden' => 2],
        ['zapato_id' => 6, 'url' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?w=600', 'orden' => 3],

        // Zapato 7 - Adidas Tensaur Kids
        ['zapato_id' => 7, 'url' => 'https://images.unsplash.com/photo-1514989940723-e8e51635b782?w=600', 'orden' => 1],
        ['zapato_id' => 7, 'url' => 'https://images.unsplash.com/photo-1519689680058-324335c77eba?w=600', 'orden' => 2],
        ['zapato_id' => 7, 'url' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600',    'orden' => 3],

        // Zapato 8 - New Balance 1080 (agotado)
        ['zapato_id' => 8, 'url' => 'https://images.unsplash.com/photo-1520256862855-398228c41684?w=600', 'orden' => 1],
        ['zapato_id' => 8, 'url' => 'https://images.unsplash.com/photo-1539185441755-769473a23570?w=600', 'orden' => 2],
        ['zapato_id' => 8, 'url' => 'https://images.unsplash.com/photo-1556906781-9a412961a28c?w=600',    'orden' => 3],
    ]);
}
}
