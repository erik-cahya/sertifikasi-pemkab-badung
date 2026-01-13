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
                                                        <div class="col-lg-2">
                                                            <div class="">
                                                                <label class="form-label">Nama LSP</label>
                                                                <input type="text" class="form-control kegiatan-nama" name="kegiatan_name[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="">
                                                                <label class="form-label">Skema</label>
                                                                <select class="select2 form-control select2-multiple" data-toggle="select2" name="skema[][]" multiple="multiple">
                                                                    <option value="Teknisi Refrigerasi Domestik">Teknisi Refrigerasi Domestik</option>
                                                                    <option value="Perawatan Mesin Pendingin / AC">Perawatan Mesin Pendingin / AC</option>
                                                                    <option value="Pelaksanaan Instalasi AC">Pelaksanaan Instalasi AC</option>
                                                                    <option value="Teknisi Lemari Pendingin">Teknisi Lemari Pendingin</option>
                                                                    <option value="Mekanik Heating, Ventilation Dan Air Condition (HVAC)">Mekanik Heating, Ventilation Dan Air Condition (HVAC)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="">
                                                                <label class="form-label">Kuota</label>
                                                                <input type="number" class="form-control" name="kuota[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="">
                                                                <label class="form-label">Tanggal</label>
                                                                <input type="text" class="form-control daterangepicker-input"
                                                                    data-toggle="daterangepicker"
                                                                    data-options='{"singleDatePicker": false, "locale": {"format": "YYYY-MM-DD"}}'
                                                                    name="date_range[]">
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
            const kegiatanContainer = document.getElementById('kegiatan-container');
            const addButton = document.getElementById('add-kegiatan-btn');

            // Fungsi untuk menginisialisasi semua plugin
            function initializeAllPlugins(element) {
                // Select2
                $(element).find('.select2-multiple').select2({
                    width: '100%',
                    // placeholder: 'Pilih skema',
                    allowClear: true
                });

                // Daterangepicker
                $(element).find('.daterangepicker-input').daterangepicker({
                    singleDatePicker: false,
                    showDropdowns: true,
                    minYear: 2021,
                    maxYear: parseInt(moment().format('YYYY'), 10) + 10,
                    locale: {
                        // format: 'YYYY-MM-DD',
                        format: 'DD MMMM YYYY',
                        separator: ' - ',
                        applyLabel: 'Pilih',
                        cancelLabel: 'Batal',
                        fromLabel: 'Dari',
                        toLabel: 'Sampai',
                        customRangeLabel: 'Custom',
                        daysOfWeek: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                        monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                        firstDay: 1
                    }
                });
            }

            // Inisialisasi untuk elemen yang sudah ada
            initializeAllPlugins(document);

            // Template untuk kegiatan baru
            function createKegiatanItem() {
                return `
        <div class="row align-items-end mb-3 kegiatan-row">
            <div class="col-lg-2">
                <div class="">
                    <label class="form-label">Nama LSP</label>
                    <input type="text" class="form-control kegiatan-nama" name="kegiatan_name[]">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="">
                    <label class="form-label">Skema</label>
                    <select class="select2 form-control select2-multiple" name="skema[][]" multiple="multiple">
                        <option value="Teknisi Refrigerasi Domestik">Teknisi Refrigerasi Domestik</option>
                        <option value="Perawatan Mesin Pendingin / AC">Perawatan Mesin Pendingin / AC</option>
                        <option value="Pelaksanaan Instalasi AC">Pelaksanaan Instalasi AC</option>
                        <option value="Teknisi Lemari Pendingin">Teknisi Lemari Pendingin</option>
                        <option value="Mekanik Heating, Ventilation Dan Air Condition (HVAC)">Mekanik Heating, Ventilation Dan Air Condition (HVAC)</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="">
                    <label class="form-label">Kuota</label>
                    <input type="number" class="form-control" name="kuota[]" min="0">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="">
                    <label class="form-label">Tanggal</label>
                    <input type="text" class="form-control daterangepicker-input" name="date_range[]">
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

            // Event listener untuk tombol Add New Kegiatan
            addButton.addEventListener('click', function() {
                const newKegiatan = createKegiatanItem();
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = newKegiatan;

                const newRow = tempDiv.firstElementChild;
                kegiatanContainer.appendChild(newRow);

                // Inisialisasi plugins
                initializeAllPlugins(newRow);

                // Event listener untuk tombol hapus
                newRow.querySelector('.remove-kegiatan-btn').addEventListener('click', function() {
                    // Cleanup plugins sebelum hapus
                    const row = this.closest('.kegiatan-row');
                    $(row).find('.select2-multiple').select2('destroy');
                    $(row).find('.daterangepicker-input').daterangepicker('destroy');
                    row.remove();
                });
            });

            // Event delegation untuk tombol hapus yang sudah ada
            document.addEventListener('click', function(e) {
                if (e.target.closest('.remove-kegiatan-btn') && !e.target.closest('.remove-kegiatan-btn').disabled) {
                    const row = e.target.closest('.kegiatan-row');
                    // Cleanup plugins sebelum hapus
                    $(row).find('.select2-multiple').select2('destroy');
                    $(row).find('.daterangepicker-input').daterangepicker('destroy');
                    row.remove();
                }
            });
        });
    </script>
@endpush
