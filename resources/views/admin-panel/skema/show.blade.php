@extends('admin-panel.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class=".card-title">Skema Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="serial_gse">Nama Skema</label>
                                    <div class="col-md-9">
                                        <input disabled type="text" class="form-control" id="serial_gse" name="serial_gse" value="{{ $skema->skema_judul }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="serial_gse">Kode Skema</label>
                                    <div class="col-md-9">
                                        <input disabled type="text" class="form-control" id="serial_gse" name="serial_gse" value="{{ $skema->skema_kode }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label" for="serial_gse">Kategori Skema</label>
                                    <div class="col-md-9">
                                        <input disabled type="text" class="form-control" id="serial_gse" name="serial_gse" value="{{ $skema->skema_kategori }}">
                                    </div>
                                </div>

                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal-{{ $skema->ref }}">
                                    <i class="ri-edit-2-line"></i> Edit Data Skema
                                </button>

                                <!-- Edit Data Modal -->
                                <div id="editModal-{{ $skema->ref }}" class="modal modal-lg fade" tabindex="-1" role="dialog"
                                    aria-labelledby="primary-header-modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">

                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('skema.update', $skema->ref) }}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <div class="modal-header modal-colored-header bg-primary">
                                                    <h4 class="modal-title" id="primary-header-modalLabel">Edit Skema {{ $skema->skema_judul }}</h4>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <input type="hidden" name="skema_ref" value="{{ $skema->ref }}">
                                                        <div class="col-lg-12">
                                                            <label for="skema_judul" class="form-label">Skema Judul</label>
                                                            <input type="text" id="skema_judul" class="form-control" name="skema_judul" value="{{ $skema->skema_judul }}">
                                                        </div>

                                                        <div class="col-lg-12 mt-3">
                                                            <label for="skema_kode" class="form-label">Kode Skema</label>
                                                            <input type="text" id="skema_kode" class="form-control" name="skema_kode" value="{{ $skema->skema_kode }}">
                                                        </div>

                                                        <div class="col-lg-12 mt-2">
                                                            <label for="skema_kategori" class="form-label">Kategori Skema</label>
                                                            <select class="text-capitalize @error('skema_kategori', 'create_skema') is-invalid @enderror form-select" id="skema_kategori" name="skema_kategori">
                                                                <option value="#" disabled selected hidden>Pilih Kategori Skema</option>
                                                                <option value="KKNI" {{ $skema->skema_kategori === 'KKNI' ? 'selected' : '' }}>KKNI</option>
                                                                <option value="Okupasi" {{ $skema->skema_kategori === 'Okupasi' ? 'selected' : '' }}>Okupasi</option>
                                                                <option value="Klaster" {{ $skema->skema_kategori === 'Klaster' ? 'selected' : '' }}>Klaster</option>
                                                                <option value="Unit Kompetensi" {{ $skema->skema_kategori === 'Unit Kompetensi' ? 'selected' : '' }}>Unit Kompetensi</option>
                                                                <option value="Profisiensi" {{ $skema->skema_kategori === 'Profisiensi' ? 'selected' : '' }}>Profisiensi</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- / END Edit Data modal -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class=".card-title">Kode Unit</h4>
                    </div>
                    <div class="card-body">
                        <table id="datatable-dashboard" class="table-striped table-sm table-bordered w-100 nowrap table" style="font-size: 12px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Unit</th>
                                    <th>Kode Unit</th>
                                    <th>Action</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($skema->details as $unit)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $unit->judul_unit }}</td>
                                        <td>{{ $unit->kode_unit }}</td>
                                        <td>
                                            <a href="javascript: void(0);" class="text-reset px-1" data-bs-toggle="modal" data-bs-target="#editModal-{{ $unit->ref }}">
                                                <i class="ri-pencil-line"></i> Edit
                                            </a>
                                            |
                                            <input type="hidden" class="skemaID" value="{{ $unit->ref }}">
                                            <a href="javascript:void(0)" class="text-reset deleteButton px-1" data-nama="{{ $unit->judul_unit }}">
                                                <span class="text-danger"> <i class="mdi mdi-trash-can"></i> Delete</span>
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Edit Data Modal -->
                                    <div id="editModal-{{ $unit->ref }}" class="modal modal-lg fade" tabindex="-1" role="dialog"
                                        aria-labelledby="success-header-modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">

                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('kode_unit.update', $unit->ref) }}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="modal-header modal-colored-header bg-success">
                                                        <h4 class="modal-title" id="success-header-modalLabel">Edit Kode Unit {{ $unit->kode_unit }}</h4>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <input type="hidden" name="skema_ref" value="{{ $skema->ref }}">
                                                            <div class="col-lg-12">
                                                                <label for="judul_unit" class="form-label">Judul Unit</label>
                                                                <input type="text" id="judul_unit" class="form-control" name="judul_unit" value="{{ $unit->judul_unit }}">
                                                            </div>

                                                            <div class="col-lg-12 mt-3">
                                                                <label for="kode_unit" class="form-label">Kode Unit</label>
                                                                <input type="text" id="kode_unit" class="form-control" name="kode_unit" value="{{ $unit->kode_unit }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
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
    <!-- Datatables js -->
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>

    <!-- Datatable Demo App js -->
    <script src="{{ asset('admin') }}/assets/js/pages/datatable.init.js"></script>

    {{-- Sweet Alert --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Saat halaman sudah ready
            const deleteButtons = document.querySelectorAll('.deleteButton');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    let propertyName = this.getAttribute('data-nama');
                    let skemaID = this.parentElement.querySelector('.skemaID').value;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete data " + propertyName + "?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Kirim DELETE request manual lewat JavaScript
                            fetch('/kode_unit/' + skemaID, {
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
