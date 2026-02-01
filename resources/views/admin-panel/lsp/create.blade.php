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
                            <h4 class="card-title">Create LSP Baru</h4>
                            <p class="text-muted mb-0">Tambahkan data LSP baru pada form berikut.</p>
                        </div>
                        <form action="{{ route('lsp.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="card border-dark border">
                                    <div class="card-header text-bg-info">
                                        <h4 class="card-title">Data LSP</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4 mt-2">
                                                <label for="lsp_nama" class="form-label">Nama LSP</label>
                                                <input type="text" id="lsp_nama" class="form-control" name="lsp_nama">
                                                @error('lsp_nama')
                                                    <style>
                                                        #lsp_nama {
                                                            border-color: #d03f3f
                                                        }
                                                    </style>
                                                    <div class="invalid-tooltip d-block position-static">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-4 mt-2">
                                                <label for="lsp_no_lisensi" class="form-label">No Lisensi LSP</label>
                                                <input type="text" class="form-control" id="lsp_no_lisensi" name="lsp_no_lisensi">
                                                @error('lsp_no_lisensi')
                                                    <style>
                                                        #lsp_no_lisensi {
                                                            border-color: #d03f3f
                                                        }
                                                    </style>
                                                    <div class="invalid-tooltip d-block position-static">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-4 mt-2">
                                                <label for="lsp_email" class="form-label">Email LSP</label>
                                                <input type="text" class="form-control" id="lsp_email" name="lsp_email">
                                                @error('lsp_email')
                                                    <style>
                                                        #lsp_email {
                                                            border-color: #d03f3f
                                                        }
                                                    </style>
                                                    <div class="invalid-tooltip d-block position-static">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-6 mt-2">
                                                <label for="lsp_alamat" class="form-label">Alamat LSP</label>
                                                <input type="text" class="form-control" id="lsp_alamat" name="lsp_alamat">
                                                @error('lsp_alamat')
                                                    <style>
                                                        #lsp_alamat {
                                                            border-color: #d03f3f
                                                        }
                                                    </style>
                                                    <div class="invalid-tooltip d-block position-static">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-6 mt-2">
                                                <label for="lsp_telp" class="form-label">Telp LSP</label>
                                                <input type="text" class="form-control" id="lsp_telp" name="lsp_telp">
                                                @error('lsp_telp')
                                                    <style>
                                                        #lsp_telp {
                                                            border-color: #d03f3f
                                                        }
                                                    </style>
                                                    <div class="invalid-tooltip d-block position-static">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-6 mt-2">
                                                <label for="lsp_direktur" class="form-label">LSP Direktur</label>
                                                <input type="text" class="form-control" id="lsp_direktur" name="lsp_direktur">
                                                @error('lsp_direktur')
                                                    <style>
                                                        #lsp_direktur {
                                                            border-color: #d03f3f
                                                        }
                                                    </style>
                                                    <div class="invalid-tooltip d-block position-static">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-6 mt-2">
                                                <label for="lsp_direktur_telp" class="form-label">Telp Direktur LSP</label>
                                                <input type="text" class="form-control" id="lsp_direktur_telp" name="lsp_direktur_telp">
                                                @error('lsp_direktur_telp')
                                                    <style>
                                                        #lsp_direktur_telp {
                                                            border-color: #d03f3f
                                                        }
                                                    </style>
                                                    <div class="invalid-tooltip d-block position-static">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-6 mt-2">
                                                <label for="lsp_logo" class="form-label">Logo LSP</label>
                                                <input type="file" class="form-control" id="lsp_logo" name="lsp_logo">
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

                                            <div class="col-lg-6 mt-2">
                                                <label for="lsp_tanggal_lisensi" class="form-label">Tanggal Lisensi LSP</label>
                                                <input type="date" class="form-control" id="lsp_tanggal_lisensi" name="lsp_tanggal_lisensi">
                                                @error('lsp_tanggal_lisensi')
                                                    <style>
                                                        #lsp_tanggal_lisensi {
                                                            border-color: #d03f3f
                                                        }
                                                    </style>
                                                    <div class="invalid-tooltip d-block position-static">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-6 mt-2">
                                                <label for="lsp_expired_lisensi" class="form-label">Expired Lisensi</label>
                                                <input type="date" class="form-control" id="lsp_expired_lisensi" name="lsp_expired_lisensi">
                                                @error('lsp_expired_lisensi')
                                                    <style>
                                                        #lsp_expired_lisensi {
                                                            border-color: #d03f3f
                                                        }
                                                    </style>
                                                    <div class="invalid-tooltip d-block position-static">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="card card border-dark border">
                                    <div class="card-header text-bg-info">
                                        <h4 class="card-title">Account LSP</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <div class="row g-2">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" class="form-control" id="name" placeholder="Input Nama User" name="name">
                                                            @error('name')
                                                                <style>
                                                                    #name {
                                                                        border-color: #d03f3f
                                                                    }
                                                                </style>
                                                                <div class="invalid-tooltip d-block position-static">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="username" class="form-label">Username</label>
                                                            <input type="text" class="form-control" id="username" placeholder="Input username" name="username">
                                                            @error('username')
                                                                <style>
                                                                    #username {
                                                                        border-color: #d03f3f
                                                                    }
                                                                </style>
                                                                <div class="invalid-tooltip d-block position-static">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div class="row g-2">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="password" class="form-label">Password</label>
                                                            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                                                            @error('password')
                                                                <style>
                                                                    #password {
                                                                        border-color: #d03f3f
                                                                    }
                                                                </style>
                                                                <div class="invalid-tooltip d-block position-static">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="password_confirmation" class="form-label">Password Confirmation</label>
                                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmation Password">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 mt-3">
                                    <button class="btn btn-primary" type="submit">Tambahkan Data LSP</button>
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
