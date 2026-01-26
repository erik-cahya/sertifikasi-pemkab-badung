@extends('admin-panel.layouts.app')
@push('style')
    <!-- Datatables css -->
    <link href="{{ asset('admin') }}/assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">

                            <h4 class=".card-title">LSP Details</h4>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                                <i class="ri-edit-2-line"></i> Edit Data LSP
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="serial_gse"><i class="ri-edit-2-line"></i> Nama LSP</label>
                                    <div class="col-md-9">
                                        <input disabled type="text" class="form-control" id="serial_gse" name="serial_gse" value="{{ $dataLSP->lsp_nama }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="serial_gse"><i class="ri-edit-2-line"></i> No Lisensi LSP</label>
                                    <div class="col-md-9">
                                        <input disabled type="text" class="form-control" id="serial_gse" name="serial_gse" value="{{ $dataLSP->lsp_no_lisensi }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="serial_gse"><i class="ri-edit-2-line"></i> Kontak LSP</label>
                                    <div class="col-md-9">
                                        <input disabled type="text" class="form-control" id="serial_gse" name="serial_gse" value="{{ $dataLSP->lsp_telp }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="serial_gse"><i class="ri-edit-2-line"></i> Alamat LSP</label>
                                    <div class="col-md-9">
                                        <input disabled type="text" class="form-control" id="serial_gse" name="serial_gse" value="{{ $dataLSP->lsp_alamat }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="serial_gse"><i class="ri-edit-2-line"></i> Direktur LSP</label>
                                    <div class="col-md-9">
                                        <input disabled type="text" class="form-control" id="serial_gse" name="serial_gse" value="{{ $dataLSP->lsp_direktur }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="serial_gse"><i class="ri-edit-2-line"></i> Kontak Direktur LSP</label>
                                    <div class="col-md-9">
                                        <input disabled type="text" class="form-control" id="serial_gse" name="serial_gse" value="{{ $dataLSP->lsp_direktur_telp }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="serial_gse"><i class="ri-edit-2-line"></i> Tanggal Lisensi LSP</label>
                                    <div class="col-md-9">
                                        <input disabled type="text" class="form-control" id="serial_gse" name="serial_gse" value="{{ \Carbon\Carbon::parse($dataLSP->lsp_tanggal_lisensi)->locale('id')->translatedFormat('l, d F Y') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="serial_gse"><i class="ri-edit-2-line"></i> Tanggal Expired Lisensi</label>
                                    <div class="col-md-9">
                                        <input disabled type="text" class="form-control" id="serial_gse" name="serial_gse" value="{{ \Carbon\Carbon::parse($dataLSP->lsp_expired_lisensi)->locale('id')->translatedFormat('l, d F Y') }}">
                                    </div>
                                </div>

                                <div class="row d-flex align-items-center mb-3">
                                    <label class="col-md-3 col-form-label" for="serial_gse"><i class="ri-edit-2-line"></i> Status LSP</label>
                                    <div class="col-md-9">
                                        <span class="badge bg-success">Active</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">

                            <h4 class=".card-title">LSP Account</h4>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                                <i class="ri-edit-2-line"></i> Edit Data LSP
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <label class="col-form-label" for="serial_gse"><i class="ri-edit-2-line"></i> Nama LSP</label>
                                <div class="">
                                    <input disabled type="text" class="form-control" id="serial_gse" name="serial_gse" value="{{ $dataLSP->lsp_nama }}">
                                </div>
                            </div>

                            <div class="col-12 mt-2">
                                <label class="col-form-label" for="serial_gse"><i class="ri-edit-2-line"></i> username</label>
                                <div class="">
                                    <input disabled type="text" class="form-control" id="serial_gse" name="serial_gse" value="{{ $dataLSP->user->username }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">

                            <h4 class=".card-title">LSP Skema</h4>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                                <i class="ri-edit-2-line"></i> Edit Data LSP
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="scroll-horizontal-datatable" class="table-sm table-striped w-100 nowrap table text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Skema</th>
                                    <th>Kode Skema</th>
                                    <th>Kategori Skema</th>
                                    <th>Jumlah Kode Unit</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 12px">
                                @foreach ($dataLSP->skemas as $dataSkema)
                                    <tr class="align-middle">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dataSkema->skema_judul }}</td>
                                        <td>{{ $dataSkema->skema_kode }}</td>
                                        <td>{{ $dataSkema->skema_kategori }}</td>
                                        <td>{{ $dataSkema->kode_units_count }} Unit</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
