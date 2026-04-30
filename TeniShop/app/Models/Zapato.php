<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Zapato extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria_id',
        'marca_id',
        'nombre',
        'descripcion',
        'precio',
        'estilo',
        'material',
        'color_principal',
        'imagen_principal',
        'disponible',
    ];

    protected $casts = [
        'precio'     => 'decimal:2',
        'disponible' => 'boolean',
    ];

    // ── Relaciones ──────────────────────────────────────

    /** Un zapato pertenece a una categoría */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    /** Un zapato pertenece a una marca */
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    /** Un zapato tiene muchas imágenes */
    public function imagenes()
    {
        return $this->hasMany(ImagenZapato::class)->orderBy('orden');
    }

    /** Un zapato está disponible en muchas tallas */
    public function tallas()
    {
        return $this->hasMany(TallaZapato::class);
    }

    // ── Scopes ──────────────────────────────────────────

    /** Busca por nombre, descripción, material, color o estilo */
    public function scopeBuscar(Builder $query, string $termino): Builder
    {
        return $query->where(function ($q) use ($termino) {
            $q->where('nombre',            'like', "%{$termino}%")
              ->orWhere('descripcion',     'like', "%{$termino}%")
              ->orWhere('material',        'like', "%{$termino}%")
              ->orWhere('color_principal', 'like', "%{$termino}%")
              ->orWhere('estilo',          'like', "%{$termino}%")
              ->orWhereHas('marca',     fn($m) => $m->where('nombre', 'like', "%{$termino}%"))
              ->orWhereHas('categoria', fn($c) => $c->where('nombre', 'like', "%{$termino}%"));
        });
    }

    /** Solo zapatos disponibles (campo disponible = true) */
    public function scopeDisponible(Builder $query): Builder
    {
        return $query->where('disponible', true);
    }
}