@extends('layouts.app')

@section('title', ($zapato->nombre ?? 'Producto') . ' — STRYDE')

@section('content')

{{-- BREADCRUMB --}}
<div class="breadcrumb animate">
    <a href="{{ route('home') }}">Inicio</a>
    <span>/</span>
    <a href="{{ route('categorias.index') }}">Categorías</a>
    <span>/</span>
    <a href="{{ route('categorias.show', $zapato->categoria_id) }}">{{ $zapato->categoria->nombre ?? 'Categoría' }}</a>
    <span>/</span>
    <strong style="color:var(--black)">{{ $zapato->nombre }}</strong>
</div>

{{-- DETALLE --}}
<div style="display:grid; grid-template-columns:1fr 1fr; gap:3rem; align-items:start;" class="animate">

    {{-- IMAGEN --}}
    <div style="position:sticky; top:80px;">
        <div style="border:1.5px solid var(--border); border-radius:var(--radius); overflow:hidden; background:var(--cream);">
            <img src="{{ $zapato->imagen_principal }}"
                 alt="{{ $zapato->nombre }}"
                 style="width:100%; aspect-ratio:1; object-fit:cover; display:block;">
        </div>

        {{-- Badge disponibilidad --}}
        <div style="margin-top:1rem; display:flex; gap:.75rem; align-items:center;">
            @if($zapato->disponible)
                <span style="background:#e8f5e9; color:#2e7d32; font-size:.78rem; font-weight:600;
                             padding:.3rem .8rem; border-radius:2px; letter-spacing:.5px;">
                    ✓ En stock
                </span>
            @else
                <span style="background:#fce4ec; color:#c62828; font-size:.78rem; font-weight:600;
                             padding:.3rem .8rem; border-radius:2px; letter-spacing:.5px;">
                    ✗ Agotado
                </span>
            @endif
            <span style="color:var(--gray); font-size:.8rem;">ID: #{{ str_pad($zapato->id, 4, '0', STR_PAD_LEFT) }}</span>
        </div>
    </div>

    {{-- INFO --}}
    <div>
        <p style="font-size:.75rem; font-weight:700; letter-spacing:3px; text-transform:uppercase; color:var(--accent); margin-bottom:.5rem;">
            {{ $zapato->marca->nombre ?? 'Marca' }}
        </p>

        <h1 style="font-family:var(--font-display); font-size:3rem; letter-spacing:2px; line-height:1.1; margin-bottom:1rem;">
            {{ strtoupper($zapato->nombre) }}
        </h1>

        <p style="color:var(--gray); line-height:1.8; margin-bottom:1.75rem; font-size:.95rem;">
            {{ $zapato->descripcion }}
        </p>

        {{-- PRECIO --}}
        <div style="margin-bottom:1.75rem;">
            <span style="font-family:var(--font-display); font-size:3.5rem; letter-spacing:2px;">
                ${{ number_format($zapato->precio, 2) }}
            </span>
        </div>

        {{-- SPECS --}}
        <div style="border:1.5px solid var(--border); border-radius:var(--radius); overflow:hidden; margin-bottom:2rem;">
            <div style="background:var(--black); padding:.6rem 1rem;">
                <span style="font-family:var(--font-display); font-size:1.1rem; color:var(--white); letter-spacing:2px;">ESPECIFICACIONES</span>
            </div>
            @php
                $specs = [
                    'Estilo'    => $zapato->estilo,
                    'Material'  => $zapato->material,
                    'Color'     => $zapato->color_principal,
                    'Categoría' => $zapato->categoria->nombre ?? '—',
                    'Marca'     => $zapato->marca->nombre ?? '—',
                ];
            @endphp
            @foreach($specs as $label => $value)
                <div style="display:flex; justify-content:space-between; padding:.75rem 1rem;
                            border-bottom:1px solid var(--border); font-size:.88rem;
                            @if($loop->last) border-bottom:none; @endif">
                    <span style="color:var(--gray); font-weight:500;">{{ $label }}</span>
                    <span style="font-weight:600;">{{ $value ?? '—' }}</span>
                </div>
            @endforeach
        </div>

        {{-- ACCIONES --}}
        <div style="display:flex; gap:1rem; flex-wrap:wrap;">
            @if($zapato->disponible)
                <button class="btn-ver" style="flex:1; padding:.75rem; font-size:.88rem; text-align:center;">
                    Agregar al carrito
                </button>
            @else
                <button disabled style="flex:1; padding:.75rem; font-size:.88rem; background:var(--border);
                                        color:var(--gray); border:none; border-radius:var(--radius); font-weight:600;
                                        letter-spacing:1px; text-transform:uppercase; cursor:not-allowed;">
                    No disponible
                </button>
            @endif
            <a href="{{ route('categorias.show', $zapato->categoria_id) }}"
               style="padding:.75rem 1.25rem; border:1.5px solid var(--black); border-radius:var(--radius);
                      font-size:.78rem; font-weight:600; letter-spacing:1px; text-transform:uppercase;
                      text-decoration:none; color:var(--black); transition:all .2s; white-space:nowrap;"
               onmouseover="this.style.background='var(--black)'; this.style.color='var(--white)'"
               onmouseout="this.style.background='transparent'; this.style.color='var(--black)'">
                ← Ver más
            </a>
        </div>
    </div>
</div>

{{-- RELACIONADOS --}}
@if(isset($relacionados) && $relacionados->count())
<div style="margin-top:4rem;">
    <div class="page-header">
        <h1>MÁS EN ESTA CATEGORÍA</h1>
    </div>
    <div class="cards-grid">
        @foreach($relacionados as $i => $rel)
            @include('components.card-zapato', ['zapato' => $rel, 'delay' => ($i % 4) + 1])
        @endforeach
    </div>
</div>
@endif

@endsection

@push('styles')
<style>
    @media (max-width: 768px) {
        div[style*="grid-template-columns:1fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endpush