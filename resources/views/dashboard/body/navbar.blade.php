<header class="navbar navbar-expand-md d-print-none" >
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="{{ route('dashboard.index') }}">
                <img src="{{ asset('static/logo-bcj-x.png') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url({{ Auth::user()->photo ? asset('images/profile/'.Auth::user()->photo) : Avatar::create(Auth::user()->name)->toBase64() }})"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="mt-1 small text-muted">{{ Auth::user()->email }}</div>
                    </div>

                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="{{ route('profile.index') }}" class="dropdown-item">Profile</a>
                    <!-- Logout -->
                    <x-form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item" onclick="return confirm('Apakah Anda yakin untuk logout?')">Logout</button>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</header>

<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <ul class="navbar-nav">

                    <li class="nav-item {{ request()->is('dashboard*') ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('dashboard.index') }}" >
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="fa-solid fa-house"></i>
                            </span>
                            <span class="nav-link-title">
                                {{ __('Dashboard') }}
                            </span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->is('my*') ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('my.information') }}" >
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="fa-solid fa-hands-holding-circle"></i>
                            </span>
                            <span class="nav-link-title">
                                {{ __('Kepemilikan') }}
                            </span>
                        </a>
                    </li>

                    @if (Auth::user()->role->name === 'admin')
                    <li class="nav-item {{ request()->is('inventories*') ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('inventories.index') }}" >
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="fa-solid fa-box"></i>
                            </span>
                            <span class="nav-link-title">
                                {{ __('Inventaris') }}
                            </span>
                        </a>
                    </li>

                    <li class="nav-item dropdown {{ request()->is('vehicles*') ? 'active' : null }}">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="fa-solid fa-car-side"></i>
                            </span>
                            <span class="nav-link-title">
                                {{ __('Kendaraan') }}
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item" href="{{ route('vehicles.index') }}">
                                        Kendaraan
                                    </a>
                                    <div class="dropend">
                                        <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                                            Pajak
                                        </a>
                                        <div class="dropdown-menu">
                                            <a href="{{ route('vehicles.weekly.tax.report') }}" class="dropdown-item">
                                                &lt; 1 Minggu
                                            </a>
                                            <a href="{{ route('vehicles.monthly.tax.report') }}" class="dropdown-item">
                                                &lt; 1 Bulan
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dropend">
                                        <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                                            STNK
                                        </a>
                                        <div class="dropdown-menu">
                                            <a href="{{ route('vehicles.weekly.stnk.report') }}" class="dropdown-item">
                                                &lt; 1 Minggu
                                            </a>
                                            <a href="{{ route('vehicles.weekly.stnk.report') }}" class="dropdown-item">
                                                &lt; 1 Bulan
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item {{ request()->is('users*') ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('users.index') }}" >
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <span class="nav-link-title">
                                {{ __('Pengguna') }}
                            </span>
                        </a>
                    </li>

                    <li class="nav-item dropdown {{ request()->is('offices*', 'brands*') ? 'active' : null }}">
                        <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="fa-solid fa-layer-group"></i>
                            </span>
                            <span class="nav-link-title">
                                {{ __('Lainnya') }}
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item {{ request()->is('offices*') ? 'active' : null }}" href="{{ route('offices.index') }}">
                                        {{ __('Kantor') }}
                                    </a>
                                    <a class="dropdown-item {{ request()->is('brands*') ? 'active' : null }}" href="{{ route('brands.index') }}">
                                        {{ __('Brand') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endif

                </ul>
            </div>
        </div>
    </div>
</header>
