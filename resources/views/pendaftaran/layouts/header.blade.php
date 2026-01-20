<nav class="navbar navbar-expand-lg bg-danger navbar-dark sticky-top shadow">
    <div class="container">
        <a class="navbar-brand" href="#">
            <span class="logo-lg">
                <img src="{{ asset('img/logo_dinas_title.png') }}" style="height: 40px; margin-left: -15px" alt="logo">
            </span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
            <ul class="navbar-nav gap-lg-4">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('/home') ? 'active fw-semibold' : '' }}" href="{{ route('dashboard') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pegawai.index') ? 'active fw-semibold' : '' }}" href="{{ route('pegawai.index') }}">Pendataan Pegawai</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('asesi.index') ? 'active fw-semibold' : '' }}" href="{{ route('asesi.index') }}">Daftar Calon Asesi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tuk.index') ? 'active fw-semibold' : '' }}" href="{{ route('tuk.index') }}">Daftar TUK</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('login') ? 'active fw-semibold' : '' }}" href="{{ route('login') }}">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

