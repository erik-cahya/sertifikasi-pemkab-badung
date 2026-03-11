<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Bidang Pelatihan dan Sertifikasi - Dinas Perindustrian dan Ketenagakerjaan Kabupaten Badung</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Portal resmi Bidang Pelatihan dan Sertifikasi - Dinas Perindustrian dan Ketenagakerjaan Kabupaten Badung" name="description" />
    <meta content="Bidang Pelatihan dan Sertifikasi - Dinas Perindustrian dan Ketenagakerjaan Kabupaten Badung" name="author" />

    @stack('style')
    <style>
        table.dataTable thead th.sorting::before,
        table.dataTable thead th.sorting::after {
            font-size: 9px;
            opacity: 0.5;
        }

        /* Floating Support Button Styles */
        .btn-floating-support {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1050;
            border-radius: 20px !important;
            padding: 12px 24px;
            box-shadow: 0 4px 15px rgba(0, 190, 80, 0.4);
            transition: all 0.3s ease;
            animation: pulse-success 2s infinite;
        }

        .btn-floating-support:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 190, 80, 0.6);
            /* animation: none; */
        }

        .btn-floating-support i {
            margin-right: 0 !important;
        }

        @media (max-width: 768px) {
            .btn-floating-support {
                padding: 12px;
                border-radius: 50%;
                bottom: 20px;
                right: 20px;
            }
        }

        @keyframes pulse-success {
            0% {
                box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
            }

            70% {
                box-shadow: 0 0 0 15px rgba(40, 167, 69, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
            }
        }
    </style>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin') }}/assets/images/favicon.ico">

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
    <div class="wrapper d-flex flex-column min-vh-100 bg-white">

        <!-- ========== Header ========== -->
        @include('pendaftaran.layouts.header')

        <!-- ========== Content ========== -->
        <div class="content flex-grow-1">

            <!-- content -->
            @yield('content')
       
        </div>
        <!-- Footer -->
        @include('pendaftaran.layouts.footer')

        <!-- Floating Contact Support Button -->
        <button type="button" class="btn btn-success btn-floating-support shadow-lg d-flex align-items-center justify-content-center gap-2" data-bs-toggle="modal" data-bs-target="#supportModal">
            <i class="mdi mdi-whatsapp fs-3"></i>
            <span class="d-none d-md-block fs-5">Bantuan</span>
        </button>

        <!-- Support Modal -->
        <div class="modal fade" id="supportModal" tabindex="-1" aria-labelledby="supportModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow rounded-4">
                    <div class="modal-header bg-success text-white rounded-top-4">
                        <h5 class="modal-title d-flex align-items-center gap-2" id="supportModalLabel">
                            <i class="mdi mdi-headset"></i> Layanan Bantuan
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center p-4">
                        <div class="mb-3">
                            <i class="mdi mdi-whatsapp text-success" style="font-size: 4rem;;"></i>
                        </div>
                        <h4>Halo! Butuh bantuan?</h4>
                        <p class="text-muted mb-4">Silakan hubungi kami melalui WhatsApp di nomor berikut:</p>
                        <h3 class="mb-4 text-dark fw-bold">+62 823-1779-6561</h3>
                        <a href="https://wa.me/6282317796561" target="_blank" class="btn btn-success btn-lg w-100 rounded-pill shadow-sm">
                            <i class="mdi mdi-whatsapp me-2"></i> Chat via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- Theme Settings -->
    @include('pendaftaran.layouts.setting')

    <!-- Vendor js -->
    <script src="{{ asset('admin') }}/assets/js/vendor.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/lucide/umd/lucide.min.js"></script>

    {{-- <!-- Bootstrap Wizard Form js -->
    <script src="{{ asset('admin') }}/assets/vendor/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
    <!-- Wizard Form Demo js -->
    <script src="{{ asset('admin') }}/assets/js/pages/form-wizard.init.js"></script>
    <!-- Bootstrap Datepicker Plugin js -->
    <script src="{{ asset('admin') }}/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <!-- Flatpickr Timepicker Plugin js -->
    <script src="{{ asset('admin') }}/assets/vendor/flatpickr/flatpickr.min.js"></script> --}}

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
