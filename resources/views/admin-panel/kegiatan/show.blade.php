@extends('admin-panel.layouts.app')
@push('style')
    <!-- Datatables css -->
    <link href="{{ asset('admin') }}/assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-lg-4">
                <div class="card border-top-0 overflow-hidden">
                    <div class="progress progress-sm rounded-0 bg-light" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-success" style="width: 60%"></div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="">
                                <p class="text-muted fw-semibold fs-16 mb-1">{{ $dataKegiatan->nama_kegiatan }}</p>
                                <p class="text-muted">
                                    <small> {{ \Carbon\Carbon::parse($dataKegiatan->mulai_kegiatan)->locale('id')->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($dataKegiatan->selesai_kegiatan)->locale('id')->translatedFormat('d F Y') }}</small>
                                </p>

                                <span class="badge bg-success rounded-pill px-3">Active</span>

                            </div>
                            <div class="avatar-sm mb-4">
                                <div class="avatar-title bg-danger-subtle text-danger fs-24 rounded">
                                    <i class="bi bi-clipboard-data"></i>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex flex-lg-nowrap justify-content-between align-items-end flex-wrap">
                            <button class="btn-sm btn btn-danger">
                                <i class="mdi mdi-pencil"></i> Edit Kegiatan</button>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="nav nav-pills nav-justified gap-0 p-3 text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        </li>
                        <li class="nav-item mt-2"><a class="nav-link fs-5 active p-2" data-bs-toggle="tab" data-bs-target="#aboutme" type="button" role="tab" aria-controls="home" aria-selected="true" href="#aboutme"><i class="mdi mdi-pencil"></i> Detail Kegiatan</a>
                        </li>
                        <li class="nav-item mt-2"><a class="nav-link fs-5 p-2" data-bs-toggle="tab" data-bs-target="#user-activities" type="button" role="tab" aria-controls="home" aria-selected="true" href="#user-activities"><i class="mdi mdi-pencil"></i> Activities</a></li>
                        <li class="nav-item mt-2"><a class="nav-link fs-5 p-2" data-bs-toggle="tab" data-bs-target="#edit-profile" type="button" role="tab" aria-controls="home" aria-selected="true" href="#edit-profile"><i class="mdi mdi-pencil"></i> Daftar LSP</a></li>
                        <li class="nav-item mt-2"><a class="nav-link fs-5 p-2" data-bs-toggle="tab" data-bs-target="#projects" type="button" role="tab" aria-controls="home" aria-selected="true" href="#projects"><i class="mdi mdi-pencil"></i> Daftar Asesi</a></li>

                    </div>

                    <div class="tab-content p-sm-4 m-0 p-2" id="v-pills-tabContent">

                        <div class="tab-pane active" id="aboutme" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <div class="profile-desk">
                                <h5 class="text-uppercase fs-17 text-dark">Johnathan Deo</h5>
                                <div class="designation mb-3">PRODUCT DESIGNER (UX / UI / Visual
                                    Interaction)</div>
                                <p class="text-muted fs-16">
                                    I have 10 years of experience designing for the web, and
                                    specialize
                                    in the areas of user interface design, interaction design,
                                    visual
                                    design and prototyping. I’ve worked with notable startups
                                    including
                                    Pearl Street Software.
                                </p>

                                <h5 class="fs-17 text-dark mt-4">Contact Information</h5>
                                <table class="table-condensed table-bordered border-top table-striped mb-0 table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Url</th>
                                            <td>
                                                <a href="#" class="ng-binding">
                                                    www.example.com
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td>
                                                <a href="" class="ng-binding">
                                                    jonathandeo@example.com
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th scope="row">Phone</th>
                                            <td class="ng-binding">(123)-456-7890</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Skype</th>
                                            <td>
                                                <a href="#" class="ng-binding">
                                                    jonathandeo123
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div> <!-- end profile-desk -->
                        </div> <!-- about-me -->
                        <!-- Activities -->
                        <div id="user-activities" class="tab-pane">
                            <div class="timeline-2">
                                <div class="time-item">
                                    <div class="item-info mb-3 ms-3">
                                        <div class="text-muted">5 minutes ago</div>
                                        <p><strong><a href="#" class="text-info">John
                                                    Doe</a></strong>Uploaded a photo</p>
                                        <img src="assets/images/small/small-3.jpg" alt="" height="40" width="60" class="rounded-1">
                                        <img src="assets/images/small/small-4.jpg" alt="" height="40" width="60" class="rounded-1">
                                    </div>
                                </div>

                                <div class="time-item">
                                    <div class="item-info mb-3 ms-3">
                                        <div class="text-muted">30 minutes ago</div>
                                        <p><a href="" class="text-info">Lorem</a> commented your
                                            post.
                                        </p>
                                        <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit.
                                                Aliquam laoreet tellus ut tincidunt euismod. "</em>
                                        </p>
                                    </div>
                                </div>

                                <div class="time-item">
                                    <div class="item-info mb-3 ms-3">
                                        <div class="text-muted">59 minutes ago</div>
                                        <p><a href="" class="text-info">Jessi</a> attended a meeting
                                            with<a href="#" class="text-success">John Doe</a>.</p>
                                        <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit.
                                                Aliquam laoreet tellus ut tincidunt euismod. "</em>
                                        </p>
                                    </div>
                                </div>

                                <div class="time-item">
                                    <div class="item-info mb-3 ms-3">
                                        <div class="text-muted">5 minutes ago</div>
                                        <p><strong><a href="#" class="text-info">John
                                                    Doe</a></strong> Uploaded 2 new photos</p>
                                        <img src="assets/images/small/small-2.jpg" alt="" height="40" width="60" class="rounded-1">
                                        <img src="assets/images/small/small-1.jpg" alt="" height="40" width="60" class="rounded-1">
                                    </div>
                                </div>

                                <div class="time-item">
                                    <div class="item-info mb-3 ms-3">
                                        <div class="text-muted">30 minutes ago</div>
                                        <p><a href="" class="text-info">Lorem</a> commented your
                                            post.
                                        </p>
                                        <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit.
                                                Aliquam laoreet tellus ut tincidunt euismod. "</em>
                                        </p>
                                    </div>
                                </div>

                                <div class="time-item">
                                    <div class="item-info mb-3 ms-3">
                                        <div class="text-muted">59 minutes ago</div>
                                        <p><a href="" class="text-info">Jessi</a> attended a meeting
                                            with<a href="#" class="text-success">John Doe</a>.</p>
                                        <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit.
                                                Aliquam laoreet tellus ut tincidunt euismod. "</em>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- settings -->
                        <div id="edit-profile" class="tab-pane">
                            <div class="user-profile-content">
                                <form>
                                    <div class="row row-cols-sm-2 row-cols-1">
                                        <div class="mb-2">
                                            <label class="form-label" for="FullName">Full
                                                Name</label>
                                            <input type="text" value="John Doe" id="FullName" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="Email">Email</label>
                                            <input type="email" value="first.last@example.com" id="Email" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="web-url">Website</label>
                                            <input type="text" value="Enter website url" id="web-url" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="Username">Username</label>
                                            <input type="text" value="john" id="Username" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="Password">Password</label>
                                            <input type="password" placeholder="6 - 15 Characters" id="Password" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="RePassword">Re-Password</label>
                                            <input type="password" placeholder="6 - 15 Characters" id="RePassword" class="form-control">
                                        </div>
                                        <div class="col-sm-12 mb-3">
                                            <label class="form-label" for="AboutMe">About Me</label>
                                            <textarea style="height: 125px;" id="AboutMe" class="form-control">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</textarea>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-content-save-outline fs-16 lh-1 me-1"></i> Save</button>
                                </form>
                            </div>
                        </div>
                        <div id="projects" class="tab-pane">
                            <div class="row m-t-10">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table-bordered table-striped table-hover mb-0 table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Project Name</th>
                                                    <th>Start Date</th>
                                                    <th>Due Date</th>
                                                    <th>Status</th>
                                                    <th>Assign</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-group-divider">
                                                <tr>
                                                    <td>1</td>
                                                    <td>Techmin Admin</td>
                                                    <td>01/01/2015</td>
                                                    <td>07/05/2015</td>
                                                    <td><span class="badge bg-info">Work
                                                            in Progress</span></td>
                                                    <td>Techzaa</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Techmin Frontend</td>
                                                    <td>01/01/2015</td>
                                                    <td>07/05/2015</td>
                                                    <td><span class="badge bg-success">Pending</span>
                                                    </td>
                                                    <td>Techzaa</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Techmin Admin</td>
                                                    <td>01/01/2015</td>
                                                    <td>07/05/2015</td>
                                                    <td><span class="badge bg-pink">Done</span>
                                                    </td>
                                                    <td>Techzaa</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Techmin Frontend</td>
                                                    <td>01/01/2015</td>
                                                    <td>07/05/2015</td>
                                                    <td><span class="badge bg-purple">Work
                                                            in Progress</span></td>
                                                    <td>Techzaa</td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Techmin Admin</td>
                                                    <td>01/01/2015</td>
                                                    <td>07/05/2015</td>
                                                    <td><span class="badge bg-warning">Coming
                                                            soon</span></td>
                                                    <td>Techzaa</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- profile -->

                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
@push('script')
    <!-- Datatables js -->
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>

    <!-- Datatable Demo App js -->
    <script src="{{ asset('admin') }}/assets/js/pages/datatable.init.js"></script>

    {{-- Sweet Alert --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.deleteButton').forEach(button => {

                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const row = this.closest('tr');
                    const dataNama = this.dataset.nama;
                    const dataID = this.closest('td').querySelector('.dataID').value;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: `Delete data ${dataNama}?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                    }).then(result => {

                        if (!result.isConfirmed) return;

                        fetch(`/lsp/${dataID}`, {
                                method: 'DELETE',
                                credentials: 'same-origin',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'X-Requested-With': 'XMLHttpRequest',
                                }
                            })
                            .then(() => {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: 'Data LSP berhasil dihapus',
                                    icon: 'success',
                                    timer: 1200,
                                    showConfirmButton: false
                                });
                                row.style.transition = 'opacity 0.3s';
                                row.style.opacity = 0;
                                setTimeout(() => row.remove(), 300);
                            })
                            .catch(err => {
                                console.error(err);
                                Swal.fire('Error', 'Request gagal dikirim ke server', 'error');
                            });
                    });
                });

            });

        });
    </script>
@endpush
