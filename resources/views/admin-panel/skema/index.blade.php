@extends('admin-panel.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dinas text-white">
                    <h4 class=".card-title">List Skema LSP</h4>
                </div>
                <div class="card-body">

                    <table id="datatable-dashboard" class="table-striped table-bordered w-100 nowrap table">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                @role('master', 'dinas')
                                    <th>Nama LSP</th>
                                @endrole
                                <th>Judul Skema</th>
                                <th>Kode Skema</th>
                                <th>Kategori</th>
                                <th>Jumlah Unit</th>
                                <th width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataSkema as $skema)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    @role('master', 'dinas')
                                        <td>{{ $skema->lsp_nama }}</td>
                                    @endrole
                                    <td>{{ $skema->skema_judul }}</td>
                                    <td>{{ $skema->skema_kode }}</td>
                                    <td class="text-center">
                                        {{ $skema->skema_kategori }}
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#editModal-{{ $skema->ref }}">
                                            {{ $skema->unitCount }} Kode Unit
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                            <a href="{{ route('skema.show', $skema->ref) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Skema" data-bs-custom-class="info-tooltip"><i class="mdi mdi-pencil"></i></a>
                                            <input type="hidden" class="skemaID" value="{{ $skema->ref }}">
                                            <a href="javascript:void(0)" data-nama="{{ $skema->skema_judul }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hapus Skema" data-bs-custom-class="danger-tooltip"><i class="mdi mdi-trash-can"></i></a>
                                            {{-- <a href="javascript: void(0);" class="text-reset fs-16 px-1">
                                                <i class="ri-pencil-line"></i>
                                            </a> --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @foreach ($dataSkema as $skema)
                        <div id="editModal-{{ $skema->ref }}" class="modal modal-lg fade" tabindex="-1" role="dialog"
                            aria-labelledby="primary-header-modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">

                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-dinas">
                                        <h4 class="modal-title" id="primary-header-modalLabel">List Kode Unit</h4>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-2">
                                            <h5 class="">{{ $skema->lsp_nama }}
                                            </h5>
                                            <span class="badge bg-dinas-subtle text-primary">{{ $skema->skema_judul }}</span>
                                        </div>
                                        <table class="table-striped table-sm table-bordered w-100 nowrap table" style="font-size: 12px">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Judul Unit</th>
                                                    <th>Kode Unit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($skema->details as $unit)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $unit->judul_unit }}</td>
                                                        <td>{{ $unit->kode_unit }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div><!-- / END Edit Data modal -->
                    @endforeach

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
