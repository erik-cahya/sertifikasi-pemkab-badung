@extends('admin-panel.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dinas text-white">
                    <h4 class=".card-title">Tambah Data Departemen</h4>
                </div>
                <form action="{{ route('departemen.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="mb-3">
                                    <label for="departemen_nama" class="form-label">Nama Departemen</label><span class="text-danger">*</span>
                                    <input type="text" id="departemen_nama" class="form-control rounded-3 @error('departemen_nama', 'create_departemen') is-invalid @enderror" name="departemen_nama" placeholder="Masukkan nama departemen" value="{{ old('departemen_nama') }}"">
                                    @error('departemen_nama', 'create_departemen')
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
                    <h4 class=".card-title">Daftar Departemen</h4>
                </div>
                <div class="card-body">

                    <table id="datatable-dashboard" class="table-striped nowrap row-border order-column w-100 table">
                        <thead>
                            <tr>
                                <th>Kode Departemen</th>
                                <th>Nama</th>
                                <th>Dibuat oleh</th>
                                <th width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataDepartemen as $item)
                                <tr>
                                    <td>{{ $item->departemen_kode }}</td>
                                    <td>{{ $item->departemen_nama }}</td>
                                    <td>{{ $item->name }} <br> {{ $item->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">

                                            <a href="{{ route('departemen.edit', $item->ref) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Departemen" data-bs-custom-class="info-tooltip"><i class="mdi mdi-pencil"></i></a>

                                            <input type="hidden" class="departemenID" value="{{ $item->ref }}">
                                            <a href="javascript:void(0)"data-nama="{{ $item->departemen_nama }}"class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hapus Departemen" data-bs-custom-class="danger-tooltip"><i class="mdi mdi-trash-can"></i></a>
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
                    let departemenID = this.parentElement.querySelector('.departemenID').value;

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
                            fetch('/departemen/' + departemenID, {
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
