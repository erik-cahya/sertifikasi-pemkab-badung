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
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Data LSP
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="simpleinput" class="form-label">Nama LSP</label>
                                                        <input type="text" id="simpleinput" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="simpleinput" class="form-label">Alamat LSP</label>
                                                        <input type="text" id="simpleinput" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="simpleinput" class="form-label">No Telp LSP</label>
                                                        <input type="text" id="simpleinput" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="simpleinput" class="form-label">Jenis</label>
                                                        <input type="text" id="simpleinput" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Account LSP
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <div class="row g-2">
                                                            <div class="col-md-4 mb-3">
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
                                                            <div class="col-md-4 mb-3">
                                                                <label for="email" class="form-label">Email</label>
                                                                <input type="email" class="form-control" id="email" placeholder="Input Email" name="email">
                                                                @error('email')
                                                                    <style>
                                                                        #email {
                                                                            border-color: #d03f3f
                                                                        }
                                                                    </style>
                                                                    <div class="invalid-tooltip d-block position-static">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="roles" class="form-label">Status LSP</label>
                                                                <select class="text-capitalize form-select" id="roles" name="roles">
                                                                    <option value="#" disabled selected hidden>Pilih Status LSP</option>
                                                                    <option value="1" {{ old('roles') === 'Active' ? 'selected' : '' }}>Active</option>
                                                                    <option value="0" {{ old('roles') === 'Disabled' ? 'selected' : '' }}>Disabled</option>
                                                                </select>

                                                                @error('roles')
                                                                    <style>
                                                                        #roles {
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
                                                                <input type="password" class="form-control" id="password" placeholder="Email" name="password">
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
                                                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                    </div>


                                </div>
                            </div>
                            <div class="mb-3 mt-3">
                                <button class="btn btn-primary" type="submit">Add New User</button>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
@endpush
