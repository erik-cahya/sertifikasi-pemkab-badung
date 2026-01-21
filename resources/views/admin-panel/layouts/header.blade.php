<div class="navbar-custom">
    <div class="topbar container-fluid">
        <div class="d-flex align-items-center gap-1">

            <!-- Topbar Brand Logo -->
            <div class="logo-topbar">
                <!-- Logo light -->
                <a href="index.html" class="logo-light">
                    <span class="logo-lg">
                        <img src="{{ asset('admin') }}/assets/images/logo.png" alt="logo">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('admin') }}/assets/images/logo-sm.png" alt="small logo">
                    </span>
                </a>

                <!-- Logo Dark -->
                <a href="index.html" class="logo-dark">
                    <span class="logo-lg">
                        <img src="{{ asset('admin') }}/assets/images/logo-dark.png" alt="dark logo">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('admin') }}/assets/images/logo-sm.png" alt="small logo">
                    </span>
                </a>
            </div>

            <!-- Sidebar Menu Toggle Button -->
            <button class="button-toggle-menu">
                <i class="mdi mdi-menu"></i>
            </button>

            <!-- Page Title -->
            <h4 class="page-title d-none d-sm-block">{{ $title ?? 'Dashboard' }}</h4>
            <h5 class="d-none d-sm-block">{{ '{roles: ' . Auth::user()->roles . '}' }}</h5>
        </div>

        <ul class="topbar-menu d-flex align-items-center gap-3">
            <li class="dropdown d-lg-none">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-magnify fs-2"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                    <form class="p-3">
                        <input type="search" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                    </form>
                </div>
            </li>

            <li class="d-none d-sm-inline-block">
                <a class="nav-link" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas">
                    <span class="ri-settings-3-line fs-22"></span>
                </a>
            </li>

            <li class="d-none d-sm-inline-block">
                <div class="nav-link" id="light-dark-mode">
                    <i class="ri-moon-line fs-22"></i>
                </div>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle arrow-none nav-user" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="account-user-avatar">
                        {{-- <img src="{{ asset('admin') }}/assets/images/users/avatar-1.jpg" alt="user-image" width="32" class="rounded-circle"> --}}
                        <div class="rounded-circle bg-dinas text-white d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                            <i class="bi bi-person-fill fs-3"></i>
                        </div>
                    </span>
                    <span class="d-lg-block d-none">
                        <h5 class="fw-normal my-0">{{ Auth::user()->name }}<i class="ri-arrow-down-s-line fs-22 d-none d-sm-inline-block align-middle"></i>
                        </h5>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome {{ strtoupper(Auth::user()->roles) }}!</h6>
                    </div>

                    <!-- item-->
                    <a href="pages-profile.html" class="dropdown-item">
                        <i class="ri-account-pin-circle-line fs-16 me-1 align-middle"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="dropdown-item">
                            <i class="ri-logout-circle-r-line me-1 align-middle"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                    {{-- <a href="auth-logout.html" class="dropdown-item">
                        <i class="ri-logout-circle-r-line me-1 align-middle"></i>
                        <span>Logout</span>
                    </a> --}}
                </div>
            </li>
        </ul>
    </div>
</div>
