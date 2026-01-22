@extends('pendaftaran.layouts.app')

@section('content')
    <!-- Simple form -->
    <div class="container mt-2 mb-2">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-lg border-0 rounded-4">
                            <div class="card-header rounded-top-4">
                                <h4 class="card-title mb-3 fw-bold">FORMULIR PENDAFTARAN CALON ASESI</h4>
                                <smal>
                                    Formulir ini digunakan untuk pendaftaran Calon Asesi dalam rangka mengikuti Sertifikasi Profesi Tahun {{ date('Y') }}  
                                    <br>
                                    Silakan mengisi formulir pendaftaran berikut dengan data yang benar, lengkap dan dapat dipertanggungjawabkan. 
                                    <br><br>
                                    Harap menyiapkan dokumen berikut sebelum mengisi formulir pendaftaran:
                                    <br>
                                    1. Scan Sertifikat Kompetensi (opsional)
                                    <br>
                                    2. Scan Ijazah Terakhir
                                    <br>
                                    3. Scan Surat Keterangan Kerja
                                    <br>
                                    4. Pas Foto Background Merah
                               </smal>
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
                            <form action="{{ route('asesi.store') }}" method="POST" enctype="multipart/form-data">>
                            @csrf
                                <div class="card-header bg-danger text-white px-4 py-2 rounded-top">
                                    <h5 class="card-title mb-1 fw-bold">A. DATA PRIBADI</h5>
                                    <small class="opacity-75">
                                        Isilah formulir di bawah ini dengan data pribadi yang benar dan sesuai dengan dokumen resmi.
                                    </small>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Nama Lengkap</label><span class="text-danger">*</span>
                                                <input type="text" id="simpleinput" class="form-control rounded-3" name="nama_lengkap" required placeholder="Masukkan Nama Lengkap">
                                                {{-- <div class="input-group"> 
                                                        <span class="input-group-text">
                                                            <i class="ri-user-3-line"></i>
                                                        </span>
                                                        <input type="text" id="simpleinput" class="form-control rounded-3" name="nama_lengkap" required placeholder="Masukkan Nama Lengkap">
                                                    </div> --}}
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="example-number" class="form-label">No. KTP / NIK / Paspor</label><span class="text-danger">*</span>
                                                <input type="number" id="example-number" class="form-control rounded-3" name="nik" required placeholder="Masukkan No. KTP/NIK/Paspor">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Tempat Lahir (Sesuai KTP)</label><span class="text-danger">*</span>
                                                <input type="text" id="simpleinput" class="form-control rounded-3" name="tempat_lahir" required placeholder="Masukkan Tempat Lahir">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Tanggal Lahir</label><span class="text-danger">*</span>
                                                <input type="date" id="simpleinput" class="form-control rounded-3" name="tanggal_lahir" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-select" class="form-label">Jenis Kelamin</label><span class="text-danger">*</span>
                                                <select class="form-select rounded-3" id="example-select" name="jenis_kelamin" required>
                                                    <option value="">Pilih Jenis Kelamin</option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-select" class="form-label">Kewaganegaraan</label><span class="text-danger">*</span>
                                                <select class="form-select rounded-3" id="example-select" name="kewaganegaraan" required>
                                                    <option value="">Pilih Kewaganegaraan</option>
                                                    <option value="WNI">WNI</option>
                                                    <option value="WNA">WNA</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-10">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Alamat Rumah</label><span class="text-danger">*</span>
                                                <input type="text" id="simpleinput" class="form-control rounded-3" name="alamat" required placeholder="Masukkan alamat rumah" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Kode Pos</label><span class="text-danger">*</span>
                                                <input type="number" id="example-number" class="form-control rounded-3" name="kode_pos" required placeholder="Masukkan Kode Pos Alamat Rumah" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="inputEmail3" class="form-label">Email</label><span class="text-danger">*</span>
                                                <input type="email" class="form-control rounded-3" id="inputEmail3" name="email" required placeholder="Masukkan alamat email" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">No. Telp. (Hp)</label><span class="text-danger">*</span>
                                                <input type="number" id="example-number" class="form-control rounded-3" name="telp_hp" placeholder="08xxxxxx" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">No. Telp. (Rumah)</label>
                                                <input type="number" id="example-number" class="form-control rounded-3" name="telp_rumah" placeholder="08xxxxxx">
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">No. Telp. (Kantor)</label>
                                                <input type="number" id="example-number" class="form-control rounded-3" name="telp_kantor" placeholder="08xxxxxx">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-select" class="form-label">Pendidikan Terakhir</label><span class="text-danger">*</span>
                                                <select class="form-select rounded-3" id="example-select" name="pendidikan_terakhir"  required>
                                                    <option value="">Pilih Pendidikan Terakhir</option>
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
                                                <label for="simpleinput" class="form-label">Ijazah Terakhir</label><span class="text-danger">*</span>
                                                <input type="file" id="example-fileinput" class="form-control rounded-3" name="ijazah_file" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Sertifikat Kompetensi (opsional)</label>
                                                <input type="file" id="example-fileinput" class="form-control rounded-3" name="sertikom_file">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Surat Keterangan Bekerja</label><span class="text-danger">*</span>
                                                <input type="file" id="example-fileinput" class="form-control rounded-3" name="keterangan_kerja_file" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Pas Foto (.png / .jpg)</label><span class="text-danger">*</span>
                                                <input type="file" id="example-fileinput" class="form-control rounded-3" name="pas_foto_file" required>
                                            </div>
                                        </div>

                                    </div> <!-- end row-->
                                </div> <!-- end card-body -->

                                <div class="card-header bg-danger text-white px-4 py-2 rounded-top">
                                    <h5 class="card-title mb-1 fw-bold">B. DATA PEKERJAAN</h5>
                                    <small class="opacity-75">
                                        Isilah formulir di bawah ini dengan data pekerjaan yang sedang dijalani saat ini.
                                    </small>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Nama Tempat Bekerja / Perusahaan</label><span class="text-danger">*</span>
                                                <input type="text" id="simpleinput" class="form-control rounded-3" name="nama_perusahaan" required placeholder="Masukkan Nama Tempat Bekerja / Perusahaan">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-select" class="form-label">Departemen</label><span class="text-danger">*</span>
                                                <select class="form-select rounded-3" id="example-select" name="departemen"  required>
                                                    <option value="">Pilih Departemen Anda</option>
                                                    @foreach ($dataDepartemen as $departemen)
                                                        <option value="{{ $departemen->departemen_nama }}">{{ $departemen->departemen_nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-select" class="form-label">Jabatan</label><span class="text-danger">*</span>
                                                <select class="form-select rounded-3" id="example-select" name="jabatan"  required>
                                                    <option value="">Pilih Jabatan Anda</option>
                                                    @foreach ($dataJabatan as $jabatan)
                                                        <option value="{{ $jabatan->jabatan_nama }}" data-dept="{{ $jabatan->departement_ref }}">{{ $jabatan->jabatan_nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-10">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Alamat Tempat Bekerja / Perusahaan</label><span class="text-danger">*</span>
                                                <input type="text" id="simpleinput" class="form-control rounded-3" name="alamat_perusahaan" required placeholder="Masukkan Alamat Tempat Bekerja / Perusahaan">
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Kode Pos</label><span class="text-danger">*</span>
                                                <input type="number" id="example-number" class="form-control rounded-3" name="kode_pos_perusahaan" required placeholder="Masukkan Kode Pos Alamat Tempat Bekerja / Perusahaan">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="inputEmail3" class="form-label">Email</label><span class="text-danger">*</span>
                                                <input type="email" class="form-control rounded-3" id="inputEmail3" name="email_perusahaan" required placeholder="Masukkan Aalamt Email Perusahaan" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">No. Telp. Tempat Bekerja / Perusahaan</label><span class="text-danger">*</span>
                                                <input type="number" id="example-number" class="form-control rounded-3" name="telp_perusahaan" placeholder="08xxxxxx" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">No. Fax Tempat Bekerja / Perusahaan</label>
                                                <input type="number" id="example-number" class="form-control rounded-3" name="fax_perusahaan" placeholder="08xxxxxx">
                                            </div>
                                        </div>

                                    </div> <!-- end row #2-->
                                </div> <!-- end card-body #2-->

                                <div class="card-header bg-danger text-white px-4 py-2 rounded-top">
                                    <h5 class="card-title mb-1 fw-bold">C. DAFTAR UJI</h5>
                                    <small class="opacity-75">
                                        Isilah formulir di bawah ini untuk memilih Lembaga Sertifikasi Profesi (LSP), Tempat Uji Kompetensi (TUK), dan jadwal pelaksanaan uji sertifikasi yang akan diikuti.
                                    </small>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Kegiatan Sertifikasi</label><span class="text-danger">*</span>
                                                {{-- <input type="text" id="simpleinput" class="form-control rounded-3" name="kegiatan" disabled> --}}
                                                 <select class="form-select rounded-3" id="example-select" name="lsp"  required>
                                                    <option value="">Pilih Kegiatan</option>
                                                    @foreach ($dataKegiatan as $kegiatan)
                                                        <option value="{{ $kegiatan->ref }}">{{ $kegiatan->nama_kegiatan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="example-select" class="form-label">Lembaga Sertifikasi Kompetensi (LSP)</label><span class="text-danger">*</span>
                                                <select class="form-select rounded-3" id="example-select" name="lsp"  required>
                                                    <option value="">Pilih Lembaga Sertifikasi Kompetensi (LSP)</option>
                                                    @foreach ($dataLsp as $lsp)
                                                        <option value="{{ $lsp->ref }}">{{ $lsp->lsp_nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="example-select" class="form-label">Tempat Uji Kompetensi (TUK)</label><span class="text-danger">*</span>
                                                <select class="form-select rounded-3" id="example-select" name="tuk"  required>
                                                    <option value="">Pilih Tempat Uji Kompetensi (TUK)</option>
                                                    <option value="xx">xx</option>
                                                    <option value="yy">yy</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="example-select" class="form-label">Tanggal Pelaksanaan Uji Kompetensi</label><span class="text-danger">*</span>
                                                <select class="form-select rounded-3" id="example-select" name="kebangsaan"  required>
                                                    <option value="">Pilih Tanggal Pelaksanaan Uji Kompetensi</option>
                                                    <option value="xx">xx</option>
                                                    <option value="yy">yy</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-2 mt-3">
                                                <button type="submit" class="btn btn-outline-primary rounded-3"><i class="ri-save-3-line"></i> DAFTAR</button>
                                            </div>
                                        </div>

                                    </div> <!-- end row #3-->
                                </div> <!-- end card-body #3-->
                            </form>
                        </div> <!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->

            </div> <!-- container -->

        </div>
    </div>
    
@endsection