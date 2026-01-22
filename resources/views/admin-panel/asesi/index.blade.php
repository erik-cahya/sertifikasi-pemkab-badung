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
                    <h4 class=".card-title">Daftar Calon Asesi</h4>
                </div>
                <div class="card-body">

                    <table id="fixed-columns-datatable" class="table table-striped nowrap row-border order-column w-100">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Tempat Lahir </th>
                                <th>Tanggal Lahir </th>
                                <th>Jenis Kelamin </th>
                                <th>Kewarganegaraan</th>
                                <th>Alamat</th>
                                <th>Telp</th>
                                <th>Email</th>
                                <th>Pendidikan Terakhir</th>
                                <th>Nama Perusahaan</th>
                                <th>Alamat</th>
                                <th>Departemen</th>
                                <th>Jabatan</th>
                                <th>Telp Perusahaan</th>
                                <th>Email Perusahaan</th>
                                <th>Files</th>
                                <th>K / BK</th>
                                <th>Mendaftar pada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataAsesi as $item )
                                <tr>
                                    <td>{{ $item->nama_lengkap }}</td>
                                    <td>{{ $item->nik }}</td>
                                    <td>{{ $item->tempat_lahir }}</td>
                                    <td>{{ $item->tgl_lahir }}</td>
                                    <td>{{ $item->jenis_kelamin }}</td>
                                    <td>{{ $item->kewarganegaraan }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>Telp : {{ $item->telp_hp }} <br> Rumah : {{ $item->telp_rumah }} <br> Kantor : {{ $item->telp_kantor }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->pendidikan_terakhir }}</td>
                                    <td>{{ $item->nama_perusahaan }}</td>
                                    <td>{{ $item->alamat_perusahaan }}</td>
                                    <td>{{ $item->departemen }}</td>
                                    <td>{{ $item->jabatan }}</td>
                                    <td>Telp : {{ $item->telp_perusahaan }} <br> Fax : {{ $item->fax_perusahaan }}</td>
                                    <td>{{ $item->email_perusahaan }}</td>
                                    <td>FILES</td>
                                    <td>K</td>
                                    <td>{{ $item->created_at->format('Y-m-d') }}</td>
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
