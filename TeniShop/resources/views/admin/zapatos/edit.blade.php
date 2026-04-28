@extends('layouts.app')

@section('title', 'Editar — ' . $zapato->nombre . ' · STRYDE Admin')

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

    .img-preview {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: var(--radius);
        border: 1.5px solid var(--border);
        margin-bottom: .5rem;
        display: block;
    }
    .img-label {
        font-size: .72rem;
        color: var(--gray);
        margin-bottom: .5rem;
        display: block;
    }

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

    .danger-zone {
        border: 1.5px solid #fce4ec;
        border-radius: var(--radius);
        padding: 1.25rem 1.5rem;
        background: #fff8f8;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1rem;
        gap: 1rem;
    }
    .danger-zone p {
        font-size: .85rem;
        color: var(--gray);
        margin: 0;
    }
    .danger-zone strong { color: #c62828; }
    .btn-danger {
        background: transparent;
        color: #c62828;
        border: 1.5px solid #c62828;
        font-size: .8rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: .55rem 1.25rem;
        border-radius: var(--radius);
        cursor: pointer;
        transition: all .2s;
        white-space: nowrap;
    }
    .btn-danger:hover { background: #c62828; color: var(--white); }
</style>
@endpush

@section('content')

<div class="breadcrumb animate">
    <a href="{{ route('home') }}">Inicio</a>
    <span>/</span>
    <a href="{{ route('admin.zapatos.index') }}">Admin · Zapatos</a>
    <span>/</span>
    <a href="{{ route('productos.show', $zapato->id) }}">{{ $zapato->nombre }}</a>
    <span>/</span>
    <strong style="color:var(--black)">Editar</strong>
</div>

<div class="page-header animate">
    <h1>EDITAR ZAPATO</h1>
    <p>ID #{{ str_pad($zapato->id, 4, '0', STR_PAD_LEFT) }} · {{ $zapato->nombre }}</p>
</div>

<form action="{{ route('admin.zapatos.update', $zapato->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-card animate animate-delay-1">
        <div class="form-card-header"><span>INFORMACIÓN BÁSICA</span></div>
        <div class="form-card-body">
            <div class="form-grid">

                <div class="form-group full">
                    <label for="nombre">Nombre *</label>
                    <input type="text" id="nombre" name="nombre"
                           value="{{ old('nombre', $zapato->nombre) }}">
                    @error('nombre') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="categoria_id">Categoría *</label>
                    <select id="categoria_id" name="categoria_id">
                        @foreach($categorias as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('categoria_id', $zapato->categoria_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="marca_id">Marca *</label>
                    <select id="marca_id" name="marca_id">
                        @foreach($marcas as $marca)
                            <option value="{{ $marca->id }}"
                                {{ old('marca_id', $zapato->marca_id) == $marca->id ? 'selected' : '' }}>
                                {{ $marca->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('marca_id') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group full">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion">{{ old('descripcion', $zapato->descripcion) }}</textarea>
                    @error('descripcion') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

            </div>
        </div>
    </div>

    <div class="form-card animate animate-delay-2">
        <div class="form-card-header"><span>DETALLES DEL PRODUCTO</span></div>
        <div class="form-card-body">
            <div class="form-grid">

                <div class="form-group">
                    <label for="precio">Precio (USD) *</label>
                    <input type="number" id="precio" name="precio" step="0.01" min="0"
                           value="{{ old('precio', $zapato->precio) }}">
                    @error('precio') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="estilo">Estilo</label>
                    <input type="text" id="estilo" name="estilo"
                           value="{{ old('estilo', $zapato->estilo) }}">
                    @error('estilo') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="material">Material</label>
                    <input type="text" id="material" name="material"
                           value="{{ old('material', $zapato->material) }}">
                    @error('material') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="color_principal">Color principal</label>
                    <input type="text" id="color_principal" name="color_principal"
                           value="{{ old('color_principal', $zapato->color_principal) }}">
                    @error('color_principal') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Imagen actual</label>
                    @if($zapato->imagen_principal)
                        <img src="{{ $zapato->imagen_principal }}"
                             alt="Imagen actual"
                             class="img-preview"
                             onerror="this.style.display='none'">
                        <span class="img-label">Subí una nueva para reemplazarla</span>
                    @endif
                  <input type="text" id="imagen_principal" name="imagen_principal"
           value="{{ old('imagen_principal', $zapato->imagen_principal) }}"
           placeholder="https://images.unsplash.com/photo-...">
      @error('imagen_principal') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group" style="justify-content:flex-end; padding-bottom:.2rem;">
                    <label>Disponibilidad</label>
                    <div class="toggle-wrap">
                        <input type="hidden" name="disponible" value="0">
                        <input type="checkbox" id="disponible" name="disponible" value="1"
                               {{ old('disponible', $zapato->disponible) ? 'checked' : '' }}>
                        <label for="disponible" style="text-transform:none; letter-spacing:0; font-size:.9rem; color:var(--black); cursor:pointer;">
                            Disponible para la venta
                        </label>
                    </div>
                </div>

            </div>
        </div>
    </div>

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
                @forelse($zapato->tallas as $i => $talla)
                    <div class="talla-row">
                        <input type="hidden" name="tallas_existentes[{{ $i }}][id]" value="{{ $talla->id }}">
                        <input type="number" name="tallas_existentes[{{ $i }}][talla_us]"
                               step="0.5" min="1" value="{{ $talla->talla_us }}">
                        <input type="number" name="tallas_existentes[{{ $i }}][talla_eu]"
                               step="0.5" min="30" value="{{ $talla->talla_eu }}">
                        <input type="number" name="tallas_existentes[{{ $i }}][stock]"
                               min="0" value="{{ $talla->stock }}">
                        <button type="button" class="btn-remove-talla" onclick="removeTalla(this)">✕</button>
                    </div>
                @empty
                    <div class="talla-row">
                        <input type="number" name="tallas[0][talla_us]" step="0.5" min="1" placeholder="Ej: 9.5">
                        <input type="number" name="tallas[0][talla_eu]" step="0.5" min="30" placeholder="Ej: 43">
                        <input type="number" name="tallas[0][stock]" min="0" placeholder="Ej: 10">
                        <button type="button" class="btn-remove-talla" onclick="removeTalla(this)">✕</button>
                    </div>
                @endforelse
            </div>

            <button type="button" class="btn-add" onclick="addTalla()">+ Agregar talla</button>
        </div>
    </div>

    <div style="display:flex; gap:1rem; justify-content:flex-end; margin-top:.5rem;" class="animate animate-delay-4">
        <a href="{{ route('admin.zapatos.index') }}" class="btn-cancel">Cancelar</a>
        <button type="submit" class="btn-primary">Guardar cambios</button>
    </div>

</form>

<div class="danger-zone animate">
    <div>
        <strong>Eliminar este zapato</strong>
        <p>Esta acción es permanente y eliminará también todas sus tallas e imágenes.</p>
    </div>
    <form action="{{ route('admin.zapatos.destroy', $zapato->id) }}" method="POST"
          onsubmit="return confirm('¿Estás seguro? Se eliminará {{ addslashes($zapato->nombre) }} permanentemente.')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-danger">Eliminar zapato</button>
    </form>
</div>

@endsection

@push('scripts')
<script>
    let tallaIndex = {{ $zapato->tallas->count() }};

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