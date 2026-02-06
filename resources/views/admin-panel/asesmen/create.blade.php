@extends('admin-panel.layouts.app')

@push('style')
    <!-- Select 2 css -->
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" type="text/css" />
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
                                    {{-- <span class="badge bg-info rounded-pill px-2 py-1">20 LSP</span> --}}
                                    <span class="badge bg-primary rounded-pill px-2 py-1">{{ $dataKegiatan->asesi_count }}/{{ $dataKegiatan->total_peserta }} Calon Asesi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @if(!$isKuotaPenuh)
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0"> <i class="ri-profile-line fw-normal fs-20 me-1 align-middle"></i>
                                    Buat Data Asesmen</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('asesmen.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-4 mb-3">
                                            <label for="nama_tuk" class="form-label">Pilih TUK</label>
                                            <select class="select2 @error('nama_tuk') is-invalid @enderror form-select" data-toggle="select2" id="nama_tuk" name="nama_tuk">
                                                <option value="#" hidden disabled selected>Pilih TUK</option>
                                                @foreach ($dataTUK as $tuk)
                                                    <option value="{{ $tuk->tuk_nama }}">{{ $tuk->tuk_nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('nama_tuk')
                                                <div class="invalid-feedback" bis_skin_checked="1">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="form-label" for="jadwal_asesmen">Tanggal Mulai Kegiatan</label>
                                            <input type="text" id="jadwal_asesmen" name="jadwal_asesmen" class="form-control single-date rounded-3 @error('jadwal_asesmen', 'create_kegiatan') is-invalid @enderror" value="{{ old('jadwal_asesmen') }}" autocomplete="off">

                                            @error('jadwal_asesmen', 'create_kegiatan')
                                                <div class="invalid-feedback" bis_skin_checked="1">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label for="skema_sertifikasi" class="form-label">Skema Sertifikasi</label>
                                            <select class="select2 @error('skema_sertifikasi') is-invalid @enderror form-select" data-toggle="select2" id="skema_sertifikasi" name="skema_sertifikasi">
                                                <option value="#" hidden disabled selected>Pilih Skema</option>
                                                @foreach ($dataSkema as $dtSkema)
                                                    <option value="{{ $dtSkema->skema->skema_judul }}">{{ $dtSkema->skema->skema_judul }}</option>
                                                @endforeach
                                            </select>
                                            @error('skema_sertifikasi')
                                                <div class="invalid-feedback" bis_skin_checked="1">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="kegiatan_lsp_ref" value="{{ $kegiatan_lsp_ref }}">
                                        <input type="hidden" name="kegiatan_ref" value="{{ $kegiatan_ref }}">
                                        <input type="hidden" name="kegiatan_jadwal_ref" value="{{ $kegiatan_jadwal_ref }}">
                                        <x-form.input className="col-md-6 mb-3" type="text" name="nama_penanggung_jawab" label="Nama Penanggung Jawab" value="{{ old('nama_penanggung_jawab') }}" />
                                        <x-form.input className="col-md-6 mb-3" type="text" name="no_penanggung_jawab" label="Nomor HP Penanggung Jawab" value="{{ old('no_penanggung_jawab') }}" />
                                        <x-form.input className="col-md-6 mb-3" type="text" name="nama_penyelenggara_uji" label="Nama Penyelenggara Uji" value="{{ old('nama_penyelenggara_uji') }}" />
                                        <x-form.input className="col-md-6 mb-3" type="text" name="no_penyelenggara_uji" label="No HP Penyelenggara Uji" value="{{ old('no_penyelenggara_uji') }}" />
                                        <x-form.input className="col-md-4 mb-3" type="text" name="nama_asesor" label="Nama Asesor" value="{{ old('nama_asesor') }}" />
                                        <x-form.input className="col-md-4 mb-3" type="text" name="no_asesor" label="Nomor HP Asesor" value="{{ old('no_asesor') }}" />
                                        <x-form.input className="col-md-4 mb-3" type="text" name="no_reg_asesor" label="Nomor REG Asesor" value="{{ old('no_reg_asesor') }}" />
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <button class="btn btn-primary" type="submit"><i class="ri-add-box-fill"></i> Buat Jadwal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger">
                            <i class="ri-information-line"></i>
                            Kuota asesmen sudah terpenuhi. Tidak dapat menambahkan jadwal baru.
                        </div>
                    </div>
                </div>
            @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0"> <i class="ri-account-circle-line fw-normal fs-20 me-1 align-middle"></i>
                                    List Data Jadwal Asesmen</h4>
                            </div>
                            <div class="card-body">
                                <table id="datatable-dashboard" class="table-sm table-bordered w-100 fs-12 table">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>TUK</th>
                                            <th>Skema</th>
                                            <th>Tanggal</th>
                                            <th>Kuota</th>
                                            <th>Penanggung Jawab</th>
                                            <th>Penyelenggara Uji</th>
                                            <th>Asesor</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataAsesmen as $asesmen)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $asesmen->nama_tuk }}</td>
                                                <td>{{ $asesmen->nama_skema }}</td>
                                                <td class="text-center">{{ \Carbon\Carbon::parse($asesmen->jadwal_asesmen)->locale('id')->translatedFormat('l, d F Y') }}</td>
                                                <td class="text-center">{{ $asesmen->asesis_count }}/{{ $asesmen->kuota_harian }} Asesi</td>
                                                <td>
                                                    {{ $asesmen->nama_penanggung_jawab }} <br> {{ $asesmen->no_penanggung_jawab }}
                                                </td>
                                                <td>
                                                    {{ $asesmen->nama_penyelenggara_uji }} <br> {{ $asesmen->no_penyelenggara_uji }}
                                                </td>
                                                <td>
                                                    {{ $asesmen->nama_asesor }} <br> {{ $asesmen->no_asesor }} <br> {{ $asesmen->no_reg_asesor }}
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                        {{-- <a href="{{ route('pdf.daftar-hadir', $asesmen->kegiatan_ref) }}" target="_blank" class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download Daftar Hadir" data-bs-custom-class="info-tooltip"><i class="mdi mdi-download"></i> </a> --}}
                                                        {{-- <a href="{{ route('pdf.daftar-penerimaan', $asesmen->kegiatan_ref) }}" target="_blank" class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download Daftar Penerimaan" data-bs-custom-class="info-tooltip"><i class="mdi mdi-download"></i> </a> --}}
                                                        {{-- <a href="{{ route('pdf.tanda-terima-sertifikat', $asesmen->kegiatan_ref) }}" target="_blank" class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download Tanda Terima Sertifikat" data-bs-custom-class="info-tooltip"><i class="mdi mdi-download"></i> </a> --}}
                                                        {{-- <input type="hidden" class="valueID" value="#">
                                                        <button type="button" class="btn btn-sm btn-info" data-nama="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hapus Jadwal Asesmen" data-bs-custom-class="danger-tooltip">
                                                            <i class="mdi mdi-circle-edit-outline"></i>
                                                        </button> --}}
                                                        {{-- <button type="button" class="btn btn-sm btn-danger deleteButton" data-nama="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hapus Jadwal Asesmen" data-bs-custom-class="danger-tooltip">
                                                            <i class="mdi mdi-trash-can"></i>
                                                        </button> --}}
                                                        <input type="hidden" class="valueID" value="{{ $asesmen->ref }}">
                                                        <button type="button" class="btn btn-sm btn-danger deleteButton" data-nama="{{ $asesmen->nama_tuk }}" data-tanggal="{{ $asesmen->jadwal_asesmen }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Data" data-bs-custom-class="danger-tooltip">
                                                            <i class="mdi mdi-trash-can"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

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
        <!-- Select 2 -->
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('js/select2.min.js') }}"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const mulaiKegiatan = moment(@json($mulaiKegiatan));
                const selesaiKegiatan = moment(@json($selesaiKegiatan));

                $(function() {
                    $('.single-date').daterangepicker({
                        singleDatePicker: true,
                        autoApply: true,
                        minDate: mulaiKegiatan,
                        maxDate: selesaiKegiatan,
                        locale: {
                            format: 'DD/MM/YYYY'
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
        {{-- Sweet Alert --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Saat halaman sudah ready
                const deleteButtons = document.querySelectorAll('.deleteButton');

                deleteButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();

                        let propertyName = this.getAttribute('data-nama');
                        let propertyJadwal = this.getAttribute('data-tanggal');
                        let valueID = this.parentElement.querySelector('.valueID').value;

                        Swal.fire({
                            title: 'Apakah kamu yakin?',
                            text: "Hapus data Jadwal Asesmen di TUK " + propertyName + " pada tanggal "+ propertyJadwal + "?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus data'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Kirim DELETE request manual lewat JavaScript
                                fetch('/asesmen/' + valueID, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                            'Content-Type': 'application/json'
                                        }
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        Swal.fire({
                                            title: data.judul,
                                            text: data.pesan,
                                            icon: data.type,
                                        });

                                        // Optional: reload table / halaman
                                        setTimeout(() => {
                                            location.reload();
                                        }, 1500);
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        Swal.fire('Error', 'Something went wrong!',
                                            'error');
                                    });
                            }
                        });
                    });
                });
            });
        </script>
    @endpush
