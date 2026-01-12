<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Form Elements | Techmin - Bootstrap 5 Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin') }}/assets/images/favicon.ico">

    <!-- Theme Config Js -->
    <script src="{{ asset('admin') }}/assets/js/config.js"></script>

    <!-- App css -->
    <link href="{{ asset('admin') }}/assets/css/app.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('admin') }}/assets/css/icons.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- Begin page -->
    <div class="container mt-2">

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class=".card-title">Form Pendaftaran LSP</h4>
                                {{-- <p class="text-muted mb-0">
                                Most common form control, text-based input fields. Includes support for all
                                HTML5 types: <code>text</code>, <code>password</code>, <code>datetime</code>,
                                <code>datetime-local</code>, <code>date</code>, <code>month</code>,
                                <code>time</code>, <code>week</code>, <code>number</code>, <code>email</code>,
                                <code>url</code>, <code>search</code>, <code>tel</code>, and <code>color</code>.
                            </p> --}}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Nama Lengkap</label>
                                            <input type="text" id="simpleinput" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Email</label>
                                            <input type="text" id="simpleinput" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">NIK (Nomor Induk Kependudukan)</label>
                                            <input type="text" id="simpleinput" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Tempat Lahir (Sesuai KTP)</label>
                                            <input type="text" id="simpleinput" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Tanggal Lahir</label>
                                            <input type="date" id="simpleinput" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Jenis Kelamin</label>
                                            <input type="text" id="simpleinput" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">No Telepon (Kontak)</label>
                                            <input type="text" id="simpleinput" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Pendidikan Terakhir</label>
                                            <input type="text" id="simpleinput" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Alamat Tempat Tinggal</label>
                                            <input type="text" id="simpleinput" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Alamat Tempat Bekerja</label>
                                            <input type="text" id="simpleinput" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Jabatan</label>
                                            <input type="text" id="simpleinput" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Alamat Tempat Bekerja</label>
                                            <input type="text" id="simpleinput" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Nama LSP</label>
                                            <input type="text" id="simpleinput" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Skema Sertifikasi</label>
                                            <input type="text" id="simpleinput" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Upload Portofolop</label>
                                            <input type="text" id="simpleinput" class="form-control">
                                        </div>
                                    </div>

                                </div>
                                <!-- end row-->
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->

            </div> <!-- container -->

        </div>

    </div>

    <div class="container mb-3">
        <!-- Footer Start -->
        <footer class="">
            <div class="row">
                <div class="col-12 text-center">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © Techmin - Theme by <b>Techzaa</b>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

    <!-- END wrapper -->

    <!-- Vendor js -->
    <script src="{{ asset('admin') }}/assets/js/vendor.js"></script>

    <script src="{{ asset('admin') }}/assets/vendor/lucide/umd/lucide.js"></script>

    <!-- App js -->
    <script src="{{ asset('admin') }}/assets/js/app.js"></script>

</body>

</html>
