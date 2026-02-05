@extends('admin-panel.layouts.app')

@section('content')
    @foreach ($dataJabatan as $item)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class=".card-title">Edit Data Jabatan</h4>
                    </div>
                    <form action="{{ route('jabatan.update', $item->ref) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="example-select" class="form-label">Pilih Departemen</label><span class="text-danger">*</span>
                                        <select class="form-select rounded-3" id="example-select" name="departemen_ref"  required>
                                            <option value="{{ $item->departemen_ref }}">{{ $item->departemen_nama }}</option>
                                            @foreach ($dataDepartemen as $departemen)
                                                <option value="{{ $departemen->ref }}">{{ $departemen->departemen_nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Nama Jabatan</label><span class="text-danger">*</span>
                                        <input type="text" id="simpleinput" class="form-control rounded-3" name="jabatan_nama" required value="{{ $item->jabatan_nama }}">
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-outline-primary rounded-3"><i class="ri-add-fill"></i> Edit</button>
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
