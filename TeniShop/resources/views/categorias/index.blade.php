@extends('layouts.app')

@section('title', 'STRYDE — Inicio')

@section('content')

{{-- HERO --}}
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

{{-- CATEGORÍAS --}}
<div class="page-header animate">
    <h1>CATEGORÍAS</h1>
    <p>Encuentra tu estilo perfecto</p>
</div>

<div class="cat-grid">
    @forelse($categorias as $i => $categoria)
        <a href="{{ route('categorias.show', $categoria->id) }}"
           class="cat-card animate animate-delay-{{ ($i % 4) + 1 }}">
            <span class="cat-icon">{{ $categoria->icono ?? '👟' }}</span>
            <div class="cat-name">{{ $categoria->nombre }}</div>
            <div class="cat-count">{{ $categoria->zapatos_count ?? 0 }} productos</div>
        </a>
    @empty
        {{-- Vista previa con datos estáticos mientras no hay BD --}}
        @php
            $cats = [
                ['nombre'=>'Casual',    'icono'=>'👟', 'count'=>6],
                ['nombre'=>'Formal',    'icono'=>'👞', 'count'=>5],
                ['nombre'=>'Deportivo', 'icono'=>'🏃', 'count'=>7],
                ['nombre'=>'Sandalias', 'icono'=>'🩴', 'count'=>5],
                ['nombre'=>'Botas',     'icono'=>'🥾', 'count'=>5],
                ['nombre'=>'Infantil',  'icono'=>'🧒', 'count'=>4],
            ];
        @endphp
        @foreach($cats as $i => $cat)
            <a href="{{ route('categorias.show', $i+1) }}"
               class="cat-card animate animate-delay-{{ ($i % 4) + 1 }}">
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