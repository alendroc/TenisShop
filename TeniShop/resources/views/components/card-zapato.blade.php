{{-- components/card-zapato.blade.php --}}
{{-- Uso: @include('components.card-zapato', ['zapato' => $zapato, 'delay' => 1]) --}}

<div class="card animate animate-delay-{{ $delay ?? 1 }}">

    {{-- Badge disponibilidad --}}
    @if(!$zapato->disponible)
        <span class="card-badge agotado">Agotado</span>
    @else
        <span class="card-badge">Disponible</span>
    @endif

    {{-- Imagen --}}
    <img class="card-img"
         src="{{ $zapato->imagen_principal }}"
         alt="{{ $zapato->nombre }}"
         loading="lazy"
         onerror="this.src='https://via.placeholder.com/600x450?text=Sin+imagen'">

    <div class="card-body">
        {{-- Marca --}}
        <div class="card-marca">{{ $zapato->marca->nombre ?? '—' }}</div>

        {{-- Nombre --}}
        <div class="card-nombre">{{ $zapato->nombre }}</div>

        {{-- Tags --}}
        <div class="card-meta">
            @if($zapato->estilo)
                <span class="tag">{{ $zapato->estilo }}</span>
            @endif
            @if($zapato->material)
                <span class="tag">{{ $zapato->material }}</span>
            @endif
            @if($zapato->color_principal)
                <span class="tag">{{ $zapato->color_principal }}</span>
            @endif
        </div>

        {{-- Precio + CTA --}}
        <div class="card-footer">
            <span class="card-precio">${{ number_format($zapato->precio, 2) }}</span>
            <a href="{{ route('productos.show', $zapato->id) }}" class="btn-ver">Ver más</a>
        </div>
    </div>
</div>