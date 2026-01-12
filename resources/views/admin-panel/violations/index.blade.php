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
                        <h4 class=".card-title">List Pelanggaran GSE</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table id="scroll-horizontal-datatable" class="table-striped w-100 nowrap table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode GSE</th>
                                            <th>Nama Pelanggaran</th>
                                            <th>Jenis Pelanggaran</th>
                                            <th>Level Pelanggaran</th>
                                            <th>Tanggal Pengecekan</th>
                                            <th>Pelapor</th>
                                            <th>Lokasi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataViolation as $pelanggaran)
                                            @php
                                                if ($pelanggaran->violation_level === 'berat') {
                                                    $textClass = 'text-danger';
                                                    $bgClass = 'bg-danger-subtle';
                                                } elseif ($pelanggaran->violation_level === 'sedang') {
                                                    $textClass = 'text-primary';
                                                    $bgClass = 'bg-primary-subtle';
                                                } else {
                                                    $textClass = 'text-success';
                                                    $bgClass = 'bg-success-subtle';
                                                }
                                            @endphp
                                            <tr class="text-capitalize">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <span class="badge bg-primary">{{ $pelanggaran->gse_serial }}</span>
                                                </td>
                                                <td>{{ $pelanggaran->violation_name }}</td>
                                                <td>{{ $pelanggaran->violation_type }}</td>
                                                <td>
                                                    <span class="badge {{ $bgClass . ' ' . $textClass }}">{{ $pelanggaran->violation_level }}</span>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($pelanggaran->examination_date)->format('d M Y') }}</td>
                                                <td>{{ $pelanggaran->employee }}</td>
                                                <td>{{ $pelanggaran->location }}</td>
                                                <td class="text-center">
                                                    <input type="hidden" class="gseID" value="{{ $pelanggaran->inspectionID }}">
                                                    <a href="javascript:void(0)" class="text-reset fs-16 deleteButton px-1" data-nama="{{ $pelanggaran->gse_serial }}"> <i class="ri-delete-bin-2-line"></i></a>
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

                    let dataName = this.getAttribute('data-nama');
                    let gseID = this.parentElement.querySelector('.gseID').value;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete data pelanggaran " + dataName + "?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Kirim DELETE request manual lewat JavaScript
                            fetch('/violation/' + gseID, {
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
                                    Swal.fire('Error', 'Something went wrong!', 'error');
                                });
                        }
                    });
                });
            });
        });
    </script>
@endpush
