<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $title ?? 'Dashboard' }} | Sistem Pelatihan dan Sertifikasi</title>
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
            border-radius: 50px;
            padding: 12px 24px;
            box-shadow: 0 4px 15px rgba(0, 190, 80, 0.4);
            transition: all 0.3s ease;
            animation: pulse-success 2s infinite;
            border-radius: 20px
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

    {{-- !-- App favicon --> --}}
    <link rel="shortcut icon" href="{{ asset('admin') }}/assets/images/favicon.ico">
    <script src="{{ asset('admin') }}/assets/js/config.js"></script>
    <link href="{{ asset('admin') }}/assets/css/app.css" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('admin') }}/assets/css/icons.css" rel="stylesheet" type="text/css" />

    <!-- Datatables css -->
    <link href="{{ asset('admin') }}/assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin') }}/assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin') }}/assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin') }}/assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin') }}/assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin') }}/assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />

    <!-- Daterangepicker css -->
    <link href="{{ asset('admin') }}/assets/vendor/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">

        <!-- ========== Header ========== -->
        @include('admin-panel.layouts.header')

        <!-- ========== Sidebar ========== -->
        @include('admin-panel.layouts.sidebar')

        <!-- ========== Content ========== -->
        <div class="content-page">

            <!-- content -->
            @yield('content')

            <!-- Footer -->
            @include('admin-panel.layouts.footer')
        </div>

        {{-- <!-- Floating Contact Support Button -->
        <button type="button" class="btn btn-dinas btn-floating-support shadow-lg d-flex align-items-center justify-content-center gap-2" data-bs-toggle="modal" data-bs-target="#supportModal">
            <i class="mdi mdi-whatsapp fs-3"></i>
            <span class="d-none d-md-block fs-5">Bantuan</span>
        </button>

        <!-- Support Modal -->
        <div class="modal fade" id="supportModal" tabindex="-1" aria-labelledby="supportModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-dinas text-white">
                        <h5 class="modal-title d-flex align-items-center gap-2" id="supportModalLabel">
                            <i class="mdi mdi-headset"></i> Layanan Bantuan
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center p-4">
                        <div class="mb-3">
                            <i class="mdi mdi-whatsapp text-dinas" style="font-size: 4rem;;"></i>
                        </div>
                        <h4>Halo! Butuh bantuan?</h4>
                        <p class="text-muted mb-4">Silakan hubungi kami melalui WhatsApp di nomor berikut:</p>
                        <h3 class="mb-4 text-dark fw-bold">+62 823-1779-6561</h3>
                        <a href="https://wa.me/6282317796561" target="_blank" class="btn btn-dinas btn-lg w-100 rounded-pill shadow-sm">
                            <i class="mdi mdi-whatsapp me-2"></i> Chat via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div> --}}

    </div>

    <!-- Theme Settings -->
    {{-- @include('admin-panel.layouts.setting') --}}

    <!-- Vendor js -->
    <script src="{{ asset('admin') }}/assets/js/vendor.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/lucide/umd/lucide.min.js"></script>

    @stack('script')
    <script src="{{ asset('admin') }}/assets/js/app.min.js"></script>

    <!-- Daterangepicker Plugin js -->
    <script src="{{ asset('admin') }}/assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/daterangepicker/daterangepicker.js"></script>

    <!-- Datatables js -->
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>

    <script src="{{ asset('admin') }}/assets/vendor/jszip/jszip.min.js"></script>

    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>

    <!-- Datatable Demo App js -->
    <script src="{{ asset('admin') }}/assets/js/pages/datatable.init.js"></script>

    <!-- Sweet alert js-->
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
