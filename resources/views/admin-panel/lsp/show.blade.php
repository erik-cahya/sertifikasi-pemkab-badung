@extends('admin-panel.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-dinas text-white">
                        <div class="d-flex justify-content-between align-items-center">

                            <h4 class=".card-title">LSP Details</h4>

                            <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#editLSPModal">
                                <i class="ri-edit-2-line"></i> Edit Data LSP
                            </button>

                            {{-- Modal Ganti Password --}}
                            <div id="editLSPModal" class="modal modal-lg fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">

                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('lsp.update', $dataLSP->ref) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header modal-colored-header bg-dinas">
                                                <h5 class="modal-title" id="primary-header-modalLabel">Edit Data LSP</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body text-dark">
                                                <div class="row">
                                                    <x-form.input className="col-md-6 mb-3" type="text" name="lsp_nama" label="Nama LSP" value="{{ $dataLSP->lsp_nama }}" errorBag="update_lsp" />
                                                    <x-form.input className="col-md-6 mb-3" type="text" name="lsp_no_lisensi" label="No Lisensi LSP" value="{{ $dataLSP->lsp_no_lisensi }}" />
                                                    <x-form.input className="col-md-6 mb-3" type="text" name="lsp_telp" label="Kontak LSP" value="{{ $dataLSP->lsp_telp }}" />
                                                    <x-form.input className="col-md-6 mb-3" type="text" name="lsp_alamat" label="Alamat LSP" value="{{ $dataLSP->lsp_alamat }}" />
                                                    <x-form.input className="col-md-6 mb-3" type="text" name="lsp_email" label="Email LSP" value="{{ $dataLSP->lsp_email }}" />
                                                    <x-form.input className="col-md-6 mb-3" type="text" name="lsp_direktur" label="Direktur LSP" value="{{ $dataLSP->lsp_direktur }}" />
                                                    <x-form.input className="col-md-6 mb-3" type="text" name="lsp_direktur_telp" label="Kontak Direktur LSP" value="{{ $dataLSP->lsp_direktur_telp }}" />
                                                    {{-- <x-form.input className="col-md-6 mb-3" type="date" name="lsp_tanggal_lisensi" label="Tanggal Lisensi LSP" value="{{ $dataLSP->lsp_tanggal_lisensi }}" /> --}}
                                                    <x-form.input className="col-md-6 mb-3" type="date" name="lsp_expired_lisensi" label="Tanggal Expired LSP" value="{{ $dataLSP->lsp_expired_lisensi }}" />

                                                    <hr>

                                                    <x-form.input className="col-md-6 mb-3" type="text" name="nama_cp_1" label="Nama Kontak Person 1" value="{{ $dataLSP->nama_cp_1 }}" />
                                                    <x-form.input className="col-md-6 mb-3" type="text" name="nomor_cp_1" label="Nomor Kontak Person 1" value="{{ $dataLSP->nomor_cp_1 }}" />
                                                    <x-form.input className="col-md-6 mb-3" type="text" name="nama_cp_2" label="Nama Kontak Person 2 (opsional)" value="{{ $dataLSP->nama_cp_2 }}" />
                                                    <x-form.input className="col-md-6 mb-3" type="text" name="nomor_cp_2" label="Nomor Kontak Person 2 (opsional)" value="{{ $dataLSP->nomor_cp_2 }}" />
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
                                    <label class="col-md-3 col-form-label" for="serial_gse"><i class="ri-edit-2-line"></i> Tanggal Expired Lisensi</label>
                                    <div class="col-md-9">
                                        <input disabled type="text" class="form-control" id="serial_gse" name="serial_gse" value="{{ \Carbon\Carbon::parse($dataLSP->lsp_expired_lisensi)->locale('id')->translatedFormat('l, d F Y') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="serial_gse"><i class="ri-edit-2-line"></i> Kontak Person 1</label>
                                    <div class="col-md-5">
                                        <input disabled type="text" class="form-control" id="serial_gse" name="serial_gse" value="{{ $dataLSP->nama_cp_1 }}">
                                    </div>
                                    <div class="col-md-4">
                                        <input disabled type="text" class="form-control" id="serial_gse" name="serial_gse" value="{{ $dataLSP->nomor_cp_1 }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="serial_gse"><i class="ri-edit-2-line"></i> Kontak Person 2</label>
                                    <div class="col-md-5">
                                        <input disabled type="text" class="form-control" id="serial_gse" name="serial_gse" value="{{ $dataLSP->nama_cp_2 ?? '-' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <input disabled type="text" class="form-control" id="serial_gse" name="serial_gse" value="{{ $dataLSP->nomor_cp_2 ?? '-' }}">
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
                                <div id="gantiPasswordModal" class="modal modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">

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
                                    <th>Action</th>
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
                                            <a href="javascript:void(0)" class="btn btn-sm btn-dinas" data-bs-toggle="modal" data-bs-target="#editModal-{{ $dataSkema->ref }}">
                                                <i class="ri-pencil-line"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Edit Data Modal -->
                                    <div id="editModal-{{ $dataSkema->ref }}" class="modal modal-lg fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">

                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('skema.update', $dataSkema->ref) }}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="modal-header modal-colored-header bg-dinas">
                                                        <h4 class="modal-title" id="primary-header-modalLabel">Edit Skema {{ $dataSkema->skema_judul }}</h4>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <input type="hidden" name="skema_ref" value="{{ $dataSkema->ref }}">
                                                            <div class="col-lg-12">
                                                                <label for="skema_judul" class="form-label">Skema Judul</label>
                                                                <input type="text" id="skema_judul" class="form-control rounded-3" name="skema_judul" value="{{ $dataSkema->skema_judul }}">
                                                            </div>

                                                            <div class="col-lg-12 mt-3">
                                                                <label for="skema_kode" class="form-label">Kode Skema</label>
                                                                <input type="text" id="skema_kode" class="form-control rounded-3" name="skema_kode" value="{{ $dataSkema->skema_kode }}">
                                                            </div>

                                                            <div class="col-lg-12 mt-2">
                                                                <label for="skema_kategori" class="form-label">Kategori Skema</label>
                                                                <select class="text-capitalize @error('skema_kategori', 'create_skema') is-invalid @enderror rounded-3 form-select" id="skema_kategori" name="skema_kategori">
                                                                    <option value="#" disabled selected hidden>Pilih Kategori Skema</option>
                                                                    <option value="KKNI" {{ $dataSkema->skema_kategori === 'KKNI' ? 'selected' : '' }}>KKNI</option>
                                                                    <option value="Okupasi" {{ $dataSkema->skema_kategori === 'Okupasi' ? 'selected' : '' }}>Okupasi</option>
                                                                    <option value="Klaster" {{ $dataSkema->skema_kategori === 'Klaster' ? 'selected' : '' }}>Klaster</option>
                                                                    {{-- <option value="Unit Kompetensi" {{ $dataSkema->skema_kategori === 'Unit Kompetensi' ? 'selected' : '' }}>Unit Kompetensi</option> --}}
                                                                    {{-- <option value="Profisiensi" {{ $dataSkema->skema_kategori === 'Profisiensi' ? 'selected' : '' }}>Profisiensi</option> --}}
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-dinas">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- / END Edit Data modal -->
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
