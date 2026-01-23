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
                            <div class="text-center text-dinas mt-4 mb-2">
                                <h3 class="card-title fw-bold">FORMULIR PENDATAAN JUMLAH PEGAWAI HOTEL</h3>
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
                            <form action="{{ route('pegawai.store') }}" method="POST" class="form-dinas">
                            @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Nama Hotel</label><span class="text-danger">*</span>
                                                <input type="text" id="simpleinput" class="form-control rounded-3" name="pegawai_nama_hotel" required placeholder="Masukkan Nama Hotel" value="{{ old('pegawai_nama_hotel') }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-number" class="form-label">Jumlah Housekeeping</label><span class="text-danger">*</span>
                                                <input type="number" id="example-number" class="form-control rounded-3 pegawai-input" name="pegawai_hk" required placeholder="Pegawai Housekeeping" value="{{ old('pegawai_hk') }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-number" class="form-label">Jumlah F&B Service</label><span class="text-danger">*</span>
                                                <input type="number" id="example-number" class="form-control rounded-3 pegawai-input" name="pegawai_fbs" required placeholder="Pegawai F&B Service" value="{{ old('pegawai_fbs') }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-number" class="form-label">Jumlah F&B Product</label><span class="text-danger">*</span>
                                                <input type="number" id="example-number" class="form-control rounded-3 pegawai-input" name="pegawai_fbp" required placeholder="Pegawai F&B Product" value="{{ old('pegawai_fbp') }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-number" class="form-label">Jumlah Kantor Depan</label><span class="text-danger">*</span>
                                                <input type="number" id="example-number" class="form-control rounded-3 pegawai-input" name="pegawai_fo" required placeholder="Pegawai Kantor Depan" value="{{ old('pegawai_fo') }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-number" class="form-label">Jumlah Engineering</label><span class="text-danger">*</span>
                                                <input type="number" id="example-number" class="form-control rounded-3 pegawai-input" name="pegawai_eng" required placeholder="Pegawai Engineering" value="{{ old('pegawai_eng') }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-number" class="form-label">Jumlah Lainnya</label><span class="text-danger">*</span>
                                                <input type="number" id="example-number" class="form-control rounded-3 pegawai-input" name="pegawai_oth" required placeholder="Pegawai Lainnya" value="{{ old('pegawai_oth') }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="example-number" class="form-label">Total Jumlah Pegawai</label><span class="text-danger">*</span>
                                                <input type="number" id="example-number" class="form-control rounded-3" name="pegawai_total" required readonly value="">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-2 mt-2">
                                                <button type="button" id="btnSubmit" class="btn btn-dinas rounded-3 px-4 py-2 fw-semibold"><i class="ri-save-3-line"></i> SIMPAN</button>
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

            // hitung total pegawai
            document.addEventListener('input', function () {
                let total = 0;

                document.querySelectorAll('.pegawai-input').forEach(function (el) {
                    total += parseInt(el.value) || 0;
                });

                document.querySelector('[name="pegawai_total"]').value = total;
            });

            // tombol submit
            const btn = document.getElementById('btnSubmit');
            if (!btn) {
                console.error('Tombol SIMPAN tidak ditemukan');
                return;
            }

            btn.addEventListener('click', function () {

                const getVal = name =>
                    document.querySelector(`[name="${name}"]`)?.value || '-';

                Swal.fire({
                    title: 'Konfirmasi Data Pegawai',
                    html: `
                        <table class="table table-bordered text-start">
                            <tr><th>Nama Hotel</th><td>${getVal('pegawai_nama_hotel')}</td></tr>
                            <tr><th>Housekeeping</th><td>${getVal('pegawai_hk')}</td></tr>
                            <tr><th>F&B Service</th><td>${getVal('pegawai_fbs')}</td></tr>
                            <tr><th>F&B Product</th><td>${getVal('pegawai_fbp')}</td></tr>
                            <tr><th>Kantor Depan</th><td>${getVal('pegawai_fo')}</td></tr>
                            <tr><th>Engineering</th><td>${getVal('pegawai_eng')}</td></tr>
                            <tr><th>Lainnya</th><td>${getVal('pegawai_oth')}</td></tr>
                            <tr class="fw-bold">
                                <th>Total</th><td>${getVal('pegawai_total')}</td>
                            </tr>
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