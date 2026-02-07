@extends('admin-panel.layouts.app')

@section('content')
    @foreach ($dataTUK as $item)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-dinas text-white">
                        <h4 class=".card-title">Edit Data TUK</h4>
                    </div>
                    <form action="{{ route('tukAdmin.update', $item->ref) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="example-select" class="form-label">Lembaga Sertifikasi Kompetensi (LSP)</label><span class="text-danger">*</span>
                                        <select class="form-select rounded-3" id="example-select" name="kebangsaan"  required disabled>
                                            <option value="{{ $item->lsp_ref }}">{{ $item->lsp_nama }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Nama TUK</label><span class="text-danger">*</span>
                                        <input type="text" id="simpleinput" class="form-control rounded-3" name="tuk_nama" required value="{{$item->tuk_nama }}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="inputEmail3" class="form-label">Email TUK</label><span class="text-danger">*</span>
                                        <input type="email" id="inputEmail3" class="form-control rounded-3" name="tuk_email" required value="{{$item->tuk_email }}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Nomor Telp TUK</label><span class="text-danger">*</span>
                                        <input type="number" id="example-number" class="form-control rounded-3" name="tuk_telp" required value="{{$item->tuk_telp }}">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Alamat TUK</label><span class="text-danger">*</span>
                                        <input type="text" id="simpleinput" class="form-control rounded-3" name="tuk_alamat" required value="{{$item->tuk_alamat }}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Nama Kontak Person TUK</label><span class="text-danger">*</span>
                                        <input type="text" id="simpleinput" class="form-control rounded-3" name="tuk_cp_nama" required value="{{$item->tuk_cp_nama }}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="inputEmail3" class="form-label">Email Kontak Person TUK</label><span class="text-danger">*</span>
                                        <input type="email" id="inputEmail3" class="form-control rounded-3" name="tuk_cp_email" required value="{{$item->tuk_cp_email }}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Nomor Telp Kontak Person TUK</label><span class="text-danger">*</span>
                                        <input type="number" id="example-number" class="form-control rounded-3" name="tuk_cp_telp" required value="{{$item->tuk_cp_telp }}">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mt-1 mb-1">
                                        <button type="submit" class="btn btn-dinas rounded-3"><i class="ri-save-3-line"></i> Edit</button>
                                    </div>
                                </div>
                            </div><!-- end row-->
                        </div> <!-- end card-body -->
                    </form>
                </div> <!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->
    @endforeach

@endsection