@extends('admin-panel.layouts.app')
@push('style')
@endpush
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class=".card-title">Create Skema & Kode Unit</h4>
                            <p class="text-muted mb-0">Tambahkan data Skema & Kode Unit pada form berikut</p>
                        </div>
                        @php
                            $activeTab = session('active_tab', 'create_skema');
                            if ($errors->getBag('create_kode_unit')->any()) {
                                $activeTab = 'create_kode_unit';
                            } elseif ($errors->getBag('create_skema')->any()) {
                                $activeTab = 'create_skema';
                            }
                        @endphp
                        <div class="card-body">
                            <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                                <li class="nav-item">
                                    <a href="#create_skema" data-bs-toggle="tab" class="nav-link rounded-0 {{ $activeTab === 'create_skema' ? 'active' : '' }}">
                                        Tambah Skema Baru
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#create_kode_unit" data-bs-toggle="tab" class="nav-link rounded-0 {{ $activeTab === 'create_kode_unit' ? 'active' : '' }}">
                                        Tambah Kode Unit
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade {{ $activeTab === 'create_skema' ? 'show active' : '' }}" id="create_skema">
                                    <form action="{{ route('skema.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6 mt-2">
                                                <label for="lsp_nama" class="form-label">Nama LSP</label>
                                                <input type="text" id="lsp_nama" class="form-control" name="lsp_nama" value="{{ $dataLsp->lsp_nama }}" disabled>
                                            </div>

                                            <div class="col-lg-6 mt-2">
                                                <label for="lsp_nama" class="form-label">No Lisensi</label>
                                                <input type="text" id="lsp_nama" class="form-control" name="lsp_nama" value="{{ $dataLsp->lsp_no_lisensi }}" disabled>
                                            </div>

                                            <div class="col-lg-6 mt-2">
                                                <label for="skema_judul" class="form-label">Judul Skema</label>
                                                <input type="text" id="skema_judul" class="form-control @error('skema_judul', 'create_skema') is-invalid @enderror" name="skema_judul" value="{{ old('skema_judul') }}">
                                                @error('skema_judul', 'create_skema')
                                                    <div class="invalid-feedback" bis_skin_checked="1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-6 mt-2">
                                                <label for="skema_kode" class="form-label">Kode Skema</label>
                                                <input type="text" id="skema_kode" class="form-control @error('skema_kode', 'create_skema') is-invalid @enderror" name="skema_kode" value="{{ old('skema_kode') }}">
                                                @error('skema_kode', 'create_skema')
                                                    <div class="invalid-feedback" bis_skin_checked="1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-6 mt-2">
                                                <label for="skema_kategori" class="form-label">Kategori Skema</label>
                                                <select class="text-capitalize @error('skema_kategori', 'create_skema') is-invalid @enderror form-select" id="skema_kategori" name="skema_kategori">
                                                    <option value="#" disabled selected hidden>Pilih Kategori Skema</option>
                                                    <option value="KKNI" {{ old('skema_kategori') === 'KKNI' ? 'selected' : '' }}>KKNI</option>
                                                    <option value="Okupasi" {{ old('skema_kategori') === 'Okupasi' ? 'selected' : '' }}>Okupasi</option>
                                                    <option value="Klaster" {{ old('skema_kategori') === 'Klaster' ? 'selected' : '' }}>Klaster</option>
                                                    <option value="Unit Kompetensi" {{ old('skema_kategori') === 'Unit Kompetensi' ? 'selected' : '' }}>Unit Kompetensi</option>
                                                    <option value="Profisiensi" {{ old('skema_kategori') === 'Profisiensi' ? 'selected' : '' }}>Profisiensi</option>
                                                </select>
                                                @error('skema_kategori', 'create_skema')
                                                    <div class="invalid-feedback" bis_skin_checked="1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3 mt-3">
                                            <button class="btn btn-primary" type="submit">Tambah Skema</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade {{ $activeTab === 'create_kode_unit' ? 'show active' : '' }}" id="create_kode_unit">
                                    <form action="{{ route('kode_unit.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12 mt-2">
                                                <label for="lsp_nama" class="form-label">Nama LSP</label>
                                                <input type="text" id="lsp_nama" class="form-control" name="lsp_nama" value="{{ $dataLsp->lsp_nama }}" disabled>
                                            </div>

                                            <div class="col-lg-12 mt-2">
                                                <label for="skema_ref" class="form-label">Skema</label>
                                                <select class="text-capitalize @error('skema_ref', 'create_kode_unit') is-invalid @enderror form-select" id="skema_ref" name="skema_ref">
                                                    <option value="#" disabled selected hidden>Pilih Skema LSP Anda</option>
                                                    @foreach ($dataSkema as $skema)
                                                        <option value="{{ $skema->ref }}" {{ old('skema_ref') === $skema->ref ? 'selected' : '' }}>{{ $skema->skema_judul }}</option>
                                                    @endforeach
                                                </select>
                                                @error('skema_ref', 'create_kode_unit')
                                                    <div class="invalid-feedback" bis_skin_checked="1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-12">
                                                <div id="kegiatan-container">
                                                    <div class="card border-secondary mt-4">
                                                        <div class="card-body">
                                                            <div class="row g-3" id="kegiatan-row">
                                                                <div class="col-lg-6">
                                                                    <label class="form-label">Judul Unit</label>
                                                                    <input type="text" class="form-control @error('judul_unit.*', 'create_kode_unit') is-invalid @enderror" name="judul_unit[]" value="{{ old('judul_unit.0') }}">
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <label class="form-label">Kode Unit</label>
                                                                    <input type="text" class="form-control @error('kode_unit.*', 'create_kode_unit') is-invalid @enderror" name="kode_unit[]" value="{{ old('kode_unit.0') }}">
                                                                </div>
                                                            </div>

                                                            <div class="d-flex mt-3 gap-2">
                                                                <button type="button" class="btn btn-sm btn-primary add-kegiatan-btn">
                                                                    + Tambah Unit
                                                                </button>

                                                                <button type="button" class="btn btn-sm btn-danger remove-kegiatan-btn d-none">
                                                                    Hapus
                                                                </button>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>

                                                {{-- error summary --}}
                                                @error('judul_unit.*', 'create_kode_unit')
                                                    <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                                @error('kode_unit.*', 'create_kode_unit')
                                                    <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="mb-3 mt-3">
                                            <button class="btn btn-primary" type="submit">Tambahkan Kode Unit Baru</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const container = document.getElementById('kegiatan-container');

            container.addEventListener('click', function(e) {

                // ========== TAMBAH UNIT ==========
                if (e.target.classList.contains('add-kegiatan-btn')) {
                    const cardBody = e.target.closest('.card-body');
                    const rows = cardBody.querySelectorAll('.row.g-3');
                    const lastRow = rows[rows.length - 1];

                    // clone row terakhir
                    const clone = lastRow.cloneNode(true);

                    // reset value & error
                    clone.querySelectorAll('input').forEach(input => {
                        input.value = '';
                        input.classList.remove('is-invalid');
                    });

                    clone.classList.add('mt-1');

                    cardBody.insertBefore(clone, cardBody.querySelector('.d-flex'));

                    // 👉 TAMPILKAN tombol hapus
                    cardBody.querySelector('.remove-kegiatan-btn')
                        .classList.remove('d-none');
                }

                // ========== HAPUS UNIT ==========
                if (e.target.classList.contains('remove-kegiatan-btn')) {

                    const cardBody = e.target.closest('.card-body');
                    const rows = cardBody.querySelectorAll('.row.g-3');

                    if (rows.length > 1) {
                        rows[rows.length - 1].remove();
                    }

                    // 👉 sembunyikan lagi kalau tinggal 1
                    if (cardBody.querySelectorAll('.row.g-3').length === 1) {
                        e.target.classList.add('d-none');
                    }
                }

            });

        });
    </script>
@endpush
