<nav class="navbar navbar-expand-lg bg-danger navbar-dark sticky-top shadow">
    <div class="container">
        <a class="navbar-brand" href="#"></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
            <ul class="navbar-nav gap-lg-4">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('/') ? 'active fw-semibold' : '' }}" href="#">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('asesi.index') ? 'active fw-semibold' : '' }}" href="#">Daftar Calon Asesi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('/') ? 'active fw-semibold' : '' }}" href="#">Daftar TUK</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('/') ? 'active fw-semibold' : '' }}" href="#">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

