@extends('pendaftaran.layouts.app')

@section('content')
    <!-- Simple form -->
    <div class="container mt-2 mb-2">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-6">
                        <div class="card shadow-lg border-0 rounded-4 mt-2">
                            <div class="text-center text-dinas mt-4 mb-2 px-3">
                                <h3 class="card-title fw-bold">FORMULIR PENDATAAN TEMPAT UJI KOMPETENSI (TUK)</h3>
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
                            <form action="{{ route('tuk.added') }}" method="POST" class="form-dinas">
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
                                                <input type="text" id="simpleinput" class="form-control rounded-3 tuk-input" name="tuk_nama" required placeholder="Masukkan nama TUK" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Alamat TUK</label><span class="text-danger">*</span>
                                                <input type="text" id="simpleinput" class="form-control rounded-3 tuk-input" name="tuk_alamat" required placeholder="Masukkan alamat TUK" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="inputEmail3" class="form-label">Email TUK</label><span class="text-danger">*</span>
                                                <input type="email" class="form-control rounded-3 tuk-input" id="inputEmail3" name="tuk_email" required placeholder="Masukkan alamat email TUK" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">No. Telp. TUK</label><span class="text-danger">*</span>
                                                <input type="number" id="example-number" class="form-control rounded-3 tuk-input" name="tuk_telp" placeholder="08xxxxxx" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Nama Kontak Person</label><span class="text-danger">*</span>
                                                <input type="text" id="simpleinput" class="form-control rounded-3 tuk-input" name="tuk_cp_nama" required placeholder="Masukkan Nama Kontak Person TUK" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="inputEmail3" class="form-label">Email Kontak Person</label><span class="text-danger">*</span>
                                                <input type="email" class="form-control rounded-3 tuk-input" id="inputEmail3" name="tuk_cp_email" required placeholder="Masukkan alamat email Kontak Person TUK" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">No. Telp. Kontak Person</label><span class="text-danger">*</span>
                                                <input type="number" id="example-number" class="form-control rounded-3 tuk-input" name="tuk_cp_telp" placeholder="08xxxxxx" required>
                                            </div>
                                        </div>

                                        {{-- <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Surat Permohonan TUK</label>
                                                <input type="file" id="example-fileinput" class="form-control rounded-3" name="tuk_file">
                                            </div>
                                        </div> --}}

                                        <div class="col-lg-12">
                                            <div class="mb-2 mt-2">
                                                <button type="button" id="btnSubmit" class="btn btn-dinas rounded-3 px-4 py-2 fw-semibold"><i class="ri-save-3-line"></i> DAFTAR TUK</button>
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

    @push('script')
        {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
        <script>
        document.addEventListener('DOMContentLoaded', function () {

            // tombol submit
            const btn = document.getElementById('btnSubmit');
            if (!btn) {
                console.error('Tombol SIMPAN tidak ditemukan');
                return;
            }

            btn.addEventListener('click', function () {

                const getVal = name =>
                    document.querySelector(`[name="${name}"]`)?.value || '-';
                const selectLsp = document.querySelector('select[name="lsp_ref"]');
                const lspNama = selectLsp.options[selectLsp.selectedIndex].text;

                Swal.fire({
                    title: 'Konfirmasi Data TUK',
                    html: `
                        <table class="table table-bordered text-start">
                            <tr><th>LSP Induk</th><td>${lspNama}</td></tr>
                            <tr><th>Nama TUK</th><td>${getVal('tuk_nama')}</td></tr>
                            <tr><th>Alamat TUK</th><td>${getVal('tuk_alamat')}</td></tr>
                            <tr><th>Email TUK</th><td>${getVal('tuk_email')}</td></tr>
                            <tr><th>Telp TUK</th><td>${getVal('tuk_telp')}</td></tr>
                            <tr><th>Kontak Person TUK</th><td>${getVal('tuk_cp_nama')}</td></tr>
                            <tr><th>Kontak Person Email</th><td>${getVal('tuk_cp_email')}</td></tr>
                            <tr><th>Kontak Person Telp</th><td>${getVal('tuk_cp_telp')}</td></tr>
                        </table>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Simpan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.querySelector('form.form-dinas').submit();
                    }
                });

            });

        });
        </script>
    @endpush

@endsection