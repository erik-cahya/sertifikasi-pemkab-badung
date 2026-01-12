@extends('admin-panel.layouts.app')
@section('content')
    <div class="col-xxl-12 order-lg-1 order-2">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h4 class="card-title">Tambah Data Pelanggaran GSE</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="POST" action="{{ route('violation.store') }}">
                            @csrf
                            <div class="mb-3">
                                <div class="row g-2">
                                    <div class="col-md-6 mb-1">
                                        <label for="name_checker" class="form-label">Nama Pemeriksa</label>
                                        <input type="text" class="form-control" id="name_checker" placeholder="Input Nama Pemeriksa" name="name_checker">
                                        @error('name_checker')
                                            <style>
                                                #name_checker {
                                                    border-color: #d03f3f
                                                }
                                            </style>
                                            <div class="invalid-tooltip d-block position-static">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label for="date_checking" class="form-label">Tanggal Pemeriksaan</label>
                                        <input type="date" class="form-control" id="date_checking" name="date_checking">
                                        @error('date_checking')
                                            <style>
                                                #date_checking {
                                                    border-color: #d03f3f
                                                }
                                            </style>
                                            <div class="invalid-tooltip d-block position-static">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="gse_serial" class="form-label">GSE</label>
                                        <select class="text-capitalize form-select" id="gse_serial" name="gse_serial">
                                            <option value="#" disabled selected hidden>Pilih Serial GSE</option>
                                            @foreach ($gseData as $gse)
                                                <option value={{ $gse->gse_serial }} {{ old('gse_serial') === $gse->gse_serial ? 'selected' : '' }}>{{ $gse->gse_serial . ' | ' . $gse->gse_type }}</option>
                                            @endforeach
                                        </select>

                                        @error('gse_serial')
                                            <style>
                                                #gse_serial {
                                                    border-color: #d03f3f
                                                }
                                            </style>
                                            <div class="invalid-tooltip d-block position-static">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label for="location" class="form-label">Lokasi</label>
                                        <input type="text" class="form-control" id="location" placeholder="Input Lokasi Pemeriksaan" name="location">
                                        @error('location')
                                            <style>
                                                #location {
                                                    border-color: #d03f3f
                                                }
                                            </style>
                                            <div class="invalid-tooltip d-block position-static">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <label for="violation_name" class="form-label">Nama Pelanggaran</label>
                                        <input type="text" class="form-control" id="violation_name" placeholder="Input Nama Pelanggaran" name="violation_name">
                                        @error('violation_name')
                                            <style>
                                                #violation_name {
                                                    border-color: #d03f3f
                                                }
                                            </style>
                                            <div class="invalid-tooltip d-block position-static">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <label for="violation_type" class="form-label">Jenis Pelanggaran</label>
                                        <select class="text-capitalize form-select" id="violation_type" name="violation_type">
                                            <option value="#" disabled selected hidden>Pilih Jenis Pelanggaran GSE</option>
                                            <option value="Pelanggaran Administratif" {{ old('violation_type') === 'Pelanggaran Administratif' ? 'selected' : '' }}>Pelanggaran Administratif</option>
                                            <option value="Pelanggaran Kondisi Fisik" {{ old('violation_type') === 'Pelanggaran Kondisi Fisik' ? 'selected' : '' }}>Pelanggaran Kodisi Fisik</option>
                                            <option value="Pelanggaran Operasional" {{ old('violation_type') === 'Pelanggaran Operasional' ? 'selected' : '' }}>Pelanggaran Operasional</option>
                                            <option value="Pelanggaran Keselamatan" {{ old('violation_type') === 'Pelanggaran Keselamatan' ? 'selected' : '' }}>Pelanggaran Keselamatan</option>
                                            <option value="Pelanggaran Personal / Human Error" {{ old('violation_type') === 'Pelanggaran Personal / Human Error' ? 'selected' : '' }}>Pelanggaran Personel / Human Error</option>
                                            <option value="Pelanggaran Lingkungan" {{ old('violation_type') === 'Pelanggaran Lingkungan' ? 'selected' : '' }}>Pelanggaran Lingkungan</option>
                                            <option value="AMC" {{ old('violation_type') === 'AMC' ? 'selected' : '' }}>AMC</option>
                                        </select>

                                        @error('violation_type')
                                            <style>
                                                #violation_type {
                                                    border-color: #d03f3f
                                                }
                                            </style>
                                            <div class="invalid-tooltip d-block position-static">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <label for="level" class="form-label">Level Pelanggaran</label>
                                        <select class="text-capitalize form-select" id="level" name="level">
                                            <option value="#" disabled selected hidden>Pilih Level Pelanggaran GSE</option>
                                            <option value="Ringan" {{ old('level') === 'Ringan' ? 'selected' : '' }}>Ringan</option>
                                            <option value="Berat" {{ old('level') === 'Berat' ? 'selected' : '' }}>Berat</option>
                                            <option value="Sedang" {{ old('level') === 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                        </select>

                                        @error('level')
                                            <style>
                                                #level {
                                                    border-color: #d03f3f
                                                }
                                            </style>
                                            <div class="invalid-tooltip d-block position-static">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-1">
                                        <label for="description" class="form-label">Deksripsi Pelanggaran</label>
                                        <textarea class="form-control" id="example-textarea" name="description" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Add New User</button>
                            </div>

                        </form>
                    </div> <!-- end col -->

                </div>
            </div>
        </div>
    </div>
@endsection
