@extends('admin-panel.layouts.app')
@push('style')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin') }}/assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />

    <!-- Daterangepicker css -->
    <link href="{{ asset('admin') }}/assets/vendor/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0"> <i class="ri-profile-line fw-normal fs-20 me-1 align-middle"></i>
                                Create Data Asesmen</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-lg-12 mb-3">
                                    <label for="kegiatan" class="form-label">Pilih Kegiatan</label>
                                    <select class="select2 @error('kegiatan') is-invalid @enderror form-select" data-toggle="select2" id="kegiatan" name="kegiatan">
                                        <option value="#" hidden disabled selected>Pilih Kegiatan</option>
                                        @foreach ($dataKegiatan as $kegiatan)
                                            <option value="{{ $kegiatan->ref }}">{{ $kegiatan->nama_kegiatan }}</option>
                                        @endforeach
                                    </select>
                                    @error('kegiatan')
                                        <div class="invalid-feedback" bis_skin_checked="1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-lg-4">
                                    <label for="tempat_tuk" class="form-label">Pilih TUK</label>
                                    <select class="select2 @error('tempat_tuk') is-invalid @enderror form-select" data-toggle="select2" id="tempat_tuk" name="tempat_tuk">
                                        <option value="#" hidden disabled selected>Pilih TUK</option>
                                        <option value="#">TUK 1</option>
                                    </select>
                                    @error('tempat_tuk')
                                        <div class="invalid-feedback" bis_skin_checked="1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-lg-4">
                                    <label class="form-label" for="tanggal_asesmen">Tanggal Mulai Kegiatan</label>
                                    <input type="text" id="tanggal_asesmen" name="tanggal_asesmen" class="form-control single-date @error('tanggal_asesmen', 'create_kegiatan') is-invalid @enderror" value="{{ old('tanggal_asesmen') }}" autocomplete="off">

                                    @error('tanggal_asesmen', 'create_kegiatan')
                                        <div class="invalid-feedback" bis_skin_checked="1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-lg-4">
                                    <label for="skema_sertifikasi" class="form-label">Skema Sertifikasi</label>
                                    <select class="select2 @error('skema_sertifikasi') is-invalid @enderror form-select" data-toggle="select2" id="skema_sertifikasi" name="skema_sertifikasi">
                                        <option value="#" hidden disabled selected>Pilih TUK</option>
                                        <option value="#">TUK 1</option>
                                    </select>
                                    @error('skema_sertifikasi')
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

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0"> <i class="ri-account-circle-line fw-normal fs-20 me-1 align-middle"></i>
                                List Data Asesmen</h4>
                        </div>
                        <div class="card-body">
                            <table class="table-sm table-bordered w-100 fs-12 table">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Skema</th>
                                        <th>TUK</th>
                                        <th>Tanggal</th>
                                        <th>Kuota</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>LSP Engineering Hospitality Indonesia</td>
                                        <td>
                                            <span class="badge bg-primary-subtle text-primary">
                                                Perawatan Mesin Pendingin / AC
                                            </span>
                                        </td>
                                        <td>LSP Engineering Hospitality Indonesia</td>

                                        <td>Sabtu, 20 Januari 2026</td>
                                        <td>3/10 Peserta</td>
                                        <td>
                                            <button class="btn btn-link text-decoration-none fs-12 p-0" data-bs-toggle="collapse" data-bs-target="#jadwal-2" aria-expanded="false" aria-controls="jadwal-2">
                                                Lihat Detail
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
@push('script')
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <!-- Daterangepicker Plugin js -->
    <script src="{{ asset('admin') }}/assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/daterangepicker/daterangepicker.js"></script>

    <!-- Datatables js -->
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>

    <!-- Datatable Demo App js -->
    <script src="{{ asset('admin') }}/assets/js/pages/datatable.init.js"></script>

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
