@extends('admin-panel.layouts.app')
@push('style')
    {{-- <link href="{{ asset('admin') }}/assets/vendor/select2/css/select2.min.css" rel="stylesheet" type="text/css" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> --}}

    <!-- Daterangepicker css -->
    <link href="{{ asset('admin') }}/assets/vendor/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />

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
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class=".card-title">Create Data Kegiatan</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                                            <input type="text" id="nama_kegiatan" name="nama_kegiatan" class="form-control rounded-3 @error('nama_kegiatan', 'create_kegiatan') is-invalid @enderror" value="{{ old('nama_kegiatan') }}">

                                            @error('nama_kegiatan', 'create_kegiatan')
                                                <div class="invalid-feedback" bis_skin_checked="1">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label for="mulai_kegiatan" class="form-label">Tanggal Mulai Kegiatan</label>
                                        <input type="date" class="form-control rounded-3 @error('mulai_kegiatan', 'create_kegiatan') is-invalid @enderror" name="mulai_kegiatan" value="{{ old('mulai_kegiatan') }}">

                                        @error('mulai_kegiatan', 'create_kegiatan')
                                            <div class="invalid-feedback" bis_skin_checked="1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label for="selesai_kegiatan" class="form-label">Tanggal Selesai Kegiatan</label>
                                        <input type="date" class="form-control rounded-3 @error('selesai_kegiatan', 'create_kegiatan') is-invalid @enderror" name="selesai_kegiatan" value="{{ old('selesai_kegiatan') }}">

                                        @error('selesai_kegiatan', 'create_kegiatan')
                                            <div class="invalid-feedback" bis_skin_checked="1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3 mt-3">
                                    <button class="btn btn-primary" type="submit"><i class="ri-add-box-fill"></i> Add New Kegiatan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>

        <div class="container-fluid">

            <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class=".card-title">Masukkan LSP ke Kegiatan</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <label for="select_kegiatan" class="form-label">Pilih Kegiatan</label>
                                        <select id="select_kegiatan" class="form-select" name="select_kegiatan">
                                            <option value="" selected disabled>Pilih Kegiatan</option>
                                            @foreach ($dataKegiatan as $kegiatan)
                                                <option value="{{ $kegiatan->ref }}">{{ $kegiatan->nama_kegiatan }}</option>
                                            @endforeach
                                        </select>

                                        @error('select_kegiatan')
                                            <div class="invalid-feedback" bis_skin_checked="1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card border-secondary border">
                                            <div class="card-body kegiatan-item">
                                                <div id="kegiatan-container">
                                                    <!-- Item pertama -->
                                                    <div class="align-items-end kegiatan-row mb-3">

                                                        <div class="row kegiatan-row mb-3">
                                                            <div class="col-lg-3">
                                                                <label class="form-label">Nama LSP</label>
                                                                <select class="lsp-select form-select" name="lsp_ref[]">
                                                                    <option value="" disabled selected>Pilih LSP</option>
                                                                    @foreach ($dataLSP as $lsp)
                                                                        <option value="{{ $lsp->ref }}">{{ $lsp->lsp_nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-lg-5">
                                                                <label class="form-label">Skema</label>
                                                                <select class="form-control select2 skema-select" name="skema_ref[][]" multiple disabled>
                                                                </select>
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <label class="form-label">Kuota</label>
                                                                <input type="number" class="form-control" name="kuota[]">
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <label class="form-label">Tanggal</label>
                                                                <input type="text" class="form-control daterangepicker-input" name="date_range[]">
                                                            </div>
                                                        </div>

                                                        <div class="row kegiatan-row mb-3">
                                                            <div class="col-lg-3">
                                                                <label class="form-label">Nama LSP</label>
                                                                <select class="lsp-select form-select" name="lsp_ref[]">
                                                                    <option value="" disabled selected>Pilih LSP</option>
                                                                    @foreach ($dataLSP as $lsp)
                                                                        <option value="{{ $lsp->ref }}">{{ $lsp->lsp_nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-lg-5">
                                                                <label class="form-label">Skema</label>
                                                                <select class="form-control select2 skema-select" name="skema_ref[][]" multiple disabled>
                                                                </select>
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <label class="form-label">Kuota</label>
                                                                <input type="number" class="form-control" name="kuota[]">
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <label class="form-label">Tanggal</label>
                                                                <input type="text" class="form-control daterangepicker-input" name="date_range[]">
                                                            </div>
                                                        </div>

                                                        <div class="row kegiatan-row mb-3">
                                                            <div class="col-lg-3">
                                                                <label class="form-label">Nama LSP</label>
                                                                <select class="lsp-select form-select" name="lsp_ref[]">
                                                                    <option value="" disabled selected>Pilih LSP</option>
                                                                    @foreach ($dataLSP as $lsp)
                                                                        <option value="{{ $lsp->ref }}">{{ $lsp->lsp_nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-lg-5">
                                                                <label class="form-label">Skema</label>
                                                                <select class="form-control select2 skema-select" name="skema_ref[][]" multiple disabled>
                                                                </select>
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <label class="form-label">Kuota</label>
                                                                <input type="number" class="form-control" name="kuota[]">
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <label class="form-label">Tanggal</label>
                                                                <input type="text" class="form-control daterangepicker-input" name="date_range[]">
                                                            </div>
                                                        </div>

                                                        <div class="row kegiatan-row mb-3">
                                                            <div class="col-lg-3">
                                                                <label class="form-label">Nama LSP</label>
                                                                <select class="lsp-select form-select" name="lsp_ref[]">
                                                                    <option value="" disabled selected>Pilih LSP</option>
                                                                    @foreach ($dataLSP as $lsp)
                                                                        <option value="{{ $lsp->ref }}">{{ $lsp->lsp_nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-lg-5">
                                                                <label class="form-label">Skema</label>
                                                                <select class="form-control select2 skema-select" name="skema_ref[][]" multiple disabled>
                                                                </select>
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <label class="form-label">Kuota</label>
                                                                <input type="number" class="form-control" name="kuota[]">
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <label class="form-label">Tanggal</label>
                                                                <input type="text" class="form-control daterangepicker-input" name="date_range[]">
                                                            </div>
                                                        </div>

                                                        <div class="row kegiatan-row mb-3">
                                                            <div class="col-lg-3">
                                                                <label class="form-label">Nama LSP</label>
                                                                <select class="lsp-select form-select" name="lsp_ref[]">
                                                                    <option value="" disabled selected>Pilih LSP</option>
                                                                    @foreach ($dataLSP as $lsp)
                                                                        <option value="{{ $lsp->ref }}">{{ $lsp->lsp_nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-lg-5">
                                                                <label class="form-label">Skema</label>
                                                                <select class="form-control select2 skema-select" name="skema_ref[][]" multiple disabled>
                                                                </select>
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <label class="form-label">Kuota</label>
                                                                <input type="number" class="form-control" name="kuota[]">
                                                            </div>

                                                            <div class="col-lg-2">
                                                                <label class="form-label">Tanggal</label>
                                                                <input type="text" class="form-control daterangepicker-input" name="date_range[]">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 mt-3">
                                    <button class="btn btn-primary" type="submit"><i class="ri-save-2-fill"></i> Simpan Data</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>

    </div>
@endsection
@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> --}}
    {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> --}}

    <!-- Daterangepicker Plugin js -->
    <script src="{{ asset('admin') }}/assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/daterangepicker/daterangepicker.js"></script>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {

            const lspSelect = document.getElementById('lsp_select');
            const skemaSelect = $('#skema_select1');

            // init select2
            skemaSelect.select2({
                placeholder: 'Pilih Skema',
                width: '100%'
            });

            lspSelect.addEventListener('change', function() {

                const lspRef = this.value;

                // reset skema
                skemaSelect.empty()
                    .append('<option value="">Loading...</option>')
                    .prop('disabled', true)
                    .trigger('change');

                if (!lspRef) return;

                fetch(`/ajax/skema-by-lsp/${lspRef}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {

                        skemaSelect.empty();

                        if (data.length === 0) {
                            skemaSelect.append('<option value="">Tidak ada skema</option>');
                        } else {
                            data.forEach(skema => {
                                skemaSelect.append(
                                    `<option value="${skema.ref}">
                            ${skema.skema_judul}
                         </option>`
                                );
                            });
                        }

                        skemaSelect.prop('disabled', false).trigger('change');
                    })
                    .catch(() => {
                        skemaSelect.empty()
                            .append('<option value="">Gagal memuat data</option>');
                    });
            });

        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const container = document.getElementById('kegiatan-container');

            // init select2 & daterangepicker
            function initPlugins(scope) {
                $(scope).find('.select2').select2({
                    width: '100%'
                });
                $(scope).find('.daterangepicker-input').daterangepicker({
                    locale: {
                        // format: 'YYYY-MM-DD'
                        format: 'DD-MM-YYYY'
                    }
                });
            }

            initPlugins(container);

            // 🔥 LSP CHANGE → LOAD SKEMA (PER ROW)
            container.addEventListener('change', function(e) {

                if (!e.target.classList.contains('lsp-select')) return;

                const row = e.target.closest('.kegiatan-row');
                const skemaSelect = $(row).find('.skema-select');

                skemaSelect.prop('disabled', true).empty();

                const lspRef = e.target.value;
                if (!lspRef) return;

                fetch(`/ajax/skema-by-lsp/${lspRef}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(skema => {
                            skemaSelect.append(
                                `<option value="${skema.ref}">
                        ${skema.skema_judul}
                    </option>`
                            );
                        });

                        skemaSelect.prop('disabled', false).trigger('change');
                    })
                    .catch(() => {
                        skemaSelect.append('<option value="">Gagal memuat skema</option>');
                    });
            });

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const container = document.getElementById('kegiatan-container');

            function getSelectedLSPs() {
                return Array.from(
                        container.querySelectorAll('.lsp-select')
                    )
                    .map(select => select.value)
                    .filter(val => val); // buang kosong
            }

            function updateLspOptions() {
                const selected = getSelectedLSPs();

                container.querySelectorAll('.lsp-select').forEach(select => {
                    const currentValue = select.value;

                    select.querySelectorAll('option').forEach(option => {
                        if (!option.value) return;

                        // disable jika sudah dipilih di row lain
                        if (selected.includes(option.value) && option.value !== currentValue) {
                            option.disabled = true;
                            option.hidden = true;
                        } else {
                            option.disabled = false;
                            option.hidden = false;
                        }
                    });
                });
            }

            // 🔄 Saat LSP berubah
            container.addEventListener('change', function(e) {
                if (e.target.classList.contains('lsp-select')) {
                    updateLspOptions();
                }
            });

            // 🔄 Saat row baru ditambahkan (panggil manual)
            window.updateLspOptions = updateLspOptions;

            // Init pertama
            updateLspOptions();
        });
    </script>
@endpush
