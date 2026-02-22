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
                    <form action="{{ route('asesiAdmin.index') }}" method="GET" class="row g-2 align-items-end mb-3">
                        <div class="col-auto">
                            <label for="filter_type" class="form-label mb-0 small">Filter berdasarkan</label>
                            <select class="form-select form-select-sm" id="filter_type" name="filter_type">
                                <option value="">-- Pilih Filter --</option>
                                <option value="tanggal" {{ ($filterType ?? '') === 'tanggal' ? 'selected' : '' }}>Per Tanggal</option>
                                <option value="bulan" {{ ($filterType ?? '') === 'bulan' ? 'selected' : '' }}>Per Bulan</option>
                                <option value="tahun" {{ ($filterType ?? '') === 'tahun' ? 'selected' : '' }}>Per Tahun</option>
                            </select>
                        </div>
                        <div class="col-auto" id="filter_value_wrapper" style="{{ $filterType ?? '' ? '' : 'display:none;' }}">
                            <label for="filter_value" class="form-label mb-0 small">Nilai Filter</label>
                            <input type="{{ ($filterType ?? '') === 'tanggal' ? 'date' : (($filterType ?? '') === 'bulan' ? 'month' : 'number') }}" class="form-control form-control-sm" id="filter_value" name="filter_value" value="{{ $filterValue ?? '' }}" {{ ($filterType ?? '') === 'tahun' ? 'min=2020 max=2030 placeholder=2026' : '' }}>
                        </div>
                        @if (($userRole ?? '') !== 'lsp')
                            <div class="col-auto">
                                <label for="filter_lsp" class="form-label mb-0 small">Filter LSP</label>
                                <select class="form-select form-select-sm" id="filter_lsp" name="filter_lsp">
                                    <option value="">-- Semua LSP --</option>
                                    @foreach ($dataLsp ?? [] as $lsp)
                                        <option value="{{ $lsp->ref }}" {{ ($filterLsp ?? '') === $lsp->ref ? 'selected' : '' }}>{{ $lsp->lsp_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="col-auto">
                            <button type="submit" class="btn btn-sm btn-dinas"><i class="mdi mdi-filter"></i> Filter</button>
                            <a href="{{ route('asesiAdmin.index') }}" class="btn btn-sm btn-secondary"><i class="mdi mdi-refresh"></i> Reset</a>
                        </div>
                    </form>

                    <table id="datatable-dashboard" class="table table-sm table-striped nowrap row-border order-column w-100">
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
                        <tbody>
                            @foreach ($dataAsesi as $item)
                                <tr>
                                    <td><span class="bg-dinas rounded-4 px-2 text-white">{{ $item->kegiatan->nama_kegiatan }}</span></td>
                                    <td>{{ $item->nama_lengkap }}</td>
                                    <td>{{ $item->nik }}</td>
                                    <td>{{ $item->tempat_lahir }}</td>
                                    <td>{{ date('Y/m/d', strtotime($item->tgl_lahir)) }}</td>
                                    <td>{{ $item->jenis_kelamin }}</td>
                                    <td>{{ $item->kewarganegaraan }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>Telp</td>
                                                <td>: {{ $item->telp_hp }} </td>
                                            </tr>
                                            <tr>
                                                <td>Rumah</td>
                                                <td>: {{ $item->telp_rumah }}</td>
                                            </tr>
                                            <tr>
                                                <td>Kantor</td>
                                                <td>: {{ $item->telp_kantor }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->pendidikan_terakhir }}</td>
                                    <td>{{ $item->nama_perusahaan }}</td>
                                    <td>{{ $item->alamat_perusahaan }}</td>
                                    <td>{{ $item->departemen }}</td>
                                    <td>{{ $item->jabatan }}</td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>Telp</td>
                                                <td>: {{ $item->telp_perusahaan }} </td>
                                            </tr>
                                            <tr>
                                                <td>Fax</td>
                                                <td>: {{ $item->fax_perusahaan }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>{{ $item->email_perusahaan }}</td>
                                    <td>{{ $item->nama_kontak_person }}</td>
                                    <td>{{ $item->no_kontak_person }}</td>
                                    <td class="no-export">
                                        <table>
                                            <tr>
                                                <td>KTP</td>
                                                <td>: @if (!empty($item->ktp_file))
                                                        <a href="{{ route('files.asesi.ktp', $item->ktp_file) }}" target="_blank"> <i class="mdi mdi-file-pdf-box"></i></a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>IJAZAH</td>
                                                <td>: @if (!empty($item->ijazah_file))
                                                        <a href="{{ route('files.asesi.ijazah', $item->ijazah_file) }}" target="_blank"> <i class="mdi mdi-file-pdf-box"></i></a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>SERTIKOM</td>
                                                <td>: @if (!empty($item->sertikom_file))
                                                        <a href="{{ route('files.asesi.sertikom', $item->sertikom_file) }}" target="_blank"> <i class="mdi mdi-file-pdf-box"></i></a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>SKB</td>
                                                <td>: @if (!empty($item->keterangan_kerja_file))
                                                        <a href="{{ route('files.asesi.skb', $item->keterangan_kerja_file) }}" target="_blank"> <i class="mdi mdi-file-pdf-box"></i></a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>PAS FOTO</td>
                                                <td>: @if (!empty($item->pas_foto_file))
                                                        <a href="{{ route('files.asesi.pasfoto', $item->pas_foto_file) }}" target="_blank"> <i class="mdi mdi-file-image"></i></a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>LSP</td>
                                                <td>: {{ $item->asesmen->nama_lsp }} </td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal</td>
                                                <td>: {{ date('Y/m/d', strtotime($item->asesmen->jadwal_asesmen)) }}</td>
                                            </tr>
                                            <tr>
                                                <td>TUK</td>
                                                <td>: {{ $item->asesmen->nama_tuk }}</td>
                                            </tr>
                                            <tr>
                                                <td>Skema</td>
                                                <td>: {{ $item->asesmen->nama_skema }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td class="text-center">{{ $item->no_sertifikat }}</td>
                                    <td>
                                        @if (!empty($item->sertifikat_file))
                                            <a href="{{ asset('asesi_files/' . $item->sertifikat_file) }}" target="_blank"> <i class="mdi mdi-file-image"></i></a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('Y/m/d') }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-dinas" data-bs-toggle="modal" data-bs-target="#editModal-{{ $item->ref }}"><i class="mdi mdi-pencil"></i></button>
                                    </td>
                                </tr>

                                <!-- Edit Data Modal -->
                                <div id="editModal-{{ $item->ref }}" class="modal modal-xl fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">

                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('asesiAdmin.update', $item->ref) }}" method="POST" enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                <div class="modal-header modal-colored-header bg-dinas">
                                                    <h4 class="modal-title" id="primary-header-modalLabel">Edit Data Asesi {{ $item->nama }}</h4>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">

                                                        <x-form.input className="col-md-4 mt-2" type="text" name="nama_lengkap" label="Nama Lengkap" value="{{ old('nama_lengkap', $item->nama_lengkap) }}" />
                                                        <x-form.input className="col-md-4 mt-2" type="text" name="nik" label="NIK" value="{{ old('nik', $item->nik) }}" />
                                                        <x-form.input className="col-md-4 mt-2" type="text" name="tempat_lahir" label="Tempat Lahir" value="{{ old('tempat_lahir', $item->tempat_lahir) }}" />
                                                        <x-form.input className="col-md-4 mt-2" type="date" name="tgl_lahir" label="Tanggal Lahir" value="{{ old('tgl_lahir', $item->tgl_lahir) }}" />

                                                        <div class="col-md-4 mt-2">
                                                            <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label><span class="text-danger">*</span>
                                                            <select class="rounded-3 form-select" id="kewarganegaraan" name="kewarganegaraan" required>
                                                                <option value="" disabled selected>Pilih Kewarganegaraan</option>
                                                                <option value="WNI" {{ $item->kewarganegaraan === 'WNI' ? 'selected' : '' }}>WNI</option>
                                                                <option value="WNA" {{ $item->kewarganegaraan === 'WNA' ? 'selected' : '' }}>WNA</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4 mt-2">
                                                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                                            <select class="text-capitalize rounded-3 form-select" id="jenis_kelamin" name="jenis_kelamin">
                                                                <option value="#" disabled selected hidden>Pilih Jenis Kelamin</option>
                                                                <option value="Laki-laki" {{ $item->jenis_kelamin === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                                <option value="Perempuan" {{ $item->jenis_kelamin === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                            </select>
                                                        </div>

                                                        <x-form.input className="col-md-4 mt-2" type="text" name="alamat" label="Alamat" value="{{ old('alamat', $item->alamat) }}" />
                                                        <x-form.input className="col-md-4 mt-2" type="text" name="kode_pos" label="Kode Pos" value="{{ old('kode_pos', $item->kode_pos) }}" />
                                                        <x-form.input className="col-md-4 mt-2" type="text" name="telp_rumah" label="No. Telp Rumah" value="{{ old('telp_rumah', $item->telp_rumah) }}" />
                                                        <x-form.input className="col-md-4 mt-2" type="text" name="telp_kantor" label="No. Telp Kantor" value="{{ old('telp_kantor', $item->telp_kantor) }}" />
                                                        <x-form.input className="col-md-4 mt-2" type="text" name="telp_hp" label="No. Telp HP" value="{{ old('telp_hp', $item->telp_hp) }}" />
                                                        <x-form.input className="col-md-4 mt-2" type="email" name="email" label="Email" value="{{ old('email', $item->email) }}" />

                                                        {{-- File Upload Section --}}
                                                        <div class="col-12 mt-3">
                                                            <hr>
                                                            <h6 class="fw-bold">Upload Dokumen <small class="text-muted">(Kosongkan jika tidak ingin mengubah)</small></h6>
                                                        </div>

                                                        <div class="col-md-4 mt-2">
                                                            <label for="ktp_file_{{ $item->ref }}" class="form-label">Scan KTP (PDF)</label>
                                                            @if (!empty($item->ktp_file))
                                                                <br><a href="{{ route('files.asesi.ktp', $item->ktp_file) }}" target="_blank" class="badge bg-success mb-1"><i class="mdi mdi-file-pdf-box"></i> Lihat File</a>
                                                            @endif
                                                            <input type="file" id="ktp_file_{{ $item->ref }}" class="form-control rounded-3" name="ktp_file" accept=".pdf">
                                                        </div>

                                                        <div class="col-md-4 mt-2">
                                                            <label for="ijazah_file_{{ $item->ref }}" class="form-label">Ijazah Terakhir (PDF)</label>
                                                            @if (!empty($item->ijazah_file))
                                                                <br><a href="{{ route('files.asesi.ijazah', $item->ijazah_file) }}" target="_blank" class="badge bg-success mb-1"><i class="mdi mdi-file-pdf-box"></i> Lihat File</a>
                                                            @endif
                                                            <input type="file" id="ijazah_file_{{ $item->ref }}" class="form-control rounded-3" name="ijazah_file" accept=".pdf">
                                                        </div>

                                                        <div class="col-md-4 mt-2">
                                                            <label for="sertikom_file_{{ $item->ref }}" class="form-label">Sertifikat Kompetensi (PDF)</label>
                                                            @if (!empty($item->sertikom_file))
                                                                <br><a href="{{ route('files.asesi.sertikom', $item->sertikom_file) }}" target="_blank" class="badge bg-success mb-1"><i class="mdi mdi-file-pdf-box"></i> Lihat File</a>
                                                            @endif
                                                            <input type="file" id="sertikom_file_{{ $item->ref }}" class="form-control rounded-3" name="sertikom_file" accept=".pdf">
                                                        </div>

                                                        <div class="col-md-4 mt-2">
                                                            <label for="keterangan_kerja_file_{{ $item->ref }}" class="form-label">Surat Keterangan Kerja (PDF)</label>
                                                            @if (!empty($item->keterangan_kerja_file))
                                                                <br><a href="{{ route('files.asesi.skb', $item->keterangan_kerja_file) }}" target="_blank" class="badge bg-success mb-1"><i class="mdi mdi-file-pdf-box"></i> Lihat File</a>
                                                            @endif
                                                            <input type="file" id="keterangan_kerja_file_{{ $item->ref }}" class="form-control rounded-3" name="keterangan_kerja_file" accept=".pdf">
                                                        </div>

                                                        <div class="col-md-4 mt-2">
                                                            <label for="pas_foto_file_{{ $item->ref }}" class="form-label">Pas Foto (JPG/PNG)</label>
                                                            @if (!empty($item->pas_foto_file))
                                                                <br><a href="{{ route('files.asesi.pasfoto', $item->pas_foto_file) }}" target="_blank" class="badge bg-success mb-1"><i class="mdi mdi-file-image"></i> Lihat File</a>
                                                            @endif
                                                            <input type="file" id="pas_foto_file_{{ $item->ref }}" class="form-control rounded-3" name="pas_foto_file" accept=".jpg,.jpeg,.png">
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-dinas">Simpan Perubahan</button>

                                                    <input type="hidden" class="asesiID" value="{{ $item->ref }}">
                                                    <a href="javascript:void(0)" data-nama="{{ $item->nama_lengkap }}" class="btn btn-sm btn-danger deleteButton" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hapus Data Asesi" data-bs-custom-class="danger-tooltip"><i class="mdi mdi-trash-can"></i></a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- / END Edit Data modal -->
                            @endforeach
                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->
@endsection
@push('script')
    {{-- Sweet Alert --}}
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

        // Filter type change handler
        const filterType = document.getElementById('filter_type');
        const filterValueWrapper = document.getElementById('filter_value_wrapper');
        const filterValue = document.getElementById('filter_value');

        if (filterType) {
            filterType.addEventListener('change', function() {
                const val = this.value;
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
    </script>
@endpush
