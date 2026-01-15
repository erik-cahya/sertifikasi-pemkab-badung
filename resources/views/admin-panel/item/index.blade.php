@extends('admin-panel.layouts.app')
@push('style')
    <!-- Datatables css -->
    <link href="{{ asset('admin') }}/assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
@endpush
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class=".card-title">Tambah Data Items</h4>
                </div>
                <form action="{{ route('item.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Kategori</label><span class="text-danger">*</span>
                                    <select class="form-select rounded-3" id="example-select" name="item_kategori" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="Departemen">Departemen</option>
                                        <option value="Jabatan">Jabatan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Nama Item</label><span class="text-danger">*</span>
                                    <input type="text" id="simpleinput" class="form-control rounded-3" name="item_nama" required placeholder="Masukkan nama item" required>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-outline-primary rounded-3"><i class="ri-add-fill"></i> Tambah</button>
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
                <div class="card-header">
                    <h4 class=".card-title">Daftar Items</h4>
                </div>
                <div class="card-body">

                    <table id="fixed-columns-datatable" class="table table-striped nowrap row-border order-column w-100">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Judul</th>
                                <th>Dibuat oleh</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataItem as $item)
                                <tr>
                                    <td>{{ $item->item_kategori }}</td>
                                    <td>{{ $item->item_nama }}</td>
                                    <td>{{ $item->name }} <br> {{ $item->created_at->format('Y-m-d') }}</td>
                                    <td>
                                         <a href="javascript: void(0);" class="text-reset fs-16 px-1">
                                            <i class="ri-pencil-line"></i>
                                        </a>

                                        <input type="hidden" class="itemID" value="{{ $item->ref }}">
                                        <a href="javascript:void(0)" class="text-reset fs-16 deleteButton px-1" data-nama="{{ $item->item_nama }}">
                                            <i class="mdi mdi-trash-can"></i>
                                        </a>
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
                    let itemID = this.parentElement.querySelector('.itemID').value;

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
                            fetch('/item/' + itemID, {
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
