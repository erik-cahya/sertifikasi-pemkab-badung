@extends('pendaftaran.layouts.app')

@section('content')
    <!-- Simple form -->
    <div class="container mb-2 mt-2">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card rounded-4 mt-2 border-0 shadow-lg">
                            <div class="card-header rounded-top-4">
                                <h4 class="card-title fw-bold mb-3">FORMULIR PENDAFTARAN CALON ASESI</h4>
                                <smal>
                                    Formulir ini digunakan untuk pendaftaran Calon Asesi dalam rangka mengikuti Sertifikasi Profesi Tahun {{ date('Y') }}
                                    <br>
                                    Silakan mengisi formulir pendaftaran berikut dengan data yang benar, lengkap dan dapat dipertanggungjawabkan.
                                    <br><br>
                                    Harap menyiapkan dokumen berikut sebelum mengisi formulir pendaftaran:
                                    <br>
                                    1. Scan Sertifikat Kompetensi (jika ada, maksimal ukuran file 2 MB)
                                    <br>
                                    2. Scan Ijazah Terakhir (jika ada, maksimal ukuran file 2 MB)
                                    <br>
                                    3. Scan Surat Keterangan Kerja (maksimal ukuran file 2 MB)
                                    <br>
                                    4. Scan KTP (maksimal ukuran file 2 MB)
                                    <br>
                                    5. Pas Foto Ukuran 3x4, Latar Belakang Merah (maksimal ukuran file 2 MB)
                                </smal>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger fs-12">
                                    <strong>DATA GAGAL DISIMPAN!</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('asesi.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="card-header bg-dinas rounded-top px-4 py-2 text-white">
                                    <h5 class="card-title fw-bold mb-1">A. DATA PRIBADI SESUAI KTP</h5>

                                    <small class="opacity-75">
                                        Isilah formulir di bawah ini dengan data pribadi yang benar dan sesuai dengan KTP.
                                    </small>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="nama_lengkap" class="form-label">Nama Lengkap (sesuai KTP)</label><span class="text-danger">*</span>
                                                <input type="text" id="nama_lengkap" class="form-control rounded-3 @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" placeholder="Masukkan Nama Lengkap" value="{{ old('nama_lengkap') }}" required>
                                                @error('nama_lengkap')
                                                    <div class="invalid-feedback" bis_skin_checked="1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="nik" class="form-label">No. KTP / NIK / Paspor</label><span class="text-danger">*</span>
                                                <input type="number" id="nik" class="form-control rounded-3 @error('nik') is-invalid @enderror" name="nik" placeholder="Masukkan No. KTP/NIK/Paspor" value="{{ old('nik') }}" required>
                                                @error('nik')
                                                    <div class="invalid-feedback" bis_skin_checked="1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="tempat_lahir" class="form-label">Tempat Lahir (Sesuai KTP)</label><span class="text-danger">*</span>
                                                <input type="text" id="tempat_lahir" class="form-control rounded-3 @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" placeholder="Masukkan Tempat Lahir" value="{{ old('tempat_lahir') }}" required>
                                                @error('tempat_lahir')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label><span class="text-danger">*</span>
                                                <input type="date" id="tgl_lahir" class="form-control rounded-3 @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" value="{{ old('tgl_lahir') }}" required>
                                                @error('tgl_lahir')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label><span class="text-danger">*</span>
                                                <select class="rounded-3 @error('jenis_kelamin') is-invalid @enderror form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                </select>
                                                @error('jenis_kelamin')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label><span class="text-danger">*</span>
                                                <select class="rounded-3 @error('kewarganegaraan') is-invalid @enderror form-select" id="kewarganegaraan" name="kewarganegaraan" required>
                                                    <option value="" disabled selected>Pilih Kewarganegaraan</option>
                                                    <option value="WNI" {{ old('kewarganegaraan') == 'WNI' ? 'selected' : '' }}>WNI</option>
                                                    <option value="WNA" {{ old('kewarganegaraan') == 'WNA' ? 'selected' : '' }}>WNA</option>
                                                </select>
                                                @error('kewarganegaraan')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-10">
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat Rumah</label><span class="text-danger">*</span>
                                                <input type="text" id="alamat" class="form-control rounded-3 @error('alamat') is-invalid @enderror" name="alamat" placeholder="Masukkan alamat rumah" value="{{ old('alamat') }}" required>
                                                @error('alamat')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                <label for="kode_pos" class="form-label">Kode Pos</label><span class="text-danger">*</span>
                                                <input type="number" id="kode_pos" class="form-control rounded-3 @error('kode_pos') is-invalid @enderror" name="kode_pos" placeholder="Masukkan Kode Pos Alamat Rumah" value="{{ old('kode_pos') }}" required>
                                                @error('kode_pos')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label><span class="text-danger">*</span>
                                                <input type="email" class="form-control rounded-3 @error('email') is-invalid @enderror" id="email" name="email" placeholder="Masukkan alamat email" value="{{ old('email') }}" required>
                                                @error('email')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="telp_hp" class="form-label">No. Telp. (Hp)</label><span class="text-danger">*</span>
                                                <input type="number" id="telp_hp" class="form-control rounded-3 @error('telp_hp') is-invalid @enderror" name="telp_hp" placeholder="08xxxxxx" value="{{ old('telp_hp') }}" required>
                                                @error('telp_hp')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="telp_rumah" class="form-label">No. Telp. (Rumah)</label>
                                                <input type="number" id="telp_rumah" class="form-control rounded-3 @error('telp_rumah') is-invalid @enderror" name="telp_rumah" placeholder="08xxxxxx" value="{{ old('telp_rumah') }}">
                                                @error('telp_rumah')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="telp_kantor" class="form-label">No. Telp. (Kantor)</label>
                                                <input type="number" id="telp_kantor" class="form-control rounded-3 @error('telp_kantor') is-invalid @enderror" name="telp_kantor" placeholder="08xxxxxx" value="{{ old('telp_kantor') }}">
                                                @error('telp_kantor')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label><span class="text-danger">*</span>
                                                <select class="rounded-3 @error('pendidikan_terakhir') is-invalid @enderror form-select" id="pendidikan_terakhir" name="pendidikan_terakhir" required>
                                                    <option value="" disabled selected>Pilih Pendidikan Terakhir</option>
                                                    <option value="SD" {{ old('pendidikan_terakhir') === 'SD' ? 'selected' : '' }}>SD</option>
                                                    <option value="SMP" {{ old('pendidikan_terakhir') === 'SMP' ? 'selected' : '' }}>SMP</option>
                                                    <option value="SMA/SMK/Sederajat" {{ old('pendidikan_terakhir') === 'SMA/SMK/Sederajat' ? 'selected' : '' }}>SMA/SMK/Sederajat</option>
                                                    <option value="D1" {{ old('pendidikan_terakhir') === 'D1' ? 'selected' : '' }}>D1</option>
                                                    <option value="D2" {{ old('pendidikan_terakhir') === 'D2' ? 'selected' : '' }}>D2</option>
                                                    <option value="D3" {{ old('pendidikan_terakhir') === 'D3' ? 'selected' : '' }}>D3</option>
                                                    <option value="D4" {{ old('pendidikan_terakhir') === 'D4' ? 'selected' : '' }}>D4</option>
                                                    <option value="S1" {{ old('pendidikan_terakhir') === 'S1' ? 'selected' : '' }}>S1</option>
                                                    <option value="S2" {{ old('pendidikan_terakhir') === 'S2' ? 'selected' : '' }}>S2</option>
                                                    <option value="S3" {{ old('pendidikan_terakhir') === 'S3' ? 'selected' : '' }}>S3</option>
                                                </select>
                                                @error('pendidikan_terakhir')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="ktp_file" class="form-label">Scan KTP (format PDF)</label><span class="text-danger">*</span>
                                                <input type="file" id="ktp_file" class="form-control rounded-3 @error('ktp_file') is-invalid @enderror" name="ktp_file" required>
                                                @error('ktp_file')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="ijazah_file" class="form-label">Ijazah Terakhir (jika ada)</label>
                                                <input type="file" id="ijazah_file" class="form-control rounded-3 @error('ijazah_file') is-invalid @enderror" name="ijazah_file">
                                                @error('ijazah_file')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="sertikom_file" class="form-label">Sertifikat Kompetensi (jika ada)</label>
                                                <input type="file" id="sertikom_file" class="form-control rounded-3 @error('sertikom_file') is-invalid @enderror" name="sertikom_file">
                                                @error('sertikom_file')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="keterangan_kerja_file" class="form-label">Surat Keterangan Bekerja</label><span class="text-danger">*</span>
                                                <input type="file" id="keterangan_kerja_file" class="form-control rounded-3 @error('keterangan_kerja_file') is-invalid @enderror" name="keterangan_kerja_file" required>
                                                @error('keterangan_kerja_file')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="pas_foto_file" class="form-label">Pas Foto (format PNG/JPG, maksimal 2 MB)</label><span class="text-danger">*</span>
                                                <input type="file" id="pas_foto_file" class="form-control rounded-3 @error('pas_foto_file') is-invalid @enderror" name="pas_foto_file" required>
                                                @error('pas_foto_file')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div> <!-- end row-->
                                </div> <!-- end card-body -->

                                <div class="card-header bg-dinas rounded-top px-4 py-2 text-white">
                                    <h5 class="card-title fw-bold mb-1">B. DAFTAR UJI KOMPETENSI</h5>

                                    <small class="opacity-75">
                                        Isilah formulir di bawah ini untuk memilih Lembaga Sertifikasi Profesi (LSP), Tempat Uji Kompetensi (TUK), dan jadwal pelaksanaan uji sertifikasi yang akan diikuti.
                                    </small>
                                </div>

                                @error('lsp_ref')
                                    <div class="alert alert-danger fs-12">
                                        <strong>DATA GAGAL DISIMPAN!</strong>
                                        <ul class="mb-0 mt-2">
                                            <li>{{ $message }}</li>
                                        </ul>
                                    </div>
                                @enderror

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="kegiatan_ref" class="form-label">Kegiatan Sertifikasi</label><span class="text-danger">*</span>
                                                <select class="rounded-3 form-select" id="kegiatan_ref" name="kegiatan_ref" required>
                                                    <option value="" selected>Pilih Kegiatan</option>
                                                    @foreach ($dataKegiatan as $kegiatan)
                                                        <option value="{{ $kegiatan->ref }}" {{ old('kegiatan_ref') == $kegiatan->ref ? 'selected' : '' }}>{{ $kegiatan->nama_kegiatan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="lsp_ref" class="form-label">Lembaga Sertifikasi Kompetensi (LSP)</label><span class="text-danger">*</span>
                                                <select class="rounded-3 form-select" id="lsp_ref" name="lsp_ref" disabled required>
                                                    <option value="" disabled selected>Pilih LSP...</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="jadwal_asesmen" class="form-label">Jadwal Asesmen</label><span class="text-danger">*</span>
                                                <select class="rounded-3 form-select" id="jadwal_asesmen" name="asesmen_ref" disabled required>
                                                    <option value="" disabled selected>Pilih Jadwal Asesmen...</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div> <!-- end card body-->

                                <div class="card-header bg-dinas rounded-top px-4 py-2 text-white">
                                    <h5 class="card-title fw-bold mb-1">C. DATA PEKERJAAN</h5>

                                    <small class="opacity-75">
                                        Isilah formulir di bawah ini dengan data pekerjaan yang sedang dijalani saat ini.
                                    </small>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="nama_perusahaan" class="form-label">Nama Tempat Bekerja / Perusahaan</label><span class="text-danger">*</span>
                                                <input type="text" id="nama_perusahaan" class="form-control rounded-3 @error('nama_perusahaan') is-invalid @enderror" name="nama_perusahaan" placeholder="Masukkan Nama Tempat Bekerja / Perusahaan" value="{{ old('nama_perusahaan') }}" required>
                                                @error('nama_perusahaan')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="departemen" class="form-label">Departemen</label><span class="text-danger">*</span>
                                                <select class="rounded-3 @error('departemen') is-invalid @enderror form-select" id="departemen" name="departemen" required>
                                                    <option value="" disabled selected>Pilih Departemen Anda</option>
                                                    @foreach ($dataDepartemen as $departemen)
                                                        <option value="{{ $departemen->departemen_nama }}" {{ old('departemen') === $departemen->departemen_nama ? 'selected' : '' }}>{{ $departemen->departemen_nama }}</option>
                                                    @endforeach
                                                </select>
                                                @error('departemen')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="jabatan" class="form-label">Jabatan</label><span class="text-danger">*</span>
                                                <select class="rounded-3 @error('jabatan') is-invalid @enderror form-select" id="jabatan" name="jabatan" disabled required>
                                                    <option value="" disabled selected>Pilih Jabatan Anda</option>
                                                </select>
                                                @error('jabatan')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-10">
                                            <div class="mb-3">
                                                <label for="alamat_perusahaan" class="form-label">Alamat Tempat Bekerja / Perusahaan</label><span class="text-danger">*</span>
                                                <input type="text" id="alamat_perusahaan" class="form-control rounded-3 @error('alamat_perusahaan') is-invalid @enderror" name="alamat_perusahaan" placeholder="Masukkan Alamat Tempat Bekerja / Perusahaan" value="{{ old('alamat_perusahaan') }}" required>
                                                @error('alamat_perusahaan')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                <label for="kode_pos_perusahaan" class="form-label">Kode Pos</label><span class="text-danger">*</span>
                                                <input type="number" id="kode_pos_perusahaan" class="form-control rounded-3 @error('kode_pos_perusahaan') is-invalid @enderror" name="kode_pos_perusahaan" placeholder="Masukkan Kode Pos Alamat Tempat Bekerja / Perusahaan" value="{{ old('kode_pos_perusahaan') }}" required>
                                                @error('kode_pos_perusahaan')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="email_perusahaan" class="form-label">Email</label><span class="text-danger">*</span>
                                                <input type="email" class="form-control rounded-3 @error('email_perusahaan') is-invalid @enderror" id="email_perusahaan" name="email_perusahaan" placeholder="Masukkan Alamat Email Perusahaan" value="{{ old('email_perusahaan') }}" required>
                                                @error('email_perusahaan')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="telp_perusahaan" class="form-label">No. Telp. Tempat Bekerja / Perusahaan</label><span class="text-danger">*</span>
                                                <input type="number" id="telp_perusahaan" class="form-control rounded-3 @error('telp_perusahaan') is-invalid @enderror" name="telp_perusahaan" placeholder="08xxxxxx" value="{{ old('telp_perusahaan') }}" required>
                                                @error('telp_perusahaan')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="fax_perusahaan" class="form-label">No. Fax Tempat Bekerja / Perusahaan</label>
                                                <input type="number" id="fax_perusahaan" class="form-control rounded-3 @error('fax_perusahaan') is-invalid @enderror" name="fax_perusahaan" placeholder="08xxxxxx" value="{{ old('fax_perusahaan') }}">
                                                @error('fax_perusahaan')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="nama_kontak_person" class="form-label">Nama Kontak Person Tempat Bekerja / Perusahaan</label><span class="text-danger">*</span>
                                                <input type="text" id="nama_kontak_person" class="form-control rounded-3 @error('nama_kontak_person') is-invalid @enderror" name="nama_kontak_person" placeholder="Masukan Nama Kontak Person dari Tempat Bekerja / Perusahaan" value="{{ old('nama_kontak_person') }}" required>
                                                @error('nama_kontak_person')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="no_kontak_person" class="form-label">Nomor HP Kontak Person Tempat Bekerja / Perusahaan</label>
                                                <input type="number" id="no_kontak_person" class="form-control rounded-3 @error('no_kontak_person') is-invalid @enderror" name="no_kontak_person" placeholder="08xxxxxx" value="{{ old('no_kontak_person') }}" required>
                                                @error('no_kontak_person')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        
                                        @if($dataKegiatan->isNotEmpty())
                                            <div class="col-lg-12">
                                                <div class="mb-2 mt-3">
                                                    <button type="button" id="btnSubmit" class="btn btn-dinas rounded-3 fw-semibold px-4 py-2"><i class="ri-save-3-line"></i> DAFTAR</button>
                                                </div>
                                            </div>
                                        @endif

                                    </div> <!-- end row #2-->
                                </div> <!-- end card-body #2-->

                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
@push('script')
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>

    {{-- Pilih Departemen & Jabatan --}}
    <script>
        const oldDepartemen = @json(old('departemen'));
        const oldJabatan = @json(old('jabatan'));
        const departemenSelect = document.getElementById('departemen');
        const jabatanSelect = document.getElementById('jabatan');

        function loadJabatan(departemen, selectedJabatan = null) {
            jabatanSelect.innerHTML = '<option>Loading...</option>';
            jabatanSelect.disabled = true;

            fetch(`/ajax/getJabatanByDepartemen/${departemen}`)
                .then(res => res.json())
                .then(data => {
                    let opt = '<option value="" disabled>Pilih Jabatan</option>';

                    data.forEach(item => {
                        const isSelected = selectedJabatan === item.jabatan_nama ? 'selected' : '';
                        opt += `<option value="${item.jabatan_nama}" ${isSelected}>${item.jabatan_nama}</option>`;
                    });

                    jabatanSelect.innerHTML = opt;
                    jabatanSelect.disabled = false;
                });
        }
        departemenSelect.addEventListener('change', function() {
            loadJabatan(this.value);
        });
        document.addEventListener('DOMContentLoaded', function() {
            if (oldDepartemen) {
                departemenSelect.value = oldDepartemen;
                loadJabatan(oldDepartemen, oldJabatan);
            }
        });
    </script>

    <script>
        const oldKegiatanRef = @json(old('kegiatan_ref'));
        const oldLspRef = @json(old('lsp_ref'));
        const oldAsesmenRef = @json(old('asesmen_ref'));

        const kegiatanSelect = document.getElementById('kegiatan_ref');
        const lspSelect = document.getElementById('lsp_ref');
        const jadwalAsesmen = document.getElementById('jadwal_asesmen');

        function formatTanggalIndo(datetime) {
            const date = new Date(datetime.replace(' ', 'T'));
            return new Intl.DateTimeFormat('id-ID', {
                weekday: 'long',
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            }).format(date);
        }

        // Get Data LSP pada saat kegiatan dipilih
        kegiatanSelect.addEventListener('change', function() {
            // reset LSP
            lspSelect.innerHTML = '<option>Loading...</option>';
            lspSelect.disabled = true;

            // reset jadwal 
            jadwalAsesmen.innerHTML = '<option value="">Pilih LSP dahulu..</option>';
            jadwalAsesmen.disabled = true;

            fetch(`/ajax/lsp-by-kegiatan/${this.value}`)
                .then(res => res.json())
                .then(data => {
                    let opt = '<option value="" disabled selected>Pilih LSP</option>';
                    data.forEach(item => {
                        const disabled = item.sisa_kuota <= 0 ? 'disabled' : '';
                        opt += `
                            <option value="${item.nama_lsp}" ${disabled}>
                                ${item.nama_lsp}
                            </option>
                        `;
                    });
                    lspSelect.innerHTML = opt;
                    lspSelect.disabled = false;
                });
        });
        // Get Data Jadwal Asesmen pada saat LSP Dipilih
        lspSelect.addEventListener('change', function() {
            jadwalAsesmen.innerHTML = '<option>Loading...</option>';
            jadwalAsesmen.disabled = true;

            fetch(`/ajax/jadwal-by-lsp?kegiatan_ref=${kegiatanSelect.value}&lsp_ref=${this.value}`)
                .then(res => res.json())
                .then(data => {
                    let opt = '<option value="" disabled selected>Pilih Jadwal Sertifikasi</option>';
                    data.forEach(item => {
                        console.table(item);
                        const isSelected = oldAsesmenRef === item.asesmen_ref ? 'selected' : '';
                        opt += `<option value="${item.asesmen_ref}" ${isSelected}>${item.nama_tuk} - ${item.nama_skema} | ${formatTanggalIndo(item.jadwal_asesmen)} | Kuota: ${item.sisa_kuota}</option>`;
                    });
                    jadwalAsesmen.innerHTML = opt;
                    jadwalAsesmen.disabled = false;
                });
        });

        // Auto-load LSP and Jadwal if old values exist
        document.addEventListener('DOMContentLoaded', function() {
            if (oldKegiatanRef) {
                kegiatanSelect.value = oldKegiatanRef;

                // Load LSP
                fetch(`/ajax/lsp-by-kegiatan/${oldKegiatanRef}`)
                    .then(res => res.json())
                    .then(data => {
                        let opt = '<option value="" disabled>Pilih LSP</option>';
                        data.forEach(item => {
                            const disabled = item.sisa_kuota <= 0 ? 'disabled' : '';
                            const isSelected = oldLspRef === item.nama_lsp ? 'selected' : '';
                            opt += `<option value="${item.nama_lsp}" ${disabled} ${isSelected}>${item.nama_lsp}</option>`;
                        });
                        lspSelect.innerHTML = opt;
                        lspSelect.disabled = false;

                        // If LSP was selected, load jadwal
                        if (oldLspRef) {
                            lspSelect.value = oldLspRef;

                            fetch(`/ajax/jadwal-by-lsp?kegiatan_ref=${oldKegiatanRef}&lsp_ref=${oldLspRef}`)
                                .then(res => res.json())
                                .then(data => {
                                    let opt = '<option value="" disabled>Pilih Jadwal Sertifikasi</option>';
                                    data.forEach(item => {
                                        const isSelected = oldAsesmenRef === item.asesmen_ref ? 'selected' : '';
                                        opt += `<option value="${item.asesmen_ref}" ${isSelected}>${item.nama_tuk} - ${item.nama_skema} | ${formatTanggalIndo(item.jadwal_asesmen)} | Kuota: ${item.sisa_kuota}</option>`;
                                    });
                                    jadwalAsesmen.innerHTML = opt;
                                    jadwalAsesmen.disabled = false;
                                });
                        }
                    });
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const btn = document.getElementById('btnSubmit');
            if (!btn) return;

            btn.addEventListener('click', function() {

                const val = name =>
                    document.querySelector(`[name="${name}"]`)?.value || '-';

                const selectedText = id =>
                    document.querySelector(`#${id} option:checked`)?.text || '-';

                Swal.fire({
                    title: 'Konfirmasi Data Pendaftaran',
                    html: `
                        <table class="table table-bordered text-start small">
                            <tr><th width="50%">Nama Lengkap</th><td>${val('nama_lengkap')}</td></tr>
                            <tr><th width="50%">NIK</th><td>${val('nik')}</td></tr>
                            <tr><th width="50%">Tempat Bekerja</th><td>${val('nama_perusahaan')}</td></tr>
                            <tr><th width="50%">Departemen</th><td>${val('departemen')}</td></tr>
                            <tr><th width="50%">Jabatan</th><td>${val('jabatan')}</td></tr>
                            <tr><th width="50%">Kegiatan</th><td>${selectedText('kegiatan_ref')}</td></tr>
                            <tr><th width="50%">LSP</th><td>${selectedText('lsp_ref')}</td></tr>
                            <tr><th width="50%">Jadwal Asesmen</th><td>${selectedText('jadwal_asesmen')}</td></tr>
                            <tr><th width="50%">Nama Kontak Person</th><td>${val('nama_kontak_person')}</td></tr>
                            <tr><th width="50%">Nomor HP Kontak Person</th><td>${val('no_kontak_person')}</td></tr>
                        </table>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Daftar',
                    cancelButtonText: 'Batal',
                    focusConfirm: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.querySelector('form').submit();
                    }
                });
            });

        });
    </script>
@endpush
