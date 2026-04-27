@extends('layouts.app')

@section('title', 'Nuevo Zapato — STRYDE Admin')

@push('styles')
<style>
    .form-card {
        background: var(--card-bg);
        border: 1.5px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    .form-card-header {
        background: var(--black);
        padding: .7rem 1.25rem;
    }
    .form-card-header span {
        font-family: var(--font-display);
        font-size: 1.2rem;
        color: var(--white);
        letter-spacing: 2px;
    }
    .form-card-body { padding: 1.5rem 1.25rem; }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
    }
    .form-group { display: flex; flex-direction: column; gap: .4rem; }
    .form-group.full { grid-column: 1 / -1; }

    label {
        font-size: .75rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: var(--gray);
    }
    input[type="text"],
    input[type="number"],
    input[type="file"],
    select,
    textarea {
        border: 1.5px solid var(--border);
        border-radius: var(--radius);
        padding: .55rem .9rem;
        font-family: var(--font-body);
        font-size: .9rem;
        background: var(--white);
        outline: none;
        transition: border-color .2s;
        width: 100%;
    }
    input:focus, select:focus, textarea:focus { border-color: var(--black); }
    textarea { resize: vertical; min-height: 100px; }

    .error-msg {
        color: var(--accent);
        font-size: .78rem;
        font-weight: 600;
    }

    .btn-primary {
        background: var(--accent);
        color: var(--white);
        font-size: .85rem;
        font-weight: 600;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: .75rem 2rem;
        border-radius: var(--radius);
        border: none;
        cursor: pointer;
        transition: background .2s;
    }
    .btn-primary:hover { background: #a83f1f; }

    .btn-cancel {
        background: transparent;
        color: var(--black);
        font-size: .85rem;
        font-weight: 600;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: .75rem 1.5rem;
        border-radius: var(--radius);
        border: 1.5px solid var(--border);
        text-decoration: none;
        transition: border-color .2s;
        display: inline-block;
    }
    .btn-cancel:hover { border-color: var(--black); }

    /* Tallas dinámicas */
    .talla-row {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr auto;
        gap: .75rem;
        align-items: end;
        margin-bottom: .75rem;
    }
    .btn-remove-talla {
        background: transparent;
        border: 1.5px solid var(--accent);
        color: var(--accent);
        border-radius: var(--radius);
        padding: .5rem .75rem;
        cursor: pointer;
        font-size: .85rem;
        transition: all .2s;
        white-space: nowrap;
    }
    .btn-remove-talla:hover { background: var(--accent); color: var(--white); }

    .btn-add {
        background: var(--cream);
        border: 1.5px dashed var(--border);
        color: var(--gray);
        border-radius: var(--radius);
        padding: .55rem 1.25rem;
        cursor: pointer;
        font-size: .82rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: border-color .2s, color .2s;
        width: 100%;
        margin-top: .5rem;
    }
    .btn-add:hover { border-color: var(--black); color: var(--black); }

    .toggle-wrap {
        display: flex;
        align-items: center;
        gap: .75rem;
    }
    .toggle-wrap input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: var(--black);
    }
</style>
@endpush

@section('content')

{{-- BREADCRUMB --}}
<div class="breadcrumb animate">
    <a href="{{ route('home') }}">Inicio</a>
    <span>/</span>
    <a href="{{ route('admin.zapatos.index') }}">Admin · Zapatos</a>
    <span>/</span>
    <strong style="color:var(--black)">Nuevo</strong>
</div>

<div class="page-header animate">
    <h1>NUEVO ZAPATO</h1>
    <p>Completá los campos para agregar un producto al catálogo.</p>
</div>

<form action="{{ route('admin.zapatos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- ── INFORMACIÓN BÁSICA ── --}}
    <div class="form-card animate animate-delay-1">
        <div class="form-card-header"><span>INFORMACIÓN BÁSICA</span></div>
        <div class="form-card-body">
            <div class="form-grid">

                <div class="form-group full">
                    <label for="nombre">Nombre *</label>
                    <input type="text" id="nombre" name="nombre"
                           value="{{ old('nombre') }}" placeholder="Ej: Nike Air Max 270">
                    @error('nombre') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="categoria_id">Categoría *</label>
                    <select id="categoria_id" name="categoria_id">
                        <option value="">Seleccioná una categoría</option>
                        @foreach($categorias as $cat)
                            <option value="{{ $cat->id }}" {{ old('categoria_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="marca_id">Marca *</label>
                    <select id="marca_id" name="marca_id">
                        <option value="">Seleccioná una marca</option>
                        @foreach($marcas as $marca)
                            <option value="{{ $marca->id }}" {{ old('marca_id') == $marca->id ? 'selected' : '' }}>
                                {{ $marca->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('marca_id') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group full">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion"
                              placeholder="Describí el producto...">{{ old('descripcion') }}</textarea>
                    @error('descripcion') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

            </div>
        </div>
    </div>

    {{-- ── DETALLES ── --}}
    <div class="form-card animate animate-delay-2">
        <div class="form-card-header"><span>DETALLES DEL PRODUCTO</span></div>
        <div class="form-card-body">
            <div class="form-grid">

                <div class="form-group">
                    <label for="precio">Precio (USD) *</label>
                    <input type="number" id="precio" name="precio" step="0.01" min="0"
                           value="{{ old('precio') }}" placeholder="0.00">
                    @error('precio') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="estilo">Estilo</label>
                    <input type="text" id="estilo" name="estilo"
                           value="{{ old('estilo') }}" placeholder="Ej: Running, Oxford, Slip-on">
                    @error('estilo') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="material">Material</label>
                    <input type="text" id="material" name="material"
                           value="{{ old('material') }}" placeholder="Ej: Cuero, Malla, Ante">
                    @error('material') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="color_principal">Color principal</label>
                    <input type="text" id="color_principal" name="color_principal"
                           value="{{ old('color_principal') }}" placeholder="Ej: Negro, Blanco/Rojo">
                    @error('color_principal') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="imagen_principal">Imagen principal</label>
                    <input type="file" id="imagen_principal" name="imagen_principal" accept="image/*">
                    @error('imagen_principal') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group" style="justify-content:flex-end; padding-bottom:.2rem;">
                    <label>Disponibilidad</label>
                    <div class="toggle-wrap">
                        <input type="hidden" name="disponible" value="0">
                        <input type="checkbox" id="disponible" name="disponible" value="1"
                               {{ old('disponible', 1) ? 'checked' : '' }}>
                        <label for="disponible" style="text-transform:none; letter-spacing:0; font-size:.9rem; color:var(--black); cursor:pointer;">
                            Disponible para la venta
                        </label>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ── TALLAS ── --}}
    <div class="form-card animate animate-delay-3">
        <div class="form-card-header"><span>TALLAS Y STOCK</span></div>
        <div class="form-card-body">

            <div style="display:grid; grid-template-columns: 1fr 1fr 1fr auto; gap:.75rem; margin-bottom:.5rem;">
                <label>Talla US</label>
                <label>Talla EU</label>
                <label>Stock</label>
                <span></span>
            </div>

            <div id="tallas-container">
                <div class="talla-row">
                    <input type="number" name="tallas[0][talla_us]" step="0.5" min="1" placeholder="Ej: 9.5">
                    <input type="number" name="tallas[0][talla_eu]" step="0.5" min="30" placeholder="Ej: 43">
                    <input type="number" name="tallas[0][stock]" min="0" placeholder="Ej: 10">
                    <button type="button" class="btn-remove-talla" onclick="removeTalla(this)">✕</button>
                </div>
            </div>

            <button type="button" class="btn-add" onclick="addTalla()">+ Agregar talla</button>
        </div>
    </div>

    {{-- ── BOTONES ── --}}
    <div style="display:flex; gap:1rem; justify-content:flex-end; margin-top:.5rem;" class="animate animate-delay-4">
        <a href="{{ route('admin.zapatos.index') }}" class="btn-cancel">Cancelar</a>
        <button type="submit" class="btn-primary">Guardar zapato</button>
    </div>

</form>

@endsection

@push('scripts')
<script>
    let tallaIndex = 1;

    function addTalla() {
        const container = document.getElementById('tallas-container');
        const row = document.createElement('div');
        row.className = 'talla-row';
        row.innerHTML = `
            <input type="number" name="tallas[${tallaIndex}][talla_us]" step="0.5" min="1" placeholder="Ej: 9.5">
            <input type="number" name="tallas[${tallaIndex}][talla_eu]" step="0.5" min="30" placeholder="Ej: 43">
            <input type="number" name="tallas[${tallaIndex}][stock]" min="0" placeholder="Ej: 10">
            <button type="button" class="btn-remove-talla" onclick="removeTalla(this)">✕</button>
        `;
        container.appendChild(row);
        tallaIndex++;
    }

    function removeTalla(btn) {
        const rows = document.querySelectorAll('.talla-row');
        if (rows.length > 1) {
            btn.closest('.talla-row').remove();
        }
    }
</script>
@endpush