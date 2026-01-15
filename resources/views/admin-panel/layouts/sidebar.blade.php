<div class="leftside-menu">

    <!-- Logo Light -->
    <a href="{{ route('dashboard') }}" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{ asset('img/logo_lsp.png') }}" style="height: 40px" alt="logo">
            {{-- <h4 class="mt-3 text-white">Gse Management</h4> --}}
        </span>
        <span class="logo-sm">
            <img src="{{ asset('img/no_title_logo.png') }}" alt="small logo">
            {{-- <h4 class="mt-3 text-white">GseManagement</h4> --}}
        </span>
    </a>

    <!-- Logo Dark -->
    <a href="{{ route('dashboard') }}" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('img/logo_lsp.png') }}" style="height: 40px" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('img/no_title_logo.png') }}" alt="small logo">
        </span>
    </a>

    <!-- Sidebar -->
    <div data-simplebar>
        <ul class="side-nav">
            <li class="side-nav-title">Main</li>

            <li class="side-nav-item {{ request()->routeIs('dashboard') ? 'menuitem-active' : '' }}">
                <a href="{{ route('dashboard') }}" class="side-nav-link">
                    <i class="ri-dashboard-2-line"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-title">Master Data</li>

            <li class="side-nav-item {{ request()->routeIs('skema.*') ? 'menuitem-active' : '' }}">
                <a data-bs-toggle="collapse" href="#skemaMenu" aria-expanded="false" aria-controls="skemaMenu" class="side-nav-link">
                    <i class="ri-article-line"></i>
                    <span> Skema </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="{{ request()->routeIs('skema.*') ? 'show' : '' }} collapse" id="skemaMenu">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item {{ request()->routeIs('skema.index') ? 'menuitem-active' : '' }}">
                            <a class="side-nav-link {{ request()->routeIs('skema.index') ? 'active' : '' }}" href="{{ route('skema.index') }}">
                                Daftar Skema
                            </a>
                        </li>

                        {{-- @if (Auth::user()->roles === 'lsp') --}}
                        @role('lsp')
                            <li class="side-nav-item {{ request()->routeIs('skema.create') ? 'menuitem-active' : '' }}">
                                <a class="side-nav-link {{ request()->routeIs('skema.create') ? 'active' : '' }}" href="{{ route('skema.create') }}">
                                    Tambah Skema Sertifikasi
                                </a>
                            </li>
                        @endrole

                    </ul>
                </div>
            </li>

            <li class="side-nav-item {{ request()->routeIs('tukAdmin.*') ? 'menuitem-active' : '' }}">
                <a data-bs-toggle="collapse" href="#tukAdminMenu" aria-expanded="false" aria-controls="tukAdminMenu" class="side-nav-link">
                    <i class="ri-hotel-line"></i>
                    <span> TUK </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="{{ request()->routeIs('tukAdmin.*') ? 'show' : '' }} collapse" id="tukAdminMenu">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item {{ request()->routeIs('tukAdmin.index') ? 'menuitem-active' : '' }}">
                            <a class="side-nav-link {{ request()->routeIs('tukAdmin.index') ? 'active' : '' }}" href="{{ route('tukAdmin.index') }}">
                                Daftar TUK
                            </a>
                        </li>

                        {{-- @if (Auth::user()->roles === 'lsp') --}}
                        @role('lsp')
                            <li class="side-nav-item {{ request()->routeIs('tukAdmin.create') ? 'menuitem-active' : '' }}">
                                <a class="side-nav-link {{ request()->routeIs('tukAdmin.create') ? 'active' : '' }}" href="{{ route('tukAdmin.create') }}">
                                    Tambah TUK
                                </a>
                            </li>
                        @endrole

                    </ul>
                </div>
            </li>

            @role('master')
                <li class="side-nav-item {{ request()->routeIs('lsp.*') ? 'menuitem-active' : '' }}">
                    <a data-bs-toggle="collapse" href="#lspMenu" aria-expanded="false" aria-controls="lspMenu" class="side-nav-link">
                        <i class=" ri-team-line"></i>
                        <span> LSP </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="{{ request()->routeIs('lsp.*') ? 'show' : '' }} collapse" id="lspMenu">
                        <ul class="side-nav-second-level">
                            <li class="side-nav-item {{ request()->routeIs('lsp.index') ? 'menuitem-active' : '' }}">
                                <a class="side-nav-link {{ request()->routeIs('lsp.index') ? 'active' : '' }}" href="{{ route('lsp.index') }}">
                                    Daftar LSP
                                </a>
                            </li>

                            <li class="side-nav-item {{ request()->routeIs('lsp.create') ? 'menuitem-active' : '' }}">
                                <a class="side-nav-link {{ request()->routeIs('lsp.create') ? 'active' : '' }}" href="{{ route('lsp.create') }}">
                                    Tambah LSP
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="side-nav-item {{ request()->routeIs('kegiatan.*') ? 'menuitem-active' : '' }}">
                    <a data-bs-toggle="collapse" href="#kegiatanMenu" aria-expanded="false" aria-controls="kegiatanMenu" class="side-nav-link">
                        <i class="ri-edit-2-line"></i>
                        <span> Kegiatan </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="{{ request()->routeIs('kegiatan.*') ? 'show' : '' }} collapse" id="kegiatanMenu">
                        <ul class="side-nav-second-level">
                            <li class="side-nav-item {{ request()->routeIs('kegiatan.index') ? 'menuitem-active' : '' }}">
                                <a class="side-nav-link {{ request()->routeIs('kegiatan.index') ? 'active' : '' }}" href="{{ route('kegiatan.index') }}">
                                    Daftar Kegiatan
                                </a>
                            </li>

                            <li class="side-nav-item {{ request()->routeIs('kegiatan.create') ? 'menuitem-active' : '' }}">
                                <a class="side-nav-link {{ request()->routeIs('kegiatan.create') ? 'active' : '' }}" href="{{ route('kegiatan.create') }}">
                                    Tambah Kegiatan
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="side-nav-item {{ request()->routeIs('item.*') ? 'menuitem-active' : '' }}">
                    <a data-bs-toggle="collapse" href="#itemMenu" aria-expanded="false" aria-controls="itemMenu" class="side-nav-link">
                        <i class=" ri-settings-2-line"></i>
                        <span> Option </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="{{ request()->routeIs('item.*') ? 'show' : '' }} collapse" id="itemMenu">
                        <ul class="side-nav-second-level">
                            <li class="side-nav-departemen {{ request()->routeIs('departemen.index') ? 'menudepartemen-active' : '' }}">
                                <a class="side-nav-link {{ request()->routeIs('departemen.index') ? 'active' : '' }}" href="{{ route('departemen.index') }}">
                                    Departemen
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </li>
            @endrole

            {{-- <li class="side-nav-item {{ request()->routeIs('violation.*') ? 'menuitem-active' : '' }}">
                <a data-bs-toggle="collapse" href="#violationMenu" aria-expanded="false" aria-controls="violationMenu" class="side-nav-link">
                    <i class="ri-flag-2-fill"></i>
                    <span> Pelanggaran GSE </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="{{ request()->routeIs('violation.*') ? 'show' : '' }} collapse" id="violationMenu">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item {{ request()->routeIs('violation.index') ? 'menuitem-active' : '' }}">
                            <a class="side-nav-link {{ request()->routeIs('violation.index') ? 'active' : '' }}" href="{{ route('violation.index') }}">
                                Daftar Pelanggaran

                            </a>
                        </li>

                        <li class="side-nav-item {{ request()->routeIs('violation.create') ? 'menuitem-active' : '' }}">
                            <a class="side-nav-link {{ request()->routeIs('violation.create') ? 'active' : '' }}" href="{{ route('violation.create') }}">
                                Input Pelanggaran GSE
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            @if (Auth::user()->roles === 'master')
                <li class="side-nav-item {{ request()->routeIs('user.*') ? 'menuitem-active' : '' }}">
                    <a data-bs-toggle="collapse" href="#userManagement" aria-expanded="false" aria-controls="userManagement" class="side-nav-link">
                        <i class="ri-user-fill"></i>
                        <span> Users Management</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="{{ request()->routeIs('user.*') ? 'show' : '' }} collapse" id="userManagement">
                        <ul class="side-nav-second-level">
                            <li class="side-nav-item {{ request()->routeIs('user.index') ? 'menuitem-active' : '' }}">
                                <a class="side-nav-link {{ request()->routeIs('user.index') ? 'active' : '' }}" href="{{ route('user.index') }}">
                                    Daftar User
                                    <span class="badge bg-success float-end">{{ App\Models\User::count() }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif --}}

        </ul>
    </div>
</div>
