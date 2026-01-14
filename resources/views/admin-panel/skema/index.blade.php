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
                    <h4 class=".card-title">List Skema LSP</h4>
                </div>
                <div class="card-body">

                    <table id="scroll-horizontal-datatable" class="table-striped table-bordered w-100 nowrap table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Skema</th>
                                <th>Kode Skema</th>
                                <th>Kategori</th>
                                <th>Jumlah Unit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataSkema as $skema)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $skema->skema_judul }}</td>
                                    <td>{{ $skema->skema_kode }}</td>
                                    <td>
                                        <span class="badge bg-primary-subtle text-primary">{{ $skema->skema_kategori }}</span>
                                    </td>
                                    <td>{{ $skema->unitCount }} Kode Unit</td>
                                    <td>

                                        <a href="{{ route('skema.show', $skema->ref) }}" class="text-reset fs-16 px-1">
                                            <i class="ri-eye-line"></i>
                                        </a>

                                        <a href="javascript: void(0);" class="text-reset fs-16 px-1">
                                            <i class="ri-pencil-line"></i>
                                        </a>

                                        <input type="hidden" class="skemaID" value="{{ $skema->ref }}">
                                        <a href="javascript:void(0)" class="text-reset fs-16 deleteButton px-1" data-nama="{{ $skema->skema_judul }}">
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
                            fetch('/skema/' + skemaID, {
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
