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
                                <th>Mulai Kegiatan</th>
                                <th>Kegiatan Selesai</th>
                                <th>Status Kegiatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataKegiatan as $kegiatan)
                                <tr>
                                    <td>
                                        <span class="bg-primary rounded-4 px-2 text-white">{{ $loop->iteration }}</span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $kegiatan->status == 1 ? 'bg-success' : 'bg-danger' }} rounded-circle p-1"><small></small></span>
                                        {{ $kegiatan->nama_kegiatan }}
                                    </td>
                                    <td>
                                        @php
                                            // Ambil LSP unik (karena bisa muncul berulang di detail)
                                            $lsps = $kegiatan->details->pluck('lsp')->unique('ref');
                                            $dataKuota = $kegiatan->details->first();

                                            // dd($kegiatan->details->groupBy('lsp_ref'));

                                        @endphp
                                        @php
                                            $validLsps = $lsps->filter(fn($lsp) => filled($lsp->lsp_nama));
                                        @endphp

                                        <div class="d-flex flex-column gap-1">
                                            @if ($validLsps->isEmpty())
                                                <span class="badge bg-danger-subtle text-danger">
                                                    Tidak ada LSP yang terlibat
                                                </span>
                                            @else
                                                @foreach ($validLsps as $lsp)
                                                    <span class="badge bg-primary-subtle text-primary">
                                                        {{ $lsp->lsp_nama }}
                                                    </span>
                                                @endforeach
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $dataKuota->kuota_lsp ?? '0' }} Peserta</td>
                                    <td>{{ \Carbon\Carbon::parse($kegiatan->mulai_kegiatan)->locale('id')->translatedFormat('l, d F Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($kegiatan->selesai_kegiatan)->locale('id')->translatedFormat('l, d F Y') }}</td>
                                    <td><span class="badge {{ $kegiatan->status == 1 ? 'bg-success' : 'bg-danger' }}">{{ $kegiatan->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</span></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                            <a href="{{ route('kegiatan.show', $kegiatan->ref) }}" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="See Details" data-bs-custom-class="success-tooltip"><i class="mdi mdi-eye"></i> </a>

                                            <input type="hidden" class="valueID" value="{{ $kegiatan->ref }}">
                                            <button type="button" class="btn btn-sm btn-danger deleteButton" data-nama="{{ $kegiatan->nama_kegiatan }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Data" data-bs-custom-class="danger-tooltip">
                                                <i class="mdi mdi-trash-can"></i>
                                            </button>

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
                    let valueID = this.parentElement.querySelector('.valueID').value;

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
                            fetch('/kegiatan/' + valueID, {
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
