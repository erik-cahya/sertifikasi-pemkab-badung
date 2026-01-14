@extends('pendaftaran.layouts.app')

@section('content')
    <!-- Simple form -->
    <div class="container mt-2">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class=".card-title">**</h4>
                                <p class="text-muted mb-0">
                                    Formulir ini digunakan untuk pendaftaran Calon Asesi dalam rangka mengikuti Sertifikasi Profesi Tahun {{ date('Y') }}  
                                    <br>
                                    Silakan mengisi formulir pendaftaran Calon Asesi Sertifikasi Profesi Tahun {{ date('Y') }} berikut dengan data yang benar dan dapat dipertanggungjawabkan. 
                                </p>
                            </div>

                            <div class="card-header">
                                <h4 class=".card-title">A. DATA PRIBADI</h4>
                                <p class="text-muted mb-0">
                                    Isilah form dibawah ini dengan data pribadi yang sebenarnya
                                </p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Nama Lengkap</label>
                                            <input type="text" id="simpleinput" class="form-control" name="nama_lengkap" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="example-number" class="form-label">No. KTP / NIK / Paspor</label>
                                            <input type="number" id="example-number" class="form-control" name="nik" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Tempat Lahir (Sesuai KTP)</label>
                                            <input type="text" id="simpleinput" class="form-control" name="tempat_lahir" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Tanggal Lahir</label>
                                            <input type="date" id="simpleinput" class="form-control" name="tanggal_lahir" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="example-select" class="form-label">Jenis Kelamin</label>
                                            <select class="form-select" id="example-select" name="jenis_kelamin"  required>
                                                <option value=""></option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>

                                     <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="example-select" class="form-label">Kebangsaan</label>
                                            <select class="form-select" id="example-select" name="kebangsaan"  required>
                                                <option value=""></option>
                                                <option value="WNI">WNI</option>
                                                <option value="WNA">WNA</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-10">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Alamat Rumah</label>
                                            <input type="text" id="simpleinput" class="form-control" name="alamat" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Kode Pos</label>
                                            <input type="number" id="example-number" class="form-control" name="kode_pos" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label for="inputEmail3" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="inputEmail3" name="email" required>
                                        </div>
                                    </div>

                                     <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">No. Telp. (Hp)</label>
                                            <input type="number" id="example-number" class="form-control" name="telp_hp">
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">No. Telp. (Rumah)</label>
                                            <input type="number" id="example-number" class="form-control" name="telp_rumah">
                                        </div>
                                    </div>

                                     <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">No. Telp. (Kantor)</label>
                                            <input type="number" id="example-number" class="form-control" name="telp_kantor">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="example-select" class="form-label">Pendidikan Terakhir</label>
                                            <select class="form-select" id="example-select" name="pendidikan_terakhir"  required>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA/SMK/Sederajat">SMA/SMK/Sederajat</option>
                                                <option value="D1">D1</option>
                                                <option value="D2">D2</option>
                                                <option value="D3">D3</option>
                                                <option value="D4">D4</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Ijazah Terakhir</label>
                                            <input type="file" id="example-fileinput" class="form-control" name="ijazah_file" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Sertifikat Kompetensi (opsional)</label>
                                            <input type="file" id="example-fileinput" class="form-control" name="sertikom_file">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Surat Keterangan Bekerja</label>
                                            <input type="file" id="example-fileinput" class="form-control" name="keterangan_kerja_file">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Pas Foto (.png / .jpg)</label>
                                            <input type="file" id="example-fileinput" class="form-control" name="pas_foto_file">
                                        </div>
                                    </div>


                                </div>
                                <!-- end row-->
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->

            </div> <!-- container -->

        </div>
    </div>

@endsection