@extends('pendaftaran.layouts.app')

@section('content')
    <div class="container mb-4 mt-3">
        <div class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-12">

                        {{-- Card Pencarian --}}
                        <div class="card rounded-4 mt-2 border-0 shadow-lg">
                            <div class="card-header bg-dinas rounded-top-4 px-4 py-3 text-center text-white">
                                <h4 class="card-title fw-bold mb-1"><i class="mdi mdi-certificate me-2"></i>DOWNLOAD SERTIFIKAT</h4>
                                <small class="opacity-75">Masukkan NIK untuk mencari dan mengunduh sertifikat peserta</small>
                            </div>
                            <div class="card-body px-4 py-4">
                                <form action="{{ route('download-sertifikat.search') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="nik" class="form-label fw-semibold">Cari berdasarkan NIK</label>
                                        <textarea name="nik" id="nik" class="form-control rounded-3" rows="5" placeholder="Masukkan NIK di sini...&#10;&#10;Untuk mencari lebih dari satu, pisahkan dengan ENTER.&#10;Contoh:&#10;5171010101010001&#10;5171010101010002" required>{{ $nikInput ?? '' }}</textarea>
                                        <small class="text-muted"><i class="mdi mdi-information-outline"></i> Pisahkan setiap NIK dengan menekan ENTER untuk pencarian lebih dari satu.</small>
                                    </div>

                                    <div class="d-md-flex flex-md-row justify-content-between align-items-md-center align-items-stretch">
                                        <div class="mb-md-0 mb-3" style="max-width: 350px;">
                                            <label for="tahun" class="form-label fw-semibold">Tahun Sertifikasi</label>
                                            <select name="tahun" id="tahun" class="rounded-3 form-select mb-1">
                                                <option value="">Semua Tahun</option>
                                                @foreach ($tahunList as $tahun)
                                                    <option value="{{ $tahun }}" {{ isset($selectedTahun) && $selectedTahun == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted"><i class="mdi mdi-information-outline"></i> Filter berdasarkan tahun pendaftaran sertifikasi.</small>
                                        </div>
                                        <div class="d-grid d-md-block mt-md-0 mt-3">
                                            <button type="submit" class="btn btn-dinas rounded-3 fw-semibold px-5 py-2">
                                                <i class="mdi mdi-magnify me-1"></i> Cari Sertifikat
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Card Hasil Pencarian --}}
                        @if (isset($searched) && $searched)
                            <div class="card rounded-4 mt-3 border-0 shadow-lg">
                                <div class="card-header rounded-top-4 border-bottom bg-white px-4 py-3">
                                    <h5 class="card-title fw-bold text-dinas mb-0">
                                        <i class="mdi mdi-table-search me-1"></i> Hasil Pencarian
                                        @if (isset($asesiList) && $asesiList->count() > 0)
                                            <span class="badge bg-dinas ms-2">{{ $asesiList->count() }} data</span>
                                        @endif
                                    </h5>
                                </div>
                                <div class="card-body p-0">
                                    @if (isset($asesiList) && $asesiList->count() > 0)
                                        <div class="table-responsive">
                                            <form action="{{ route('download-sertifikat.bulk') }}" method="POST" id="bulk-download-form">
                                                @csrf
                                                <div class="d-flex justify-content-start m-2">
                                                    <button type="submit" class="btn btn-dinas rounded-3 fs-12 px-3 py-1" id="btn-bulk-download" disabled>
                                                        <i class="mdi mdi-download-multiple me-1"></i> Download Terpilih (.zip)
                                                    </button>
                                                </div>
                                                <table class="table-bordered table-hover table-sm mb-0 table align-middle" style="font-size: 12px">
                                                    <thead class="bg-light">
                                                        <tr>
                                                            <th class="px-2 py-2 text-center" style="width: 40px;">
                                                                <div class="form-check d-flex justify-content-center mb-0">
                                                                    <input class="form-check-input" type="checkbox" id="check-all">
                                                                </div>
                                                            </th>
                                                            <th class="px-3 py-2 text-center" style="width: 50px;">No</th>
                                                            <th class="px-3 py-2">NIK</th>
                                                            <th class="px-3 py-2">Nama Asesi</th>
                                                            <th class="px-3 py-2">Lembaga Sertifikasi</th>
                                                            <th class="px-3 py-2">Skema Sertifikasi</th>
                                                            <th class="px-3 py-2">Tahun Sertifikasi</th>
                                                            <th class="px-3 py-2 text-center" style="width: 150px;">Download</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($asesiList as $item)
                                                            <tr class="{{ isset($item->is_found) && !$item->is_found ? 'table-danger' : '' }}">
                                                                <td class="px-2 text-center">
                                                                    <div class="form-check d-flex justify-content-center mb-0">
                                                                        @if (!empty($item->sertifikat_file))
                                                                            <input class="form-check-input row-checkbox" type="checkbox" name="sertifikat_files[]" value="{{ $item->sertifikat_file }}">
                                                                        @else
                                                                            <input class="form-check-input" type="checkbox" disabled>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                                <td class="px-3 text-center">{{ $loop->iteration }}</td>
                                                                <td class="font-monospace px-3">{{ $item->nik }}</td>
                                                                <td class="px-3">
                                                                    @if (isset($item->is_found) && !$item->is_found)
                                                                        <span class="text-danger fst-italic"><i class="mdi mdi-alert-circle-outline me-1"></i>{{ $item->nama_lengkap }}</span>
                                                                    @else
                                                                        {{ $item->nama_lengkap }}
                                                                    @endif
                                                                </td>
                                                                <td class="px-3">{{ $item->asesmen->nama_lsp ?? '-' }}</td>
                                                                <td class="px-3">{{ $item->asesmen->nama_skema ?? '-' }}</td>
                                                                <td class="px-3">
                                                                    <span class="badge bg-danger-subtle text-danger rounded-pill px-3">
                                                                        {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('Y') : '-' }}
                                                                    </span>
                                                                </td>
                                                                <td class="px-3 text-center">
                                                                    @if (!empty($item->sertifikat_file))
                                                                        <a href="{{ route('download-sertifikat.download', $item->sertifikat_file) }}" class="badge bg-success rounded-3 px-3 py-1 text-white">
                                                                            <i class="mdi mdi-download me-1"></i> Download
                                                                        </a>
                                                                    @elseif (isset($item->is_found) && !$item->is_found)
                                                                        <span class="text-muted">-</span>
                                                                    @else
                                                                        <span class="badge bg-warning text-dark rounded-3 px-3 py-1">
                                                                            <i class="mdi mdi-clock-outline me-1"></i>Belum Tersedia
                                                                        </span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </form>
                                        </div>
                                    @else
                                        <div class="px-4 py-5 text-center">
                                            <i class="mdi mdi-file-search-outline text-muted" style="font-size: 4rem;"></i>
                                            <h5 class="text-muted mt-3">Data Tidak Ditemukan</h5>
                                            <p class="text-muted mb-0">Pastikan NIK yang Anda masukkan sudah benar dan terdaftar.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                    </div><!-- end col -->
                </div><!-- end row -->
            </div> <!-- container -->
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkAll = document.getElementById('check-all');
            const checkboxes = document.querySelectorAll('.row-checkbox');
            const bulkDownloadBtn = document.getElementById('btn-bulk-download');

            function toggleBulkDownloadBtn() {
                const checkedCount = document.querySelectorAll('.row-checkbox:checked').length;
                if (bulkDownloadBtn) {
                    bulkDownloadBtn.disabled = checkedCount === 0;
                }
                if (checkAll && checkboxes.length > 0) {
                    checkAll.checked = checkedCount === checkboxes.length;
                }
            }

            if (checkAll) {
                checkAll.addEventListener('change', function() {
                    checkboxes.forEach(cb => {
                        cb.checked = checkAll.checked;
                    });
                    toggleBulkDownloadBtn();
                });
            }

            if (checkboxes.length > 0) {
                checkboxes.forEach(cb => {
                    cb.addEventListener('change', function() {
                        toggleBulkDownloadBtn();
                    });
                });
            }
        });
    </script>
@endpush
