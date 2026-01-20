@extends('pendaftaran.layouts.app')

@section('content')
    <!-- Simple form -->
    <div class="container mt-2 mb-2">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-6">
                        <div class="card shadow-lg border-0 rounded-4">
                            <div class="my-auto p-4 text-center text-danger">
                                <h3 class="card-title fw-bold">FORMULIR PENDATAAN PEGAWAI</h3>
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
                            <form action="{{ route('pegawai.store') }}" method="POST">
                            @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Nama Lengkap</label><span class="text-danger">*</span>
                                                <input type="text" id="simpleinput" class="form-control rounded-3" name="pegawai_nama" required placeholder="Masukkan Nama Lengkap">
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
                                                <input type="number" id="example-number" class="form-control rounded-3" name="pegawai_telp" placeholder="08xxxxxx" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Nama Tempat Bekerja / Perusahaan</label><span class="text-danger">*</span>
                                                <input type="text" id="simpleinput" class="form-control rounded-3" name="pegawai_tempat_bekerja" required placeholder="Masukkan Nama Tempat Bekerja / Perusahaan">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-2 mt-3">
                                                <button type="submit" class="btn btn-outline-primary rounded-3"><i class="ri-save-3-line"></i> SIMPAN</button>
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