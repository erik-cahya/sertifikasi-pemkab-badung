@extends('pendaftaran.layouts.app')

@section('content')

    <section class="hero-gradient py-5 py-md-6">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="fw-bold text-white mb-4 display-6">
                        Sistem Informasi Pelatihan dan Sertifikasi
                    </h1>

                    <p class="fs-5 text-white-50 mb-5">
                        Portal resmi Dinas Perindustrian dan Ketenagakerjaan Kabupaten Badung
                        untuk pengelolaan pelatihan dan sertifikasi tenaga kerja.
                    </p>

                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="#" class="btn btn-orange d-flex align-items-center text-white">
                            Daftar Calon Asesi
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>

                        <a href="#" class="btn btn-outline-orange text-white">
                            Pendataan Pegawai
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 py-md-6">
        <div class="container">
            <!-- Header -->
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">
                    Layanan Kami
                </h2>
                <p class="text-muted mx-auto" style="max-width: 720px;">
                    Berbagai layanan untuk mendukung pengembangan kompetensi dan sertifikasi tenaga kerja di Kabupaten Badung.
                </p>
            </div>

            <!-- Cards -->
            <div class="row g-4">
                <!-- Pendataan Pegawai -->
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="/pegawai" class="service-card text-decoration-none d-block h-100">
                        <div class="service-icon mb-4">
                            <i class="bi bi-people fs-4"></i>
                        </div>
                        <h5 class="fw-semibold mb-2">Pendataan Pegawai</h5>
                        <p class="text-muted small mb-0">
                            Isi data anda yang bekerja sebagai pegawai di wilayah kabupaten badung.
                        </p>
                    </a>
                </div>

                <!-- Daftar Calon Asesi -->
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="/asesi" class="service-card text-decoration-none d-block h-100">
                        <div class="service-icon mb-4">
                            <i class="bi bi-clipboard-check fs-4"></i>
                        </div>
                        <h5 class="fw-semibold mb-2">Daftar Calon Asesi</h5>
                        <p class="text-muted small mb-0">
                            Daftarkan diri anda sebagai calon asesi untuk mengikuti uji kompetensi di bidang keahlian yang dipilih.
                        </p>
                    </a>
                </div>

                <!-- Daftar TUK -->
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="/tuk" class="service-card text-decoration-none d-block h-100">
                        <div class="service-icon mb-4">
                            <i class="bi bi-building fs-4"></i>
                        </div>
                        <h5 class="fw-semibold mb-2">Daftar TUK</h5>
                        <p class="text-muted small mb-0">
                            Daftarkan Tempat Uji Kompetensi (TUK) untuk menjadi mitra sertifikasi.
                        </p>
                    </a>
                </div>

                {{-- <!-- Sertifikasi -->
                <div class="col-12 col-md-6 col-lg-3">
                    <a href="/sertifikasi" class="service-card text-decoration-none d-block h-100">
                        <div class="service-icon mb-4">
                            <i class="bi bi-file-text fs-4"></i>
                        </div>
                        <h5 class="fw-semibold mb-2">Sertifikasi</h5>
                        <p class="text-muted small mb-0">
                            Informasi lengkap mengenai program sertifikasi dan skema kompetensi yang tersedia.
                        </p>
                    </a>
                </div>
            </div> --}}
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="bg-white rounded-4 shadow-lg p-4 p-md-5">
                        <h2 class="fw-bold text-center mb-4" style="color:#571919;">
                            Tentang Bidang Pelatihan dan Sertifikasi
                        </h2>

                        <div class="text-muted">
                            <p class="mb-3">
                                Bidang Pelatihan dan Sertifikasi merupakan bagian dari
                                Dinas Perindustrian dan Ketenagakerjaan Kabupaten Badung
                                yang bertanggung jawab dalam penyelenggaraan pelatihan kerja
                                dan sertifikasi kompetensi tenaga kerja.
                            </p>

                            <p class="mb-0">
                                Melalui portal ini, masyarakat dapat mengakses berbagai layanan
                                terkait pendaftaran sebagai calon asesi, pendaftaran Tempat Uji
                                Kompetensi (TUK), serta informasi mengenai program-program
                                sertifikasi yang tersedia.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
