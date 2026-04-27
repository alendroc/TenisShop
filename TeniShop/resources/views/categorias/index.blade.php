@extends('layouts.app')

@section('title', 'STRYDE — Inicio')

@section('content')


<style>
        .cat-running         { background: linear-gradient(135deg, #b89070, #9a7358); }
    .cat-running:hover   { background: linear-gradient(135deg, #c8a080, #aa8368); }
    .cat-casual          { background: linear-gradient(135deg, #7898b0, #5a7a96); }
    .cat-casual:hover    { background: linear-gradient(135deg, #88a8c0, #6a8aa6); }
    .cat-formal          { background: linear-gradient(135deg, #6a7a7e, #4e5e62); }
    .cat-formal:hover    { background: linear-gradient(135deg, #7a8a8e, #5e6e72); }
    .cat-deportivo-mujer { background: linear-gradient(135deg, #b07888, #966070); }
    .cat-deportivo-mujer:hover { background: linear-gradient(135deg, #c08898, #a67080); }
    .cat-infantil        { background: linear-gradient(135deg, #7aaa8e, #5e9070); }
    .cat-infantil:hover  { background: linear-gradient(135deg, #8aba9e, #6ea080); }
    .cat-default         { background: linear-gradient(135deg, #909898, #707880); }
    .cat-default:hover   { background: linear-gradient(135deg, #a0a8a8, #808890); }
</style>

<div style="
    background: var(--black);
    border-radius: var(--radius);
    padding: 4rem 3rem;
    margin-bottom: 3rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    overflow: hidden;
    position: relative;
">
    <div style="position: relative; z-index:1;">
        <p style="color:var(--accent); font-size:.8rem; letter-spacing:3px; text-transform:uppercase; font-weight:600; margin-bottom:.75rem;">Nueva Colección 2025</p>
        <h1 style="font-family:var(--font-display); font-size:5rem; color:var(--white); letter-spacing:3px; line-height:1; margin-bottom:1.25rem;">
            EL PASO<br>PERFECTO
        </h1>
        <p style="color:var(--gray); max-width:380px; margin-bottom:1.75rem; line-height:1.7;">
            Descubre nuestra selección de calzado de las mejores marcas. Desde sneakers hasta botas, para cada momento.
        </p>
        <a href="{{ route('categorias.index') }}" class="btn-ver" style="font-size:.9rem; padding:.65rem 1.5rem;">
            Ver Categorías →
        </a>
    </div>
    <div style="font-size:10rem; opacity:.07; position:absolute; right:2rem; top:50%; transform:translateY(-50%);">👟</div>
</div>


<div class="page-header animate">
    <h1>CATEGORÍAS</h1>
    <p>Encuentra tu estilo perfecto</p>
</div>

    <div class="cat-grid">
        @forelse($categorias as $i => $categoria)
            @php
                $config = match(strtolower($categoria->nombre)) {
                    'running'         => ['icono' => '🏃', 'clase' => 'cat-running'],
                    'casual'          => ['icono' => '👟', 'clase' => 'cat-casual'],
                    'formal'          => ['icono' => '👞', 'clase' => 'cat-formal'],
                    'deportivo mujer' => ['icono' => '👠', 'clase' => 'cat-deportivo-mujer'],
                    'infantil'        => ['icono' => '🧒', 'clase' => 'cat-infantil'],
                    default           => ['icono' => '👟', 'clase' => 'cat-default'],
                };
            @endphp
            <a href="{{ route('categorias.show', $categoria->id) }}"
               class="cat-card animate animate-delay-{{ ($i % 4) + 1 }} {{ $config['clase'] }}">
                <span class="cat-icon">{{ $config['icono'] }}</span>
                <div class="cat-name">{{ $categoria->nombre }}</div>
                <div class="cat-count">{{ $categoria->zapatos_count ?? 0 }} productos</div>
            </a>
        @empty
            @php
                $cats = [
                    ['nombre' => 'Running',         'icono' => '🏃', 'count' => 7,  'clase' => 'cat-running'],
                    ['nombre' => 'Casual',          'icono' => '👟', 'count' => 6,  'clase' => 'cat-casual'],
                    ['nombre' => 'Formal',          'icono' => '👞', 'count' => 5,  'clase' => 'cat-formal'],
                    ['nombre' => 'Deportivo Mujer', 'icono' => '👠', 'count' => 5,  'clase' => 'cat-deportivo-mujer'],
                    ['nombre' => 'Infantil',        'icono' => '🧒', 'count' => 4,  'clase' => 'cat-infantil'],
                ];
            @endphp
            @foreach($cats as $i => $cat)
                <a href="{{ route('categorias.show', $i+1) }}"
                   class="cat-card animate animate-delay-{{ ($i % 4) + 1 }} {{ $cat['clase'] }}">
                    <span class="cat-icon">{{ $cat['icono'] }}</span>
                    <div class="cat-name">{{ $cat['nombre'] }}</div>
                    <div class="cat-count">{{ $cat['count'] }} productos</div>
                </a>
            @endforeach
        @endforelse
    </div>

{{-- DESTACADOS --}}
@if(isset($destacados) && $destacados->count())
<div class="page-header animate" style="margin-top:3.5rem;">
    <h1>DESTACADOS</h1>
    <p>Los más populares de la temporada</p>
</div>

<div class="cards-grid">
    @foreach($destacados as $i => $zapato)
        @include('components.card-zapato', ['zapato' => $zapato, 'delay' => ($i % 4) + 1])
    @endforeach
</div>
@endif

@endsection