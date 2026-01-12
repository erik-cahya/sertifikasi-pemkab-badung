@extends('admin-panel.layouts.app')
@section('content')
    <div class="col-xxl-8 order-lg-1 order-2">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h4 class="card-title">Add New User</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form enctype="multipart/form-data" method="POST" action="{{ route('user.store') }}">
                            @csrf
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
                                        <label for="roles" class="form-label">Role User</label>
                                        <select class="text-capitalize form-select" id="roles" name="roles">
                                            <option value="#" disabled selected hidden>Pilih Role User</option>
                                            <option value="Master" {{ old('roles') === 'Master' ? 'selected' : '' }}>Master</option>
                                            <option value="AMC" {{ old('roles') === 'AMC' ? 'selected' : '' }}>AMC</option>
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

                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Add New User</button>
                            </div>

                        </form>
                    </div> <!-- end col -->

                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-8 order-lg-1 order-2">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h4 class="card-title">User List</h4>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="mb-0 table align-middle">
                        <thead>
                            <tr class="table-light text-capitalize">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Password</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <!-- end table heading -->

                        <tbody>
                            @foreach ($dataUser as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm">
                                                <img src="{{ asset('admin') }}/assets/images/users/avatar.png" alt="" class="img-fluid rounded-circle">
                                            </div>
                                            <div class="ps-2">
                                                <h5 class="mb-1">{{ $user->name }}</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-semibold">{{ $user->email }}</span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $user->roles === 'master' ? 'bg-danger-subtle text-danger' : 'bg-success-subtle text-success' }} text-uppercase">{{ $user->roles }}</span>
                                    </td>
                                    <td>
                                        <h5 class="mb-0 ms-1">******</h5>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="See Details" data-bs-custom-class="success-tooltip"><i class="mdi mdi-eye"></i> </button>

                                            <a href="{{ route('gse.edit', $user->id) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Data" data-bs-custom-class="warning-tooltip"><i class="mdi mdi-lead-pencil"></i> </a>

                                            @if ($user->id !== Auth::user()->id)
                                                <input type="hidden" class="userID" value="{{ $user->id }}">
                                                <button type="button" class="btn btn-sm btn-danger deleteButton" data-nama="{{ $user->name }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Data" data-bs-custom-class="danger-tooltip">
                                                    <i class="mdi mdi-trash-can"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <!-- end table body -->
                    </table>
                    <!-- end table -->
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    {{-- Sweet Alert --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Saat halaman sudah ready
            const deleteButtons = document.querySelectorAll('.deleteButton');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    let nameUser = this.getAttribute('data-nama');
                    let userID = this.parentElement.querySelector('.userID').value;

                    console.log(userID);
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete user " + nameUser + "?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Kirim DELETE request manual lewat JavaScript
                            fetch('/user/' + userID, {
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
                                        icon: data.swalFlashIcon,
                                    });

                                    // Optional: reload table / halaman
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1500);
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire('Error', 'Something went wrong!', 'error');
                                });
                        }
                    });
                });
            });
        });
    </script>
@endpush
