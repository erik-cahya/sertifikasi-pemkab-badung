@extends('admin-panel.layouts.app')
@push('style')
@endpush
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Create Skema LSP</h4>
                            <p class="text-muted mb-0">Tambahkan data skema LSP pada form berikut.</p>
                        </div>
                        <form action="{{ route('lsp.store') }}" method="POST">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-lg-6 mt-2">
                                        <label for="lsp_nama" class="form-label">Nama LSP</label>
                                        <input type="text" id="lsp_nama" class="form-control" name="lsp_nama" value="{{ $dataLsp->lsp_nama }}" disabled>
                                    </div>

                                    <div class="col-lg-6 mt-2">
                                        <label for="lsp_nama" class="form-label">No Lisensi</label>
                                        <input type="text" id="lsp_nama" class="form-control" name="lsp_nama" value="{{ $dataLsp->lsp_no_lisensi }}" disabled>
                                    </div>

                                </div>

                                <div class="mb-3 mt-3">
                                    <button class="btn btn-primary" type="submit">Tambah Skema</button>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
@endpush
