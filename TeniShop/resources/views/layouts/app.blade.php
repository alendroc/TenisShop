<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'STRYDE — Tienda de Zapatos')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --black:   #0a0a0a;
            --white:   #f5f2ee;
            --cream:   #ede8e0;
            --accent:  #c8502a;
            --accent2: #2a4c8f;
            --gray:    #7a7672;
            --border:  #d4cfc8;
            --card-bg: #ffffff;
            --radius:  6px;
            --font-display: 'Bebas Neue', sans-serif;
            --font-body:    'DM Sans', sans-serif;
        }
        

        body {
            background: var(--white);
            color: var(--black);
            font-family: var(--font-body);
            font-size: 15px;
            line-height: 1.6;
            min-height: 100vh;
        }

        /* ── NAV ── */
        nav {
            background: var(--black);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .nav-logo {
            font-family: var(--font-display);
            font-size: 2rem;
            color: var(--white);
            text-decoration: none;
            letter-spacing: 2px;
        }
        .nav-logo span { color: var(--accent); }

        .nav-links { display: flex; gap: 2rem; align-items: center; }
        .nav-links a {
            color: var(--border);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: color .2s;
        }
        .nav-links a:hover { color: var(--white); }

        /* ── SEARCH BAR ── */
        .search-form {
            display: flex;
            gap: 0;
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            background: #1a1a1a;
        }
        .search-form input {
            background: transparent;
            border: none;
            outline: none;
            color: var(--white);
            padding: .45rem 1rem;
            font-family: var(--font-body);
            font-size: .85rem;
            width: 220px;
        }
        .search-form input::placeholder { color: var(--gray); }
        .search-form button {
            background: var(--accent);
            border: none;
            color: var(--white);
            padding: .45rem .9rem;
            cursor: pointer;
            font-size: .9rem;
            transition: background .2s;
        }
        .search-form button:hover { background: #a83f1f; }

        /* ── MAIN ── */
        main { max-width: 1280px; margin: 0 auto; padding: 2.5rem 2rem; }

        /* ── PAGE HEADER ── */
        .page-header {
            margin-bottom: 2.5rem;
            border-bottom: 2px solid var(--black);
            padding-bottom: 1rem;
        }
        .page-header h1 {
            font-family: var(--font-display);
            font-size: 3.5rem;
            letter-spacing: 2px;
            line-height: 1;
        }
        .page-header p { color: var(--gray); margin-top: .4rem; }

        /* ── BREADCRUMB ── */
        .breadcrumb {
            display: flex;
            gap: .5rem;
            align-items: center;
            font-size: .8rem;
            color: var(--gray);
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: .5px;
        }
        .breadcrumb a { color: var(--gray); text-decoration: none; }
        .breadcrumb a:hover { color: var(--accent); }
        .breadcrumb span { color: var(--border); }

        /* ── CARDS GRID ── */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 1.5rem;
        }

        /* ── PRODUCT CARD ── */
        .card {
            background: var(--card-bg);
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            transition: transform .25s ease, box-shadow .25s ease, border-color .25s;
            position: relative;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0,0,0,.1);
            border-color: var(--black);
        }
        .card-img {
            width: 100%;
            aspect-ratio: 4/3;
            object-fit: cover;
            display: block;
            background: var(--cream);
        }
        .card-badge {
            position: absolute;
            top: .75rem;
            left: .75rem;
            background: var(--black);
            color: var(--white);
            font-size: .7rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: .2rem .6rem;
            border-radius: 2px;
        }
        .card-badge.agotado {
            background: var(--accent);
        }
        .card-body { padding: 1rem 1.1rem 1.2rem; }
        .card-marca {
            font-size: .72rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--gray);
            margin-bottom: .25rem;
        }
        .card-nombre {
            font-size: 1rem;
            font-weight: 600;
            color: var(--black);
            margin-bottom: .4rem;
            line-height: 1.3;
        }
        .card-meta {
            display: flex;
            gap: .5rem;
            flex-wrap: wrap;
            margin-bottom: .8rem;
        }
        .tag {
            background: var(--cream);
            color: var(--gray);
            font-size: .7rem;
            padding: .15rem .5rem;
            border-radius: 2px;
            letter-spacing: .5px;
        }
        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-precio {
            font-family: var(--font-display);
            font-size: 1.5rem;
            letter-spacing: 1px;
            color: var(--black);
        }
        .btn-ver {
            background: var(--black);
            color: var(--white);
            text-decoration: none;
            font-size: .78rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: .45rem .9rem;
            border-radius: var(--radius);
            transition: background .2s;
            border: none;
            cursor: pointer;
        }
        .btn-ver:hover { background: var(--accent); }

        /* ── CATEGORY CARD ── */
        .cat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.2rem;
        }
        .cat-card {
            background: var(--black);
            color: var(--white);
            border-radius: var(--radius);
            padding: 2rem 1.5rem;
            text-decoration: none;
            display: block;
            position: relative;
            overflow: hidden;
            transition: transform .25s, background .25s;
            border: 2px solid transparent;
        }
        .cat-card:hover {
            background: var(--accent);
            transform: translateY(-3px);
        }
        .cat-icon { font-size: 2.2rem; margin-bottom: .75rem; display: block; }
        .cat-name {
            font-family: var(--font-display);
            font-size: 1.6rem;
            letter-spacing: 2px;
            line-height: 1;
        }
        .cat-count {
            font-size: .78rem;
            color: rgba(255,255,255,.55);
            margin-top: .3rem;
            letter-spacing: 1px;
        }

        /* ── PAGINACIÓN ── */
        .pagination-wrap {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
        }
        .pagination {
            display: flex;
            gap: .4rem;
            list-style: none;
        }
        .pagination li a,
        .pagination li span {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px; height: 38px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            font-size: .85rem;
            font-weight: 600;
            color: var(--black);
            text-decoration: none;
            transition: all .2s;
        }
        .pagination li a:hover { background: var(--black); color: var(--white); border-color: var(--black); }
        .pagination li.active span { background: var(--black); color: var(--white); border-color: var(--black); }
        .pagination li.disabled span { color: var(--border); cursor: not-allowed; }

        /* ── ALERTS / EMPTY ── */
        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
            color: var(--gray);
        }
        .empty-state .emoji { font-size: 3.5rem; margin-bottom: 1rem; display: block; }
        .empty-state h3 { font-family: var(--font-display); font-size: 2rem; color: var(--black); margin-bottom: .5rem; }

        /* ── FOOTER ── */
        footer {
            background: var(--black);
            color: var(--gray);
            text-align: center;
            padding: 1.5rem;
            font-size: .8rem;
            letter-spacing: 1px;
            margin-top: 4rem;
        }
        footer span { color: var(--accent); }

        /* ── ANIMACIONES ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate { animation: fadeUp .4s ease both; }
        .animate-delay-1 { animation-delay: .05s; }
        .animate-delay-2 { animation-delay: .1s; }
        .animate-delay-3 { animation-delay: .15s; }
        .animate-delay-4 { animation-delay: .2s; }
    </style>
    @stack('styles')
</head>
<body>

<nav>
    <a href="{{ route('home') }}" class="nav-logo">STR<span>Y</span>DE</a>

    <div class="nav-links">
        <a href="{{ route('home') }}">Inicio</a>
        <a href="{{ route('categorias.index') }}">Categorías</a>

        <form action="{{ route('buscar') }}" method="GET" class="search-form">
            <input type="text" name="q" placeholder="Buscar zapatos..." value="{{ request('q') }}">
            <button type="submit">🔍</button>
        </form>
    </div>
</nav>

<main>
    @yield('content')
</main>

<footer>
    &copy; {{ date('Y') }} <span>STRYDE</span> — Todos los derechos reservados
</footer>

@stack('scripts')
</body>
</html>