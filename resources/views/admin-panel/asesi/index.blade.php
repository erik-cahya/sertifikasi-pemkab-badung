@extends('admin-panel.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dinas text-white">
                    <h4 class=".card-title">Daftar Calon Asesi</h4>
                </div>
                <div class="card-body">

                    {{-- Filter Form --}}
                    <div class="row g-2 align-items-end mb-3">
                        <div class="col-auto">
                            <label for="filter_type" class="form-label small mb-0">Filter berdasarkan</label>
                            <select class="form-select-sm form-select" id="filter_type">
                                <option value="">-- Pilih Filter --</option>
                                <option value="tanggal">Per Tanggal</option>
                                <option value="bulan">Per Bulan</option>
                                <option value="tahun">Per Tahun</option>
                            </select>
                        </div>
                        <div class="col-auto" id="filter_value_wrapper" style="display:none;">
                            <label for="filter_value" class="form-label small mb-0">Nilai Filter</label>
                            <input type="text" class="form-control form-control-sm" id="filter_value">
                        </div>
                        @if (($userRole ?? '') !== 'lsp')
                            <div class="col-auto">
                                <label for="filter_lsp" class="form-label small mb-0">Filter LSP</label>
                                <select class="form-select-sm form-select" id="filter_lsp">
                                    <option value="">-- Semua LSP --</option>
                                    @foreach ($dataLsp ?? [] as $lsp)
                                        <option value="{{ $lsp->ref }}">{{ $lsp->lsp_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="col-auto">
                            <button type="button" id="btn-filter" class="btn btn-sm btn-dinas"><i class="mdi mdi-filter"></i> Filter</button>
                            <button type="button" id="btn-reset" class="btn btn-sm btn-secondary"><i class="mdi mdi-refresh"></i> Reset</button>
                        </div>
                    </div>

                    <table id="datatable-asesi" class="table-sm table-striped nowrap row-border order-column w-100 table">
                        <thead>
                            <tr>
                                <th>Sertifikasi</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Tempat Lahir </th>
                                <th>Tanggal Lahir </th>
                                <th>Jenis Kelamin </th>
                                <th>Kewarganegaraan</th>
                                <th>Alamat</th>
                                <th>Telp</th>
                                <th>Email</th>
                                <th>Pendidikan Terakhir</th>
                                <th>Nama Perusahaan</th>
                                <th>Alamat</th>
                                <th>Departemen</th>
                                <th>Jabatan</th>
                                <th>Telp Perusahaan</th>
                                <th>Email Perusahaan</th>
                                <th>Nama Kontak Person Perusahaan</th>
                                <th>Nomor HP Kontak Person Perusahaan</th>
                                <th class="no-export">Dokumen</th>
                                <th>Jadwal Asesmen</th>
                                <th>No Sertifikat</th>
                                <th>Sertifikat</th>
                                <th>Mendaftar pada</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->

    <!-- Single Shared Edit Modal -->
    <div id="editModal" class="modal modal-xl fade" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-header modal-colored-header bg-dinas">
                        <h4 class="modal-title" id="editModalLabel">Edit Data Asesi</h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="py-5 text-center" id="modal-loading">
                            <div class="spinner-border text-primary" role="status"></div>
                            <p class="text-muted mt-2">Memuat data...</p>
                        </div>
                        <div class="row" id="modal-content" style="display: none;">

                            <x-form.input className="col-md-4 mt-2" type="text" name="nama_lengkap" label="Nama Lengkap" value="" />
                            <x-form.input className="col-md-4 mt-2" type="text" name="nik" label="NIK" value="" />
                            <x-form.input className="col-md-4 mt-2" type="text" name="tempat_lahir" label="Tempat Lahir" value="" />
                            <x-form.input className="col-md-4 mt-2" type="date" name="tgl_lahir" label="Tanggal Lahir" value="" />

                            <div class="col-md-4 mt-2">
                                <label for="edit_kewarganegaraan" class="form-label">Kewarganegaraan</label><span class="text-danger">*</span>
                                <select class="rounded-3 form-select" id="edit_kewarganegaraan" name="kewarganegaraan" required>
                                    <option value="" disabled selected>Pilih Kewarganegaraan</option>
                                    <option value="WNI">WNI</option>
                                    <option value="WNA">WNA</option>
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="edit_jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="text-capitalize rounded-3 form-select" id="edit_jenis_kelamin" name="jenis_kelamin">
                                    <option value="#" disabled selected hidden>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <x-form.input className="col-md-4 mt-2" type="text" name="alamat" label="Alamat" value="" />
                            <x-form.input className="col-md-4 mt-2" type="text" name="kode_pos" label="Kode Pos" value="" />
                            <x-form.input className="col-md-4 mt-2" type="text" name="telp_rumah" label="No. Telp Rumah" value="" />
                            <x-form.input className="col-md-4 mt-2" type="text" name="telp_kantor" label="No. Telp Kantor" value="" />
                            <x-form.input className="col-md-4 mt-2" type="text" name="telp_hp" label="No. Telp HP" value="" />
                            <x-form.input className="col-md-4 mt-2" type="email" name="email" label="Email" value="" />

                            <hr class="mt-2">

                            <div class="col-md-6">
                                <label class="form-label">LSP</label>
                                <input type="text" class="form-control rounded-3" id="edit_lsp_nama" disabled>
                            </div>

                            <div class="col-md-6">
                                <label for="edit_asesmen_ref" class="form-label">Jadwal Asesmen</label>
                                <select class="rounded-3 form-select" id="edit_asesmen_ref" name="asesmen_ref">
                                    <option value="" disabled selected>Pilih Jadwal Asesmen</option>
                                </select>
                                <small class="text-muted text-xs">Opsi jadwal disesuaikan dengan LSP pilihan Anda.</small>
                            </div>

                            {{-- File Upload Section --}}
                            <div class="col-12 mt-3">
                                <hr>
                                <h6 class="fw-bold">Upload Dokumen <small class="text-muted">(Kosongkan jika tidak ingin mengubah)</small></h6>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label class="form-label">Scan KTP (PDF)</label>
                                <span id="edit_ktp_link"></span>
                                <input type="file" class="form-control rounded-3" name="ktp_file" accept=".pdf">
                            </div>

                            <div class="col-md-4 mt-2">
                                <label class="form-label">Ijazah Terakhir (PDF)</label>
                                <span id="edit_ijazah_link"></span>
                                <input type="file" class="form-control rounded-3" name="ijazah_file" accept=".pdf">
                            </div>

                            <div class="col-md-4 mt-2">
                                <label class="form-label">Sertifikat Kompetensi (PDF)</label>
                                <span id="edit_sertikom_link"></span>
                                <input type="file" class="form-control rounded-3" name="sertikom_file" accept=".pdf">
                            </div>

                            <div class="col-md-4 mt-2">
                                <label class="form-label">Surat Keterangan Kerja (PDF)</label>
                                <span id="edit_skb_link"></span>
                                <input type="file" class="form-control rounded-3" name="keterangan_kerja_file" accept=".pdf">
                            </div>

                            <div class="col-md-4 mt-2">
                                <label class="form-label">Pas Foto (JPG/PNG)</label>
                                <span id="edit_pasfoto_link"></span>
                                <input type="file" class="form-control rounded-3" name="pas_foto_file" accept=".jpg,.jpeg,.png">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dinas">Simpan Perubahan</button>

                        <input type="hidden" id="edit_asesi_ref" value="">
                        <a href="javascript:void(0)" id="btn-delete-asesi" data-nama="" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hapus Data Asesi" data-bs-custom-class="danger-tooltip"><i class="mdi mdi-trash-can"></i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- / END Edit Data modal -->
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ============================================
            // Server-side DataTables
            // ============================================
            var asesiTable = $('#datatable-asesi').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('asesiAdmin.data') }}',
                    data: function(d) {
                        d.filter_type = $('#filter_type').val();
                        d.filter_value = $('#filter_value').val();
                        d.filter_lsp = $('#filter_lsp').val();
                    }
                },
                order: [
                    [23, 'desc']
                ], // default sort: Mendaftar pada
                pageLength: 25,
                scrollX: true,
                scrollY: '70vh',
                scrollCollapse: true,

                dom: "<'row mb-2' <'col-md-6 d-flex align-items-center gap-2'B> <'col-md-6 d-flex justify-content-end'f> > rt <'row mt-2' <'col-md-6'i> <'col-md-6'p>>",
                buttons: [{
                        extend: 'copy',
                        className: 'btn-dinas-fill'
                    },
                    {
                        extend: 'print',
                        className: 'btn-dinas-fill'
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'btn-dinas-fill',
                        exportOptions: {
                            columns: ':not(.no-export)',
                            stripHtml: true
                        }
                    }
                ],
                language: {
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    infoFiltered: "(difilter dari _MAX_ data)",
                    search: "Cari:",
                    processing: '<div class="spinner-border spinner-border-sm text-primary" role="status"></div> Memuat data...',
                    paginate: {
                        previous: "<i class='ri-arrow-left-s-line'>",
                        next: "<i class='ri-arrow-right-s-line'>"
                    },
                    lengthMenu: "Tampilkan _MENU_ data",
                },
                columnDefs: [{
                        targets: [19, 20, 22, 24],
                        orderable: false
                    }, // Dokumen, Jadwal, Sertifikat, Action
                ],
                drawCallback: function() {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
                }
            });

            // Filter button
            document.getElementById('btn-filter').addEventListener('click', function() {
                asesiTable.ajax.reload();
            });

            // Reset button
            document.getElementById('btn-reset').addEventListener('click', function() {
                document.getElementById('filter_type').value = '';
                document.getElementById('filter_value').value = '';
                var filterLsp = document.getElementById('filter_lsp');
                if (filterLsp) filterLsp.value = '';
                document.getElementById('filter_value_wrapper').style.display = 'none';
                asesiTable.ajax.reload();
            });

            // Filter type change handler
            var filterType = document.getElementById('filter_type');
            var filterValueWrapper = document.getElementById('filter_value_wrapper');
            var filterValue = document.getElementById('filter_value');

            if (filterType) {
                filterType.addEventListener('change', function() {
                    var val = this.value;
                    filterValue.value = '';

                    if (!val) {
                        filterValueWrapper.style.display = 'none';
                        return;
                    }

                    filterValueWrapper.style.display = '';

                    switch (val) {
                        case 'tanggal':
                            filterValue.type = 'date';
                            filterValue.removeAttribute('min');
                            filterValue.removeAttribute('max');
                            filterValue.removeAttribute('placeholder');
                            break;
                        case 'bulan':
                            filterValue.type = 'month';
                            filterValue.removeAttribute('min');
                            filterValue.removeAttribute('max');
                            filterValue.removeAttribute('placeholder');
                            break;
                        case 'tahun':
                            filterValue.type = 'number';
                            filterValue.min = 2020;
                            filterValue.max = 2030;
                            filterValue.placeholder = '2026';
                            break;
                    }
                });
            }

            // ============================================
            // Edit Modal — load data on click via AJAX
            // ============================================
            var editModal = new bootstrap.Modal(document.getElementById('editModal'));

            $('#datatable-asesi').on('click', '.btn-edit-asesi', function() {
                var ref = $(this).data('ref');

                // Reset modal
                $('#modal-loading').show();
                $('#modal-content').hide();

                // Show modal
                editModal.show();

                // Set form action
                $('#editForm').attr('action', '/asesiAdmin/' + ref);
                $('#edit_asesi_ref').val(ref);

                // Fetch data
                $.ajax({
                    url: '/asesiAdmin/' + ref + '/show',
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        var asesi = data.asesi;

                        // Fill text fields
                        $('[name="nama_lengkap"]').val(asesi.nama_lengkap);
                        $('[name="nik"]').val(asesi.nik);
                        $('[name="tempat_lahir"]').val(asesi.tempat_lahir);
                        $('[name="tgl_lahir"]').val(asesi.tgl_lahir);
                        $('[name="alamat"]').val(asesi.alamat);
                        $('[name="kode_pos"]').val(asesi.kode_pos);
                        $('[name="telp_rumah"]').val(asesi.telp_rumah);
                        $('[name="telp_kantor"]').val(asesi.telp_kantor);
                        $('[name="telp_hp"]').val(asesi.telp_hp);
                        $('[name="email"]').val(asesi.email);

                        // Selects
                        $('#edit_kewarganegaraan').val(asesi.kewarganegaraan);
                        $('#edit_jenis_kelamin').val(asesi.jenis_kelamin);

                        // LSP
                        $('#edit_lsp_nama').val(data.lspNama);

                        // Jadwal Asesmen dropdown
                        var $jadwalSelect = $('#edit_asesmen_ref');
                        $jadwalSelect.empty().append('<option value="" disabled>Pilih Jadwal Asesmen</option>');
                        data.jadwalOptions.forEach(function(opt) {
                            $jadwalSelect.append('<option value="' + opt.ref + '"' + (opt.selected ? ' selected' : '') + '>' + opt.label + '</option>');
                        });

                        // File links
                        setFileLink('#edit_ktp_link', asesi.ktp_file, '{{ route('files.asesi.ktp', ':file') }}', 'mdi-file-pdf-box');
                        setFileLink('#edit_ijazah_link', asesi.ijazah_file, '{{ route('files.asesi.ijazah', ':file') }}', 'mdi-file-pdf-box');
                        setFileLink('#edit_sertikom_link', asesi.sertikom_file, '{{ route('files.asesi.sertikom', ':file') }}', 'mdi-file-pdf-box');
                        setFileLink('#edit_skb_link', asesi.keterangan_kerja_file, '{{ route('files.asesi.skb', ':file') }}', 'mdi-file-pdf-box');
                        setFileLink('#edit_pasfoto_link', asesi.pas_foto_file, '{{ route('files.asesi.pasfoto', ':file') }}', 'mdi-file-image');

                        // Delete button data
                        $('#btn-delete-asesi').attr('data-nama', asesi.nama_lengkap);

                        // Show content
                        $('#modal-loading').hide();
                        $('#modal-content').show();
                    },
                    error: function() {
                        alert('Gagal memuat data asesi.');
                        editModal.hide();
                    }
                });
            });

            function setFileLink(selector, filename, routeTemplate, icon) {
                if (filename) {
                    var url = routeTemplate.replace(':file', filename);
                    $(selector).html('<br><a href="' + url + '" target="_blank" class="badge bg-success mb-1"><i class="mdi ' + icon + '"></i> Lihat File</a>');
                } else {
                    $(selector).html('');
                }
            }

            // ============================================
            // Delete handler
            // ============================================
            document.getElementById('btn-delete-asesi').addEventListener('click', function(e) {
                e.preventDefault();

                var propertyName = this.getAttribute('data-nama');
                var asesiID = document.getElementById('edit_asesi_ref').value;

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

                                // Close modal & reload table
                                editModal.hide();
                                asesiTable.ajax.reload(null, false);
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire('Error', 'Something went wrong!', 'error');
                            });
                    }
                });
            });
        });
    </script>
@endpush
