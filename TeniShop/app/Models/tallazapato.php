<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TallaZapato extends Model
{
    use HasFactory;

    protected $table = 'talla_zapatos';

    protected $fillable = [
        'zapato_id',
        'talla_us',
        'talla_eu',
        'stock',
    ];

    protected $casts = [
        'talla_us' => 'decimal:1',
        'talla_eu' => 'decimal:1',
        'stock'    => 'integer',
    ];


    public function estaDisponible(): bool
    {
        return $this->stock > 0;
    }

    public function zapato()
    {
        return $this->belongsTo(Zapato::class);
    }
}