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
                    <h4 class=".card-title">All Data LSP</h4>
                </div>
                <div class="card-body">
                    <table id="scroll-horizontal-datatable" class="table-striped w-100 nowrap table">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Nama Kegiatan</th>
                                <th>LSP Terlibat</th>
                                <th>Kuota Peserta</th>
                                <th>Tanggal</th>
                                <th>No Telp LSP</th>
                                <th>Status LSP</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Sertifikasi LSP Engineering Hospitality</td>
                                <td>
                                    <span class="d-flex flex-column">
                                        <span class="badge bg-primary mt-1" style="font-size: 10px">LSP Engineering Hospitality Indonesia</span>
                                        <span class="badge bg-primary mt-1" style="font-size: 10px">LSP Engineering Hospitality Indonesia</span>
                                    </span>
                                </td>
                                <td>BNSP-LSP-1303-ID</td>
                                <td>2027-01-24</td>
                                <td>081337803127</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                        <a href="#" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="See Details" data-bs-custom-class="success-tooltip"><i class="mdi mdi-eye"></i> </a>
                                        <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Data" data-bs-custom-class="warning-tooltip"><i class="mdi mdi-lead-pencil"></i> </a>

                                        <input type="hidden" class="gseID" value="#">
                                        <button type="button" class="btn btn-sm btn-danger deleteButton" data-nama="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Data" data-bs-custom-class="danger-tooltip">
                                            <i class="mdi mdi-trash-can"></i>
                                        </button>

                                    </div>
                                </td>
                            </tr>

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
                    let gseID = this.parentElement.querySelector('.gseID').value;

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
                            fetch('/gse/' + gseID, {
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
