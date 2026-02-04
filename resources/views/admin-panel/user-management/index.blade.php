@extends('admin-panel.layouts.app')
@section('content')
    <div class="col-xxl-8 order-lg-1 order-2">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <div class="">
                    <h4 class="card-title">Add New User</h4>
                </div>
                <a href="{{ route('lsp.create') }}" class="btn btn-info btn-sm"><i class="ri-add-circle-line"></i> Buat Account LSP</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form enctype="multipart/form-data" method="POST" action="{{ route('user-management.store') }}">
                            @csrf
                            <div class="mb-3">
                                <div class="row g-2">

                                    <x-form.input className="col-md-4 mb-3" type="text" name="name" label="Nama User" value="{{ old('name') }}" />
                                    <x-form.input className="col-md-4 mb-3" type="text" name="email" label="Email" value="{{ old('email') }}" />
                                    <x-form.input className="col-md-4 mb-3" type="text" name="username" label="Username" value="{{ old('username') }}" />


                                    <div class="col-md-4 mb-3">
                                        <label for="roles" class="form-label">Role User</label>
                                        <select class="text-capitalize form-select rounded-3 @error('roles') is-invalid @enderror" id="roles" name="roles">
                                            <option value="#" disabled selected hidden>Pilih Role User</option>
                                            <option value="Master" {{ old('roles') === 'Master' ? 'selected' : '' }}>Master</option>
                                            <option value="Dinas" {{ old('roles') === 'Dinas' ? 'selected' : '' }}>Dinas</option>
                                            <option value="HRD" {{ old('roles') === 'HRD' ? 'selected' : '' }}>HRD</option>
                                        </select>

                                        @error('roles')
                                            <div class="invalid-feedback" bis_skin_checked="1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <x-form.input className="col-md-4 mb-3" type="password" name="password" label="Password" />
                                    <x-form.input className="col-md-4 mb-3" type="password" name="password_confirmation" label="Password Confirmation" />



                                </div>

                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit"><i class="ri-add-circle-line"></i> Add New User</button>
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
                                <th>Username</th>
                                <th>Roles</th>
                                <th>Status</th>
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
                                        <span class="fw-semibold ">{{ $user->username }}</span>
                                    </td>
                                    <td>
                                        @php
                                            if ($user->roles == 'master') {
                                                $className = 'bg-danger-subtle text-danger';
                                            } elseif ($user->roles == 'dinas') {
                                                $className = 'bg-primary-subtle text-primary';
                                            } elseif ($user->roles == 'hrd') {
                                                $className = 'bg-purple-subtle text-purple';
                                            } else {
                                                $className = 'bg-success-subtle text-success';
                                            }
                                        @endphp
                                        <span class="badge {{ $className }} text-uppercase">{{ $user->roles }}</span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $user->is_active == 1 ? 'bg-primary-subtle text-primary' : 'bg-danger-subtle text-danger' }}">
                                            {{ $user->is_active == 1 ? 'Active' : 'Not Active' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="See Details" data-bs-custom-class="success-tooltip"><i class="mdi mdi-eye"></i> </button>

                                            {{-- <a href="{{ route('user-management.edit', $user->id) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Data" data-bs-custom-class="warning-tooltip" data-bs-target="#editModal"><i class="mdi mdi-lead-pencil"></i> </a> --}}

                                            <button class="btn-sm btn btn-warning" data-bs-toggle="modal" data-bs-placement="top" data-bs-target="#editUserModal">
                                                <i class="mdi mdi-lead-pencil"></i>
                                            </button>

                                            @if ($user->id !== Auth::id() && $user->roles !== 'lsp')
                                                <input type="hidden" class="userID" value="{{ $user->id }}">
                                                <button type="button" class="btn btn-sm btn-danger deleteButton" data-nama="{{ $user->name }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Data" data-bs-custom-class="danger-tooltip">
                                                    <i class="mdi mdi-trash-can"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <!-- Edit Data Modal -->
                                <div id="editUserModal" class="modal modal-lg fade" tabindex="-1" role="dialog" aria-labelledby="success-header-modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('user-management.update', $user->id) }}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <div class="modal-header modal-colored-header bg-dinas text-white">
                                                    <h4 class="modal-title" id="success-header-modalLabel">Edit Kegiatan</h4>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row px-2">
                                                        <x-form.input className="col-md-6 mb-3" type="text" name="name" label="Nama User" value="{{ old('name', $user->name) }}" errorBag="update_user" />
                                                        <x-form.input className="col-md-6 mb-3" type="text" name="email" label="Email" value="{{ old('email', $user->email) }}" errorBag="update_user" />
                                                        <x-form.input className="col-md-6 mb-3" type="text" name="username" label="Username" value="{{ old('username', $user->username) }}" errorBag="update_user" />
                                                        <x-form.input className="col-md-6 mb-3" type="text" name="username" label="Username" value="{{ $user->roles }}" disabled />

                                                        <hr>

                                                        <x-form.input className="col-md-6 mb-3" type="password" name="password" label="Change Password" errorBag="update_user" />
                                                        <x-form.input className="col-md-6 mb-3" type="password" name="password_confirmation" label="Password Confirmation" errorBag="update_user" />
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-pink">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Edit Data Modal -->
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
    @if ($errors->update_user->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editUserModal = new bootstrap.Modal(
                    document.getElementById('editUserModal')
                );
                editUserModal.show();
            });
        </script>
    @endif
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
                            fetch('/user-management/' + userID, {
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
