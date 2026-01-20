<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login - Bidang Pelatihan dan Sertifikasi - Dinas Perindustrian dan Ketenagakerjaan Kabupaten Badung</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin') }}/assets/images/favicon.ico">

    <!-- Theme Config Js -->
    <script src="{{ asset('admin') }}/assets/js/config.js"></script>

    <!-- App css -->
    <link href="{{ asset('admin') }}/assets/css/app.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('admin') }}/assets/css/icons.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>

<body class="authentication-bg position-relative" style="height: 100vh;">
    <div class="account-pages p-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-lg-6">
                    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-12">

                                <div class="d-flex flex-column h-100">
                                    <div class="auth-brand p-4 pb-0 text-center">
                                        <a href="index.html" class="logo-light">
                                            <img src="{{ asset('img/logo_dinas_title.png') }}" alt="logo" height="28">
                                        </a>
                                        <a href="index.html" class="logo-dark">
                                            <img src="{{ asset('img/logo_dinas_no_title.png') }}" alt="dark logo" height="120">
                                        </a>
                                    </div>
                                    <div class="my-auto p-3 text-center">
                                        <h4 class="fs-20">HALAMAN LOGIN</h4>
                                        <p class="text-muted mb-4">Masukkan alamat email atau username dan password anda</p>

                                        <!-- form -->
                                        <form action="{{ route('login') }}" method="POST" class="text-start">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="emailaddress" class="form-label">Email / Username</label>
                                                <input class="form-control rounded-3" type="text" name="login" autofocus id="emailaddress" value="{{ old('email') }}" required placeholder="Masukkan Email atau Username">
                                            </div>

                                            <div class="mb-3">
                                                <label for="emailaddress" class="form-label">Password</label>
                                                <div class="input-group input-group-merge " bis_skin_checked="1">
                                                    <input type="password" id="password" class="form-control " style="border-radius: 0.5rem 0 0 0.5rem" placeholder="Masukkan Password" name="password">
                                                    <div class="input-group-text" style="border-radius: 0 0.5rem 0.5rem 0" data-password="true" bis_skin_checked="1">
                                                        <span class="password-eye"> <i class="bi bi-eye"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="checkbox-signin">
                                                    <label class="form-check-label" for="checkbox-signin">Ingat saya</label>
                                                </div>
                                            </div>

                                            @error('login')
                                                <div class="alert alert-danger mt-1" role="alert">
                                                    <i data-feather="alert-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="mb-3 text-start">
                                                <button class="btn btn-soft-danger w-100" type="submit">
                                                    <i class="ri-login-circle-fill me-1"></i>
                                                    <span class="fw-bold">Masuk</span>
                                                </button>
                                            </div>

                                        </form>
                                        <!-- end form-->
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        {{-- <div class="row">
                            <div class="col-12 text-center ">
                                <p class="text-dark-emphasis">Tidak memiliki akun? <a href="{{ route('register') }}" class="text-dark fw-bold link-offset-3 text-decoration-underline ms-1"><b>Sign up</b></a>
                                </p>
                            </div> <!-- end col -->
                        </div> --}}
                    </div>
                </div>
                <!-- end row -->
            </div>

            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- Vendor js -->
    <script src="{{ asset('admin') }}/assets/js/vendor.min.js"></script>

    <script src="{{ asset('admin') }}/assets/vendor/lucide/umd/lucide.min.js"></script>

    <!-- App js -->
    <script src="{{ asset('admin') }}/assets/js/app.min.js"></script>


</body>

</html>
