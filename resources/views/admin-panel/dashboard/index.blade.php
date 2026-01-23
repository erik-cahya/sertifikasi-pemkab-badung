@extends('admin-panel.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet"
        href="{{ asset('admin') }}/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css">
@endpush
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row">

            </div><!-- end row -->

        </div>
        <!-- end container -->

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
