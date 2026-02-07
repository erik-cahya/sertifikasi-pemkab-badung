@extends('admin-panel.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dinas text-white">
                    <h4 class=".card-title">Daftar Kegiatan</h4>
                </div>
                <div class="card-body">
                    <table id="datatable-dashboard" class="table-striped w-100 nowrap table">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Kegiatan</th>
                                @role('master')
                                    <th>LSP Terlibat</th>
                                    <th>Kuota Peserta</th>
                                @endrole
                                <th>Mulai Kegiatan</th>
                                <th>Kegiatan Selesai</th>
                                <th>Status Kegiatan</th>
                                <th width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataKegiatan as $kegiatan)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="badge {{ $kegiatan->status == 1 ? 'bg-success' : 'bg-danger' }} rounded-circle p-1"><small></small></span>
                                        {{ $kegiatan->nama_kegiatan }}
                                    </td>

                                    @role('master')
                                        <td>
                                            @php
                                                $lsps = $kegiatan->kegiatanJadwal
                                                    ->map(fn($item) => $item->lsp) // ambil model LSP
                                                    ->filter() // buang null
                                                    ->unique('ref'); // unik per LSP

                                                // dd($kegiatan);

                                            @endphp

                                            <div class="d-flex flex-column gap-1">
                                                @if ($lsps->isEmpty())
                                                    <span class="badge bg-danger-subtle text-danger">
                                                        Tidak ada LSP yang terlibat
                                                    </span>
                                                @else
                                                    @foreach ($lsps as $lsp)
                                                        <span class="badge bg-primary-subtle text-primary">
                                                            {{ $lsp->lsp_nama }}
                                                        </span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $kegiatan->total_kuota ?? '0' }} Peserta</td>
                                    @endrole('master')
                                    <td>{{ \Carbon\Carbon::parse($kegiatan->mulai_kegiatan)->locale('id')->translatedFormat('l, d F Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($kegiatan->selesai_kegiatan)->locale('id')->translatedFormat('l, d F Y') }}</td>
                                    <td class="text-center"><span class="badge {{ $kegiatan->status == 1 ? 'bg-success' : 'bg-danger' }}">{{ $kegiatan->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</span></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                            @role('lsp')
                                                <a href="{{ route('asesmen.create', $kegiatan->ref) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Buat Jadwal Asesmen" data-bs-custom-class="info-tooltip"><i class="mdi mdi-calendar-edit"></i> </a>
                                            @endrole
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
