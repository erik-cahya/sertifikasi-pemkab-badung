@extends('admin-panel.layouts.app')
@push('style')
    <style>
        table.dataTable>thead .sorting:before,
        table.dataTable>thead .sorting_asc:before,
        table.dataTable>thead .sorting_desc:before,
        table.dataTable>thead .sorting_asc_disabled:before,
        table.dataTable>thead .sorting_desc_disabled:before,
        table.dataTable>thead .sorting:after,
        table.dataTable>thead .sorting_asc:after,
        table.dataTable>thead .sorting_desc:after,
        table.dataTable>thead .sorting_asc_disabled:after,
        table.dataTable>thead .sorting_desc_disabled:after {
            font-size: 12px !important;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dinas text-white">
                    <h4 class=".card-title">Daftar Pegawai</h4>
                </div>
                <div class="card-body">

                    <table id="datatable-dashboard" class="table-striped table-bordered nowrap row-border order-column w-100 table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Hotel</th>
                                <th>Housekeeping</th>
                                <th>F&B Service</th>
                                <th>F&B Product</th>
                                <th>Kantor Depan</th>
                                <th>Engineering</th>
                                <th>Lainnya</th>
                                <th>Total</th>
                                <th>Ditambahkan pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataPegawai as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->pegawai_nama_hotel }}</td>
                                    <td class="text-center">{{ $item->pegawai_hk }}</td>
                                    <td class="text-center">{{ $item->pegawai_fbs }}</td>
                                    <td class="text-center">{{ $item->pegawai_fbp }}</td>
                                    <td class="text-center">{{ $item->pegawai_fo }}</td>
                                    <td class="text-center">{{ $item->pegawai_eng }}</td>
                                    <td class="text-center">{{ $item->pegawai_oth }}</td>
                                    <td class="text-center">{{ $item->pegawai_total }}</td>
                                    <td class="text-center">{{ $item->created_at->format('Y-m-d') }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning editButton" 
                                                data-ref="{{ $item->ref }}"
                                                data-nama="{{ $item->pegawai_nama_hotel }}"
                                                data-hk="{{ $item->pegawai_hk }}"
                                                data-fbs="{{ $item->pegawai_fbs }}"
                                                data-fbp="{{ $item->pegawai_fbp }}"
                                                data-fo="{{ $item->pegawai_fo }}"
                                                data-eng="{{ $item->pegawai_eng }}"
                                                data-oth="{{ $item->pegawai_oth }}">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger deleteButton" 
                                                data-ref="{{ $item->ref }}"
                                                data-nama="{{ $item->pegawai_nama_hotel }}">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dinas text-white">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Pegawai</h5>
                </div>
                <form id="editForm">
                    <div class="modal-body">
                        <input type="hidden" id="edit_ref" name="ref">
                        
                        <div class="form-group">
                            <label for="edit_nama_hotel">Nama Hotel <span class="text-danger">*</span></label>
                            <input type="text" class="rounded-3 form-control" id="edit_nama_hotel" name="pegawai_nama_hotel" required>
                        </div>

                        <div class="row">
                            <div class="mt-2 col-md-6">
                                <div class="form-group">
                                    <label for="edit_hk">Housekeeping <span class="text-danger">*</span></label>
                                    <input type="number" class="rounded-3 form-control pegawai-count" id="edit_hk" name="pegawai_hk" min="0" required>
                                </div>
                            </div>
                            <div class="mt-2 col-md-6">
                                <div class="form-group">
                                    <label for="edit_fbs">F&B Service <span class="text-danger">*</span></label>
                                    <input type="number" class="rounded-3 form-control pegawai-count" id="edit_fbs" name="pegawai_fbs" min="0" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mt-2 col-md-6">
                                <div class="form-group">
                                    <label for="edit_fbp">F&B Product <span class="text-danger">*</span></label>
                                    <input type="number" class="rounded-3 form-control pegawai-count" id="edit_fbp" name="pegawai_fbp" min="0" required>
                                </div>
                            </div>
                            <div class="mt-2 col-md-6">
                                <div class="form-group">
                                    <label for="edit_fo">Kantor Depan <span class="text-danger">*</span></label>
                                    <input type="number" class="rounded-3 form-control pegawai-count" id="edit_fo" name="pegawai_fo" min="0" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mt-2 col-md-6">
                                <div class="form-group">
                                    <label for="edit_eng">Engineering <span class="text-danger">*</span></label>
                                    <input type="number" class="rounded-3 form-control pegawai-count" id="edit_eng" name="pegawai_eng" min="0" required>
                                </div>
                            </div>
                            <div class="mt-2 col-md-6">
                                <div class="form-group">
                                    <label for="edit_oth">Lainnya <span class="text-danger">*</span></label>
                                    <input type="number" class="rounded-3 form-control pegawai-count" id="edit_oth" name="pegawai_oth" min="0" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <label>Total Pegawai</label>
                            <input type="text" class="rounded-3 form-control" id="edit_total" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dinas">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    {{-- Sweet Alert --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto calculate total on edit modal
            const pegawaiInputs = document.querySelectorAll('.pegawai-count');
            pegawaiInputs.forEach(input => {
                input.addEventListener('input', function() {
                    calculateTotal();
                });
            });

            function calculateTotal() {
                const hk = parseInt(document.getElementById('edit_hk').value) || 0;
                const fbs = parseInt(document.getElementById('edit_fbs').value) || 0;
                const fbp = parseInt(document.getElementById('edit_fbp').value) || 0;
                const fo = parseInt(document.getElementById('edit_fo').value) || 0;
                const eng = parseInt(document.getElementById('edit_eng').value) || 0;
                const oth = parseInt(document.getElementById('edit_oth').value) || 0;
                
                const total = hk + fbs + fbp + fo + eng + oth;
                document.getElementById('edit_total').value = total;
            }

            // Edit button handler
            const editButtons = document.querySelectorAll('.editButton');
            editButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Populate modal with data
                    document.getElementById('edit_ref').value = this.getAttribute('data-ref');
                    document.getElementById('edit_nama_hotel').value = this.getAttribute('data-nama');
                    document.getElementById('edit_hk').value = this.getAttribute('data-hk');
                    document.getElementById('edit_fbs').value = this.getAttribute('data-fbs');
                    document.getElementById('edit_fbp').value = this.getAttribute('data-fbp');
                    document.getElementById('edit_fo').value = this.getAttribute('data-fo');
                    document.getElementById('edit_eng').value = this.getAttribute('data-eng');
                    document.getElementById('edit_oth').value = this.getAttribute('data-oth');
                    
                    calculateTotal();
                    
                    // Show modal
                    $('#editModal').modal('show');
                });
            });

            // Edit form submit handler
            document.getElementById('editForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const ref = document.getElementById('edit_ref').value;
                const formData = {
                    pegawai_nama_hotel: document.getElementById('edit_nama_hotel').value,
                    pegawai_hk: document.getElementById('edit_hk').value,
                    pegawai_fbs: document.getElementById('edit_fbs').value,
                    pegawai_fbp: document.getElementById('edit_fbp').value,
                    pegawai_fo: document.getElementById('edit_fo').value,
                    pegawai_eng: document.getElementById('edit_eng').value,
                    pegawai_oth: document.getElementById('edit_oth').value,
                };

                fetch('/pegawaiAdmin/' + ref, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(data => {
                    $('#editModal').modal('hide');
                    Swal.fire({
                        title: data.judul,
                        text: data.pesan,
                        icon: data.type,
                    });
                    
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'Terjadi kesalahan saat mengupdate data!', 'error');
                });
            });

            // Delete button handler
            const deleteButtons = document.querySelectorAll('.deleteButton');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    let namaHotel = this.getAttribute('data-nama');
                    let ref = this.getAttribute('data-ref');

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Hapus data pegawai " + namaHotel + "?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch('/pegawaiAdmin/' + ref, {
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

                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire('Error', 'Terjadi kesalahan saat menghapus data!', 'error');
                            });
                        }
                    });
                });
            });
        });
    </script>
@endpush
