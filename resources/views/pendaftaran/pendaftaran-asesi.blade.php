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
                                    <h5 class="card-title fw-bold mb-1">A. DATA PRIBADI</h5>

                                    <small class="opacity-75">
                                        Isilah formulir di bawah ini dengan data pribadi yang benar dan sesuai dengan dokumen resmi.
                                    </small>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label><span class="text-danger">*</span>
                                                <input type="text" id="nama_lengkap" class="form-control rounded-3 @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" placeholder="Masukkan Nama Lengkap" value="{{ old('nama_lengkap') }}">
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
                                                <input type="number" id="nik" class="form-control rounded-3 @error('nik') is-invalid @enderror" name="nik" placeholder="Masukkan No. KTP/NIK/Paspor" value="{{ old('nik') }}">
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
                                                <input type="text" id="tempat_lahir" class="form-control rounded-3 @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" placeholder="Masukkan Tempat Lahir" value="{{ old('tempat_lahir') }}">
                                                @error('tempat_lahir')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label><span class="text-danger">*</span>
                                                <input type="date" id="tgl_lahir" class="form-control rounded-3 @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" value="{{ old('tgl_lahir') }}">
                                                @error('tgl_lahir')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label><span class="text-danger">*</span>
                                                <select class="rounded-3 @error('jenis_kelamin') is-invalid @enderror form-select" id="jenis_kelamin" name="jenis_kelamin">
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
                                                <select class="rounded-3 @error('kewarganegaraan') is-invalid @enderror form-select" id="kewarganegaraan" name="kewarganegaraan">
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
                                                <input type="text" id="alamat" class="form-control rounded-3 @error('alamat') is-invalid @enderror" name="alamat" placeholder="Masukkan alamat rumah" value="{{ old('alamat') }}">
                                                @error('alamat')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                <label for="kode_pos" class="form-label">Kode Pos</label><span class="text-danger">*</span>
                                                <input type="number" id="kode_pos" class="form-control rounded-3 @error('kode_pos') is-invalid @enderror" name="kode_pos" placeholder="Masukkan Kode Pos Alamat Rumah" value="{{ old('kode_pos') }}">
                                                @error('kode_pos')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label><span class="text-danger">*</span>
                                                <input type="email" class="form-control rounded-3 @error('email') is-invalid @enderror" id="email" name="email" placeholder="Masukkan alamat email" value="{{ old('email') }}">
                                                @error('email')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="telp_hp" class="form-label">No. Telp. (Hp)</label><span class="text-danger">*</span>
                                                <input type="number" id="telp_hp" class="form-control rounded-3 @error('telp_hp') is-invalid @enderror" name="telp_hp" placeholder="08xxxxxx" value="{{ old('telp_hp') }}">
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

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label><span class="text-danger">*</span>
                                                <select class="rounded-3 @error('pendidikan_terakhir') is-invalid @enderror form-select" id="pendidikan_terakhir" name="pendidikan_terakhir">
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

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="ijazah_file" class="form-label">Ijazah Terakhir</label><span class="text-danger">*</span>
                                                <input type="file" id="ijazah_file" class="form-control rounded-3 @error('ijazah_file') is-invalid @enderror" name="ijazah_file">
                                                @error('ijazah_file')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="sertikom_file" class="form-label">Sertifikat Kompetensi (opsional)</label>
                                                <input type="file" id="sertikom_file" class="form-control rounded-3 @error('sertikom_file') is-invalid @enderror" name="sertikom_file">
                                                @error('sertikom_file')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="keterangan_kerja_file" class="form-label">Surat Keterangan Bekerja</label><span class="text-danger">*</span>
                                                <input type="file" id="keterangan_kerja_file" class="form-control rounded-3 @error('keterangan_kerja_file') is-invalid @enderror" name="keterangan_kerja_file">
                                                @error('keterangan_kerja_file')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="pas_foto_file" class="form-label">Pas Foto (.png / .jpg)</label><span class="text-danger">*</span>
                                                <input type="file" id="pas_foto_file" class="form-control rounded-3 @error('pas_foto_file') is-invalid @enderror" name="pas_foto_file">
                                                @error('pas_foto_file')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div> <!-- end row-->
                                </div> <!-- end card-body -->

                                <div class="card-header bg-dinas rounded-top px-4 py-2 text-white">
                                    <h5 class="card-title fw-bold mb-1">B. DATA PEKERJAAN</h5>

                                    <small class="opacity-75">
                                        Isilah formulir di bawah ini dengan data pekerjaan yang sedang dijalani saat ini.
                                    </small>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="nama_perusahaan" class="form-label">Nama Tempat Bekerja / Perusahaan</label><span class="text-danger">*</span>
                                                <input type="text" id="nama_perusahaan" class="form-control rounded-3 @error('nama_perusahaan') is-invalid @enderror" name="nama_perusahaan" placeholder="Masukkan Nama Tempat Bekerja / Perusahaan" value="{{ old('nama_perusahaan') }}">
                                                @error('nama_perusahaan')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="departemen" class="form-label">Departemen</label><span class="text-danger">*</span>
                                                <select class="rounded-3 @error('departemen') is-invalid @enderror form-select" id="departemen" name="departemen">
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
                                                <select class="rounded-3 @error('jabatan') is-invalid @enderror form-select" id="jabatan" name="jabatan" disabled>
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
                                                <input type="text" id="alamat_perusahaan" class="form-control rounded-3 @error('alamat_perusahaan') is-invalid @enderror" name="alamat_perusahaan" placeholder="Masukkan Alamat Tempat Bekerja / Perusahaan" value="{{ old('alamat_perusahaan') }}">
                                                @error('alamat_perusahaan')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                <label for="kode_pos_perusahaan" class="form-label">Kode Pos</label><span class="text-danger">*</span>
                                                <input type="number" id="kode_pos_perusahaan" class="form-control rounded-3 @error('kode_pos_perusahaan') is-invalid @enderror" name="kode_pos_perusahaan" placeholder="Masukkan Kode Pos Alamat Tempat Bekerja / Perusahaan" value="{{ old('kode_pos_perusahaan') }}">
                                                @error('kode_pos_perusahaan')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="email_perusahaan" class="form-label">Email</label><span class="text-danger">*</span>
                                                <input type="email" class="form-control rounded-3 @error('email_perusahaan') is-invalid @enderror" id="email_perusahaan" name="email_perusahaan" placeholder="Masukkan Aalamt Email Perusahaan" value="{{ old('email_perusahaan') }}">
                                                @error('email_perusahaan')
                                                    <div class="invalid-feedback" bis_skin_checked="1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="telp_perusahaan" class="form-label">No. Telp. Tempat Bekerja / Perusahaan</label><span class="text-danger">*</span>
                                                <input type="number" id="telp_perusahaan" class="form-control rounded-3 @error('telp_perusahaan') is-invalid @enderror" name="telp_perusahaan" placeholder="08xxxxxx" value="{{ old('telp_perusahaan') }}">
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

                                    </div> <!-- end row #2-->
                                </div> <!-- end card-body #2-->

                                <div class="card-header bg-dinas rounded-top px-4 py-2 text-white">
                                    <h5 class="card-title fw-bold mb-1">C. DAFTAR UJI</h5>

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
                                                <select class="rounded-3 form-select" id="kegiatan_ref" name="kegiatan_ref">
                                                    <option value="" selected>Pilih Kegiatan</option>
                                                    @foreach ($dataKegiatan as $kegiatan)
                                                        <option value="{{ $kegiatan->ref }}">{{ $kegiatan->nama_kegiatan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="lsp_ref" class="form-label">Lembaga Sertifikasi Kompetensi (LSP)</label><span class="text-danger">*</span>
                                                <select class="rounded-3 form-select" id="lsp_ref" name="lsp_ref" disabled>
                                                    <option value="" disabled selected>Pilih LSP...</option>
                                                </select>
                                            </div>
                                        </div>

                                         <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="asesmen_ref" class="form-label">Jadwal Asesmen</label><span class="text-danger">*</span>
                                                <select class="rounded-3 form-select" id="asesmen_ref" name="asesmen_ref" disabled>
                                                    <option value="" disabled selected>Pilih Jadwal Asesmen...</option>
                                                </select>
                                            </div>
                                        </div>

                                        {{-- <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="skema_asesmen" class="form-label">Skema Sertifikasi Kompetensi</label><span class="text-danger">*</span>
                                                <select class="rounded-3 form-select" id="skema_asesmen" name="skema_asesmen" disabled>
                                                    <option value="" disabled selected>Pilih Skema Sertifikasi Kompetensi</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="tuk_ref" class="form-label">Tempat Uji Kompetensi (TUK)</label><span class="text-danger">*</span>
                                                <select class="rounded-3 form-select" id="tuk_ref" name="tuk_ref" disabled>
                                                    <option value="" disabled selected>Pilih Tempat Uji Kompetensi (TUK)</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="tgl_asesmen" class="form-label">Tanggal Pelaksanaan Uji Kompetensi</label><span class="text-danger">*</span>
                                                <select class="rounded-3 form-select" id="tgl_asesmen" name="tgl_asesmen" disabled>
                                                    <option value="" disabled selected>Pilih Jadwal Uji Kompetensi</option>
                                                </select>
                                            </div>
                                        </div> --}}

                                        <div class="col-lg-12">
                                            <div class="mb-2 mt-3">
                                                <button type="submit" class="btn btn-dinas rounded-3 fw-semibold px-4 py-2"><i class="ri-save-3-line"></i> DAFTAR</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
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

    <script>
        const departemenSelect = document.getElementById('departemen');
        const jabatanSelect = document.getElementById('jabatan');

        departemenSelect.addEventListener('change', function() {
            jabatanSelect.innerHTML = '<option>Loading...</option>';
            jabatanSelect.disabled = true;

            fetch(`/ajax/getJabatanByDepartemen/${this.value}`)
                .then(res => res.json())
                .then(data => {
                    let opt = '<option value="" disabled selected>Pilih Jabatan</option>';
                    data.forEach(item => {
                        opt += `<option value="${item.jabatan_nama}">${item.jabatan_nama}</option>`;
                    });
                    jabatanSelect.innerHTML = opt;
                    jabatanSelect.disabled = false;
                });
        });
    </script>

    <script>
        const kegiatanSelect = document.getElementById('kegiatan_ref');
        const lspSelect = document.getElementById('lsp_ref');
        const skemaSelect = document.getElementById('skema_asesmen');
        const tglAsesmen = document.getElementById('tgl_asesmen');
        const TempatUjiKompetensi = document.getElementById('tuk_ref');

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

            // reset skema
            skemaSelect.innerHTML = '<option value="">Pilih LSP dahulu..</option>';
            skemaSelect.disabled = true;

            // reset jadwal 
            tglAsesmen.innerHTML = '<option value="">Pilih LSP dahulu..</option>';
            tglAsesmen.disabled = true;

            // reset jadwal 
            TempatUjiKompetensi.innerHTML = '<option value="">Pilih LSP dahulu..</option>';
            TempatUjiKompetensi.disabled = true;

            fetch(`/ajax/lsp-by-kegiatan/${this.value}`)
                .then(res => res.json())
                .then(data => {
                    let opt = '<option value="" disabled selected>Pilih LSP</option>';
                    data.forEach(item => {
                        console.table(item);
                        const disabled = item.sisa_kuota <= 0 ? 'disabled' : '';
                        opt += `
                            <option value="${item.lsp_ref}" ${disabled}>
                                ${item.lsp_nama} (Sisa Kuota: ${item.sisa_kuota})
                            </option>
                        `;
                    });
                    lspSelect.innerHTML = opt;
                    lspSelect.disabled = false;
                });
        });
        // Get Data Skema pada saat LSP di pilih
        lspSelect.addEventListener('change', function() {
            skemaSelect.innerHTML = '<option>Loading...</option>';
            skemaSelect.disabled = true;

            fetch(`/ajax/skema-by-kegiatan-lsp?kegiatan_ref=${kegiatanSelect.value}&lsp_ref=${this.value}`)
                .then(res => res.json())
                .then(data => {
                    let opt = '<option value="" disabled selected>Pilih Skema Sertifikasi</option>';
                    data.forEach(item => {
                        opt += `<option value="${item.skema_ref}">${item.skema_judul}</option>`;
                    });
                    skemaSelect.innerHTML = opt;
                    skemaSelect.disabled = false;
                });


        });

        // Get Data Jadwal Asesmen pada saat LSP Dipilih
        lspSelect.addEventListener('change', function() {
            tglAsesmen.innerHTML = '<option>Loading...</option>';
            tglAsesmen.disabled = true;

            fetch(`/ajax/jadwal-by-lsp?kegiatan_ref=${kegiatanSelect.value}&lsp_ref=${this.value}`)
                .then(res => res.json())
                .then(data => {
                    let opt = '<option value="" disabled selected>Pilih Jadwal Sertifikasi</option>';
                    data.forEach(item => {
                        // console.table(item);
                        opt += `<option value="${item.ref}">${formatTanggalIndo(item.mulai_asesmen)}</option>`;
                    });
                    tglAsesmen.innerHTML = opt;
                    tglAsesmen.disabled = false;
                });
        });

        // Get Data TUK pada saat LSP Dipilih
        lspSelect.addEventListener('change', function() {
            TempatUjiKompetensi.innerHTML = '<option>Loading...</option>';
            TempatUjiKompetensi.disabled = true;

            fetch(`/ajax/tuk-by-lsp?kegiatan_ref=${kegiatanSelect.value}&lsp_ref=${this.value}`)
                .then(res => res.json())
                .then(data => {
                    let opt = '<option value="" disabled selected>Pilih Tempat Uji Kompetensi</option>';

                    if (data.tuk_nama !== undefined) {
                        opt += `<option value="${data.ref}">${data.tuk_nama}</option>`;
                    } else {
                        opt += `'<option value="" disabled>Tidak ada TUK tersedia</option>`;
                    }

                    TempatUjiKompetensi.innerHTML = opt;
                    TempatUjiKompetensi.disabled = false;
                });
        });
    </script>
@endpush
