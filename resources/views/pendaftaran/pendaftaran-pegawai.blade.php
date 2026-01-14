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
                            <div class="my-auto p-4 mt-3 text-center text-danger">
                                <h4 class="fs-20">FORM PENDATAAN PEGAWAI</h4>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Nama Lengkap</label><span class="text-danger">*</span>
                                            <input type="text" id="simpleinput" class="form-control rounded-3" name="pegawai_nama_lengkap" required placeholder="Masukkan Nama Lengkap">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="example-number" class="form-label">No. KTP / NIK / Paspor</label><span class="text-danger">*</span>
                                            <input type="number" id="example-number" class="form-control rounded-3" name="pegawai_nik" required placeholder="Masukkan No. KTP/NIK/Paspor">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">No. Telp. (Hp)</label><span class="text-danger">*</span>
                                            <input type="number" id="example-number" class="form-control rounded-3" name="pegawai_telp_hp" placeholder="08xxxxxx" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Nama Tempat Bekerja / Perusahaan</label><span class="text-danger">*</span>
                                            <input type="text" id="simpleinput" class="form-control rounded-3" name="pegawai_nama_perusahaan" required placeholder="Masukkan Nama Tempat Bekerja / Perusahaan">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-2 mt-3">
                                            <button type="submit" class="btn btn-outline-primary rounded-3"><i class="ri-save-3-line"></i> SUBMIT</button>
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