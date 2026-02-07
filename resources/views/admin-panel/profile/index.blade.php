@extends('admin-panel.layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="p-sm-3 profile-user mt-4 p-0">
                <div class="row g-2">
                    <div class="col-lg-3 d-none d-lg-block">
                        <div class="profile-user-img p-2 text-start mt-3">
                            <img src="{{ asset('img/' . $dataLSP->lsp_logo) }}" alt="" style="width: 150px; height: 150px;">
                        </div>
                        <div class="p-1 pt-2 text-start">
                            <h4 class="fs-17 ellipsis fw-bold">{{ $dataLSP->lsp_nama }}</h4>
                            <p class="font-13 fw-bold"> {{ $dataLSP->lsp_no_lisensi }}</p> 
                            <p class="text-muted mb-0"><small>{{ $dataLSP->lsp_alamat }}</small></p>

                            {{-- <div class="d-flex align-items-center justify-content-center flex-xl-nowrap flex-lg-wrap justify-content-md-start pt-3">
                                <button type="button" class="btn btn-soft-danger me-sm-2 mt-1">
                                    <i class="mdi mdi-cog fs-16 lh-1 me-1 align-text-bottom"></i>
                                    Edit Profile
                                </button>

                            </div> --}}

                        </div>
                        <div class="ps-1 pt-3">
                            <table>
                                <tr>
                                    <td class="fw-bold">Telp LSP </td>
                                    <td><span class="ms-2">: {{ $dataLSP->lsp_telp }}</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Email </td>
                                    <td><span class="ms-2">: {{ $dataLSP->lsp_email }}</span></td>
                                </tr>
                                <tr class="text-danger">
                                    <td class="fw-bold">Lisensi Expired </td>
                                    <td><span class="ms-2">: {{ $dataLSP->lsp_expired_lisensi }}</span></td>
                                </tr>
                            </table>
                            {{-- <p class="text-muted font-13 mb-2"><strong>Telp LSP :</strong><span class="ms-2">{{ $dataLSP->lsp_telp }}</span></p>
                            <p class="text-muted font-13 mb-2"><strong>Email :</strong> <span class="ms-2">{{ $dataLSP->lsp_email }}</span></p>
                            <p class="text-muted font-13 mb-1"><strong>Lisensi Expired :</strong> <span class="ms-2">{{ $dataLSP->lsp_expired_lisensi }}</span></p> --}}
                        </div>

                    </div>

                    <div class="col-lg-9 bg-light-subtle">
                        <div class="profile-content">
                            <div class="nav nav-pills nav-justified gap-0 p-3 text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                </li>
                                <li class="nav-item mt-2"><a class="nav-link fs-5 active p-2" data-bs-toggle="tab" data-bs-target="#aboutme" type="button" role="tab" aria-controls="home" aria-selected="true" href="#aboutme">Details</a>
                                </li>
                                <li class="nav-item mt-2"><a class="nav-link fs-5 p-2" data-bs-toggle="tab" data-bs-target="#edit-profile" type="button" role="tab" aria-controls="home" aria-selected="true" href="#edit-profile">Edit Data</a></li>

                            </div>

                            <div class="tab-content p-2" id="v-pills-tabContent">

                                <div class="tab-pane active" id="aboutme" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                    <div class="profile-desk">
                                        <table class="table-condensed table-bordered border-top table-striped mb-0 table">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Nama LSP</th>
                                                    <td><span>{{ $dataLSP->lsp_nama }}</span></td>
                                                </tr>
                                                 <tr>
                                                    <th scope="row">Nomor Lisensi</th>
                                                    <td><span>{{ $dataLSP->lsp_no_lisensi }}</span></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Tanggal Lisensi</th>
                                                    <td><span>{{ $dataLSP->lsp_tanggal_lisensi }}</span></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Expired Lisensi</th>
                                                    <td><span>{{ $dataLSP->lsp_expired_lisensi }}</span></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Telp LSP</th>
                                                    <td><span>{{ $dataLSP->lsp_telp }}</span></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Alamat LSP</th>
                                                    <td><span>{{ $dataLSP->lsp_alamat }}</span></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Email LSP</th>
                                                    <td><span>{{ $dataLSP->lsp_email }}</span></td>
                                                </tr>
                                               <tr>
                                                    <th scope="row">Nama Direktur</th>
                                                    <td><span>{{ $dataLSP->lsp_direktur }}</span></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Telp Direktur</th>
                                                    <td><span>{{ $dataLSP->lsp_direktur_telp }}</span></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div> <!-- end profile-desk -->
                                </div> <!-- about-me -->

                                <!-- settings -->
                                <div id="edit-profile" class="tab-pane">
                                    <div class="user-profile-content">
                                        <form action="{{ route('profile.update', $dataLSP->ref) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <x-form.input className="col-md-6 mb-3" type="text" name="lsp_nama" label="Nama LSP" value="{{ $dataLSP->lsp_nama }}" errorBag="update_lsp" />
                                                <x-form.input className="col-md-6 mb-3" type="text" name="lsp_no_lisensi" label="No Lisensi LSP" value="{{ $dataLSP->lsp_no_lisensi }}" />
                                                <x-form.input className="col-md-6 mb-3" type="text" name="lsp_telp" label="Kontak LSP" value="{{ $dataLSP->lsp_telp }}" />
                                                <x-form.input className="col-md-6 mb-3" type="text" name="lsp_alamat" label="Alamat LSP" value="{{ $dataLSP->lsp_alamat }}" />
                                                <x-form.input className="col-md-6 mb-3" type="text" name="lsp_email" label="Email LSP" value="{{ $dataLSP->lsp_email }}" />
                                                <x-form.input className="col-md-6 mb-3" type="text" name="lsp_direktur" label="Direktur LSP" value="{{ $dataLSP->lsp_direktur }}" />
                                                <x-form.input className="col-md-6 mb-3" type="text" name="lsp_direktur_telp" label="Kontak Direktur LSP" value="{{ $dataLSP->lsp_direktur_telp }}" />
                                                <x-form.input className="col-md-6 mb-3" type="date" name="lsp_tanggal_lisensi" label="Tanggal Lisensi LSP" value="{{ $dataLSP->lsp_tanggal_lisensi }}" />
                                                <x-form.input className="col-md-6 mb-3" type="date" name="lsp_expired_lisensi" label="Tanggal Expired LSP" value="{{ $dataLSP->lsp_expired_lisensi }}" />
                                                <x-form.input className="col-md-6 mb-3" type="file" name="lsp_logo" label="Upload Logo" />
                                            </div>
                                            <button class="btn btn-dinas" type="submit"><i class="mdi mdi-content-save-outline fs-16 lh-1 me-1"></i> Save</button>
                                        </form>
                                    </div>
                                </div>

                                <!-- profile -->

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
