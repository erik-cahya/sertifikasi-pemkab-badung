@extends('admin-panel.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dinas text-white">
                    <h4 class=".card-title">Tambah Data Jabatan</h4>
                </div>
                <form action="{{ route('jabatan.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Pilih Departemen</label><span class="text-danger">*</span>
                                    <select class="rounded-3 form-select" id="example-select" name="departemen_ref" required>
                                        <option value="">Pilih Departemen</option>
                                        @foreach ($dataDepartemen as $departemen)
                                            <option value="{{ $departemen->ref }}">{{ $departemen->departemen_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="mb-3">
                                    <label for="jabatan_nama" class="form-label">Nama Jabatan</label><span class="text-danger">*</span>
                                    <input type="text" id="jabatan_nama" class="form-control rounded-3 @error('jabatan_nama', 'create_jabatan') is-invalid @enderror" name="jabatan_nama" placeholder="Masukkan nama jabatan" value="{{ old('jabatan_nama') }}">
                                    @error('jabatan_nama', 'create_jabatan')
                                        <div class="invalid-feedback" bis_skin_checked="1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-dinas rounded-3"><i class="ri-add-fill"></i> Tambah</button>
                                </div>
                            </div>
                        </div><!-- end row-->
                    </div> <!-- end card-body -->
                </form>
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dinas text-white">
                    <h4 class=".card-title">Daftar Jabatan</h4>
                </div>
                <div class="card-body">

                    <table id="datatable-dashboard" class="table-striped nowrap row-border order-column w-100 table">
                        <thead>
                            <tr>
                                <th>Departemen</th>
                                <th>Nama Jabatan</th>
                                <th>Dibuat oleh</th>
                                <th width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataJabatan as $item)
                                <tr>
                                    <td>{{ $item->departemen_nama }}</td>
                                    <td>{{ $item->jabatan_nama }}</td>
                                    <td>{{ $item->name }} <br> {{ $item->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">

                                            <a href="{{ route('jabatan.edit', $item->ref) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Jabatan" data-bs-custom-class="info-tooltip"><i class="mdi mdi-pencil"></i></a>
</a>

                                            <input type="hidden" class="jabatanID" value="{{ $item->ref }}">
                                            <a href="javascript:void(0)" data-nama="{{ $item->jabatan_nama }}"class="btn btn-sm btn-danger deleteButton" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hapus Jabatan" data-bs-custom-class="danger-tooltip"><i class="mdi mdi-trash-can"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->
@endsection
@push('script')
    {{-- Sweet Alert --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Saat halaman sudah ready
            const deleteButtons = document.querySelectorAll('.deleteButton');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    let propertyName = this.getAttribute('data-nama');
                    let jabatanID = this.parentElement.querySelector('.jabatanID').value;

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
                            fetch('/jabatan/' + jabatanID, {
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
