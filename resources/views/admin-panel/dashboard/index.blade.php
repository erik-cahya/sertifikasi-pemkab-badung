@extends('admin-panel.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet"
        href="{{ asset('admin') }}/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css">
@endpush
@section('content')
    <div class="container-fluid">

    {{-- Header --}}
    <div class="mb-4 mt-4">
        <h2 class="fw-bold text-dinas">
            Selamat Datang, {{ Auth::user()->name }} 👋
        </h2>
        <p class="text-muted mb-0">
            Anda login sebagai
            <span class="badge bg-dinas">
                {{ strtoupper(Auth::user()->roles) }}
            </span>
        </p>
    </div>

    {{-- Card Sambutan --}}
    {{-- <div class="row">
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h6 class="fw-semibold mb-3">
                        Informasi Akun
                    </h6>

                    <table class="table table-sm mb-0">
                        <tr>
                            <td width="40%">Nama</td>
                            <td>: {{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td>: {{ strtoupper(Auth::user()->roles) }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                : <span class="badge bg-success">Aktif</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
        
</div>

    </div>

</div>
@endsection
@push('script')
    <!-- Apex Charts js -->
    <script src="{{ asset('admin') }}/assets/vendor/apexcharts/apexcharts.min.js"></script>

    <!-- Vector Map js -->
    <script src="{{ asset('admin') }}/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js">
    </script>
    <script
        src="{{ asset('admin') }}/assets/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js">
    </script>

    <!-- Dashboard App js -->
    <script src="{{ asset('admin') }}/assets/js/pages/dashboard.js"></script>
@endpush
