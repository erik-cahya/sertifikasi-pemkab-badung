@extends('admin-panel.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-dinas text-white">
                        <div class="d-flex justify-content-between align-items-center">

                            <h4 class=".card-title">LSP Details</h4>

                            @role('lsp')
                                <button type="button" class="btn btn-sm btn-dinas" data-bs-toggle="modal" data-bs-target="#editLSPModal">
                                    <i class="ri-edit-2-line"></i> Edit Data LSP
                                </button>

                                {{-- Modal Ganti Password --}}
                                <div id="editLSPModal" class="modal modal-lg fade" tabindex="-1" role="dialog"
                                    aria-labelledby="primary-header-modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">

                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('lsp.update', $dataLSP->ref) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header modal-colored-header bg-dinas">
                                                    <h5 class="modal-title" id="primary-header-modalLabel">Edit Data LSP</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">

                                                    <div class="row">
                                                        <x-form.input className="col-md-6 mb-3" type="text" name="lsp_nama" label="Nama LSP" value="{{ $dataLSP->lsp_nama }}" errorBag="update_lsp" />
                                                        <x-form.input className="col-md-6 mb-3" type="text" name="lsp_no_lisensi" label="No Lisensi LSP" value="{{ $dataLSP->lsp_no_lisensi }}" />
                                                        <x-form.input className="col-md-6 mb-3" type="text" name="lsp_telp" label="Kontak LSP" value="{{ $dataLSP->lsp_telp }}" />
                                                        <x-form.input className="col-md-6 mb-3" type="text" name="lsp_alamat" label="Alamat LSP" value="{{ $dataLSP->lsp_alamat }}" />
                                                        <x-form.input className="col-md-6 mb-3" type="text" name="lsp_email" label="Email LSP" value="{{ $dataLSP->lsp_email }}" />
                                                        <x-form.input className="col-md-6 mb-3" type="text" name="lsp_direktur" label="Direktur LSP" value="{{ $dataLSP->lsp_direktur }}" />
                                                        <x-form.input className="col-md-6 mb-3" type="text" name="lsp_direktur_telp" label="Kontak Direktur LSP" value="{{ $dataLSP->lsp_direktur_telp }}" />
                                                        <x-form.input className="col-md-6 mb-3" type="date" name="lsp_tanggal_lisensi" label="Tanggal Lisensi LSP" value="{{ $dataLSP->lsp_tanggal_lisensi }}" />
                                                        <x-form.input className="col-md-6 mb-3" type="date" name="lsp_expired_lisensi" label="Tanggal Expired LSP" value="{{ $dataLSP->lsp_expired_lisensi }}" />
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-dinas">Edit Data</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div><!-- / END Modal Ganti Password -->
                            @endrole
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
                                    <label class="col-md-3 col-form-label" for="serial_gse"><i class="ri-edit-2-line"></i> Email</label>
                                    <div class="col-md-9">
                                        <input disabled type="text" class="form-control" id="serial_gse" name="serial_gse" value="{{ $dataLSP->lsp_email }}">
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
                    <div class="card-header bg-dinas text-white">
                        <div class="d-flex justify-content-between align-items-center">

                            <h4 class=".card-title">LSP Account</h4>
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
                                <label class="col-form-label" for="serial_gse"><i class="ri-edit-2-line"></i> Username</label>
                                <div class="">
                                    <input disabled type="text" class="form-control" id="serial_gse" name="serial_gse" value="{{ $dataLSP->user->username }}">
                                </div>
                            </div>

                            @role('master')
                                <div class="col-12 mt-2">
                                    <button type="button" class="btn btn-sm btn-dinas" data-bs-toggle="modal" data-bs-target="#gantiPasswordModal">
                                        <i class="ri-lock-password-fill"></i> Ganti Password
                                    </button>
                                </div>

                                {{-- Modal Ganti Password --}}
                                <div id="gantiPasswordModal" class="modal modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="primary-header-modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">

                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('lsp.change-password', $dataLSP->ref) }}" method="POST">
                                                @csrf
                                                <div class="modal-header modal-colored-header bg-dinas">
                                                    <h5 class="modal-title" id="primary-header-modalLabel">Ganti Password</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <x-form.input className="col-md-12 mb-3" type="password" name="password" label="Password " placeholder="Masukkan Password Baru" />
                                                    <x-form.input className="col-md-12 mb-3" type="password" name="password_confirmation" label="Password Confirmation " placeholder="Konfirmasi Password" />

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-dinas" data-bs-dismiss="modal">Change Password</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div><!-- / END Modal Ganti Password -->
                            @endrole
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-8">
                <div class="card">
                    <div class="card-header bg-dinas text-white">
                        <div class="d-flex justify-content-between align-items-center">

                            <h4 class=".card-title">LSP Skema</h4>
                            @role('lsp')
                                <button type="button" class="btn btn-sm btn-dinas" data-bs-toggle="modal" data-bs-target="#editModal">
                                    <i class="ri-edit-2-line"></i> Edit Data LSP
                                </button>
                            @endrole
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
                                        <td>
                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#editModal-{{ $dataSkema->ref }}">
                                                {{ $dataSkema->kode_units_count }} Unit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @foreach ($dataLSP->skemas as $skema)
                            <div id="editModal-{{ $skema->ref }}" class="modal modal-lg fade" tabindex="-1" role="dialog"
                                aria-labelledby="primary-header-modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">

                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header modal-colored-header bg-dinas">
                                            <h4 class="modal-title" id="primary-header-modalLabel">List Kode Unit</h4>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-2">
                                                <h5 class="">{{ $skema->lsp_nama }}
                                                </h5>
                                                <span class="badge bg-dinas-subtle text-primary">{{ $skema->skema_judul }}</span>
                                            </div>
                                            <table class="table-striped table-sm table-bordered w-100 nowrap table" style="font-size: 12px">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Judul Unit</th>
                                                        <th>Kode Unit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($skema->details as $unit)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $unit->judul_unit }}</td>
                                                            <td>{{ $unit->kode_unit }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                </div>
                            </div><!-- / END Edit Data modal -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    @if ($errors->update_lsp->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editModal = new bootstrap.Modal(
                    document.getElementById('editLSPModal')
                );
                editModal.show();
            });
        </script>
    @endif

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
