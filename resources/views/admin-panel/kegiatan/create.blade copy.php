@extends('admin-panel.layouts.app')
@push('style')
    <link href="{{ asset('admin') }}/assets/vendor/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <style>
        .kegiatan-item:first-child .remove-kegiatan-btn {
            display: none;
            /* Sembunyikan tombol hapus pada item pertama */
        }

        .remove-kegiatan-btn {
            margin-top: 10px;
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
                                            <label for="namaLengkap" class="form-label">Nama Lengkap</label>
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
                                        <div id="kegiatan-container">
                                            <!-- Container untuk kegiatan yang akan ditambahkan -->
                                            <div class="card border-secondary border kegiatan-item">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Nama Kegiatan</label>
                                                                <input type="text" class="form-control kegiatan-nama">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Tanggal Kegiatan</label>
                                                                <input type="date" class="form-control kegiatan-tanggal">
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>

                                        <!-- Tombol untuk menambah kegiatan baru -->
                                        <div class="mt-3">
                                            <button type="button" class="btn btn-primary" id="add-kegiatan-btn">
                                                <i class="fas fa-plus"></i> Add New Kegiatan
                                            </button>
                                        </div>
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

            // Template untuk kegiatan baru
            function createKegiatanItem() {
                return `
        <div class="card border-secondary border kegiatan-item mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Nama Kegiatan</label>
                            <input type="text" class="form-control kegiatan-nama">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Kegiatan</label>
                            <input type="date" class="form-control kegiatan-tanggal">
                        </div>
                    </div>
                </div>
                <!-- Tombol hapus untuk item yang baru ditambahkan -->
                <div class="text-end">
                    <button type="button" class="btn btn-danger btn-sm remove-kegiatan-btn">
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

            // Inisialisasi: Tambahkan tombol hapus pada item pertama jika ada
            const firstRemoveButton = kegiatanContainer.querySelector('.remove-kegiatan-btn');
            if (firstRemoveButton) {
                addRemoveButtonListener(firstRemoveButton);
            }
        });
    </script>
@endpush
