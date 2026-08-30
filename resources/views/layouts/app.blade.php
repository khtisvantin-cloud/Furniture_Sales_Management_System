<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Furniture Sales Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <aside class="sidebar">
        <a class="brand" href="{{ route('dashboard') }}">
            <b class="brand-mark"><i class="bi bi-chair"></i></b>
            <span><b class="brand-title d-block">FURNITURE</b><small>Sales Management</small></span>
        </a>
        <a class="side-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="bi bi-grid"></i>Dashboard</a>
        <div class="side-label">MANAGEMENT</div>
        @foreach (['furnitures' => 'lamp', 'categories' => 'grid', 'customers' => 'people', 'suppliers' => 'truck', 'orders' => 'cart3', 'inventory' => 'box-seam'] as $link => $icon)
            <a class="side-link {{ request()->routeIs($link . '.*') ? 'active' : '' }}" href="{{ route($link . '.index') }}"><i class="bi bi-{{ $icon }}"></i>{{ ucfirst($link) }}</a>
        @endforeach
    </aside>

    <div class="page-wrap">
        <header class="topbar">
            <button class="menu-toggle" data-sidebar-toggle><i class="bi bi-list"></i></button>
            <div class="search-wrap"><i class="bi bi-search"></i><input class="form-control" placeholder="Search anything..."></div>
            <div class="top-actions">
                <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div class="profile-text"><b>{{ auth()->user()->name }}</b><small class="d-block text-muted">{{ ucfirst(auth()->user()->role) }}</small></div>
                <form method="POST" action="{{ route('logout') }}">@csrf <button class="btn btn-sm btn-soft">Logout</button></form>
            </div>
        </header>

        <main class="content">
            @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
            @if (session('warning')) <div class="alert alert-warning">{{ session('warning') }}</div> @endif
            @if ($errors->any()) <div class="alert alert-danger">{{ $errors->first() }}</div> @endif
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
