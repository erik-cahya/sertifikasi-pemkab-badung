@extends('admin-panel.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dinas text-white">
                    <h4 class=".card-title">List Skema LSP</h4>
                </div>
                <div class="card-body">

                    <table id="datatable-dashboard" class="table-striped table-sm fs-12 table-bordered w-100 nowrap table">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                @role('master', 'dinas')
                                    <th>Nama LSP</th>
                                @endrole
                                <th>Judul Skema</th>
                                <th>Kode Skema</th>
                                <th>Kategori</th>
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
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                            <a href="{{ route('skema.show', $skema->ref) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Skema" data-bs-custom-class="info-tooltip"><i class="mdi mdi-pencil"></i></a>
                                            <input type="hidden" class="skemaID" value="{{ $skema->ref }}">
                                            <a href="javascript:void(0)" data-nama="{{ $skema->skema_judul }}" class="btn btn-sm btn-danger deleteButton" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hapus Skema" data-bs-custom-class="danger-tooltip"><i class="mdi mdi-trash-can"></i></a>
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
