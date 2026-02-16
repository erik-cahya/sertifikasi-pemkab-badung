@extends('admin-panel.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dinas text-white">
                    <h4 class=".card-title">Daftar TUK</h4>
                </div>
                <div class="card-body">

                    <table id="datatable-dashboard" class="table table-striped nowrap row-border order-column w-100">
                        <thead>
                            <tr>
                                <th>LSP</th>
                                <th>Nama TUK</th>
                                <th>Alamat TUK</th>
                                <th>Email TUK</th>
                                <th>Telp TUK</th>
                                <th>Nama CP</th>
                                <th>Email CP</th>
                                <th>Telp CP</th>
                                <th>Verifikasi</th>
                                <th>Dibuat Pada</th>
                                <th width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataTUK as $item )
                                <tr>
                                    <td>{{ $item->lsp_nama }}</td>
                                    <td>{{ $item->tuk_nama }}</td>
                                    <td>{{ $item->tuk_alamat }}</td>
                                    <td>{{ $item->tuk_email }}</td>
                                    <td>{{ $item->tuk_telp }}</td>
                                    <td>{{ $item->tuk_cp_nama }}</td>
                                    <td>{{ $item->tuk_cp_email }}</td>
                                    <td>{{ $item->tuk_cp_telp }}</td>
                                    {{-- <td>@if($item->tuk_verif==0)  <a href="{{ route('tukAdmin.verifikasi',  [$item->ref, 1]) }}"><i class=" ri-close-fill fs-3 text-danger fw-bold text-center d-block"></a>@else <a href="{{ route('tukAdmin.verifikasi',  [$item->ref, 0]) }}"><i class="ri-check-fill  fs-3 text-success fw-bold text-center d-block" ></i></a> @endif</td> --}}
                                    <td class="text-center">
                                        @if($item->tuk_verif == 0)
                                            <a href="javascript:void(0)"
                                            class="verifButton"
                                            data-url="{{ route('tukAdmin.verifikasi', [$item->ref, 1]) }}"
                                            data-nama="{{ $item->tuk_nama }}"
                                            data-action="verifikasi">
                                                <i class="ri-close-fill fs-3 text-danger fw-bold d-block"></i>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)"
                                            class="verifButton"
                                            data-url="{{ route('tukAdmin.verifikasi', [$item->ref, 0]) }}"
                                            data-nama="{{ $item->tuk_nama }}"
                                            data-action="batalkan verifikasi">
                                                <i class="ri-check-fill fs-3 text-success fw-bold d-block"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                            <a href="{{ route('tukAdmin.edit', $item->ref) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit TUK" data-bs-custom-class="info-tooltip"><i class="mdi mdi-pencil"></i></a>
                                            <input type="hidden" class="tukID" value="{{ $item->ref }}">
                                            <a href="javascript:void(0)" data-nama="{{ $item->tuk_nama }}" class="btn btn-sm btn-danger deleteButton" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hapus TUK" data-bs-custom-class="danger-tooltip"><i class="mdi mdi-trash-can"></i></a>
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

        // Verifikasi TUK
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.verifButton').forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();

                    const url   = this.dataset.url;
                    const nama  = this.dataset.nama;
                    const aksi  = this.dataset.action;

                    Swal.fire({
                        title: 'Konfirmasi',
                        text: `Yakin ingin ${aksi} TUK "${nama}"?`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    });
                });
            });
        });
    </script>
@endpush
