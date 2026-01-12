@extends('admin-panel.layouts.app')
@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class=".card-title">Add New Data GSE</h4>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form enctype="multipart/form-data" method="POST" action="{{ route('gse.update', $dataGse->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Nomor Seri GSE</label>
                                            <input type="text" id="simpleinput" class="form-control" name="gse_serial" placeholder="Masukkan Nomor Seri GSE" value="{{ old('gse_serial', $dataGse->gse_serial) }}">
                                            @error('gse_serial')
                                                <style>
                                                    .form-control {
                                                        border-color: #d03f3f
                                                    }
                                                </style>
                                                <div class="invalid-tooltip d-block position-static">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="gse_type" class="form-label">Jenis GSE</label>
                                            <select class="form-select" id="gse_type" name="gse_type">
                                                <option value="" disabled hidden {{ old('gse_type', $dataGse->gse_type) === null ? 'selected' : '' }}>Pilih Jenis GSE</option>
                                                <option value="Bus" {{ old('gse_type', $dataGse->gse_type) === 'Bus' ? 'selected' : '' }}>Bus</option>
                                                <option value="Tractor" {{ old('gse_type', $dataGse->gse_type) === 'Tractor' ? 'selected' : '' }}>Tractor</option>
                                                <option value="Belt Loader" {{ old('gse_type', $dataGse->gse_type) === 'Belt Loader' ? 'selected' : '' }}>Belt Loader</option>
                                            </select>

                                            @error('gse_type')
                                                <style>
                                                    #gse_type {
                                                        border-color: #d03f3f
                                                    }
                                                </style>
                                                <div class="invalid-tooltip d-block position-static">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="operator" class="form-label">Operator GSE</label>
                                            <select class="form-select" id="operator" name="operator">
                                                <option value="" disabled hidden {{ old('operator', $dataGse->operator) === null ? 'selected' : '' }}>Pilih Operator</option>
                                                <option value="Operator" {{ old('operator', $dataGse->operator) === 'Operator' ? 'selected' : '' }}>Operator</option>
                                                <option value="Maskapai" {{ old('operator', $dataGse->operator) === 'Maskapai' ? 'selected' : '' }}>Maskapai</option>
                                                <option value="Ground Handling" {{ old('operator', $dataGse->operator) === 'Ground Handling' ? 'selected' : '' }}>Ground Handling</option>
                                            </select>
                                            @error('operator')
                                                <style>
                                                    #operator {
                                                        border-color: #d03f3f
                                                    }
                                                </style>
                                                <div class="invalid-tooltip d-block position-static">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="operation_area" class="form-label">Area Operasi</label>
                                            <select class="form-select" id="operation_area" name="operation_area">
                                                <option value="" disabled hidden {{ old('operation_area', $dataGse->operation_area) === null ? 'selected' : '' }}>Pilih Area Operasi GSE</option>
                                                <option value="Operator" {{ old('operation_area', $dataGse->operation_area) === 'Operator' ? 'selected' : '' }}>Operator</option>
                                                <option value="Maskapai" {{ old('operation_area', $dataGse->operation_area) === 'Maskapai' ? 'selected' : '' }}>Maskapai</option>
                                                <option value="Ground Handling" {{ old('operation_area', $dataGse->operation_area) === 'Ground Handling' ? 'selected' : '' }}>Ground Handling</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="status_gse" class="form-label">Status GSE</label>
                                            <select class="form-select" id="status_gse" name="status">
                                                <option value="" disabled hidden {{ old('status', $dataGse->status) === null ? 'selected' : '' }}>Pilih Status GSE</option>
                                                <option value="1" {{ old('status', $dataGse->status) === 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status', $dataGse->status) === 0 ? 'selected' : '' }}>Not Active</option>
                                            </select>
                                            @error('status')
                                                <style>
                                                    #status_gse {
                                                        border-color: #d03f3f
                                                    }
                                                </style>
                                                <div class="invalid-tooltip d-block position-static">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <button class="btn btn-primary" type="submit">Create Data GSE</button>
                                        </div>

                                    </form>
                                </div> <!-- end col -->

                            </div>
                            <!-- end row-->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

        </div> <!-- container -->

    </div>
@endsection
