@extends('layouts.app')

@section('title', ($categoria->nombre ?? 'Categoría') . ' — STRYDE')

@section('content')

{{-- BREADCRUMB --}}
<div class="breadcrumb animate">
    <a href="{{ route('home') }}">Inicio</a>
    <span>/</span>
    <a href="{{ route('categorias.index') }}">Categorías</a>
    <span>/</span>
    <strong style="color:var(--black)">{{ $categoria->nombre ?? 'Categoría' }}</strong>
</div>

{{-- HEADER --}}
<div class="page-header animate">
    <h1>{{ strtoupper($categoria->nombre ?? 'Categoría') }}</h1>
    <p>
        {{ $zapatos->total() }} producto{{ $zapatos->total() !== 1 ? 's' : '' }} encontrado{{ $zapatos->total() !== 1 ? 's' : '' }}
        @if(request('q'))
            — búsqueda: <strong>"{{ request('q') }}"</strong>
        @endif
    </p>
</div>

{{-- FILTROS / ORDENAMIENTO --}}
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; flex-wrap:wrap; gap:1rem;">

    {{-- Búsqueda dentro de categoría --}}
    <form action="{{ route('categorias.show', $categoria->id) }}" method="GET"
          style="display:flex; gap:0; border:1.5px solid var(--border); border-radius:var(--radius); overflow:hidden;">
        <input type="text" name="q" value="{{ request('q') }}"
               placeholder="Buscar en {{ $categoria->nombre ?? 'esta categoría' }}..."
               style="border:none; outline:none; padding:.45rem 1rem; font-family:var(--font-body); font-size:.85rem; width:220px; background:var(--white);">
        <button type="submit"
                style="background:var(--black); border:none; color:var(--white); padding:.45rem .9rem; cursor:pointer;">
            🔍
        </button>
    </form>

    {{-- Ordenamiento --}}
    <form action="{{ route('categorias.show', $categoria->id) }}" method="GET">
        @if(request('q'))
            <input type="hidden" name="q" value="{{ request('q') }}">
        @endif
        <select name="orden" onchange="this.form.submit()"
                style="border:1.5px solid var(--border); border-radius:var(--radius); padding:.45rem .9rem;
                       font-family:var(--font-body); font-size:.85rem; background:var(--white); cursor:pointer; outline:none;">
            <option value="">Ordenar por...</option>
            <option value="precio_asc"  {{ request('orden') === 'precio_asc'  ? 'selected' : '' }}>Precio: menor a mayor</option>
            <option value="precio_desc" {{ request('orden') === 'precio_desc' ? 'selected' : '' }}>Precio: mayor a menor</option>
            <option value="nombre_asc"  {{ request('orden') === 'nombre_asc'  ? 'selected' : '' }}>Nombre A–Z</option>
        </select>
    </form>
</div>

{{-- GRID DE PRODUCTOS --}}
@if($zapatos->count())
    <div class="cards-grid">
        @foreach($zapatos as $i => $zapato)
            @include('components.card-zapato', ['zapato' => $zapato, 'delay' => ($i % 4) + 1])
        @endforeach
    </div>

    {{-- PAGINACIÓN --}}
    <div class="pagination-wrap">
        {{ $zapatos->appends(request()->query())->links('components.paginacion') }}
    </div>

@else
    <div class="empty-state animate">
        <span class="emoji">🔍</span>
        <h3>Sin resultados</h3>
        <p>No encontramos productos con ese criterio en <strong>{{ $categoria->nombre }}</strong>.</p>
        <a href="{{ route('categorias.show', $categoria->id) }}" class="btn-ver" style="display:inline-block; margin-top:1.25rem;">
            Ver todos los productos
        </a>
    </div>
@endif

@endsection