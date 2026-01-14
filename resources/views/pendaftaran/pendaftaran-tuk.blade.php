@extends('pendaftaran.layouts.app')

@section('content')
    <!-- Simple form -->
    <div class="container mt-2 mb-2">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-6">
                        <div class="card rounded-3">
                            <div class="card-header rounded-2">
                                <h4 class=".card-title">**</h4>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="example-select" class="form-label">Lembaga Sertifikasi Kompetensi (LSP)</label><span class="text-danger">*</span>
                                            <select class="form-select rounded-3" id="example-select" name="kebangsaan"  required>
                                                <option value="">Pilih Lembaga Sertifikasi Kompetensi (LSP)</option>
                                                <option value="xx">xx</option>
                                                <option value="yy">yy</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Nama TUK</label><span class="text-danger">*</span>
                                            <input type="text" id="simpleinput" class="form-control rounded-3" name="nama_lengkap" required placeholder="Masukkan Nama Lengkap" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Alamat TUK</label><span class="text-danger">*</span>
                                            <input type="text" id="simpleinput" class="form-control rounded-3" name="alamat" required placeholder="Masukkan alamat rumah" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="inputEmail3" class="form-label">Email TUK</label><span class="text-danger">*</span>
                                            <input type="email" class="form-control rounded-3" id="inputEmail3" name="email" required placeholder="Masukkan alamat email" required>
                                        </div>
                                    </div>

                                     <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">No. Telp. TUK</label><span class="text-danger">*</span>
                                            <input type="number" id="example-number" class="form-control rounded-3" name="telp_hp" placeholder="08xxxxxx" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Nama Kontak Person</label><span class="text-danger">*</span>
                                            <input type="text" id="simpleinput" class="form-control rounded-3" name="nama_lengkap" required placeholder="Masukkan Nama Lengkap" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="inputEmail3" class="form-label">Email Kontak Person</label><span class="text-danger">*</span>
                                            <input type="email" class="form-control rounded-3" id="inputEmail3" name="email" required placeholder="Masukkan alamat email" required>
                                        </div>
                                    </div>

                                     <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">No. Telp. Kontak Person</label><span class="text-danger">*</span>
                                            <input type="number" id="example-number" class="form-control rounded-3" name="telp_hp" placeholder="08xxxxxx" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Surat Permohonan TUK</label><span class="text-danger">*</span>
                                            <input type="file" id="example-fileinput" class="form-control rounded-3" name="sertikom_file" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-2 mt-3">
                                            <button type="submit" class="btn btn-outline-primary rounded-3"><i class="ri-save-3-line"></i> DAFTAR TUK</button>
                                        </div>
                                    </div>


                                </div> <!-- end row-->
                            </div> <!-- end card-body -->

                        </div> <!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->

            </div> <!-- container -->

        </div>
    </div>

@endsection