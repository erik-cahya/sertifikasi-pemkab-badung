@extends('admin-panel.layouts.app')
@push('style')
    <!-- Select2 css -->
    <link href="{{ asset('admin') }}/assets/vendor/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

    <style>
        .kegiatan-item {
            border-radius: 8px;
        }

        .remove-kegiatan-btn {
            transition: all 0.3s ease;
        }

        .remove-kegiatan-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(220, 53, 69, 0.1);
        }

        /* Untuk tampilan mobile */
        @media (max-width: 992px) {
            .kegiatan-item .row>div {
                margin-bottom: 10px;
            }
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-lg-12">
                <div class="card border-top-0 overflow-hidden">
                    <div class="progress progress-sm rounded-0 bg-light" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-success" style="width: 60%"></div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="">
                                <p class="text-muted fw-semibold fs-16 mb-1">{{ $dataKegiatan->nama_kegiatan }}</p>

                                <p class="text-muted">
                                    <small>Durasi Kegiatan : {{ \Carbon\Carbon::parse($dataKegiatan->mulai_kegiatan)->locale('id')->translatedFormat('d F Y') }} s/d {{ \Carbon\Carbon::parse($dataKegiatan->selesai_kegiatan)->locale('id')->translatedFormat('d F Y') }}</small>
                                </p>

                                <span class="badge {{ $dataKegiatan->status == 1 ? 'bg-success' : 'bg-danger' }} rounded-pill px-2 py-1">Status : {{ $dataKegiatan->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</span>
                                @role('master', 'dinas')
                                    <span class="badge bg-info rounded-pill px-2 py-1">{{ $dataKegiatan->kegiatanJadwal->pluck('lsp')->unique('ref')->count() }} LSP</span>
                                @endrole
                                <span class="badge bg-primary rounded-pill px-2 py-1">{{ $dataKegiatan->asesi_count }}/{{ $dataKegiatan->total_peserta }} Calon Asesi</span>

                            </div>
                        </div>
                        @unlessrole('lsp')
                            <hr>
                            <div class="d-flex gap-2">
                                <div class="d-flex flex-lg-nowrap justify-content-between align-items-end flex-wrap">
                                    @role('master', 'dinas')
                                        <button class="btn-sm btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal-{{ $dataKegiatan->ref }}">
                                            <i class="mdi mdi-pencil"></i> Edit Kegiatan
                                        </button>
                                    @endrole
                                </div>
                            </div>

                            <!-- Edit Data Modal -->
                            <div id="editModal-{{ $dataKegiatan->ref }}" class="modal modal-lg fade" tabindex="-1" role="dialog" aria-labelledby="success-header-modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('kegiatan.update', $dataKegiatan->ref) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="modal-header modal-colored-header bg-pink">
                                                <h4 class="modal-title" id="success-header-modalLabel">Edit Kegiatan</h4>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row px-2">
                                                    <div class="col-lg-12 mb-2">
                                                        <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                                                        <input type="text" id="nama_kegiatan" class="form-control" name="nama_kegiatan" value="{{ $dataKegiatan->nama_kegiatan }}">
                                                    </div>

                                                    <div class="col-lg-6 mb-2">
                                                        <label for="mulai_kegiatan" class="form-label">Mulai Kegiatan</label>
                                                        <input type="text" value="{{ \Carbon\Carbon::parse($dataKegiatan->mulai_kegiatan)->translatedFormat('d/m/Y') }}" id="mulai_kegiatan" name="mulai_kegiatan" class="form-control single-date @error('mulai_kegiatan', 'create_kegiatan') is-invalid @enderror">
                                                    </div>

                                                    <div class="col-lg-6 mb-2">
                                                        <label for="selesai_kegiatan" class="form-label">Selesai Kegiatan</label>
                                                        <input type="text" value="{{ \Carbon\Carbon::parse($dataKegiatan->selesai_kegiatan)->locale('id')->translatedFormat('d/m/Y') }}" id="selesai_kegiatan" class="form-control single-date @error('selesai_kegiatan', 'create_kegiatan') is-invalid @enderror" name="selesai_kegiatan">
                                                    </div>
                                                    <div class="col-lg-6 mb-2">
                                                        <label for="status" class="form-label">Status</label>
                                                        <select class="text-capitalize form-select" id="skema_kategori" name="status">
                                                            <option value="#" disabled selected hidden>Pilih Kategori Skema</option>
                                                            <option value="1" {{ $dataKegiatan->status === 1 ? 'selected' : '' }}>Active</option>
                                                            <option value="0" {{ $dataKegiatan->status === 0 ? 'selected' : '' }}>Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-pink">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Edit Data Modal -->
                            {{-- @endunlessrole --}}
                        @endauth
                    </div>
                </div>
            </div>

            <div class="col-lg-12" bis_skin_checked="1">
                <div class="card" bis_skin_checked="1">
                    <h5 class="card-header bg-dinas text-white">Data Peserta</h5>
                    <div class="card-body" bis_skin_checked="1">
                        <div class="table-responsive">
                            <table class="table-sm table-bordered w-100 table">
                                <thead class="text-center align-middle">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama LSP</th>
                                        <th>Jumlah Skema</th>
                                        <th>Kuota</th>
                                        <th>Laporan Asesmen</th>
                                        @role('lsp')
                                            <th>Upload Laporan Asesmen</th>
                                        @endrole
                                        <th>Details</th>
                                    </tr>
                                </thead>

                                <tbody id="dataPeserta">
                                    @foreach ($dataKegiatan->kegiatanJadwal as $kegiatan)
                                        {{-- {{ dd($kegiatan) }} --}}
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $kegiatan->lsp->lsp_nama }}</td>
                                            <td width="500px">
                                                <div class="d-flex mb-1 flex-wrap gap-1">
                                                    @foreach ($dataSkema[$kegiatan->lsp->ref] ?? [] as $skema)
                                                        <span class="badge bg-primary-subtle text-primary d-inline-flex align-items-center">
                                                            {{ $skema->skema_judul }}
                                                            @role('dinas', 'master')
                                                                <button type="button" class="btn-close fs-10 btn-remove-skema ms-2" style="font-size: 0.5rem;" data-lsp="{{ $kegiatan->lsp->ref }}" data-skema="{{ $skema->ref }}" data-namaskema="{{ $skema->skema_judul }}" aria-label="Remove"></button>
                                                            @endrole
                                                        </span>
                                                    @endforeach
                                                </div>
                                                @role('dinas', 'master')
                                                    <button class="btn btn-xs btn-outline-success mt-1 shadow-sm" style="padding: 5px; font-size: 10px;" data-bs-toggle="modal" data-bs-target="#addSkemaModal-{{ $kegiatan->lsp->ref }}"><i class="mdi mdi-plus"></i> Tambah Skema</button>
                                                @endrole
                                            </td>

                                            <td>
                                                @php
                                                    $terdaftar = $dataKegiatan->asesi->where('lsp_ref', $kegiatan->lsp->ref)->count();
                                                @endphp
                                                {{ $terdaftar }} / {{ $kegiatan->kuota_lsp ?? 0 }} Orang
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center mb-2 gap-2">
                                                    <div style="width:120px;">Laporan 1</div>
                                                    <div style="width:15px;">:</div>
                                                    <span id="laporan-{{ $kegiatan->ref }}-1" class="flex-fill">
                                                        @if ($kegiatan->laporan_asesmen)
                                                            <a href="{{ route('files.asesmen.laporan_asesmen', $kegiatan->laporan_asesmen) }}" target="_blank" class="text-danger d-inline-flex align-items-center gap-1" title="Lihat Laporan Asesmen"> <i class="mdi mdi-download"></i> Download </a>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </span>
                                                </div>

                                                <div class="d-flex align-items-center mb-2 gap-2">
                                                    <div style="width:120px;">Laporan 2</div>
                                                    <div style="width:15px;">:</div>
                                                    <span id="laporan-{{ $kegiatan->ref }}-2" class="flex-fill">
                                                        @if ($kegiatan->laporan_asesmen2)
                                                            <a href="{{ route('files.asesmen.laporan_asesmen', $kegiatan->laporan_asesmen2) }}" target="_blank" class="text-danger d-inline-flex align-items-center gap-1" title="Lihat Laporan Asesmen"> <i class="mdi mdi-download"></i> Download </a>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </span>
                                                </div>

                                                <div class="d-flex align-items-center mb-2 gap-2">
                                                    <div style="width:120px;">Laporan 3</div>
                                                    <div style="width:15px;">:</div>
                                                    <span id="laporan-{{ $kegiatan->ref }}-3" class="flex-fill">
                                                        @if ($kegiatan->laporan_asesmen3)
                                                            <a href="{{ route('files.asesmen.laporan_asesmen', $kegiatan->laporan_asesmen3) }}" target="_blank" class="text-danger d-inline-flex align-items-center gap-1" title="Lihat Laporan Asesmen"> <i class="mdi mdi-download"></i> Download </a>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </span>
                                                </div>

                                                <div class="d-flex align-items-center mb-2 gap-2">
                                                    <div style="width:120px;">Laporan 4</div>
                                                    <div style="width:15px;">:</div>
                                                    <span id="laporan-{{ $kegiatan->ref }}-4" class="flex-fill">
                                                        @if ($kegiatan->laporan_asesmen4)
                                                            <a href="{{ route('files.asesmen.laporan_asesmen', $kegiatan->laporan_asesmen4) }}" target="_blank" class="text-danger d-inline-flex align-items-center gap-1" title="Lihat Laporan Asesmen"> <i class="mdi mdi-download"></i> Download </a>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </span>
                                                </div>

                                                <div class="d-flex align-items-center mb-2 gap-2">
                                                    <div style="width:120px;">Laporan 5</div>
                                                    <div style="width:15px;">:</div>
                                                    <span id="laporan-{{ $kegiatan->ref }}-5" class="flex-fill">
                                                        @if ($kegiatan->laporan_asesmen5)
                                                            <a href="{{ route('files.asesmen.laporan_asesmen', $kegiatan->laporan_asesmen5) }}" target="_blank" class="text-danger d-inline-flex align-items-center gap-1" title="Lihat Laporan Asesmen"> <i class="mdi mdi-download"></i> Download </a>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </span>
                                                </div>
                                            </td>

                                            @role('lsp')
                                                <td>
                                                    {{-- <input type="file" class="form-control upload-laporan-asesmen form-control-sm" data-ref="{{ $kegiatan->ref }}" accept="application/pdf"> --}}
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div style="width:120px;">Laporan 1</div>
                                                        <div style="width:15px;">:</div>
                                                        <input type="file" class="form-control form-control-sm upload-laporan-asesmen" data-ref="{{ $kegiatan->ref }}" data-index="1" accept="application/pdf">
                                                    </div>

                                                    <div class="d-flex align-items-center mb-2">
                                                        <div style="width:120px;">Laporan 2</div>
                                                        <div style="width:15px;">:</div>
                                                        <input type="file" class="form-control form-control-sm upload-laporan-asesmen" data-ref="{{ $kegiatan->ref }}" data-index="2" accept="application/pdf">
                                                    </div>

                                                    <div class="d-flex align-items-center mb-2">
                                                        <div style="width:120px;">Laporan 3</div>
                                                        <div style="width:15px;">:</div>
                                                        <input type="file" class="form-control form-control-sm upload-laporan-asesmen" data-ref="{{ $kegiatan->ref }}" data-index="3" accept="application/pdf">
                                                    </div>

                                                    <div class="d-flex align-items-center mb-2">
                                                        <div style="width:120px;">Laporan 4</div>
                                                        <div style="width:15px;">:</div>
                                                        <input type="file" class="form-control form-control-sm upload-laporan-asesmen" data-ref="{{ $kegiatan->ref }}" data-index="4" accept="application/pdf">
                                                    </div>

                                                    <div class="d-flex align-items-center mb-2">
                                                        <div style="width:120px;">Laporan 5</div>
                                                        <div style="width:15px;">:</div>
                                                        <input type="file" class="form-control form-control-sm upload-laporan-asesmen" data-ref="{{ $kegiatan->ref }}" data-index="5" accept="application/pdf">
                                                    </div>
                                                </td>
                                            @endrole

                                            <td>
                                                <button class="btn btn-link text-decoration-none fs-12 p-0" data-bs-toggle="collapse" data-bs-target="#jadwal-{{ $kegiatan->ref }}" aria-expanded="false" aria-controls="jadwal-{{ $kegiatan->ref }}">
                                                    Lihat Jadwal
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="bg-light collapse" id="jadwal-{{ $kegiatan->ref }}" data-bs-parent="#dataPeserta">

                                            <td colspan="7" class="">
                                                <div class="card mb-0 border-0 shadow-sm">
                                                    <div class="card-body p-0">
                                                        <div class="card-header bg-dinas d-flex justify-content-between align-items-center text-white" bis_skin_checked="1">
                                                            <h4 class="card-title mb-0"> Detail Jadwal & Skema</h4>
                                                            <div class="d-flex align-items-center gap-2">
                                                                <select class="form-select-sm text-dark month-selector-{{ $kegiatan->ref }} form-select bg-white" style="width: 130px;">
                                                                    @php
                                                                        $bulanList = [
                                                                            1 => 'Januari',
                                                                            2 => 'Februari',
                                                                            3 => 'Maret',
                                                                            4 => 'April',
                                                                            5 => 'Mei',
                                                                            6 => 'Juni',
                                                                            7 => 'Juli',
                                                                            8 => 'Agustus',
                                                                            9 => 'September',
                                                                            10 => 'Oktober',
                                                                            11 => 'November',
                                                                            12 => 'Desember',
                                                                        ];
                                                                    @endphp
                                                                    @foreach ($bulanList as $num => $nama)
                                                                        <option value="{{ $num }}" {{ $num == now()->month ? 'selected' : '' }}>{{ $nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <select class="form-select-sm text-dark year-selector-{{ $kegiatan->ref }} form-select bg-white" style="width: 90px;">
                                                                    @for ($y = now()->year - 2; $y <= now()->year + 1; $y++)
                                                                        <option value="{{ $y }}" {{ $y == now()->year ? 'selected' : '' }}>{{ $y }}</option>
                                                                    @endfor
                                                                </select>
                                                                <a href="{{ route('pdf.jadwal-asesmen', ['month' => now()->month, 'year' => now()->year, 'kegiatan_jadwal_ref' => $kegiatan->ref, 'nama_lsp' => $kegiatan->lsp->lsp_nama]) }}" class="btn btn-sm btn-light text-dark download-jadwal-btn" data-base-url="{{ route('pdf.jadwal-asesmen') }}" data-ref="{{ $kegiatan->ref }}" data-lsp="{{ $kegiatan->lsp->lsp_nama }}" title="Download Jadwal Asesmen Excel">
                                                                    <i class="mdi mdi-file-excel"></i> Download Jadwal
                                                                </a>
                                                                <button type="button" class="btn btn-sm btn-warning text-dark" data-bs-toggle="modal" data-bs-target="#penandatanganModal-{{ $kegiatan->ref }}" title="Setting Penandatangan">
                                                                    <i class="mdi mdi-account-edit"></i> Setting ttd
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <table class="table-sm table-bordered table" style="font-size: 12px">
                                                            <thead class="text-center align-middle">
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Total Asesi</th>
                                                                    <th>Tanggal Uji Kompetensi</th>
                                                                    <th>Tempat Uji Kompetensi</th>
                                                                    <th>Skema</th>
                                                                    <th>Download Form <br> (Template)</th>
                                                                    <th>Download Form <br> (Bukti)</th>
                                                                    @role('lsp')
                                                                        <th>Upload Form</th>
                                                                    @endrole
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="detailJadwal-{{ $kegiatan->ref }}">
                                                                {{-- {{ dd($kegiatan->lsp->lsp_nama) }} --}}
                                                                @foreach ($jadwalKegiatan[$kegiatan->lsp->lsp_nama] ?? [] as $asesmen)
                                                                    <tr class="{{ count($dataAsesi[$asesmen->ref] ?? []) != $asesmen->kuota_harian ? 'bg-warning' : '' }}">
                                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                                        <td>{{ count($dataAsesi[$asesmen->ref] ?? []) }} / {{ $asesmen->kuota_harian }} Orang</td>
                                                                        <td class="{{ count($dataAsesi[$asesmen->ref] ?? []) >= 1 ? '' : '' }}">{{ \Carbon\Carbon::parse($asesmen->jadwal_asesmen)->locale('id')->translatedFormat('l, d F Y') }}</td>
                                                                        <td>{{ $asesmen->nama_tuk }}</td>
                                                                        <td>{{ $asesmen->nama_skema }}</td>
                                                                        <!-- Download Template -->
                                                                        <td>
                                                                            <div class="d-flex align-items-center mb-2">
                                                                                <div style="width:180px;">Daftar Hadir</div>
                                                                                <div style="width:15px;">:</div>
                                                                                <a href="{{ route('pdf.daftar-hadir', $asesmen->ref) }}" target="_blank" class="d-inline-flex align-items-center gap-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download Daftar Hadir" data-bs-custom-class="info-tooltip"><i class="mdi mdi-download"></i> Download </a>
                                                                            </div>
                                                                            <div class="d-flex align-items-center mb-2">
                                                                                <div style="width:180px;">Daftar Penerimaan</div>
                                                                                <div style="width:15px;">:</div>
                                                                                <a href="{{ route('pdf.daftar-penerimaan', $asesmen->ref) }}" target="_blank" class="d-inline-flex align-items-center gap-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download Daftar Hadir" data-bs-custom-class="info-tooltip"><i class="mdi mdi-download"></i> Download </a>
                                                                            </div>
                                                                            <div class="d-flex align-items-center mb-2">
                                                                                <div style="width:180px;">Tanda Terima Sertifikat</div>
                                                                                <div style="width:15px;">:</div>
                                                                                <a href="{{ route('pdf.tanda-terima-sertifikat', $asesmen->ref) }}" target="_blank" class="d-inline-flex align-items-center gap-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download Daftar Hadir" data-bs-custom-class="info-tooltip"><i class="mdi mdi-download"></i> Download </a>
                                                                            </div>
                                                                        </td>
                                                                        <!-- Download Bukti -->
                                                                        <td>
                                                                            <div class="d-flex align-items-center mb-2">
                                                                                <div style="width:180px;">Bukti Asesmen</div>
                                                                                <div style="width:15px;">:</div>
                                                                                <span id="asesmen-{{ $asesmen->ref }}">
                                                                                    @if ($asesmen->bukti_asesmen)
                                                                                        <a href="{{ route('files.asesmen.bukti_asesmen', $asesmen->bukti_asesmen) }}" target="_blank" class="text-danger d-inline-flex align-items-center gap-1" title="Lihat Bukti Asesmen"> <i class="mdi mdi-download"></i> Download </a>
                                                                                    @else
                                                                                        <span class="text-muted">-</span>
                                                                                    @endif
                                                                                </span>
                                                                            </div>
                                                                            <div class="d-flex align-items-center mb-2">
                                                                                <div style="width:180px;">Dokumentasi Asesmen</div>
                                                                                <div style="width:15px;">:</div>
                                                                                <span id="dokumentasi-{{ $asesmen->ref }}">
                                                                                    @if ($asesmen->dokumentasi_asesmen)
                                                                                        <a href="{{ route('files.asesmen.dokumentasi_asesmen', $asesmen->dokumentasi_asesmen) }}" target="_blank" class="text-danger d-inline-flex align-items-center gap-1" title="Lihat Dokumentasi Asesmen"> <i class="mdi mdi-download"></i> Download </a>
                                                                                    @else
                                                                                        <span class="text-muted">-</span>
                                                                                    @endif
                                                                                </span>
                                                                            </div>
                                                                            <div class="d-flex align-items-center mb-2">
                                                                                <div style="width:180px;">Bukti Terima Sertifikat</div>
                                                                                <div style="width:15px;">:</div>
                                                                                <span id="bukti-terima-{{ $asesmen->ref }}">
                                                                                    @if ($asesmen->bukti_terima_sertifikat)
                                                                                        <a href="{{ route('files.asesmen.bukti_terima_sertifikat', $asesmen->bukti_terima_sertifikat) }}" target="_blank" class="text-danger d-inline-flex align-items-center gap-1" title="Lihat Bukti Terima Sertifikat"> <i class="mdi mdi-download"></i> Download </a>
                                                                                    @else
                                                                                        <span class="text-muted">-</span>
                                                                                    @endif
                                                                                </span>
                                                                            </div>
                                                                        </td>
                                                                        <!-- Upload Bukti -->
                                                                        @role('lsp')
                                                                            <td>
                                                                                <div class="d-flex align-items-center mb-2">
                                                                                    <div style="width:180px;">Bukti Asesmen</div>
                                                                                    <div style="width:15px;">:</div>
                                                                                    <input type="file" class="form-control form-control-sm upload-bukti-asesmen" data-ref="{{ $asesmen->ref }}" accept="application/pdf">
                                                                                </div>

                                                                                <div class="d-flex align-items-center mb-2">
                                                                                    <div style="width:180px;">Dokumentasi Asesmen</div>
                                                                                    <div style="width:15px;">:</div>
                                                                                    <input type="file" class="form-control form-control-sm upload-dokumentasi-asesmen" data-ref="{{ $asesmen->ref }}" accept="application/pdf">
                                                                                </div>

                                                                                <div class="d-flex align-items-center mb-2">
                                                                                    <div style="width:180px;">Bukti Terima Sertifikat</div>
                                                                                    <div style="width:15px;">:</div>
                                                                                    <input type="file" class="form-control form-control-sm upload-bukti-terima" data-ref="{{ $asesmen->ref }}" accept="application/pdf">
                                                                                </div>
                                                                            </td>
                                                                        @endrole
                                                                        <td>
                                                                            <div class="d-flex gap-2">
                                                                                <button class="btn btn-link text-decoration-none fs-12 p-0" data-bs-toggle="collapse" data-bs-target="#asesi_list-{{ $asesmen->ref }}" aria-expanded="false" aria-controls="asesi_list-{{ $asesmen->ref }}">
                                                                                    Lihat Asesi
                                                                                </button>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="bg-light collapse" id="asesi_list-{{ $asesmen->ref }}" data-bs-parent="#detailJadwal-{{ $kegiatan->ref }}">
                                                                        <td colspan="16" class="p-3">
                                                                            <div class="card mb-0 border-0 shadow-sm">
                                                                                <div class="card-body p-1">
                                                                                    <div class="card-header bg-dinas px-3 text-white" bis_skin_checked="1">
                                                                                        <h4 class="card-title"> List Asesi</h4>
                                                                                        <h6>{{ \Carbon\Carbon::parse($asesmen->jadwal_asesmen)->locale('id')->translatedFormat('l, d F Y') }}</h6>
                                                                                    </div>
                                                                                    <table class="table-sm table-bordered table" style="font-size: 12px">
                                                                                        <thead class="text-center align-middle">
                                                                                            <tr>
                                                                                                <th>No</th>
                                                                                                <th>Nama Asesi</th>
                                                                                                <th>Tempat Bekerja</th>
                                                                                                <th>Nomor Sertifikat @role('lsp')
                                                                                                        <small class="fw-normal fs-10">( Klik Kolom untuk tambah/edit )</small>
                                                                                                    @endrole
                                                                                                </th>
                                                                                                @role('lsp')
                                                                                                    <th width="20%">Upload Sertifikat</th>
                                                                                                @endrole
                                                                                                <th>Download Sertifikat</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            @foreach ($dataAsesi[$asesmen->ref] ?? [] as $asesi)
                                                                                                <tr>
                                                                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                                                                    <td>
                                                                                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#editModal-{{ $asesi->ref }}"> {{ $asesi->nama_lengkap }}</a>
                                                                                                    </td>
                                                                                                    <td>{{ $asesi->nama_perusahaan }}</td>
                                                                                                    <td>
                                                                                                        <span @role('lsp') class="edited text-primary" style="cursor: pointer; border-bottom: 1px dashed #007bff; padding-bottom: 2px" @endrole id="no_sertifikat" ref="{{ $asesi->ref }}" data-value="{{ $asesi->no_sertifikat }}">
                                                                                                            @if ($asesi->no_sertifikat != null)
                                                                                                                {{ $asesi->no_sertifikat }}
                                                                                                            @else
                                                                                                                @role('lsp')
                                                                                                                    <i class="mdi mdi-pencil-outline"></i> Isi No. Sertifikat
                                                                                                                @else
                                                                                                                    -
                                                                                                                @endrole
                                                                                                            @endif
                                                                                                        </span>
                                                                                                    </td>
                                                                                                    @role('lsp')
                                                                                                        <td><input type="file" class="form-control upload-sertifikat" data-ref="{{ $asesi->ref }}" accept="application/pdf"></td>
                                                                                                    @endrole
                                                                                                    <td class="d-flex align-items-center gap-2 text-center">
                                                                                                        <span id="sertifikat-{{ $asesi->ref }}">
                                                                                                            @if ($asesi->sertifikat_file)
                                                                                                                <a href="{{ route('files.asesi.sertifikat', $asesi->sertifikat_file) }}" target="_blank" class="text-danger" title="Lihat Sertifikat"> <i class="mdi mdi-download"></i> Download </a>
                                                                                                            @else
                                                                                                                <span class="text-muted">-</span>
                                                                                                            @endif
                                                                                                        </span>
                                                                                                    </td>
                                                                                                </tr>

                                                                                                <!-- Edit Data Modal -->
                                                                                                <div id="editModal-{{ $asesi->ref }}" class="modal modal-xl fade" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">

                                                                                                    <div class="modal-dialog">
                                                                                                        <div class="modal-content">
                                                                                                            <form action="{{ route('kegiatan.updateAsesi', $asesi->ref) }}" method="POST" enctype="multipart/form-data">
                                                                                                                @method('PUT')
                                                                                                                @csrf
                                                                                                                <div class="modal-header modal-colored-header bg-dinas">
                                                                                                                    <h4 class="modal-title" id="primary-header-modalLabel">Edit Data Asesi {{ $asesi->nama }}</h4>
                                                                                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                                                </div>
                                                                                                                <div class="modal-body">
                                                                                                                    <div class="row">

                                                                                                                        <x-form.input className="col-md-4 mt-2" type="text" name="nama_lengkap" label="Nama Lengkap" value="{{ old('nama_lengkap', $asesi->nama_lengkap) }}" />
                                                                                                                        <x-form.input className="col-md-4 mt-2" type="text" name="nik" label="NIK" value="{{ old('nik', $asesi->nik) }}" />
                                                                                                                        <x-form.input className="col-md-4 mt-2" type="text" name="tempat_lahir" label="Tempat Lahir" value="{{ old('tempat_lahir', $asesi->tempat_lahir) }}" />
                                                                                                                        <x-form.input className="col-md-4 mt-2" type="date" name="tgl_lahir" label="Tanggal Lahir" value="{{ old('tgl_lahir', $asesi->tgl_lahir) }}" />

                                                                                                                        <div class="col-md-4 mt-2">
                                                                                                                            <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label><span class="text-danger">*</span>
                                                                                                                            <select class="rounded-3 form-select" id="kewarganegaraan" name="kewarganegaraan" required>
                                                                                                                                <option value="" disabled selected>Pilih Kewarganegaraan</option>
                                                                                                                                <option value="WNI" {{ $asesi->kewarganegaraan === 'WNI' ? 'selected' : '' }}>WNI</option>
                                                                                                                                <option value="WNA" {{ $asesi->kewarganegaraan === 'WNA' ? 'selected' : '' }}>WNA</option>
                                                                                                                            </select>
                                                                                                                        </div>

                                                                                                                        <div class="col-md-4 mt-2">
                                                                                                                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                                                                                                            <select class="text-capitalize rounded-3 form-select" id="jenis_kelamin" name="jenis_kelamin">
                                                                                                                                <option value="#" disabled selected hidden>Pilih Jenis Kelamin</option>
                                                                                                                                <option value="Laki-laki" {{ $asesi->jenis_kelamin === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                                                                                                <option value="Perempuan" {{ $asesi->jenis_kelamin === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                                                                                            </select>
                                                                                                                        </div>

                                                                                                                        <x-form.input className="col-md-4 mt-2" type="text" name="alamat" label="Alamat" value="{{ old('alamat', $asesi->alamat) }}" />
                                                                                                                        <x-form.input className="col-md-4 mt-2" type="text" name="kode_pos" label="Kode Pos" value="{{ old('kode_pos', $asesi->kode_pos) }}" />
                                                                                                                        <x-form.input className="col-md-4 mt-2" type="text" name="telp_rumah" label="No. Telp Rumah" value="{{ old('telp_rumah', $asesi->telp_rumah) }}" />
                                                                                                                        <x-form.input className="col-md-4 mt-2" type="text" name="telp_kantor" label="No. Telp Kantor" value="{{ old('telp_kantor', $asesi->telp_kantor) }}" />
                                                                                                                        <x-form.input className="col-md-4 mt-2" type="text" name="telp_hp" label="No. Telp HP" value="{{ old('telp_hp', $asesi->telp_hp) }}" />
                                                                                                                        <x-form.input className="col-md-4 mt-2" type="email" name="email" label="Email" value="{{ old('email', $asesi->email) }}" />

                                                                                                                        <hr class="mt-2">

                                                                                                                        <x-form.input className="col-md-6" type="text" name="email" label="LSP" disabled value="{{ $asesi->asesmen->nama_lsp }}" />

                                                                                                                        <div class="col-md-6">
                                                                                                                            <label for="asesmen_ref" class="form-label">Jadwal Asesmen</label>

                                                                                                                            {{-- <select class="rounded-3 form-select" id="asesmen_ref" name="asesmen_ref">
                                                                                                                                <option value="" disabled selected>Pilih Jadwal Asesmen</option>
                                                                                                                                @php
                                                                                                                                    $jadwalLsp = $jadwalKegiatan[$asesi->asesmen->nama_lsp] ?? [];
                                                                                                                                @endphp
                                                                                                                                @foreach ($jadwalLsp as $jadwal)
                                                                                                                                    <option value="{{ $jadwal->ref }}" {{ $asesi->asesmen_ref == $jadwal->ref ? 'selected' : '' }}>
                                                                                                                                        {{ \Carbon\Carbon::parse($jadwal->jadwal_asesmen)->locale('id')->translatedFormat('l, d F Y') }} - {{ $jadwal->nama_skema }} (TUK: {{ $jadwal->nama_tuk }})
                                                                                                                                    </option>
                                                                                                                                @endforeach
                                                                                                                            </select> --}}

                                                                                                                            <select class="form-control select2" data-toggle="select2" name="asesmen_ref" id="asesmen_ref_{{ $asesi->ref }}">
                                                                                                                                <option value="" disabled selected>Pilih Jadwal Asesmen</option>
                                                                                                                                @php
                                                                                                                                    $semuaJadwal = \App\Models\AsesmenModel::where('nama_lsp', $asesi->asesmen->nama_lsp)
                                                                                                                                        ->has('kegiatan')
                                                                                                                                        ->with('kegiatan')
                                                                                                                                        ->withCount('asesis')
                                                                                                                                        ->orderBy('jadwal_asesmen', 'ASC')
                                                                                                                                        ->get()
                                                                                                                                        ->groupBy(function ($item) {
                                                                                                                                            return $item->kegiatan->nama_kegiatan;
                                                                                                                                        });
                                                                                                                                @endphp

                                                                                                                                @foreach ($semuaJadwal as $namaKegiatan => $jadwals)
                                                                                                                                    <optgroup label="{{ $namaKegiatan }}">
                                                                                                                                        @foreach ($jadwals as $jadwal)
                                                                                                                                            @php
                                                                                                                                                $isFull = $jadwal->asesis_count >= $jadwal->kuota_harian;
                                                                                                                                                $statusQuota = $isFull ? '(PENUH)' : '(Kuota: ' . ($jadwal->kuota_harian - $jadwal->asesis_count) . ')';
                                                                                                                                                $isSelected = $asesi->asesmen_ref == $jadwal->ref;
                                                                                                                                                $isDisabled = $isFull && !$isSelected ? 'disabled' : '';
                                                                                                                                            @endphp
                                                                                                                                            <option value="{{ $jadwal->ref }}" {{ $isSelected ? 'selected' : '' }} {{ $isDisabled }}>
                                                                                                                                                {{ \Carbon\Carbon::parse($jadwal->jadwal_asesmen)->locale('id')->translatedFormat('d F Y') }} - {{ $jadwal->nama_skema }} - {{ $jadwal->nama_tuk }} {{ $statusQuota }}
                                                                                                                                            </option>
                                                                                                                                        @endforeach
                                                                                                                                    </optgroup>
                                                                                                                                @endforeach
                                                                                                                            </select>

                                                                                                                            <small class="text-muted text-xs">Opsi jadwal disesuaikan dengan LSP pilihan Anda.</small>
                                                                                                                        </div>

                                                                                                                        {{-- File Upload Section --}}
                                                                                                                        <div class="col-12 mt-3">
                                                                                                                            <hr>
                                                                                                                            <h6 class="fw-bold">Upload Dokumen <small class="text-muted">(Kosongkan jika tidak ingin mengubah)</small></h6>
                                                                                                                        </div>

                                                                                                                        <div class="col-md-4 mt-2">
                                                                                                                            <label for="ktp_file_{{ $asesi->ref }}" class="form-label">Scan KTP (PDF)</label>
                                                                                                                            @if (!empty($asesi->ktp_file))
                                                                                                                                <br><a href="{{ route('files.asesi.ktp', $asesi->ktp_file) }}" target="_blank" class="badge bg-success mb-1"><i class="mdi mdi-file-pdf-box"></i> Lihat File</a>
                                                                                                                            @endif
                                                                                                                            <input type="file" id="ktp_file_{{ $asesi->ref }}" class="form-control rounded-3" name="ktp_file" accept=".pdf">
                                                                                                                        </div>

                                                                                                                        <div class="col-md-4 mt-2">
                                                                                                                            <label for="ijazah_file_{{ $asesi->ref }}" class="form-label">Ijazah Terakhir (PDF)</label>
                                                                                                                            @if (!empty($asesi->ijazah_file))
                                                                                                                                <br><a href="{{ route('files.asesi.ijazah', $asesi->ijazah_file) }}" target="_blank" class="badge bg-success mb-1"><i class="mdi mdi-file-pdf-box"></i> Lihat File</a>
                                                                                                                            @endif
                                                                                                                            <input type="file" id="ijazah_file_{{ $asesi->ref }}" class="form-control rounded-3" name="ijazah_file" accept=".pdf">
                                                                                                                        </div>

                                                                                                                        <div class="col-md-4 mt-2">
                                                                                                                            <label for="sertikom_file_{{ $asesi->ref }}" class="form-label">Sertifikat Kompetensi (PDF)</label>
                                                                                                                            @if (!empty($asesi->sertikom_file))
                                                                                                                                <br><a href="{{ route('files.asesi.sertikom', $asesi->sertikom_file) }}" target="_blank" class="badge bg-success mb-1"><i class="mdi mdi-file-pdf-box"></i> Lihat File</a>
                                                                                                                            @endif
                                                                                                                            <input type="file" id="sertikom_file_{{ $asesi->ref }}" class="form-control rounded-3" name="sertikom_file" accept=".pdf">
                                                                                                                        </div>

                                                                                                                        <div class="col-md-4 mt-2">
                                                                                                                            <label for="keterangan_kerja_file_{{ $asesi->ref }}" class="form-label">Surat Keterangan Kerja (PDF)</label>
                                                                                                                            @if (!empty($asesi->keterangan_kerja_file))
                                                                                                                                <br><a href="{{ route('files.asesi.skb', $asesi->keterangan_kerja_file) }}" target="_blank" class="badge bg-success mb-1"><i class="mdi mdi-file-pdf-box"></i> Lihat File</a>
                                                                                                                            @endif
                                                                                                                            <input type="file" id="keterangan_kerja_file_{{ $asesi->ref }}" class="form-control rounded-3" name="keterangan_kerja_file" accept=".pdf">
                                                                                                                        </div>

                                                                                                                        <div class="col-md-4 mt-2">
                                                                                                                            <label for="pas_foto_file_{{ $asesi->ref }}" class="form-label">Pas Foto (JPG/PNG)</label>
                                                                                                                            @if (!empty($asesi->pas_foto_file))
                                                                                                                                <br><a href="{{ route('files.asesi.pasfoto', $asesi->pas_foto_file) }}" target="_blank" class="badge bg-success mb-1"><i class="mdi mdi-file-image"></i> Lihat File</a>
                                                                                                                            @endif
                                                                                                                            <input type="file" id="pas_foto_file_{{ $asesi->ref }}" class="form-control rounded-3" name="pas_foto_file" accept=".jpg,.jpeg,.png">
                                                                                                                        </div>

                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="modal-footer">
                                                                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                                                                    <button type="submit" class="btn btn-dinas">Simpan Perubahan</button>

                                                                                                                    <input type="hidden" class="asesiID" value="{{ $asesi->ref }}">
                                                                                                                    <a href="javascript:void(0)" data-nama="{{ $asesi->nama_lengkap }}" class="btn btn-sm btn-danger deleteButton" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hapus Data Asesi" data-bs-custom-class="danger-tooltip"><i class="mdi mdi-trash-can"></i></a>
                                                                                                                </div>
                                                                                                            </form>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <!-- / END Edit Data modal -->
                                                                                            @endforeach
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Penandatangan Modals (placed outside tables to avoid collapse issues) --}}
    @foreach ($dataKegiatan->kegiatanJadwal as $kegiatan)
        <div id="penandatanganModal-{{ $kegiatan->ref }}" class="modal fade" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title">Setting Penandatangan - {{ $kegiatan->lsp->lsp_nama }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="penandatangan-ref" value="{{ $kegiatan->ref }}">
                        <div class="mb-2">
                            <label class="form-label fw-semibold">Tempat Tanda Tangan</label>
                            <input type="text" class="form-control form-control-sm penandatangan-tempat" value="{{ $kegiatan->penandatangan->tempat_ttd ?? 'Mangupura' }}">
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-semibold">Tanggal Surat</label>
                            <input type="text" class="form-control form-control-sm penandatangan-tanggal single-date" value="{{ isset($kegiatan->penandatangan->tanggal_ttd) ? \Carbon\Carbon::parse($kegiatan->penandatangan->tanggal_ttd)->format('d/m/Y') : '' }}" placeholder="Kosongkan untuk tanggal hari ini">
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-semibold">Nama Dinas</label>
                            <input type="text" class="form-control form-control-sm penandatangan-dinas" value="{{ $kegiatan->penandatangan->nama_dinas ?? 'Kepala Dinas Perindustrian dan Tenaga Kerja Kabupaten Badung' }}">
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-semibold">Jabatan Penandatangan</label>
                            <input type="text" class="form-control form-control-sm penandatangan-jabatan" value="{{ $kegiatan->penandatangan->jabatan_penandatangan ?? 'Selaku Pengguna Anggaran (PA) merangkap Pejabat Pembuat Komitmen (PPK),' }}">
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-semibold">Nama Penandatangan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm penandatangan-nama" value="{{ $kegiatan->penandatangan->nama_penandatangan ?? '' }}" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-semibold">Pangkat</label>
                            <input type="text" class="form-control form-control-sm penandatangan-pangkat" value="{{ $kegiatan->penandatangan->pangkat ?? '' }}">
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-semibold">NIP</label>
                            <input type="text" class="form-control form-control-sm penandatangan-nip" value="{{ $kegiatan->penandatangan->nip ?? '' }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-warning btn-save-penandatangan">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Add Skema Modal --}}
        <div id="addSkemaModal-{{ $kegiatan->lsp->ref }}" class="modal fade" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('kegiatan.add-skema') }}" method="POST">
                        @csrf
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Tambah Skema - {{ $kegiatan->lsp->lsp_nama }}</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="kegiatan_ref" value="{{ $dataKegiatan->ref }}">
                            <input type="hidden" name="lsp_ref" value="{{ $kegiatan->lsp->ref }}">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Pilih Skema</label>
                                <select name="skema_ref[]" class="select2-dynamic form-select" data-lsp="{{ $kegiatan->lsp->ref }}" data-assigned='@json(collect($dataSkema[$kegiatan->lsp->ref] ?? [])->pluck('ref'))' multiple="multiple" required style="width: 100%;">
                                </select>
                                <small class="text-muted d-block mt-1">Anda bisa memilih lebih dari satu skema.</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Tambahkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@push('script')
    {{-- Download Jadwal Asesmen Excel - update link on month/year change --}}
    <script>
        function updateJadwalLink(container) {
            let month = container.find('[class*="month-selector-"]').val();
            let year = container.find('[class*="year-selector-"]').val();
            let btn = container.find('.download-jadwal-btn');
            let baseUrl = btn.data('base-url');
            let ref = btn.data('ref');
            let lsp = btn.data('lsp');
            btn.attr('href', baseUrl + '?month=' + month + '&year=' + year + '&kegiatan_jadwal_ref=' + ref + '&nama_lsp=' + encodeURIComponent(lsp));
        }
        $(document).on('change', '[class*="month-selector-"], [class*="year-selector-"]', function() {
            updateJadwalLink($(this).closest('.d-flex'));
        });
    </script>
    <script>
        $(document).on('focus', '.single-date', function() {
            const modal = $(this).closest('.modal');

            $(this).daterangepicker({
                singleDatePicker: true,
                autoUpdateInput: false,
                parentEl: modal,
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });

            $(this).on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY'));
            });
        });
    </script>

    <!-- Upload Laporan Asesmen -->
    <script>
        // #### LAPORAN 1
        $(document).on('change', '.upload-laporan-asesmen', function() {
            let input = this;
            let file = this.files[0];
            let ref = $(this).data('ref');
            let index = $(this).data('index');

            if (!file) return;

            let formData = new FormData();
            formData.append('file', file);
            formData.append('ref', ref);
            formData.append('index', index)
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: "{{ route('kegiatan.uploadLaporanAsesmen') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                // beforeSend: function() {
                //     Swal.fire({
                //         title: 'Uploading...',
                //         text: 'Mohon tunggu, file sedang diupload',
                //         allowOutsideClick: false,
                //         allowEscapeKey: false,
                //         didOpen: () => {
                //             Swal.showLoading();
                //         }
                //     });
                // },

                beforeSend: function() {
                    Swal.fire({
                        title: 'Mengunggah...',
                        html: `
                            <div style="position:relative; width:100%; height:24px; background:#a3a3a3; border-radius:12px; overflow:hidden;">
                                
                                <div id="progress-bar"
                                    style="position:absolute; left:0; top:0; height:100%; width:0%; 
                                            background:#671919; transition:width 0.3s ease; z-index:1;">
                                </div>

                                <div id="progress-text"
                                    style="position:absolute; left:0; top:0; width:100%; height:100%;
                                            display:flex; align-items:center; justify-content:center;
                                            font-weight:600; color:#ffffff; z-index:2;">
                                    0%
                                </div>

                            </div>
                            <small class="mt-2 d-block">Mohon tunggu, file sedang diunggah</small>
                        `,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false
                    });
                },


                xhr: function() {
                    let xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            let percent = Math.round((evt.loaded / evt.total) * 100);

                            $('#progress-bar').css('width', percent + '%');
                            $('#progress-text').text(percent + '%');
                        }
                    }, false);
                    return xhr;
                },

                success: function(res) {
                    input.value = '';
                    Swal.fire({
                        icon: 'success',
                        text: res.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    $('#laporan-' + ref + '-' + index).html(`
                        <a href="${res.url}" target="_blank" class="text-danger fs-5">
                            <i class="mdi mdi-download"></i> Download
                        </a>
                    `);
                },

                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        text: xhr.responseJSON?.message ?? 'Upload gagal'
                    });
                }
            });
        });
    </script>

    <!-- Update no_sertifikat asesi -->
    <script>
        $(document).ready(function() {
            // Delegate click event to the document (or a parent element that won't change)
            $(document).on('click', '.edited', function() {
                var span = $(this);
                // Get the real value from data-value, not the rendered text (which might contain the placeholder icon)
                var itemText = span.attr('data-value') || '';
                var itemId = span.attr('id'); // Get the id
                var itemRef = span.attr('ref'); // Get the ref

                // Create an input field with the current text
                var input = $('<input type="text" class="form-control form-control-sm"/>').val(itemText).attr('id', itemId).attr('ref', itemRef).css({
                    width: '100%',
                    boxSizing: 'border-box'
                });

                // Replace the span with the input field
                span.replaceWith(input);

                // Focus the input field
                input.focus();

                // Handle blur event (when input loses focus)
                input.on('blur', function() {
                    var newValue = $.trim(input.val());

                    // Reconstruct the span based on whether it's empty or has a value
                    var updatedSpan = $('<span class="edited text-primary" style="cursor: pointer; border-bottom: 1px dashed #007bff; padding-bottom: 2px"></span>')
                        .attr('id', itemId)
                        .attr('ref', itemRef)
                        .attr('data-value', newValue);

                    if (newValue !== '') {
                        updatedSpan.text(newValue);
                    } else {
                        updatedSpan.html('<i class="mdi mdi-pencil-outline"></i> Isi No. Sertifikat');
                    }

                    // Replace the input back with the updated span
                    input.replaceWith(updatedSpan);

                    // Send the updated value to the server using AJAX only if it changed
                    if (itemText !== newValue) {
                        $.ajax({
                            url: "{{ route('kegiatan.sertifikatUpdate') }}",
                            type: 'POST',
                            data: {
                                id: itemId,
                                ref: itemRef,
                                value: newValue,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(res) {
                                //notif alert bisa delete aja kalo ganggu
                                Swal.fire({
                                    icon: res.success ? 'success' : 'error',
                                    text: res.message,
                                    timer: 1200,
                                    showConfirmButton: false
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    text: xhr.responseJSON?.message ?? 'Gagal menyimpan data'
                                });
                                // Optionally revert the span back to old value on error
                                updatedSpan.attr('data-value', itemText);
                                if (itemText !== '') {
                                    updatedSpan.text(itemText);
                                } else {
                                    updatedSpan.html('<i class="mdi mdi-pencil-outline"></i> Isi No. Sertifikat');
                                }
                            }
                        });
                    }
                });

            });
        });
    </script>

    <!-- Upload Bukti Asesmen -->
    <script>
        $(document).on('change', '.upload-bukti-asesmen', function() {
            let input = this;
            let file = this.files[0];
            let ref = $(this).data('ref');

            if (!file) return;

            let formData = new FormData();
            formData.append('bukti_asesmen', file);
            formData.append('ref', ref);
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: "{{ route('kegiatan.uploadBuktiAsesmen') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                beforeSend: function() {
                    Swal.fire({
                        title: 'Mengunggah...',
                        html: `
                            <div style="position:relative; width:100%; height:24px; background:#a3a3a3; border-radius:12px; overflow:hidden;">
                                
                                <div id="progress-bar"
                                    style="position:absolute; left:0; top:0; height:100%; width:0%; 
                                            background:#671919; transition:width 0.3s ease; z-index:1;">
                                </div>

                                <div id="progress-text"
                                    style="position:absolute; left:0; top:0; width:100%; height:100%;
                                            display:flex; align-items:center; justify-content:center;
                                            font-weight:600; color:#ffffff; z-index:2;">
                                    0%
                                </div>

                            </div>
                            <small class="mt-2 d-block">Mohon tunggu, file sedang diunggah</small>
                        `,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false
                    });
                },


                xhr: function() {
                    let xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            let percent = Math.round((evt.loaded / evt.total) * 100);

                            $('#progress-bar').css('width', percent + '%');
                            $('#progress-text').text(percent + '%');
                        }
                    }, false);
                    return xhr;
                },

                success: function(res) {
                    input.value = '';
                    Swal.fire({
                        icon: 'success',
                        text: res.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    $('#asesmen-' + ref).html(`
                        <a href="${res.url}" target="_blank" class="text-danger fs-5">
                            <i class="mdi mdi-download"></i> Download
                        </a>
                    `);
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        text: xhr.responseJSON?.message ?? 'Upload gagal'
                    });
                }
            });
        });
    </script>

    <!-- Upload Dokumentasi Asesmen -->
    <script>
        $(document).on('change', '.upload-dokumentasi-asesmen', function() {
            let input = this;
            let file = this.files[0];
            let ref = $(this).data('ref');

            if (!file) return;

            let formData = new FormData();
            formData.append('dokumentasi_asesmen', file);
            formData.append('ref', ref);
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: "{{ route('kegiatan.uploadDokumentasiAsesmen') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                beforeSend: function() {
                    Swal.fire({
                        title: 'Mengunggah...',
                        html: `
                            <div style="position:relative; width:100%; height:24px; background:#a3a3a3; border-radius:12px; overflow:hidden;">
                                
                                <div id="progress-bar"
                                    style="position:absolute; left:0; top:0; height:100%; width:0%; 
                                            background:#671919; transition:width 0.3s ease; z-index:1;">
                                </div>

                                <div id="progress-text"
                                    style="position:absolute; left:0; top:0; width:100%; height:100%;
                                            display:flex; align-items:center; justify-content:center;
                                            font-weight:600; color:#ffffff; z-index:2;">
                                    0%
                                </div>

                            </div>
                            <small class="mt-2 d-block">Mohon tunggu, file sedang diunggah</small>
                        `,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false
                    });
                },


                xhr: function() {
                    let xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            let percent = Math.round((evt.loaded / evt.total) * 100);

                            $('#progress-bar').css('width', percent + '%');
                            $('#progress-text').text(percent + '%');
                        }
                    }, false);
                    return xhr;
                },

                success: function(res) {
                    input.value = '';
                    Swal.fire({
                        icon: 'success',
                        text: res.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    $('#dokumentasi-' + ref).html(`
                        <a href="${res.url}" target="_blank" class="text-danger fs-5">
                            <i class="mdi mdi-download"></i> Download
                        </a>
                    `);
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        text: xhr.responseJSON?.message ?? 'Upload gagal'
                    });
                }
            });
        });
    </script>

    <!-- Upload Bukti Terima Sertifikat -->
    <script>
        $(document).on('change', '.upload-bukti-terima', function() {
            let input = this;
            let file = this.files[0];
            let ref = $(this).data('ref');

            if (!file) return;

            let formData = new FormData();
            formData.append('bukti_terima_sertifikat', file);
            formData.append('ref', ref);
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: "{{ route('kegiatan.uploadBuktiTerimaSertifikat') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                beforeSend: function() {
                    Swal.fire({
                        title: 'Mengunggah...',
                        html: `
                            <div style="position:relative; width:100%; height:24px; background:#a3a3a3; border-radius:12px; overflow:hidden;">
                                
                                <div id="progress-bar"
                                    style="position:absolute; left:0; top:0; height:100%; width:0%; 
                                            background:#671919; transition:width 0.3s ease; z-index:1;">
                                </div>

                                <div id="progress-text"
                                    style="position:absolute; left:0; top:0; width:100%; height:100%;
                                            display:flex; align-items:center; justify-content:center;
                                            font-weight:600; color:#ffffff; z-index:2;">
                                    0%
                                </div>

                            </div>
                            <small class="mt-2 d-block">Mohon tunggu, file sedang diunggah</small>
                        `,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false
                    });
                },


                xhr: function() {
                    let xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            let percent = Math.round((evt.loaded / evt.total) * 100);

                            $('#progress-bar').css('width', percent + '%');
                            $('#progress-text').text(percent + '%');
                        }
                    }, false);
                    return xhr;
                },

                success: function(res) {
                    input.value = '';
                    Swal.fire({
                        icon: 'success',
                        text: res.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    $('#bukti-terima-' + ref).html(`
                        <a href="${res.url}" target="_blank" class="text-danger fs-5">
                            <i class="mdi mdi-download"></i> Download
                        </a>
                    `);
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        text: xhr.responseJSON?.message ?? 'Upload gagal'
                    });
                }
            });
        });
    </script>

    <!-- Upload sertifikat -->
    <script>
        $(document).on('change', '.upload-sertifikat', function() {
            let input = this;
            let file = this.files[0];
            let ref = $(this).data('ref');

            if (!file) return;

            let formData = new FormData();
            formData.append('sertifikat_file', file);
            formData.append('ref', ref);
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: "{{ route('kegiatan.uploadSertifikat') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    input.value = '';
                    Swal.fire({
                        icon: 'success',
                        text: res.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    $('#sertifikat-' + ref).html(`
                        <a href="${res.url}" target="_blank" class="text-danger fs-5">
                            <i class="mdi mdi-download"></i> Download
                        </a>
                    `);
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        text: xhr.responseJSON?.message ?? 'Upload gagal'
                    });
                }
            });
        });
    </script>

    {{-- Sweet Alert --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.deleteButton').forEach(button => {

                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const row = this.closest('tr');
                    const dataNama = this.dataset.nama;
                    const dataID = this.closest('td').querySelector('.dataID').value;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: `Hapus jadwal asesmen pada hari ${dataNama}?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                    }).then(result => {

                        if (!result.isConfirmed) return;

                        fetch(`/asesmen/${dataID}`, {
                                method: 'DELETE',
                                credentials: 'same-origin',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'X-Requested-With': 'XMLHttpRequest',
                                }
                            })
                            .then(() => {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: 'Jadwal asesmen berhasil dihapus',
                                    icon: 'success',
                                    timer: 1200,
                                    showConfirmButton: false
                                });
                                row.style.transition = 'opacity 0.3s';
                                row.style.opacity = 0;
                                setTimeout(() => row.remove(), 300);
                            })
                            .catch(err => {
                                console.error(err);
                                Swal.fire('Error', 'Request gagal dikirim ke server', 'error');
                            });
                    });
                });

            });

        });
    </script>

    <!-- Save Penandatangan -->
    <script>
        $(document).on('click', '.btn-save-penandatangan', function() {
            let modal = $(this).closest('.modal');
            let ref = modal.find('.penandatangan-ref').val();
            let nama = modal.find('.penandatangan-nama').val();

            if (!nama) {
                Swal.fire({
                    icon: 'warning',
                    text: 'Nama Penandatangan wajib diisi'
                });
                return;
            }

            $.ajax({
                url: "{{ route('kegiatan.storePenandatangan') }}",
                type: 'POST',
                data: {
                    kegiatan_jadwal_ref: ref,
                    tempat_ttd: modal.find('.penandatangan-tempat').val(),
                    tanggal_ttd: modal.find('.penandatangan-tanggal').val() ? moment(modal.find('.penandatangan-tanggal').val(), 'DD/MM/YYYY').format('YYYY-MM-DD') : '',
                    nama_dinas: modal.find('.penandatangan-dinas').val(),
                    jabatan_penandatangan: modal.find('.penandatangan-jabatan').val(),
                    nama_penandatangan: nama,
                    pangkat: modal.find('.penandatangan-pangkat').val(),
                    nip: modal.find('.penandatangan-nip').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    modal.modal('hide');
                    Swal.fire({
                        icon: 'success',
                        text: res.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        text: xhr.responseJSON?.message ?? 'Gagal menyimpan data'
                    });
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Saat halaman sudah ready
            const deleteButtons = document.querySelectorAll('.deleteButton');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    let propertyName = this.getAttribute('data-nama');
                    let asesiID = this.parentElement.querySelector('.asesiID').value;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete data " + propertyName + "?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Kirim DELETE request manual lewat JavaScript
                            fetch('/asesiAdmin/' + asesiID, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    Swal.fire({
                                        title: data.judul,
                                        text: data.pesan,
                                        icon: data.type,
                                    });

                                    // Optional: reload table / halaman
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1500);
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire('Error', 'Something went wrong!',
                                        'error');
                                });
                        }
                    });
                });
            });
        });

        // ==========================================
        // FITUR TAMBAH DAN HAPUS SKEMA PER-LSP
        // ==========================================

        $(document).ready(function() {
            // Load dropdown options untuk Tambah Skema saat Modal dibuka
            $('.modal').on('show.bs.modal', function(e) {
                var $modal = $(this);
                var $select = $modal.find('.select2-dynamic');

                if ($select.length > 0 && !$select.hasClass('loaded')) {
                    var lspRef = $select.data('lsp');
                    $select.html('<option disabled>Loading skema...</option>');

                    $.ajax({
                        url: '/ajax/skema-by-lsp/' + lspRef,
                        type: 'GET',
                        success: function(res) {
                            var assignedRefs = $select.data('assigned') || [];
                            var options = '';
                            res.forEach(function(item) {
                                if (!assignedRefs.includes(item.ref)) {
                                    options += '<option value="' + item.ref + '">' + item.skema_judul + '</option>';
                                }
                            });

                            if (options === '') {
                                $select.html('<option disabled>Seluruh skema LSP ini sudah ditambahkan (tidak ada skema baru)</option>');
                            } else {
                                $select.html(options);
                            }

                            $select.select2({
                                dropdownParent: $modal,
                                placeholder: '--- Pilih Skema yang ingin ditambahkan ---',
                                allowClear: true
                            });
                            $select.addClass('loaded');
                        },
                        error: function() {
                            $select.html('<option disabled>Gagal mengambil data</option>');
                        }
                    });
                }
            });

            // Handle fungsi Hapus Skema
            $(document).on('click', '.btn-remove-skema', function(e) {
                e.preventDefault();
                let lsp_ref = $(this).data('lsp');
                let skema_ref = $(this).data('skema');
                let skema_nama = $(this).data('namaskema');
                let kegiatan_ref = '{{ $dataKegiatan->ref }}';

                Swal.fire({
                    title: 'Hapus Skema?',
                    text: 'Anda yakin ingin menghapus skema "' + skema_nama + '" dari LSP ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('kegiatan.remove-skema') }}',
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                                kegiatan_ref: kegiatan_ref,
                                lsp_ref: lsp_ref,
                                skema_ref: skema_ref
                            },
                            success: function(res) {
                                Swal.fire({
                                    icon: res.type,
                                    title: res.judul,
                                    text: res.pesan,
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(err) {
                                Swal.fire('Error', 'Gagal menghapus skema', 'error');
                            }
                        });
                    }
                });
            });

            // Re-initialize Select2 untuk Modal (Mencegah Focus Trap Bug)
            $('.modal').on('shown.bs.modal', function() {
                var $modal = $(this);
                $modal.find('select[name="asesmen_ref"]').each(function() {
                    $(this).select2({
                        dropdownParent: $modal,
                        width: '100%'
                    });
                });
            });
        });
    </script>

    <!--  Select2 Plugin Js -->
    <script src="{{ asset('admin') }}/assets/vendor/select2/js/select2.min.js"></script>
@endpush
