@extends('admin-panel.layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header bg-dinas text-white">
                            <h4 class=".card-title">Tambah Skema & Kode Unit</h4>
                            <p class="mb-0">Tambahkan data Skema & Kode Unit pada form berikut</p>
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
                            <form action="{{ route('skema.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 mt-2">
                                        <label for="lsp_nama" class="form-label">Nama LSP</label>
                                        <input type="text" id="lsp_nama" class="form-control rounded-3" name="lsp_nama" value="{{ $dataLsp->lsp_nama }}" disabled>
                                    </div>

                                    <div class="col-lg-6 mt-2">
                                        <label for="lsp_nama" class="form-label">No Lisensi</label>
                                        <input type="text" id="lsp_nama" class="form-control rounded-3" name="lsp_nama" value="{{ $dataLsp->lsp_no_lisensi }}" disabled>
                                    </div>

                                    <div class="col-lg-6 mt-2">
                                        <label for="skema_judul" class="form-label">Judul Skema</label>
                                        <input type="text" id="skema_judul" class="form-control rounded-3 @error('skema_judul', 'create_skema') is-invalid @enderror" name="skema_judul" value="{{ old('skema_judul') }}">
                                        @error('skema_judul', 'create_skema')
                                            <div class="invalid-feedback" bis_skin_checked="1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 mt-2">
                                        <label for="skema_kode" class="form-label">Kode Skema</label>
                                        <input type="text" id="skema_kode" class="form-control rounded-3 @error('skema_kode', 'create_skema') is-invalid @enderror" name="skema_kode" value="{{ old('skema_kode') }}">
                                        @error('skema_kode', 'create_skema')
                                            <div class="invalid-feedback" bis_skin_checked="1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 mt-2">
                                        <label for="skema_kategori" class="form-label">Kategori Skema</label>
                                        <select class="text-capitalize @error('skema_kategori', 'create_skema') is-invalid @enderror rounded-3 form-select" id="skema_kategori" name="skema_kategori">
                                            <option value="#" disabled selected hidden>Pilih Kategori Skema</option>
                                            <option value="KKNI" {{ old('skema_kategori') === 'KKNI' ? 'selected' : '' }}>KKNI</option>
                                            <option value="Okupasi" {{ old('skema_kategori') === 'Okupasi' ? 'selected' : '' }}>Okupasi</option>
                                            <option value="Klaster" {{ old('skema_kategori') === 'Klaster' ? 'selected' : '' }}>Klaster</option>
                                        </select>
                                        @error('skema_kategori', 'create_skema')
                                            <div class="invalid-feedback" bis_skin_checked="1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 mt-3">
                                    <button class="btn btn-dinas" type="submit">Tambah Skema</button>
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
