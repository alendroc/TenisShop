<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImagenZapato extends Model
{
    use HasFactory;

    protected $table = 'imagen_zapatos';

    protected $fillable = [
        'zapato_id',
        'url',
        'orden',
    ];

    protected $casts = [
        'orden' => 'integer',
    ];

    // ── Relaciones ──────────────────────────────────────

    /** Una imagen pertenece a un zapato */
    public function zapato()
    {
        return $this->belongsTo(Zapato::class);
    }
}