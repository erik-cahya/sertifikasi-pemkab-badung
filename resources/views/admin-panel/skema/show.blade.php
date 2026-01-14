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
                        <table id="scroll-horizontal-datatable" class="table-striped table-sm table-bordered w-100 nowrap table" style="font-size: 12px">
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
                                            <a href="javascript: void(0);" class="text-reset px-1">
                                                <i class="ri-pencil-line"></i> Edit
                                            </a>
                                            |
                                            <input type="hidden" class="skemaID" value="{{ $unit->ref }}">
                                            <a href="javascript:void(0)" class="text-reset deleteButton px-1" data-nama="{{ $unit->judul_unit }}">
                                                <span class="text-danger"> <i class="mdi mdi-trash-can"></i> Delete</span>
                                            </a>
                                        </td>
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
                                        icon: data.swalFlashIcon,
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
