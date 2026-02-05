@extends('admin-panel.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class=".card-title">Edit Data Asesmen</h4>
                </div>
                <form action="{{ route('asesmen.update', $dataKegiatan->ref) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="namaKegiatan" class="form-label">Nama Kegiatan</label>
                                    <input type="text" id="namaKegiatan" class="form-control rounded-3" name="tuk_email" required value="{{ $dataKegiatan->kegiatan->nama_kegiatan }}" disabled>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="inputEmail3" class="form-label">Nama LSP</label>
                                    <input type="text" id="inputEmail3" class="form-control rounded-3" name="tuk_email" value="{{ $dataKegiatan->lsp->lsp_nama }}" disabled>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="kuota_lsp" class="form-label">Kuota Peserta</label>
                                    <input type="number" id="kuota_lsp" class="form-control rounded-3" name="kuota_lsp" value="{{ $dataKegiatan->kuota_lsp }}" required>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="mulai_asesmen" class="form-label">Mulai Asesmen</label>
                                    <input type="text" value="{{ \Carbon\Carbon::parse($dataKegiatan->mulai_asesmen)->translatedFormat('d/m/Y') }}" id="mulai_asesmen" name="mulai_asesmen" class="form-control rounded-3 single-date">

                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="selesai_asesmen" class="form-label">Selesai Asesmen</label>
                                    <input type="text" value="{{ \Carbon\Carbon::parse($dataKegiatan->selesai_asesmen)->translatedFormat('d/m/Y') }}" id="selesai_asesmen" name="selesai_asesmen" class="form-control rounded-3 single-date">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-1 mt-1">
                                    <button type="submit" class="btn btn-outline-primary rounded-3"><i class="ri-save-3-line"></i> Edit</button>
                                </div>
                            </div>
                        </div><!-- end row-->
                    </div> <!-- end card-body -->
                </form>
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->
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
@endpush
