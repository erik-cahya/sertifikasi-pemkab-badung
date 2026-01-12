@extends('admin-panel.layouts.app')
@push('style')
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

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" id="email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <p class="mb-1 fw-bold text-muted">LSP (pilih lebih dari 1)</p>
                                        <select class="select2 form-control select2-multiple" data-toggle="select2" name="lsp[]" multiple="multiple">
                                            <option value="LSP Engineering">LSP Engineering</option>
                                            <option value="LSP Hospitality">LSP Hospitality</option>
                                            <option value="LSP Indonesia">LSP Indonesia</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-12">
                                        <!-- Container untuk kegiatan yang akan ditambahkan -->
                                        <div class="card border-secondary border ">
                                            <div class="card-body kegiatan-item">
                                                <div id="kegiatan-container">

                                                    <div class="row align-items-end">
                                                        <div class="col-lg-5">
                                                            <div class="mb-3">
                                                                <label class="form-label">Nama Kegiatan</label>
                                                                <input type="text" class="form-control kegiatan-nama" name="kegiatan_name[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <div class="mb-3">
                                                                <label class="form-label">Tanggal Kegiatan</label>
                                                                <input type="date" class="form-control kegiatan-tanggal" name="kegiatan_date[]">
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
    <script src="{{ asset('admin') }}/assets/vendor/select2/js/select2.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const kegiatanContainer = document.getElementById('kegiatan-container');
            const addButton = document.getElementById('add-kegiatan-btn');
            let kegiatanCounter = 1; // Counter untuk melacak jumlah kegiatan

            // Template untuk kegiatan baru
            function createKegiatanItem() {
                kegiatanCounter++;
                return `
                <div class="row align-items-end kegiatan-item">
                    <div class="col-lg-5">
                        <div class="mb-3">
                            <label class="form-label">Nama Kegiatan</label>
                            <input type="text" class="form-control kegiatan-nama" name="kegiatan_name[]">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Kegiatan</label>
                            <input type="date" class="form-control kegiatan-tanggal" name="kegiatan_date[]">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="mb-3 d-grid">
                            <button type="button" class="btn btn-outline-danger remove-kegiatan-btn">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
       
        
        `;
            }

            // Fungsi untuk menambahkan event listener pada tombol hapus
            function addRemoveButtonListener(button) {
                button.addEventListener('click', function() {
                    this.closest('.kegiatan-item').remove();
                    kegiatanCounter--;
                });
            }

            // Event listener untuk tombol Add New Kegiatan
            addButton.addEventListener('click', function() {
                const newKegiatan = createKegiatanItem();
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = newKegiatan;

                kegiatanContainer.appendChild(tempDiv.firstElementChild);

                // Tambahkan event listener pada tombol hapus yang baru dibuat
                const removeButton = kegiatanContainer.lastElementChild.querySelector('.remove-kegiatan-btn');
                addRemoveButtonListener(removeButton);
            });
        });
    </script>
@endpush
