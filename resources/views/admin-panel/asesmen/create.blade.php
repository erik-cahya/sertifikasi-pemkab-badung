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
                <div class="col-lg-12">
                <div class="card border-top-0 overflow-hidden">
                    <div class="progress progress-sm rounded-0 bg-light" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-success" style="width: 60%"></div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="">
                                <p class="text-muted fw-semibold fs-16 mb-1">{{ $dataKegiatan->nama_kegiatan }}</p>

                                <p class="text-muted">
                                    <small>Durasi Kegiatan : {{ \Carbon\Carbon::parse($dataKegiatan->mulai_kegiatan)->locale('id')->translatedFormat('d F Y') }} s/d {{ \Carbon\Carbon::parse($dataKegiatan->selesai_kegiatan)->locale('id')->translatedFormat('d F Y') }}</small>
                                </p>

                                <span class="badge {{ $dataKegiatan->status == 1 ? 'bg-success' : 'bg-danger' }} rounded-pill px-2 py-1">Status : {{ $dataKegiatan->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</span>
                                <span class="badge bg-info rounded-pill px-2 py-1">{{ $dataKegiatan->kegiatanLsp->pluck('lsp')->unique('ref')->count() }} LSP</span>
                                <span class="badge bg-primary rounded-pill px-2 py-1">{{ $dataKegiatan->asesi_count }}/{{ $dataKegiatan->total_peserta }} Calon Asesi</span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0"> <i class="ri-profile-line fw-normal fs-20 me-1 align-middle"></i>
                                Buat Data Asesmen</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 mb-3">
                                    <label for="nama_tuk" class="form-label">Pilih TUK</label>
                                    <select class="select2 @error('nama_tuk') is-invalid @enderror form-select" data-toggle="select2" id="nama_tuk" name="nama_tuk">
                                        <option value="#" hidden disabled selected>Pilih TUK</option>
                                        @foreach ($dataTUK as $tuk)
                                            <option value="{{ $tuk->ref }}">{{ $tuk->tuk_nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('nama_tuk')
                                        <div class="invalid-feedback" bis_skin_checked="1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-lg-4 mb-3">
                                    <label class="form-label" for="tanggal_asesmen">Tanggal Mulai Kegiatan</label>
                                    <input type="text" id="tanggal_asesmen" name="tanggal_asesmen" class="form-control single-date @error('tanggal_asesmen', 'create_kegiatan') is-invalid @enderror" value="{{ old('tanggal_asesmen') }}" autocomplete="off">

                                    @error('tanggal_asesmen', 'create_kegiatan')
                                        <div class="invalid-feedback" bis_skin_checked="1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-lg-4 mb-3">
                                    <label for="skema_sertifikasi" class="form-label">Skema Sertifikasi</label>
                                    <select class="select2 @error('skema_sertifikasi') is-invalid @enderror form-select" data-toggle="select2" id="skema_sertifikasi" name="skema_sertifikasi">
                                        <option value="#" hidden disabled selected>Pilih Skema</option>
                                        @foreach ($dataSkema as $skema)
                                            <option value="{{ $skema->ref }}">{{ $skema->skema_judul }}</option>
                                        @endforeach
                                    </select>
                                    @error('skema_sertifikasi')
                                        <div class="invalid-feedback" bis_skin_checked="1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-lg-3 mb-3">
                                    <label for="nama_penanggung_jawab" class="form-label">Nama Penanggung Jawab</label>
                                    <input type="text" id="nama_penanggung_jawab" name="nama_penanggung_jawab" class="form-control @error('nama_penanggung_jawab', 'create_kegiatan') is-invalid @enderror" value="{{ old('nama_penanggung_jawab') }}" autocomplete="off">

                                    @error('nama_penanggung_jawab', 'create_kegiatan')
                                        <div class="invalid-feedback" bis_skin_checked="1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                 <div class="col-lg-3 mb-3">
                                    <label for="no_penanggung_jawab" class="form-label">No Penanggung Jawab</label>
                                    <input type="text" id="no_penanggung_jawab" name="no_penanggung_jawab" class="form-control @error('no_penanggung_jawab', 'create_kegiatan') is-invalid @enderror" value="{{ old('no_penanggung_jawab') }}" autocomplete="off">

                                    @error('no_penanggung_jawab', 'create_kegiatan')
                                        <div class="invalid-feedback" bis_skin_checked="1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-lg-3 mb-3">
                                    <label for="nama_penyelenggara_uji" class="form-label">Nama Penyelenggara Uji</label>
                                    <input type="text" id="nama_penyelenggara_uji" name="nama_penyelenggara_uji" class="form-control @error('nama_penyelenggara_uji', 'create_kegiatan') is-invalid @enderror" value="{{ old('nama_penyelenggara_uji') }}" autocomplete="off">

                                    @error('nama_penyelenggara_uji', 'create_kegiatan')
                                        <div class="invalid-feedback" bis_skin_checked="1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                 <div class="col-lg-3 mb-3">
                                    <label for="no_penyelenggara_uji" class="form-label">No Penyelenggara Uji</label>
                                    <input type="text" id="no_penyelenggara_uji" name="no_penyelenggara_uji" class="form-control @error('no_penyelenggara_uji', 'create_kegiatan') is-invalid @enderror" value="{{ old('no_penyelenggara_uji') }}" autocomplete="off">

                                    @error('no_penyelenggara_uji', 'create_kegiatan')
                                        <div class="invalid-feedback" bis_skin_checked="1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-lg-4 mb-3">
                                    <label for="nama_asesor" class="form-label">Nama Asesor</label>
                                    <input type="text" id="nama_asesor" name="nama_asesor" class="form-control @error('nama_asesor', 'create_kegiatan') is-invalid @enderror" value="{{ old('nama_asesor') }}" autocomplete="off">

                                    @error('nama_asesor', 'create_kegiatan')
                                        <div class="invalid-feedback" bis_skin_checked="1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-lg-4 mb-3">
                                    <label for="no_asesor" class="form-label">No Asesor</label>
                                    <input type="text" id="no_asesor" name="no_asesor" class="form-control @error('no_asesor', 'create_kegiatan') is-invalid @enderror" value="{{ old('no_asesor') }}" autocomplete="off">

                                    @error('no_asesor', 'create_kegiatan')
                                        <div class="invalid-feedback" bis_skin_checked="1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="col-lg-4 mb-3">
                                    <label for="no_reg_asesor" class="form-label">No Reg Asesor</label>
                                    <input type="text" id="no_reg_asesor" name="no_reg_asesor" class="form-control @error('no_reg_asesor', 'create_kegiatan') is-invalid @enderror" value="{{ old('no_reg_asesor') }}" autocomplete="off">

                                    @error('no_reg_asesor', 'create_kegiatan')
                                        <div class="invalid-feedback" bis_skin_checked="1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="mb-3 mt-3">
                                <button class="btn btn-primary" type="submit"><i class="ri-add-box-fill"></i> Buat Jadwal</button>
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
