    @extends('layouts.app')

@section('title', 'STRYDE — Tienda de Zapatos')

@push('styles')
<style>
 
    .hero {
        position: relative;
        background: var(--black);
        border-radius: var(--radius);
        overflow: hidden;
        padding: 5rem 3.5rem;
        margin-bottom: 4rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 2rem;
        min-height: 380px;
    }
    .hero-bg {
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse at 80% 50%, rgba(200, 80, 42, 0.18) 0%, transparent 60%),
            radial-gradient(ellipse at 10% 80%, rgba(42, 76, 143, 0.15) 0%, transparent 50%);
        pointer-events: none;
    }
    .hero-content { position: relative; z-index: 1; max-width: 520px; }
    .hero-eyebrow {
        font-size: .75rem;
        font-weight: 600;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--accent);
        margin-bottom: 1rem;
        display: block;
    }
    .hero-title {
        font-family: var(--font-display);
        font-size: clamp(3.5rem, 7vw, 6rem);
        color: var(--white);
        line-height: .95;
        letter-spacing: 3px;
        margin-bottom: 1.2rem;
    }
    .hero-title span { color: var(--accent); }
    .hero-subtitle {
        color: rgba(245,242,238,.6);
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 2rem;
        max-width: 400px;
    }
    .hero-cta {
        display: inline-flex;
        align-items: center;
        gap: .6rem;
        background: var(--accent);
        color: var(--white);
        text-decoration: none;
        font-size: .85rem;
        font-weight: 600;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: .85rem 2rem;
        border-radius: var(--radius);
        transition: background .2s, transform .2s;
    }
    .hero-cta:hover { background: #a83f1f; transform: translateY(-2px); }
    .hero-cta-secondary {
        display: inline-flex;
        align-items: center;
        gap: .6rem;
        background: transparent;
        color: var(--white);
        text-decoration: none;
        font-size: .85rem;
        font-weight: 600;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: .85rem 2rem;
        border-radius: var(--radius);
        border: 1.5px solid rgba(245,242,238,.25);
        transition: border-color .2s, transform .2s;
        margin-left: .75rem;
    }
    .hero-cta-secondary:hover { border-color: var(--white); transform: translateY(-2px); }
    .hero-stats {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        text-align: right;
    }
    .hero-stat-number {
        font-family: var(--font-display);
        font-size: 3.5rem;
        color: var(--white);
        line-height: 1;
        letter-spacing: 2px;
    }
    .hero-stat-label {
        font-size: .72rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: rgba(245,242,238,.4);
        margin-top: .1rem;
    }
    .hero-divider {
        width: 1px;
        height: 60px;
        background: rgba(245,242,238,.15);
        margin-left: auto;
    }

    /* ── SECTION HEADER ── */
    .section-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 1.75rem;
        padding-bottom: 1rem;
        border-bottom: 1.5px solid var(--border);
    }
    .section-title {
        font-family: var(--font-display);
        font-size: 2.5rem;
        letter-spacing: 2px;
        line-height: 1;
    }
    .section-title span { color: var(--accent); }
    .section-link {
        font-size: .78rem;
        font-weight: 600;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: var(--gray);
        text-decoration: none;
        transition: color .2s;
        white-space: nowrap;
    }
    .section-link:hover { color: var(--accent); }

    /* ── CATEGORÍAS ── */
    .section-categorias { margin-bottom: 4.5rem; }

    .cat-card {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-end;
        min-height: 160px;
        transition: transform .25s ease, box-shadow .25s ease, filter .25s ease;
        color: #fff;
    }
    .cat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 32px rgba(0,0,0,.2);
        filter: brightness(1.1);
    }
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

    /* ── BANNER INTERMEDIO ── */
    .banner-mid {
        background: var(--black);
        border-radius: var(--radius);
        padding: 3rem 3.5rem;
        margin: 4rem 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 2rem;
        position: relative;
        overflow: hidden;
    }
    .banner-mid::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at 100% 50%, rgba(42,76,143,.25) 0%, transparent 60%);
    }
    .banner-mid-text { position: relative; z-index: 1; }
    .banner-mid-text h2 {
        font-family: var(--font-display);
        font-size: 2.8rem;
        color: var(--white);
        letter-spacing: 3px;
        line-height: 1;
        margin-bottom: .5rem;
    }
    .banner-mid-text h2 span { color: var(--accent); }
    .banner-mid-text p {
        color: rgba(245,242,238,.5);
        font-size: .9rem;
    }
    .banner-mid-cta { position: relative; z-index: 1; }

    /* ── FEATURED PRODUCTS ── */
    .section-productos { margin-bottom: 4rem; }

    /* ── FEATURES ── */
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-top: 4rem;
    }
    .feature-card {
        background: var(--card-bg);
        border: 1.5px solid var(--border);
        border-radius: var(--radius);
        padding: 1.75rem 1.5rem;
        transition: border-color .2s, transform .2s;
    }
    .feature-card:hover {
        border-color: var(--black);
        transform: translateY(-3px);
    }
    .feature-icon {
        font-size: 2rem;
        margin-bottom: 1rem;
        display: block;
    }
    .feature-title {
        font-family: var(--font-display);
        font-size: 1.3rem;
        letter-spacing: 1px;
        margin-bottom: .4rem;
    }
    .feature-desc {
        font-size: .82rem;
        color: var(--gray);
        line-height: 1.6;
    }
</style>
@endpush

@section('content')

{{-- ── HERO ── --}}
<section class="hero animate animate-delay-1">
    <div class="hero-bg"></div>

    <div class="hero-content">
        <span class="hero-eyebrow">Nueva colección 2026</span>
        <h1 class="hero-title">EL PASO<br>QUE TE<br><span>DEFINE</span></h1>
        <p class="hero-subtitle">
            Calzado de calidad para cada estilo de vida.
            Encontrá tu par perfecto entre más de {{ $totalZapatos ?? 30 }} modelos.
        </p>
        <div>
            <a href="{{ route('categorias.index') }}" class="hero-cta">
                Ver colección →
            </a>
            <a href="{{ route('buscar', ['q' => '']) }}" class="hero-cta-secondary">
                Explorar todo
            </a>
        </div>
    </div>

    <div class="hero-stats">
        <div>
            <div class="hero-stat-number">{{ $totalZapatos ?? '30' }}+</div>
            <div class="hero-stat-label">Modelos</div>
        </div>
        <div class="hero-divider"></div>
        <div>
            <div class="hero-stat-number">{{ $totalMarcas ?? '6' }}</div>
            <div class="hero-stat-label">Marcas</div>
        </div>
        <div class="hero-divider"></div>
        <div>
            <div class="hero-stat-number">{{ $totalCategorias ?? '5' }}</div>
            <div class="hero-stat-label">Categorías</div>
        </div>
    </div>
</section>

{{-- ── CATEGORÍAS ── --}}
<section class="section-categorias">
    <div class="section-header">
        <h2 class="section-title">CATEGO<span>RÍAS</span></h2>
        <a href="{{ route('categorias.index') }}" class="section-link">Ver todas →</a>
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
</section>

{{-- ── BANNER INTERMEDIO ── --}}
<div class="banner-mid animate animate-delay-2">
    <div class="banner-mid-text">
        <h2>ENVÍO <span>GRATIS</span></h2>
        <p>En compras mayores a ₡25,000 · Entrega en 24–48 horas</p>
    </div>
    <div class="banner-mid-cta">
        <a href="{{ route('buscar', ['q' => '']) }}" class="hero-cta">Comprar ahora →</a>
    </div>
</div>

{{-- ── PRODUCTOS DESTACADOS ── --}}
<section class="section-productos">
    <div class="section-header">
        <h2 class="section-title">DESTA<span>CADOS</span></h2>
        <a href="{{ route('buscar', ['q' => '']) }}" class="section-link">Ver todos →</a>
    </div>

    <div class="cards-grid">
        @forelse($destacados as $i => $zapato)
            <x-card-zapato :zapato="$zapato" :delay="($i % 4) + 1" />
        @empty
            <div class="empty-state" style="grid-column: 1/-1;">
                <span class="emoji">👟</span>
                <h3>Pronto habrá productos</h3>
                <p>Estamos cargando el catálogo.</p>
            </div>
        @endforelse
    </div>
</section>



@endsection