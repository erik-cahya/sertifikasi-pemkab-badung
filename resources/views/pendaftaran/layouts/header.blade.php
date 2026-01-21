<nav class="navbar navbar-expand-lg bg-dinas navbar-dark sticky-top shadow">
    <div class="container">
        <a class="navbar-brand" href="#">
            <span class="logo-lg d-flex align-items-center">
                <img src="{{ asset('img/logo_dinas_no_title.png') }}" alt="logo" class="me-2" style="height: 52px">

                <div class="lh-sm">
                    <h1 class="fw-bold fs-5 text-white">BIDANG PELATIHAN DAN SERTIFIKASI</h1>
                    <p class="opacity-75 small mb-0">DINAS PERINDUSTRIAN DAN TENAGA KERJA</p>
                </div>
            </span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
            <ul class="navbar-nav custom-nav gap-lg-1">
            {{-- <ul class="navbar-nav gap-lg-4"> --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active fw-semibold' : '' }}" href="/">Beranda</a>
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
                    <a target="_" class="nav-link {{ request()->routeIs('login') ? 'active fw-semibold' : '' }} bg-orange rounded-4 px-3 fw-bold" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Masuk</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

