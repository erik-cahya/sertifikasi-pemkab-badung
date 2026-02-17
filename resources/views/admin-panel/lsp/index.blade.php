@extends('admin-panel.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dinas text-white">
                    <h4 class=".card-title">Data LSP</h4>
                </div>
                <div class="card-body">

                    <table id="datatable-dashboard" class="table-striped table-bordered table-sm fs-12 w-100 nowrap table">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama LSP</th>
                                <th>No Lisensi</th>
                                <th>Email LSP</th>
                                <th>Status LSP</th>
                                <th>Username</th>
                                <th width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataLSP as $lsp)
                                <tr class="align-middle">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <span>
                                            {{ $lsp->lsp_nama }}
                                            <hr class="m-1">
                                            <span class="fw-bold fst-italic d-flex justify-content-start">
                                                <small class="fs-11">TUK : {{ $lsp->tuk_count }}</small>
                                                <small class="fs-11 mx-2">|</small>
                                                <small class="fs-11">Skema : {{ $lsp->skemas_count }}</small>
                                            </span>
                                        </span>
                                    </td>
                                    <td class="text-center">{{ $lsp->lsp_no_lisensi }}</td>
                                    <td>
                                        {{ $lsp->lsp_email }}
                                        <hr class="m-1">
                                        <span class="fw-bold fst-italic d-flex">
                                            <small class="fs-11">Telp : {{ $lsp->lsp_telp }}</small>
                                        </span>

                                    </td>
                                    <td class="text-center"><span class="badge {{ $lsp->is_active == 1 ? 'bg-success' : 'bg-danger' }}">{{ $lsp->is_active == 1 ? 'Active' : 'Not Active' }}</span></td>
                                    <td class="text-center">
                                        <span class="badge bg-dark rounded-pill px-2">
                                            {{ $lsp->username }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">

                                            <a href="{{ route('lsp.show', $lsp->ref) }}" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="See Details" data-bs-custom-class="success-tooltip"><i class="mdi mdi-eye"></i> </a>

                                            {{-- <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Data" data-bs-custom-class="warning-tooltip"><i class="mdi mdi-lead-pencil"></i> </a> --}}

                                            <input type="hidden" class="dataID" value="{{ $lsp->ref }}">
                                            <button type="button" class="btn btn-sm btn-danger deleteButton" data-nama="{{ $lsp->lsp_nama }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Data" data-bs-custom-class="danger-tooltip">
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

            document.querySelectorAll('.deleteButton').forEach(button => {

                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const row = this.closest('tr');
                    const dataNama = this.dataset.nama;
                    const dataID = this.closest('td').querySelector('.dataID').value;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: `Delete data ${dataNama}?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                    }).then(result => {
                        if (!result.isConfirmed) return;
                        fetch(`/lsp/${dataID}`, {
                                method: 'DELETE',
                                credentials: 'same-origin',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'X-Requested-With': 'XMLHttpRequest',
                                }
                            })
                            .then(() => {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: 'Data LSP berhasil dihapus',
                                    icon: 'success',
                                    timer: 1200,
                                    showConfirmButton: false
                                });
                                row.style.transition = 'opacity 0.3s';
                                row.style.opacity = 0;
                                setTimeout(() => row.remove(), 300);
                            })
                            .catch(err => {
                                console.error(err);
                                Swal.fire('Error', 'Request gagal dikirim ke server', 'error');
                            });
                    });
                });

            });

        });
    </script>
@endpush
