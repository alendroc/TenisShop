@extends('layouts.app')

@section('title', 'Búsqueda: "' . request('q') . '" — STRYDE')

@section('content')

<div class="breadcrumb animate">
    <a href="{{ route('home') }}">Inicio</a>
    <span>/</span>
    <strong style="color:var(--black)">Búsqueda</strong>
</div>

<div class="page-header animate">
    <h1>RESULTADOS</h1>
    <p>
        @if(request('q'))
            {{ $zapatos->total() }} resultado{{ $zapatos->total() !== 1 ? 's' : '' }}
            para <strong>"{{ request('q') }}"</strong>
        @else
            Ingresa un término para buscar
        @endif
    </p>
</div>

{{-- Nuevo search prominente --}}
<form action="{{ route('buscar') }}" method="GET"
      style="display:flex; max-width:560px; margin-bottom:2.5rem; border:2px solid var(--black);
             border-radius:var(--radius); overflow:hidden;">
    <input type="text" name="q" value="{{ request('q') }}"
           placeholder="Buscar zapatos, marcas, materiales..."
           autofocus
           style="flex:1; border:none; outline:none; padding:.65rem 1.25rem;
                  font-family:var(--font-body); font-size:1rem; background:var(--white);">
    <button type="submit"
            style="background:var(--black); border:none; color:var(--white);
                   padding:.65rem 1.25rem; cursor:pointer; font-size:.9rem; font-weight:600;
                   letter-spacing:1px; text-transform:uppercase; font-family:var(--font-body);">
        Buscar
    </button>
</form>

@if(request('q'))
    @if($zapatos->count())
        <div class="cards-grid">
            @foreach($zapatos as $i => $zapato)
                @include('components.card-zapato', ['zapato' => $zapato, 'delay' => ($i % 4) + 1])
            @endforeach
        </div>

        <div class="pagination-wrap">
            {{ $zapatos->appends(request()->query())->links('components.paginacion') }}
        </div>
    @else
        <div class="empty-state animate">
            <span class="emoji">👟</span>
            <h3>Sin resultados</h3>
            <p>No encontramos productos para <strong>"{{ request('q') }}"</strong>.</p>
            <p style="margin-top:.5rem; font-size:.88rem;">Intenta con otro término o explora nuestras categorías.</p>
            <a href="{{ route('categorias.index') }}" class="btn-ver" style="display:inline-block; margin-top:1.5rem;">
                Ver Categorías
            </a>
        </div>
    @endif
@endif

@endsection