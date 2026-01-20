<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Bidang Pelatihan dan Sertifikasi - Dinas Perindustrian dan Ketenagakerjaan Kabupaten Badung</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />

    @stack('style')

    <!-- App favicon -->
    {{-- <link rel="shortcut icon" href="{{ asset('admin') }}/assets/images/favicon.ico"> --}}

    <!-- Theme Config Js -->
    <script src="{{ asset('admin') }}/assets/js/config.js"></script>

    <!-- App css -->
    <link href="{{ asset('admin') }}/assets/css/app.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('admin') }}/assets/css/icons.css" rel="stylesheet" type="text/css" />

    <!-- Flatpickr Timepicker css -->
    <link href="{{ asset('admin') }}/assets/vendor/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
</head>


<body>
    <!-- Begin page -->
    <div class="wrapper bg-white d-flex flex-column min-vh-100">

        <!-- ========== Header ========== -->
        @include('pendaftaran.layouts.header')

        <!-- ========== Content ========== -->
        <div class="content flex-grow-1 mt-4 mb-5">

            <!-- content -->
            @yield('content')
        </div>

        <!-- Footer -->
        @include('pendaftaran.layouts.footer')

    </div>

    <!-- Theme Settings -->
    @include('pendaftaran.layouts.setting')

    <!-- Vendor js -->
    <script src="{{ asset('admin') }}/assets/js/vendor.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/lucide/umd/lucide.min.js"></script>
    <!-- Bootstrap Wizard Form js -->
    <script src="{{ asset('admin') }}/assets/vendor/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
    <!-- Wizard Form Demo js -->
    <script src="{{ asset('admin') }}/assets/js/pages/form-wizard.init.js"></script>
    <!-- Bootstrap Datepicker Plugin js -->
    <script src="{{ asset('admin') }}/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <!-- Flatpickr Timepicker Plugin js -->
    <script src="{{ asset('admin') }}/assets/vendor/flatpickr/flatpickr.min.js"></script>

    @stack('script')
    <script src="{{ asset('admin') }}/assets/js/app.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('flashData'))
            var flashData = @json(session('flashData'));

            Swal.fire({
                title: flashData.title,
                text: flashData.message,
                icon: flashData.type,
                confirmButtonText: 'OK'
            });
        @endif
    </script>

</body>

</html>
