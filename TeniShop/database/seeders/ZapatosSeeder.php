<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZapatosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    DB::table('zapatos')->insert([
        [
            'categoria_id'     => 1,
            'marca_id'         => 1,
            'nombre'           => 'Nike Air Zoom Pegasus 40',
            'descripcion'      => 'Zapatilla de running con amortiguación reactiva y ajuste seguro.',
            'precio'           => 130.00,
            'estilo'           => 'deportivo',
            'material'         => 'tela',
            'color_principal'  => 'negro',
            'imagen_principal' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?w=600',
            'disponible'       => true,
        ],
        [
            'categoria_id'     => 1,
            'marca_id'         => 2,
            'nombre'           => 'Adidas Ultraboost 23',
            'descripcion'      => 'Running premium con suela Boost para máxima energía de retorno.',
            'precio'           => 180.00,
            'estilo'           => 'deportivo',
            'material'         => 'tela',
            'color_principal'  => 'blanco',
            'imagen_principal' => 'https://images.unsplash.com/photo-1587563871167-1ee9c731aefb?w=600',
            'disponible'       => true,
        ],
        [
            'categoria_id'     => 2,
            'marca_id'         => 3,
            'nombre'           => 'New Balance 574',
            'descripcion'      => 'Clásico sneaker casual con comodidad todo el día.',
            'precio'           => 90.00,
            'estilo'           => 'casual',
            'material'         => 'sintetico',
            'color_principal'  => 'gris',
            'imagen_principal' => 'https://images.unsplash.com/photo-1539185441755-769473a23570?w=600',
            'disponible'       => true,
        ],
        [
            'categoria_id'     => 2,
            'marca_id'         => 5,
            'nombre'           => 'Vans Old Skool',
            'descripcion'      => 'Icónico skate shoe con la característica franja lateral.',
            'precio'           => 75.00,
            'estilo'           => 'casual',
            'material'         => 'tela',
            'color_principal'  => 'negro',
            'imagen_principal' => 'https://images.unsplash.com/photo-1561861422-a549073e547a?w=600',
            'disponible'       => true,
        ],
        [
            'categoria_id'     => 3,
            'marca_id'         => 4,
            'nombre'           => 'Puma Future Rider',
            'descripcion'      => 'Diseño retro con acabados modernos para ocasiones formales.',
            'precio'           => 95.00,
            'estilo'           => 'formal',
            'material'         => 'cuero',
            'color_principal'  => 'marron',
            'imagen_principal' => 'https://images.unsplash.com/photo-1531310197839-ccf54634509e?w=600',
            'disponible'       => true,
        ],
        [
            'categoria_id'     => 4,
            'marca_id'         => 1,
            'nombre'           => 'Nike Free Run Flyknit',
            'descripcion'      => 'Zapatilla ultraligera de entrenamiento para mujer.',
            'precio'           => 110.00,
            'estilo'           => 'deportivo',
            'material'         => 'tela',
            'color_principal'  => 'rosado',
            'imagen_principal' => 'https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?w=600',
            'disponible'       => true,
        ],
        [
            'categoria_id'     => 5,
            'marca_id'         => 2,
            'nombre'           => 'Adidas Tensaur Run Kids',
            'descripcion'      => 'Zapatilla ligera y resistente para niños activos.',
            'precio'           => 55.00,
            'estilo'           => 'deportivo',
            'material'         => 'sintetico',
            'color_principal'  => 'azul',
            'imagen_principal' => 'https://images.unsplash.com/photo-1514989940723-e8e51635b782?w=600',
            'disponible'       => true,
        ],
        [
            'categoria_id'     => 1,
            'marca_id'         => 3,
            'nombre'           => 'New Balance Fresh Foam X 1080',
            'descripcion'      => 'Máxima amortiguación para largas distancias outdoor.',
            'precio'           => 160.00,
            'estilo'           => 'outdoor',
            'material'         => 'tela',
            'color_principal'  => 'verde',
            'imagen_principal' => 'https://images.unsplash.com/photo-1520256862855-398228c41684?w=600',
            'disponible'       => false,
        ],
    ]);
}
}
