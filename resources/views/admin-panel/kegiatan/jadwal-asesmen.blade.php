@extends('admin-panel.layouts.app')
@push('style')
    {{-- <link href="{{ asset('admin') }}/assets/vendor/select2/css/select2.min.css" rel="stylesheet" type="text/css" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> --}}

    <!-- Daterangepicker css -->
    <link href="{{ asset('admin') }}/assets/vendor/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />

    <style>
        .kegiatan-item {
            border-radius: 8px;
        }

        .remove-kegiatan-btn {
            transition: all 0.3s ease;
        }

        .remove-kegiatan-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(220, 53, 69, 0.1);
        }

        /* Untuk tampilan mobile */
        @media (max-width: 992px) {
            .kegiatan-item .row>div {
                margin-bottom: 10px;
            }
        }
    </style>
@endpush
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class=".card-title">Create Data Kegiatan</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label" for="mulai_kegiatan">Tanggal Mulai Kegiatan</label>
                                        <input type="text" id="mulai_kegiatan" name="mulai_kegiatan" class="form-control single-date @error('mulai_kegiatan', 'create_kegiatan') is-invalid @enderror" value="{{ old('mulai_kegiatan') }}" autocomplete="off">

                                        @error('mulai_kegiatan', 'create_kegiatan')
                                            <div class="invalid-feedback" bis_skin_checked="1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3 mt-3">
                                    <button class="btn btn-primary" type="submit"><i class="ri-add-box-fill"></i> Add New Kegiatan</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </form>

        </div>

    </div>
@endsection
@push('script')
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <!-- Daterangepicker Plugin js -->
    <script src="{{ asset('admin') }}/assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/daterangepicker/daterangepicker.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const mulaiKegiatan = moment('2026-01-01');
            const selesaiKegiatan = moment('2026-02-01');

            $(function() {
                $('.single-date').daterangepicker({
                    singleDatePicker: true,
                    autoApply: true,
                    minDate: mulaiKegiatan,
                    maxDate: selesaiKegiatan,
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                });

                $('.single-date').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('DD/MM/YYYY'));
                }).on('cancel.daterangepicker', function() {
                    $(this).val('');
                });
            });


        });
    </script>
@endpush
