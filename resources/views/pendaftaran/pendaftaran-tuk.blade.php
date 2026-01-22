@extends('pendaftaran.layouts.app')

@section('content')
    <!-- Simple form -->
    <div class="container mt-2 mb-2">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-6">
                        <div class="card shadow-lg border-0 rounded-4">
                            <div class="my-auto p-4 text-center text-danger">
                                <h3 class="card-title fw-bold">FORMULIR PENDAFTARAN TEMPAT UJI KOMPETENSI (TUK)</h3>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>DATA GAGAL DISIMPAN!</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('tuk.added') }}" method="POST">
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

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Nama TUK</label><span class="text-danger">*</span>
                                                <input type="text" id="simpleinput" class="form-control rounded-3" name="tuk_nama" required placeholder="Masukkan nama TUK" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Alamat TUK</label><span class="text-danger">*</span>
                                                <input type="text" id="simpleinput" class="form-control rounded-3" name="tuk_alamat" required placeholder="Masukkan alamat TUK" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="inputEmail3" class="form-label">Email TUK</label><span class="text-danger">*</span>
                                                <input type="email" class="form-control rounded-3" id="inputEmail3" name="tuk_email" required placeholder="Masukkan alamat email TUK" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">No. Telp. TUK</label><span class="text-danger">*</span>
                                                <input type="number" id="example-number" class="form-control rounded-3" name="tuk_telp" placeholder="08xxxxxx" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Nama Kontak Person</label><span class="text-danger">*</span>
                                                <input type="text" id="simpleinput" class="form-control rounded-3" name="tuk_cp_nama" required placeholder="Masukkan Nama Kontak Person TUK" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="inputEmail3" class="form-label">Email Kontak Person</label><span class="text-danger">*</span>
                                                <input type="email" class="form-control rounded-3" id="inputEmail3" name="tuk_cp_email" required placeholder="Masukkan alamat email Kontak Person TUK" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">No. Telp. Kontak Person</label><span class="text-danger">*</span>
                                                <input type="number" id="example-number" class="form-control rounded-3" name="tuk_cp_telp" placeholder="08xxxxxx" required>
                                            </div>
                                        </div>

                                        {{-- <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Surat Permohonan TUK</label>
                                                <input type="file" id="example-fileinput" class="form-control rounded-3" name="tuk_file">
                                            </div>
                                        </div> --}}

                                        <div class="col-lg-12">
                                            <div class="mb-2 mt-3">
                                                <button type="submit" class="btn btn-outline-primary rounded-3"><i class="ri-save-3-line"></i> DAFTAR TUK</button>
                                            </div>
                                        </div>

                                    </div> <!-- end row-->
                                </div> <!-- end card-body -->
                            </form>
                        </div> <!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->

            </div> <!-- container -->

        </div>
    </div>

@endsection