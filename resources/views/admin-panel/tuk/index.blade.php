@extends('admin-panel.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class=".card-title">Daftar TUK</h4>
                </div>
                <div class="card-body">

                    <table id="fixed-columns-datatable" class="table table-striped nowrap row-border order-column w-100">
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
                                         <a href="{{ route('tukAdmin.edit', $item->ref) }}" class="text-reset fs-16 px-1">
                                            <button type="button" class="btn btn-sm btn-outline-primary"><i class="ri-pencil-line"></i> Edit</button>
                                        </a>

                                        <input type="hidden" class="tukID" value="{{ $item->ref }}">
                                        <a href="javascript:void(0)" class="text-reset fs-16 deleteButton px-1" data-nama="{{ $item->tuk_nama }}">
                                            <button type="button" class="btn btn-sm btn-outline-danger"><i class=" ri-delete-bin-5-line"></i> Hapus</button>
                                        </a>
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
