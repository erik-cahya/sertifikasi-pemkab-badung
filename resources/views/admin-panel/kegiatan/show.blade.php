@extends('admin-panel.layouts.app')
@push('style')
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
                    <h5 class="card-header bg-light-subtle">Data Peserta</h5>
                    <div class="card-body" bis_skin_checked="1">
                        <div class="table-responsive">
                            <table class="table-sm table-bordered w-100 table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama LSP</th>
                                        <th>Jumlah Skema</th>
                                        <th>Kuota</th>
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

                                                @foreach ($dataSkema[$kegiatan->lsp->ref] as $skema)
                                                    <span class="badge bg-primary-subtle text-primary">
                                                        {{ $skema->skema_judul }}
                                                    </span>
                                                @endforeach
                                            </td>

                                            <td>
                                                {{ $kegiatan->kuota_lsp ?? 0 }} Peserta
                                            </td>

                                            <td>
                                                <button class="btn btn-link text-decoration-none fs-12 p-0" data-bs-toggle="collapse" data-bs-target="#jadwal-{{ $kegiatan->ref }}" aria-expanded="false" aria-controls="jadwal-{{ $kegiatan->ref }}">
                                                    Lihat Jadwal
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="bg-light collapse" id="jadwal-{{ $kegiatan->ref }}" data-bs-parent="#dataPeserta">

                                            <td colspan="5" class="">
                                                <div class="card mb-0 border-0 shadow-sm">
                                                    <div class="card-body p-0">
                                                        <div class="card-header bg-dinas text-white" bis_skin_checked="1">
                                                            <h4 class="card-title"> Detail Jadwal & Skema
                                                            </h4>
                                                        </div>
                                                        <table class="table-sm table-bordered table" style="font-size: 12px">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Total Asesi</th>
                                                                    <th>Tanggal Asesmen</th>
                                                                    <th>Tempat Asesmen</th>
                                                                    <th>Skema Asesmen</th>
                                                                    {{-- <th>Penanggung Jawab</th>
                                                                    <th>Penyelenggara Uji</th>
                                                                    <th>Asesor</th> --}}
                                                                    <th>Form Daftar Hadir</th>
                                                                    <th>Form Daftar Penerimaan</th>
                                                                    <th>Form Tanda Terima Sertifikat</th>
                                                                    <th>Bukti Asesmen</th>

                                                                    <th>Upload Bukti Asesmen</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="detailJadwal-{{ $kegiatan->ref }}">
                                                                {{-- {{ dd($kegiatan->lsp->lsp_nama) }} --}}
                                                                @foreach ($jadwalKegiatan[$kegiatan->lsp->lsp_nama] ?? [] as $asesmen)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ count($dataAsesi[$asesmen->ref] ?? []) }} / {{ $asesmen->kuota_harian }} Orang</td>
                                                                        <td class={{ count($dataAsesi[$asesmen->ref] ?? []) >= 1 ? 'fw-bold' : '' }}>{{ \Carbon\Carbon::parse($asesmen->jadwal_asesmen)->locale('id')->translatedFormat('l, d F Y') }}</td>
                                                                        <td>{{ $asesmen->nama_tuk }}</td>
                                                                        <td>{{ $asesmen->nama_skema }}</td>
                                                                        {{-- <td>{{ $asesmen->nama_penanggung_jawab }}</td>
                                                                        <td>{{ $asesmen->nama_penyelenggara_uji }}</td>
                                                                        <td>{{ $asesmen->nama_asesor }}</td> --}}
                                                                        <td><a href="{{ route('pdf.daftar-hadir', $asesmen->ref) }}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download Daftar Hadir" data-bs-custom-class="info-tooltip"><i class="mdi mdi-download"></i> Download </a></td>
                                                                        <td><a href="{{ route('pdf.daftar-penerimaan', $asesmen->ref) }}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download Daftar Penerimaan" data-bs-custom-class="info-tooltip"><i class="mdi mdi-download"></i> Download</a> </td>
                                                                        <td><a href="{{ route('pdf.tanda-terima-sertifikat', $asesmen->ref) }}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download Tanda Terima Sertifikat" data-bs-custom-class="info-tooltip"><i class="mdi mdi-download"></i> Download</a> </td>
                                                                        <td class="d-flex gap-2 align-items-center">
                                                                            <span id="asesmen-{{ $asesmen->ref }}">
                                                                                @if ($asesmen->bukti_asesmen)
                                                                                    <a href="{{ asset('asesmen_files/' . $asesmen->bukti_asesmen) }}" target="_blank" class="text-danger fs-5" title="Lihat Sertifikat"> <i class="mdi mdi-download"></i> Download </a>
                                                                                @else
                                                                                    <span class="text-muted">-</span>
                                                                                @endif
                                                                            </span>
                                                                        </td>

                                                                        <td>
                                                                            @role('lsp')
                                                                                <input type="file" class="form-control upload-bukti-asesmen form-control-sm" data-ref="{{ $asesmen->ref }}" accept="application/pdf">
                                                                            @endrole
                                                                            @role('dinas', 'master')
                                                                                -
                                                                            @endrole
                                                                        </td>

                                                                        <td class="d-flex gap-2">
                                                                            <button class="btn btn-link text-decoration-none fs-12 p-0" data-bs-toggle="collapse" data-bs-target="#asesi_list-{{ $asesmen->ref }}" aria-expanded="false" aria-controls="asesi_list-{{ $asesmen->ref }}">
                                                                                Lihat Asesi
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="bg-light collapse" id="asesi_list-{{ $asesmen->ref }}" data-bs-parent="#detailJadwal-{{ $kegiatan->ref }}">
                                                                        <td colspan="14" class="p-3">
                                                                            <div class="card mb-0 border-0 shadow-sm">
                                                                                <div class="card-body p-1">
                                                                                    <div class="card-header text-white bg-dinas px-3" bis_skin_checked="1">
                                                                                        <h4 class="card-title"> List Asesi</h4>
                                                                                        <h6>{{ \Carbon\Carbon::parse($asesmen->jadwal_asesmen)->locale('id')->translatedFormat('l, d F Y') }}</h6>
                                                                                    </div>
                                                                                    <table class="table-sm table-bordered table" style="font-size: 12px">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>No</th>
                                                                                                <th>Nama Asesi</th>
                                                                                                <th>Nomor Sertifikat <small class="fw-normal fs-10">( Klik Kolom untuk tambah/edit )</small></th>
                                                                                                <th width="20%">Upload Sertifikat</th>
                                                                                                <th>Download Sertifikat</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            @foreach ($dataAsesi[$asesmen->ref] ?? [] as $asesi)
                                                                                                {{-- {{ dd($asesi) }} --}}
                                                                                                <tr>
                                                                                                    <td>{{ $loop->iteration }}</td>
                                                                                                    <td>{{ $asesi->nama_lengkap }}</td>
                                                                                                    <td><span class="edited" id="no_sertifikat" ref="{{ $asesi->ref }}">
                                                                                                            @if ($asesi->no_sertifikat != null)
                                                                                                            {{ $asesi->no_sertifikat }} @else-
                                                                                                            @endif
                                                                                                        </span></td>
                                                                                                    <td><input type="file" class="form-control upload-sertifikat" data-ref="{{ $asesi->ref }}" accept="application/pdf"></td>
                                                                                                    <td class="d-flex gap-2 align-items-center">
                                                                                                        <span id="sertifikat-{{ $asesi->ref }}">
                                                                                                            @if ($asesi->sertifikat_file)
                                                                                                                <a href="{{ asset('asesi_files/' . $asesi->sertifikat_file) }}" target="_blank" class="text-danger fs-5" title="Lihat Sertifikat"> <i class="mdi mdi-download"></i> Download </a>
                                                                                                            @else
                                                                                                                <span class="text-muted">-</span>
                                                                                                            @endif
                                                                                                        </span>
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
@endsection
@push('script')
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

    <!-- Update no_sertifikat asesi -->
    <script>
        $(document).ready(function() {
            // Delegate click event to the document (or a parent element that won't change)
            $(document).on('click', '.edited', function() {
                var span = $(this);
                var itemText = span.text();
                var itemId = span.attr('id'); // Get the id
                var itemRef = span.attr('ref'); // Get the ref

                // Create an input field with the current text
                var input = $('<input type="text" class="form-control"/>').val(itemText).attr('id', itemId).attr('ref', itemRef);

                // Replace the span with the input field
                span.replaceWith(input);

                // Focus the input field
                input.focus();

                // Handle blur event (when input loses focus)
                input.on('blur', function() {
                    var newValue = input.val();
                    var updatedSpan = $('<span class="edited"></span>').text(newValue).attr('id', itemId).attr('ref', itemRef);

                    // Replace the input back with the updated span
                    input.replaceWith(updatedSpan);

                    // Send the updated value to the server using AJAX
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
                        }
                    });
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
@endpush
