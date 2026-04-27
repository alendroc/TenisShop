@extends('layouts.app')

@section('title', 'Admin — Zapatos · STRYDE')

@push('styles')
<style>
    .admin-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--black);
    }
    .admin-header h1 {
        font-family: var(--font-display);
        font-size: 2.8rem;
        letter-spacing: 2px;
    }
    .btn-primary {
        background: var(--accent);
        color: var(--white);
        text-decoration: none;
        font-size: .8rem;
        font-weight: 600;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: .6rem 1.4rem;
        border-radius: var(--radius);
        border: none;
        cursor: pointer;
        transition: background .2s;
        display: inline-block;
    }
    .btn-primary:hover { background: #a83f1f; }

    .btn-edit {
        background: var(--black);
        color: var(--white);
        text-decoration: none;
        font-size: .75rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: .35rem .8rem;
        border-radius: var(--radius);
        border: none;
        cursor: pointer;
        transition: background .2s;
        display: inline-block;
    }
    .btn-edit:hover { background: #333; }

    .btn-delete {
        background: transparent;
        color: var(--accent);
        font-size: .75rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: .35rem .8rem;
        border-radius: var(--radius);
        border: 1.5px solid var(--accent);
        cursor: pointer;
        transition: all .2s;
    }
    .btn-delete:hover { background: var(--accent); color: var(--white); }

    /* Filtros */
    .filters-bar {
        display: flex;
        gap: 1rem;
        align-items: center;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
        padding: 1rem 1.25rem;
        background: var(--cream);
        border-radius: var(--radius);
        border: 1.5px solid var(--border);
    }
    .filters-bar input,
    .filters-bar select {
        border: 1.5px solid var(--border);
        border-radius: var(--radius);
        padding: .4rem .85rem;
        font-family: var(--font-body);
        font-size: .85rem;
        background: var(--white);
        outline: none;
        transition: border-color .2s;
    }
    .filters-bar input:focus,
    .filters-bar select:focus { border-color: var(--black); }

    /* Tabla */
    .admin-table {
        width: 100%;
        border-collapse: collapse;
        font-size: .88rem;
    }
    .admin-table thead tr {
        background: var(--black);
        color: var(--white);
    }
    .admin-table th {
        padding: .75rem 1rem;
        text-align: left;
        font-size: .72rem;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        font-weight: 600;
    }
    .admin-table td {
        padding: .75rem 1rem;
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
    }
    .admin-table tbody tr:hover { background: var(--cream); }
    .admin-table tbody tr:last-child td { border-bottom: none; }

    .table-wrap {
        border: 1.5px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
    }

    .thumb {
        width: 52px;
        height: 52px;
        object-fit: cover;
        border-radius: 4px;
        background: var(--cream);
        border: 1px solid var(--border);
    }

    .badge-disponible {
        background: #e8f5e9;
        color: #2e7d32;
        font-size: .7rem;
        font-weight: 700;
        padding: .2rem .6rem;
        border-radius: 2px;
        letter-spacing: .5px;
    }
    .badge-agotado {
        background: #fce4ec;
        color: #c62828;
        font-size: .7rem;
        font-weight: 700;
        padding: .2rem .6rem;
        border-radius: 2px;
        letter-spacing: .5px;
    }

    /* Alert */
    .alert-success {
        background: #e8f5e9;
        color: #2e7d32;
        padding: .85rem 1.25rem;
        border-radius: var(--radius);
        font-size: .88rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        border-left: 4px solid #2e7d32;
    }
</style>
@endpush

@section('content')

{{-- BREADCRUMB --}}
<div class="breadcrumb animate">
    <a href="{{ route('home') }}">Inicio</a>
    <span>/</span>
    <strong style="color:var(--black)">Admin · Zapatos</strong>
</div>

{{-- HEADER --}}
<div class="admin-header animate">
    <h1>ZAPATOS</h1>
    <a href="{{ route('admin.zapatos.create') }}" class="btn-primary">+ Nuevo zapato</a>
</div>

{{-- ALERT --}}
@if(session('success'))
    <div class="alert-success animate">✓ {{ session('success') }}</div>
@endif

{{-- FILTROS --}}
<form action="{{ route('admin.zapatos.index') }}" method="GET" class="filters-bar animate">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar por nombre...">

    <select name="categoria" onchange="this.form.submit()">
        <option value="">Todas las categorías</option>
        @foreach($categorias as $cat)
            <option value="{{ $cat->id }}" {{ request('categoria') == $cat->id ? 'selected' : '' }}>
                {{ $cat->nombre }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="btn-primary">Filtrar</button>

    @if(request()->hasAny(['q','categoria']))
        <a href="{{ route('admin.zapatos.index') }}" style="font-size:.82rem; color:var(--gray); text-decoration:none;">
            Limpiar filtros ✕
        </a>
    @endif
</form>

{{-- TABLA --}}
<div class="table-wrap animate">
    <table class="admin-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Marca</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($zapatos as $zapato)
                <tr>
                    <td style="color:var(--gray); font-size:.78rem;">
                        #{{ str_pad($zapato->id, 4, '0', STR_PAD_LEFT) }}
                    </td>
                    <td>
                        <img class="thumb"
                             src="{{ $zapato->imagen_principal }}"
                             alt="{{ $zapato->nombre }}"
                             onerror="this.src='https://via.placeholder.com/52?text=?'">
                    </td>
                    <td style="font-weight:600;">{{ $zapato->nombre }}</td>
                    <td style="color:var(--gray);">{{ $zapato->categoria->nombre ?? '—' }}</td>
                    <td style="color:var(--gray);">{{ $zapato->marca->nombre ?? '—' }}</td>
                    <td style="font-family:var(--font-display); font-size:1.1rem;">
                        ${{ number_format($zapato->precio, 2) }}
                    </td>
                    <td>
                        @if($zapato->disponible)
                            <span class="badge-disponible">Disponible</span>
                        @else
                            <span class="badge-agotado">Agotado</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex; gap:.5rem; align-items:center;">
                            {{-- Ver detalle --}}
                            <a href="{{ route('productos.show', $zapato->id) }}"
                               class="btn-edit" title="Ver">👁</a>

                            {{-- Editar --}}
                            <a href="{{ route('admin.zapatos.edit', $zapato->id) }}"
                               class="btn-edit" title="Editar">✏️</a>

                            {{-- Eliminar --}}
                            <form action="{{ route('admin.zapatos.destroy', $zapato->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('¿Eliminar {{ addslashes($zapato->nombre) }}? Esta acción no se puede deshacer.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" title="Eliminar">✕</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align:center; padding:3rem; color:var(--gray);">
                        No se encontraron zapatos.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- PAGINACIÓN --}}
@if($zapatos->hasPages())
    <div class="pagination-wrap">
        {{ $zapatos->appends(request()->query())->links('components.paginacion') }}
    </div>
@endif

<p style="color:var(--gray); font-size:.8rem; margin-top:1rem; text-align:right;">
    Mostrando {{ $zapatos->firstItem() }}–{{ $zapatos->lastItem() }} de {{ $zapatos->total() }} zapatos
</p>

@endsection