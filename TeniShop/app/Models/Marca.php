<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'pais_origen',
        'logo',
    ];

    // ── Relaciones ──────────────────────────────────────

    /** Una marca tiene muchos zapatos */
    public function zapatos()
    {
        return $this->hasMany(Zapato::class);
    }
}