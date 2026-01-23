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
                    <h4 class=".card-title">Daftar Pegawai</h4>
                </div>
                <div class="card-body">

                    <table id="fixed-columns-datatable" class="table table-striped nowrap row-border order-column w-100">
                        <thead>
                            <tr>
                                <th>Nama Hotel</th>
                                <th>Housekeeping</th>
                                <th>F&B Service</th>
                                <th>F&B Product</th>
                                <th>Kantor Depan</th>
                                <th>Engineering</th>
                                <th>Lainnya</th>
                                <th>Total</th>
                                <th>Ditambahkan pada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataPegawai as $item )
                                <tr>
                                    <td>{{ $item->pegawai_nama_hotel }}</td>
                                    <td class="text-center">{{ $item->pegawai_hk }}</td>
                                    <td class="text-center">{{ $item->pegawai_fbs }}</td>
                                    <td class="text-center">{{ $item->pegawai_fbp }}</td>
                                    <td class="text-center">{{ $item->pegawai_fo }}</td>
                                    <td class="text-center">{{ $item->pegawai_eng }}</td>
                                    <td class="text-center">{{ $item->pegawai_oth }}</td>
                                    <td class="text-center">{{ $item->pegawai_total }}</td>
                                    <td class="text-center">{{ $item->created_at->format('Y-m-d') }}</td>
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
                    let tukID = this.parentElement.querySelector('.tukID').value;

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
                            fetch('/tukAdmin/' + tukID, {
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
