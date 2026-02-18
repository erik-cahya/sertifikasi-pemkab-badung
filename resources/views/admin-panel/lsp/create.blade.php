@extends('admin-panel.layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header bg-dinas text-white">
                            <h4 class="card-title">Tambah LSP Baru</h4>
                            <p class="mb-0">Tambahkan data LSP baru pada form berikut.</p>
                        </div>
                        <form action="{{ route('lsp.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="card border-dark border">
                                    <div class="card-header bg-dinas text-white">
                                        <h4 class="card-title">Data LSP</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">

                                            <x-form.input className="col-md-4 mt-2" type="text" name="lsp_nama" label="Nama LSP" value="{{ old('lsp_nama') }}" />
                                            <x-form.input className="col-md-4 mt-2" type="text" name="lsp_no_lisensi" label="No Lisensi LSP" value="{{ old('lsp_no_lisensi') }}" />
                                            <x-form.input className="col-md-4 mt-2" type="text" name="lsp_email" label="Email LSP" value="{{ old('lsp_email') }}" />
                                            <x-form.input className="col-md-4 mt-2" type="text" name="lsp_alamat" label="Alamat LSP" value="{{ old('lsp_alamat') }}" />
                                            <x-form.input className="col-md-4 mt-2" type="text" name="lsp_telp" label="Telp LSP" value="{{ old('lsp_telp') }}" />
                                            <x-form.input className="col-md-4 mt-2" type="text" name="lsp_direktur" label="Nama Direktur LSP" value="{{ old('lsp_direktur') }}" />
                                            <x-form.input className="col-md-4 mt-2" type="text" name="lsp_direktur_telp" label="No Telp Direktur" value="{{ old('lsp_direktur_telp') }}" />

                                            <div class="col-md-4 mt-2">
                                                <label for="lsp_logo" class="form-label">Logo LSP</label>
                                                <input type="file" class="form-control rounded-3" id="lsp_logo" name="lsp_logo">
                                                @error('lsp_logo')
                                                    <style>
                                                        #lsp_logo {
                                                            border-color: #d03f3f
                                                        }
                                                    </style>
                                                    <div class="invalid-tooltip d-block position-static">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            {{-- <div class="col-md-6 mt-3">
                                                <label class="form-label" for="lsp_tanggal_lisensi">Tanggal Lisensi
                                                    LSP</label>

                                                <input type="text" id="lsp_tanggal_lisensi" name="lsp_tanggal_lisensi"
                                                    class="form-control rounded-3 single-date @error('lsp_tanggal_lisensi') is-invalid @enderror"
                                                    value="{{ old('lsp_tanggal_lisensi') }}" autocomplete="off">

                                                @error('lsp_tanggal_lisensi')
                                                    <div class="invalid-feedback" bis_skin_checked="1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div> --}}

                                            <div class="col-md-4 mt-2">
                                                <label class="form-label" for="lsp_expired_lisensi">Tanggal Expired Lisensi</label>

                                                <input type="text" id="lsp_expired_lisensi" name="lsp_expired_lisensi" class="form-control rounded-3 single-date @error('lsp_expired_lisensi') is-invalid @enderror" value="{{ old('lsp_expired_lisensi') }}" autocomplete="off">

                                                @error('lsp_expired_lisensi')
                                                    <div class="invalid-feedback" bis_skin_checked="1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <x-form.input className="col-md-6 mt-2" type="text" name="nama_cp_1" label="Nama Kontak Person 1" value="{{ old('nama_cp_1') }}" />
                                            <x-form.input className="col-md-6 mt-2" type="text" name="nomor_cp_1" label="Nomor Kontak Person 1" value="{{ old('nomor_cp_1') }}" />
                                            <x-form.input className="col-md-6 mt-2" type="text" name="nama_cp_2" label="Nama Kontak Person 2 (opsional)" value="{{ old('nama_cp_2') }}" />
                                            <x-form.input className="col-md-6 mt-2" type="text" name="nomor_cp_2" label="Nomor Kontak Person 2 (opsional)" value="{{ old('nomor_cp_2') }}" />


                                        </div>
                                    </div>
                                </div>

                                <div class="card card border-dark border">
                                    <div class="card-header bg-dinas text-white">
                                        <h4 class="card-title">Account LSP</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <div class="row g-2">

                                                        <x-form.input className="col-md-6 mt-2" type="text" name="name" label="Nama LSP" value="{{ old('name') }}" />
                                                        <x-form.input className="col-md-6 mt-2" type="text" name="username" label="Username" value="{{ old('username') }}" />
                                                        <x-form.input className="col-md-6 mt-2" type="password" name="password" label="Password" />
                                                        <x-form.input className="col-md-6 mt-2" type="password" name="password_confirmation" label="Password Confirmation" />



                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 mt-3">
                                    <button class="btn btn-dinas" type="submit">Tambahkan Data LSP</button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(function() {
                $('.single-date').daterangepicker({
                    singleDatePicker: true,
                    autoUpdateInput: false,
                    locale: {
                        format: 'DD/MM/YYYY'
                    }
                });

                $('.single-date').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('DD/MM/YYYY'));
                }).on('cancel.daterangepicker', function() {
                    $(this).val('');
                });
            });
        });
    </script>
@endpush
