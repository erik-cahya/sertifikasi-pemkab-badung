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
                                            <label for="namaLengkap" class="form-label">Nama Kegiatan</label>
                                            <input type="text" id="namaLengkap" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <!-- Container untuk kegiatan yang akan ditambahkan -->
                                        <div class="card border-secondary border">
                                            <div class="card-body kegiatan-item">
                                                <div id="kegiatan-container">
                                                    <!-- Item pertama -->
                                                    <div class="row align-items-end kegiatan-row mb-3">



                                                        <div class="col-lg-3">
                                                            <label for="skema_kategori" class="form-label">Nama LSP</label>
                                                            <select id="lsp_select" class="form-select" name="lsp_ref">
                                                                <option value="" selected disabled>Pilih LSP</option>
                                                                @foreach ($dataLSP as $lsp)
                                                                    <option value="{{ $lsp->ref }}">{{ $lsp->lsp_nama }}</option>
                                                                @endforeach
                                                            </select>

                                                            @error('skema_kategori', 'create_skema')
                                                                <div class="invalid-feedback" bis_skin_checked="1">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        <div class="col-lg-5">
                                                            <div class="">
                                                                <label class="form-label">Skema</label>
                                                                <select id="skema_select" class="select2 select2-multiple form-control" multiple="multiple" name="skema_ref" disabled>
                                                                    <option value="">Pilih Skema</option>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="col-lg-1">
                                                            <div class="">
                                                                <label class="form-label">Kuota</label>
                                                                <input type="number" class="form-control" name="kuota[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="">
                                                                <label class="form-label">Tanggal</label>
                                                                <input type="text" class="form-control daterangepicker-input" data-toggle="daterangepicker" data-options='{"singleDatePicker": false, "locale": {"format": "YYYY-MM-DD"}}' name="date_range[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <div class="d-grid">
                                                                <button type="button" class="btn btn-outline-danger btn-sm remove-kegiatan-btn" disabled>
                                                                    <i class="fas fa-trash"></i> Hapus
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <button type="button" class="btn btn-sm btn-primary" id="add-kegiatan-btn">
                                                        <i class="fas fa-plus"></i> Add New Kegiatan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Tombol untuk menambah kegiatan baru -->
                                    </div>
                                </div>
                                <div class="mb-3 mt-3">
                                    <button class="btn btn-primary" type="submit">Add New User</button>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const lspSelect = document.getElementById('lsp_select');
            const skemaSelect = $('#skema_select');

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
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const kegiatanContainer = document.getElementById('kegiatan-container');
            const addButton = document.getElementById('add-kegiatan-btn');
            let rowCounter = 0; // Counter untuk index array

            // Fungsi untuk menginisialisasi semua plugin
            function initializeAllPlugins(element, index) {
                // Select2 dengan name yang sesuai index
                $(element).find('.select2-multiple').select2({
                    width: '100%',
                    // placeholder: 'Pilih skema',
                    allowClear: true
                });

                // Daterangepicker
                $(element).find('.daterangepicker-input').daterangepicker({
                    singleDatePicker: false,
                    locale: {
                        format: 'YYYY-MM-DD',
                        separator: ' - '
                    }
                });
            }

            // Template untuk kegiatan baru dengan index dinamis
            function createKegiatanItem(index) {
                return `
                    <div class="row align-items-end mb-3 kegiatan-row" data-index="${index}">
                        <div class="col-lg-3">
                            <div class="">
                                <label class="form-label">Nama LSP</label>
                                <input type="text" class="form-control" name="nama_lsp[${index}]">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="">
                                <label class="form-label">Skema</label>
                                <select class="select2-multiple form-control" name="skema[${index}][]" multiple="multiple">
                                    <option value="Teknisi Refrigerasi Domestik">Teknisi Refrigerasi Domestik</option>
                                    <option value="Perawatan Mesin Pendingin / AC">Perawatan Mesin Pendingin / AC</option>
                                    <option value="Pelaksanaan Instalasi AC">Pelaksanaan Instalasi AC</option>
                                    <option value="Teknisi Lemari Pendingin">Teknisi Lemari Pendingin</option>
                                    <option value="Mekanik Heating, Ventilation Dan Air Condition (HVAC)">Mekanik Heating, Ventilation Dan Air Condition (HVAC)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="">
                                <label class="form-label">Kuota</label>
                                <input type="number" class="form-control" name="kuota[${index}]" min="0">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="">
                                <label class="form-label">Tanggal</label>
                                <input type="text" class="form-control daterangepicker-input" 
                                    name="date_range[${index}]"
                                    placeholder="Pilih rentang tanggal">
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="d-grid">
                                <button type="button" class="btn btn-outline-danger btn-sm remove-kegiatan-btn">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            }

            // Inisialisasi baris pertama
            if (document.querySelector('.kegiatan-row')) {
                initializeAllPlugins(document.querySelector('.kegiatan-row'), rowCounter);
                rowCounter++;
            }

            // Event listener untuk tombol Add New Kegiatan
            addButton.addEventListener('click', function() {
                const newKegiatan = createKegiatanItem(rowCounter);
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = newKegiatan;

                const newRow = tempDiv.firstElementChild;
                kegiatanContainer.appendChild(newRow);

                // Inisialisasi plugins
                initializeAllPlugins(newRow, rowCounter);

                // Event listener untuk tombol hapus
                newRow.querySelector('.remove-kegiatan-btn').addEventListener('click', function() {
                    const row = this.closest('.kegiatan-row');
                    $(row).find('.select2-multiple').select2('destroy');
                    $(row).find('.daterangepicker-input').off().removeData();
                    row.remove();

                    // Update index untuk semua baris setelah yang dihapus
                    updateIndexes();
                });

                rowCounter++;
            });

            // Fungsi untuk mengupdate index setelah penghapusan
            function updateIndexes() {
                const rows = document.querySelectorAll('.kegiatan-row');
                rows.forEach((row, index) => {
                    row.dataset.index = index;

                    // Update semua nama input dalam baris
                    row.querySelectorAll('[name^="kegiatan_name"]').forEach(input => {
                        input.name = `kegiatan_name[${index}]`;
                    });

                    row.querySelectorAll('[name^="lsp"]').forEach(select => {
                        select.name = `lsp[${index}][]`;
                    });

                    row.querySelectorAll('[name^="kuota"]').forEach(input => {
                        input.name = `kuota[${index}]`;
                    });

                    row.querySelectorAll('[name^="date_range"]').forEach(input => {
                        input.name = `date_range[${index}]`;
                    });
                });

                // Update rowCounter
                rowCounter = rows.length;
            }
        });
    </script>
@endpush
