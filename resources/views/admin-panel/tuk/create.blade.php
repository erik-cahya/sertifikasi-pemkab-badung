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
                    <h4 class=".card-title">Tambah Data TUK</h4>
                </div>
                <form action="{{ route('tukAdmin.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                             <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Lembaga Sertifikasi Kompetensi (LSP)</label><span class="text-danger">*</span>
                                    <select class="form-select rounded-3" id="example-select" name="lsp_ref"  required>
                                        <option value="">Pilih Lembaga Sertifikasi Kompetensi (LSP)</option>
                                        @foreach ($dataLsp as $lsp)
                                            <option value="{{ $lsp->ref }}">{{ $lsp->lsp_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Nama TUK</label><span class="text-danger">*</span>
                                    <input type="text" id="simpleinput" class="form-control rounded-3" name="tuk_nama" required >
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="inputEmail3" class="form-label">Email TUK</label><span class="text-danger">*</span>
                                    <input type="email" id="inputEmail3" class="form-control rounded-3" name="tuk_email" required >
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="example-number" class="form-label">Nomor Telp TUK</label><span class="text-danger">*</span>
                                    <input type="number" id="example-number" class="form-control rounded-3" name="tuk_telp" required >
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Alamat TUK</label><span class="text-danger">*</span>
                                    <input type="text" id="simpleinput" class="form-control rounded-3" name="tuk_alamat" required >
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Nama Kontak Person TUK</label><span class="text-danger">*</span>
                                    <input type="text" id="simpleinput" class="form-control rounded-3" name="tuk_cp_nama" required >
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="inputEmail3" class="form-label">Email Kontak Person TUK</label><span class="text-danger">*</span>
                                    <input type="email" id="inputEmail3" class="form-control rounded-3" name="tuk_cp_email" required>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="example-number" class="form-label">Nomor Telp Kontak Person TUK</label><span class="text-danger">*</span>
                                    <input type="number" id="example-number" class="form-control rounded-3" name="tuk_cp_telp" required>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mt-1 mb-1">
                                    <button type="submit" class="btn btn-outline-primary rounded-3"><i class="ri-save-3-line"></i> Tambah Data TUK</button>
                                </div>
                            </div>
                        </div><!-- end row-->
                    </div> <!-- end card-body -->
                </form>
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

@endsection
@push('script')
    <!-- Datatables js -->
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>

    <!-- Datatable Demo App js -->
    <script src="{{ asset('admin') }}/assets/js/pages/datatable.init.js"></script>

    
@endpush
