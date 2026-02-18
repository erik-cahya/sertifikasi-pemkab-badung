@extends('admin-panel.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dinas text-white">
                    <h4 class=".card-title">Daftar Calon Asesi</h4>
                </div>
                <div class="card-body">

                    <table id="datatable-dashboard" class="table table-striped nowrap row-border order-column w-100">
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
                                </tr>
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
                    let tukID = this.parentElement.querySelector('.tukID').value;

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
                            fetch('/tukAdmin/' + tukID, {
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
    </script>
@endpush
