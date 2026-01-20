@extends('admin-panel.layouts.app')
@push('style')
    <!-- Datatables css -->
    <link href="{{ asset('admin') }}/assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ asset('admin') }}/assets/vendor/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" /> --}}

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
    <div class="container-fluid">
        <div class="row mt-2">
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
                                    <small> {{ \Carbon\Carbon::parse($dataKegiatan->mulai_kegiatan)->locale('id')->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($dataKegiatan->selesai_kegiatan)->locale('id')->translatedFormat('d F Y') }}</small>
                                </p>

                                <span class="badge {{ $dataKegiatan->status == 1 ? 'bg-success' : 'bg-danger' }} rounded-pill px-3">{{ $dataKegiatan->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</span>
                                <span class="badge bg-info rounded-pill px-3">{{ $dataKegiatan->details->pluck('lsp')->unique('ref')->count() }} LSP</span>
                                <span class="badge bg-primary rounded-pill px-3">13/{{ $dataKegiatan->total_peserta }} Peserta</span>

                            </div>
                            <div class="avatar-sm mb-4">
                                <div class="avatar-title bg-danger-subtle text-danger fs-24 rounded">
                                    <i class="bi bi-journal-medical"></i>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex gap-2">
                            <div class="d-flex flex-lg-nowrap justify-content-between align-items-end flex-wrap">
                                <button class="btn-sm btn btn-pink" data-bs-toggle="modal" data-bs-target="#editModal-{{ $dataKegiatan->ref }}">
                                    <i class="mdi mdi-pencil"></i> Edit Kegiatan</button>
                            </div>

                            <div class="d-flex flex-lg-nowrap justify-content-between align-items-end flex-wrap">
                                <a href="{{ route('kegiatan.add-lsp', $dataKegiatan->ref) }}" class="btn-sm btn btn-success"><i class="mdi mdi-plus"></i> Tambah LSP Baru</a>
                            </div>
                        </div>

                        <!-- Edit Data Modal -->
                        <div id="editModal-{{ $dataKegiatan->ref }}" class="modal modal-lg fade" tabindex="-1" role="dialog" aria-labelledby="success-header-modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('kegiatan.update', $dataKegiatan->ref) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-header modal-colored-header bg-pink">
                                            <h4 class="modal-title" id="success-header-modalLabel">Edit Kegiatan</h4>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row px-2">
                                                <div class="col-lg-12 mb-2">
                                                    <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                                                    <input type="text" id="nama_kegiatan" class="form-control" name="nama_kegiatan" value="{{ $dataKegiatan->nama_kegiatan }}">
                                                </div>

                                                <div class="col-lg-6 mb-2">
                                                    <label for="mulai_kegiatan" class="form-label">Mulai Kegiatan</label>
                                                    <input type="text" value="{{ \Carbon\Carbon::parse($dataKegiatan->mulai_kegiatan)->translatedFormat('d/m/Y') }}" id="mulai_kegiatan" name="mulai_kegiatan" class="form-control single-date @error('mulai_kegiatan', 'create_kegiatan') is-invalid @enderror">
                                                </div>

                                                <div class="col-lg-6 mb-2">
                                                    <label for="selesai_kegiatan" class="form-label">Selesai Kegiatan</label>
                                                    <input type="text" value="{{ \Carbon\Carbon::parse($dataKegiatan->selesai_kegiatan)->locale('id')->translatedFormat('d/m/Y') }}" id="selesai_kegiatan" class="form-control single-date @error('selesai_kegiatan', 'create_kegiatan') is-invalid @enderror" name="selesai_kegiatan">
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select class="text-capitalize form-select" id="skema_kategori" name="status">
                                                        <option value="#" disabled selected hidden>Pilih Kategori Skema</option>
                                                        <option value="1" {{ $dataKegiatan->status === 1 ? 'selected' : '' }}>Active</option>
                                                        <option value="0" {{ $dataKegiatan->status === 0 ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-pink">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Edit Data Modal -->

                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="nav nav-pills nav-justified gap-0 p-3 text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <li class="nav-item mt-2"><a class="nav-link fs-5 active p-2" data-bs-toggle="tab" data-bs-target="#daftar_lsp" type="button" role="tab" aria-controls="home" aria-selected="true" href="#daftar_lsp"><i class="mdi mdi-pencil"></i> Daftar LSP</a></li>
                        <li class="nav-item mt-2"><a class="nav-link fs-5 p-2" data-bs-toggle="tab" data-bs-target="#daftar_asesi" type="button" role="tab" aria-controls="home" aria-selected="true" href="#daftar_asesi"><i class="mdi mdi-pencil"></i> Daftar Peserta Asesi</a></li>
                    </div>

                    <div class="tab-content m-0 p-3 pt-0" id="v-pills-tabContent">

                        <!-- Daftar LSP -->
                        <div id="daftar_lsp" class="tab-pane active">
                            <div class="row m-t-10">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table-sm table-bordered table-striped mb-0 table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama LSP</th>
                                                    <th>Jumlah Skema</th>
                                                    <th>Kuota</th>
                                                    <th>Jadwal</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-group-divider fs-12">

                                                @foreach ($dataKegiatan->detailsGroupedByLsp as $details)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $details->lsp->lsp_nama }}</td>
                                                        <td>
                                                            {{ $skemaPerLsp[$details->lsp_ref]->total_skema ?? 0 }} Skema
                                                        </td>
                                                        <td>{{ $details->total_kuota_lsp ?? '0' }} Peserta</td>
                                                        {{-- <td>{{ \Carbon\Carbon::parse($details->created_at)->locale('id')->translatedFormat('d F Y') }}</td> --}}
                                                        <td>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#jadwalModal-{{ $details->lsp_ref }}">Lihat Jadwal</a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>

                                        @foreach ($dataKegiatan->detailsGroupedByLsp as $details)
                                            <!-- Edit Data Modal -->
                                            <div id="jadwalModal-{{ $details->lsp_ref }}" class="modal modal-lg fade" tabindex="-1" role="dialog" aria-labelledby="success-header-modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header modal-colored-header bg-success">
                                                            <h4 class="modal-title" id="success-header-modalLabel">Pembagian Jadwal Asesmen</h4>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <span class="badge bg-primary-subtle text-primary rounded-pill fs-5 mb-2">{{ $jadwalKegiatan[$details->lsp_ref]->first()->lsp->lsp_nama ?? '' }}</span>


                                                            <div class="nav nav-pills nav-justified gap-0 p-3 text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                                <li class="nav-item mt-2"><a class="nav-link fs-5 active p-2" data-bs-toggle="tab" data-bs-target="#jadwal_asesmen" type="button" role="tab" aria-controls="home" aria-selected="true" href="#jadwal_asesmen"><i class="mdi mdi-pencil"></i> Daftar Jadwal Asesmen</a></li>
                                                                <li class="nav-item mt-2"><a class="nav-link fs-5 p-2" data-bs-toggle="tab" data-bs-target="#daftar_skema" type="button" role="tab" aria-controls="home" aria-selected="true" href="#daftar_skema"><i class="mdi mdi-pencil"></i> Daftar Skema</a></li>
                                                            </div>

                                                            <div class="tab-content m-0 p-3 pt-0" id="v-pills-tabContent">
                                                                {{-- Jadwal Asesmen Content --}}
                                                                <div id="jadwal_asesmen" class="tab-pane active">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <table class="table-sm table-bordered table-striped mb-0 table" style="font-size: 12px">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>No</th>
                                                                                        <th>Kuota</th>
                                                                                        <th>Tanggal Asesmen</th>
                                                                                        <th>Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($jadwalKegiatan[$details->lsp_ref] as $jadwal)
                                                                                        <tr>
                                                                                            <td>{{ $loop->iteration }}</td>
                                                                                            <td>{{ $jadwal->kuota_lsp }} Peserta</td>
                                                                                            <td>{{ \Carbon\Carbon::parse($jadwal->mulai_asesmen)->locale('id')->translatedFormat('l, d F Y') }}</td>
                                                                                            <td class="d-flex gap-2">
                                                                                                <a href="{{ route('asesmen.edit', $jadwal->ref) }}" class="text-primary">
                                                                                                    <i class="mdi mdi-pencil-outline"></i> Edit
                                                                                                </a>

                                                                                                <input type="hidden" class="dataID" value="{{ $jadwal->ref }}">
                                                                                                <a href="#" class="text-danger deleteButton" data-nama="{{ \Carbon\Carbon::parse($jadwal->mulai_asesmen)->locale('id')->translatedFormat('l, d F Y') }}">
                                                                                                    <i class="mdi mdi-trash-can-outline"></i> Hapus
                                                                                                </a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- END Jadwal Asesmen Content --}}

                                                                {{-- Skema Content --}}
                                                                <div id="daftar_skema" class="tab-pane">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <table class="table-sm table-bordered table-striped mb-0 table" style="font-size: 12px">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>No</th>
                                                                                        <th>Nama Skema</th>
                                                                                        <th>Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($skemaPerLsp[$details->lsp_ref] as $jadwal)
                                                                                        {{-- {{ dd($skemaPerLsp) }} --}}
                                                                                        <tr>
                                                                                            <td>{{ $loop->iteration }}</td>
                                                                                            <td>Skema 1</td>
                                                                                            <td class="d-flex gap-2">
                                                                                                <a href="#" class="text-danger">
                                                                                                    <i class="mdi mdi-trash-can-outline"></i> Hapus
                                                                                                </a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- END Skema Content --}}


                                                            </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Daftar Asesi -->
                        <div id="daftar_asesi" class="tab-pane">
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- <table id="scroll-horizontal-datatable" class="table-sm table-bordered table-striped w-100 nowrap table"> --}}
                                    <table id="fixed-columns-datatable" class="table table-striped nowrap row-border order-column w-100">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Peserta</th>
                                                <th>Tanggal Ujian</th>
                                                <th> LSP Dipilih</th>
                                                <th>Skema</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @for ($x = 1; $x <= 50; $x++)
                                                <tr>
                                                    <td>{{ $x }}</td>
                                                    <td>Gede Nyoman</td>
                                                    <td>AC-213214.312421</td>
                                                    <td>
                                                        LSP Engineering Hospitality Indonesia
                                                        {{-- <hr class="my-1"> --}}
                                                        

                                                    </td>
                                                    <td>Skema Refrigerasi Domestik</td>
                                                    <td>10 Unit</td>
                                                </tr>
                                            @endfor

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Daterangepicker Plugin js -->
    <script src="{{ asset('admin') }}/assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/daterangepicker/daterangepicker.js"></script>

    <!-- Datatables js -->
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/pages/datatable.init.js"></script>

    <script src="{{ asset('admin') }}/assets/vendor/lucide/umd/lucide.min.js"></script>

    <!--  Select2 Plugin Js -->
    <script src="{{ asset('admin') }}/assets/vendor/select2/js/select2.min.js"></script>



    <script>
        $(document).on('focus', '.single-date', function() {
            const modal = $(this).closest('.modal');

            $(this).daterangepicker({
                singleDatePicker: true,
                autoUpdateInput: false,
                parentEl: modal,
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });

            $(this).on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY'));
            });
        });
    </script>



    {{-- Sweet Alert --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.deleteButton').forEach(button => {

                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const row = this.closest('tr');
                    const dataNama = this.dataset.nama;
                    const dataID = this.closest('td').querySelector('.dataID').value;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: `Hapus jadwal asesmen pada hari ${dataNama}?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                    }).then(result => {

                        if (!result.isConfirmed) return;

                        fetch(`/asesmen/${dataID}`, {
                                method: 'DELETE',
                                credentials: 'same-origin',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'X-Requested-With': 'XMLHttpRequest',
                                }
                            })
                            .then(() => {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: 'Jadwal asesmen berhasil dihapus',
                                    icon: 'success',
                                    timer: 1200,
                                    showConfirmButton: false
                                });
                                row.style.transition = 'opacity 0.3s';
                                row.style.opacity = 0;
                                setTimeout(() => row.remove(), 300);
                            })
                            .catch(err => {
                                console.error(err);
                                Swal.fire('Error', 'Request gagal dikirim ke server', 'error');
                            });
                    });
                });

            });

        });
    </script>
@endpush
