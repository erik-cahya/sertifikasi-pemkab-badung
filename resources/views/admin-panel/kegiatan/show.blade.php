@extends('admin-panel.layouts.app')
@push('style')
    <!-- Datatables css -->
    <link href="{{ asset('admin') }}/assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-lg-4">
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

                                <span class="badge bg-success rounded-pill px-3">Active</span>
                                <span class="badge bg-info rounded-pill px-3">{{ $dataKegiatan->details->pluck('lsp')->unique('ref')->count() }} LSP</span>
                                <span class="badge bg-primary rounded-pill px-3">100/{{ $dataKegiatan->total_kuota_lsp }} Peserta</span>

                            </div>
                            <div class="avatar-sm mb-4">
                                <div class="avatar-title bg-danger-subtle text-danger fs-24 rounded">
                                    <i class="bi bi-journal-medical"></i>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex flex-lg-nowrap justify-content-between align-items-end flex-wrap">
                            <button class="btn-sm btn btn-danger">
                                <i class="mdi mdi-pencil"></i> Edit Kegiatan</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="nav nav-pills nav-justified gap-0 p-3 text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                        <li class="nav-item mt-2"><a class="nav-link fs-5 active p-2" data-bs-toggle="tab" data-bs-target="#daftar_lsp" type="button" role="tab" aria-controls="home" aria-selected="true" href="#daftar_lsp"><i class="mdi mdi-pencil"></i> Daftar LSP</a></li>
                        <li class="nav-item mt-2"><a class="nav-link fs-5 p-2" data-bs-toggle="tab" data-bs-target="#daftar_asesi" type="button" role="tab" aria-controls="home" aria-selected="true" href="#daftar_asesi"><i class="mdi mdi-pencil"></i> Daftar Asesi</a></li>
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
                                                    <th>Tanggal</th>
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
                                                        <td>{{ \Carbon\Carbon::parse($details->created_at)->locale('id')->translatedFormat('d F Y') }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Daftar Asesi -->
                        <div id="daftar_asesi" class="tab-pane">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="basic-datatable" class="table-sm table-bordered table-striped w-100 nowrap table">
                                        <thead>

                                            <tr>
                                                <th>No</th>
                                                <th>Nama Peserta</th>
                                                <th>Tanggal Ujian</th>
                                                <th>LSP Dipilih</th>
                                                <th>Skema</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody style="font-size: 12px">
                                            <tr>
                                                <td>1</td>
                                                <td>Teknisi Refrigerasi Domestik</td>
                                                <td>AC-213214.312421</td>
                                                <td>AC-213214.312421</td>
                                                <td>10 Unit</td>
                                                <td>10 Unit</td>
                                            </tr>
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
    <!-- Datatables js -->
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>

    <!-- Datatable Demo App js -->
    <script src="{{ asset('admin') }}/assets/js/pages/datatable.init.js"></script>

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
                        text: `Delete data ${dataNama}?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                    }).then(result => {

                        if (!result.isConfirmed) return;

                        fetch(`/lsp/${dataID}`, {
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
                                    text: 'Data LSP berhasil dihapus',
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
