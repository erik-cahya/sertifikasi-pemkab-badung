@extends('admin-panel.layouts.app')

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class=".card-title">Search Data GSE</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="POST" action="{{ route('gse.searchData') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Nomor Seri GSE</label>
                                            <input type="text" id="simpleinput" class="form-control" name="gse_serial" placeholder="Masukkan Nomor Seri GSE" value="{{ $inputSerial ?? '' }}">
                                        </div>

                                        <div class="mb-3">
                                            <button class="btn btn-primary" type="submit">Search Data GSE</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @if (isset($inputSerial))
            @if ($dataGse !== null)
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class=".card-title">Data GSE Ditemukan</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="serial_gse">Serial GSE</label>
                                                <div class="col-md-9">
                                                    <input disabled type="text" class="form-control" id="serial_gse" name="serial_gse" value="{{ $dataGse->gse_serial }}">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="type_gse">Type GSE</label>
                                                <div class="col-md-9">
                                                    <input disabled type="text" class="form-control" id="type_gse" name="type_gse" value="{{ $dataGse->gse_type }}">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="operator">Opeator</label>
                                                <div class="col-md-9">
                                                    <input disabled type="text" class="form-control" id="operator" name="operator" value="{{ $dataGse->operator }}">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="operation_area">Operation Area</label>
                                                <div class="col-md-9">
                                                    <input disabled type="text" class="form-control" id="operation_area" name="operation_area" value="{{ $dataGse->operation_area }}">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="created_at">Ditambahkan</label>
                                                <div class="col-md-9">
                                                    <input disabled type="text" class="form-control" id="created_at" name="created_at" value="{{ $dataGse->created_at->format('d M Y | H:i:s') }}">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="updated_at">Diubah</label>
                                                <div class="col-md-9">
                                                    <input disabled type="text" class="form-control" id="updated_at" name="updated_at" value="{{ $dataGse->updated_at->format('d M Y | H:i:s') }}">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="status">Status</label>
                                                <div class="col-md-9">
                                                    <div class="alert {{ $dataGse->status === 1 ? 'alert-success' : 'alert-danger' }} d-flex align-items-center" role="alert">
                                                        <i class="{{ $dataGse->status === 1 ? 'mdi mdi-check' : 'mdi mdi-alert' }} fs-16 me-1"></i>
                                                        <div>{{ $dataGse->status === 1 ? 'Active' : 'Not Active' }}</div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class=".card-title">Riwayat GSE</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="timeline timeline-left">
                                                @foreach ($dataViolations as $pelanggaran)
                                                    @php
                                                        if ($pelanggaran->violation_level === 'berat') {
                                                            $textClass = 'text-danger';
                                                            $bgClass = 'bg-danger';
                                                        } elseif ($pelanggaran->violation_level === 'sedang') {
                                                            $textClass = 'text-primary';
                                                            $bgClass = 'bg-primary';
                                                        } else {
                                                            $textClass = 'text-success';
                                                            $bgClass = 'bg-success';
                                                        }
                                                    @endphp
                                                    <article class="timeline-item">
                                                        <div class="timeline-desk">
                                                            <div class="panel">
                                                                <div class="timeline-box">
                                                                    <span class="arrow"></span>
                                                                    <span class="timeline-icon {{ $bgClass }}"><i class="mdi mdi-record-circle-outline"></i></span>
                                                                    <span class="d-flex justify-content-between">

                                                                        <h4 class="fs-14 fw-semibold text-capitalize mb-1">{{ $pelanggaran->violation_name }} - {{ $pelanggaran->violation_type }}</h4>
                                                                        <h4 class="fs-14 fw-semibold {{ $textClass }} text-capitalize mb-1">Level {{ $pelanggaran->violation_level }}</h4>
                                                                    </span>

                                                                    <p class="timeline-date text-muted d-inline"><small> <i class="ri-calendar-line"></i> {{ \Carbon\Carbon::parse($pelanggaran->examination_date)->format('d M Y') }}</small></p>

                                                                    <p class="timeline-date text-muted d-inline p-2"><small> <i class="ri-user-fill"></i> {{ $pelanggaran->employee }}</small></p>
                                                                    <p class="timeline-date text-muted d-inline text-capitalize p-2"><small> <i class="ri-map-pin-2-fill"></i> {{ $pelanggaran->location }}</small></p>
                                                                    <hr>
                                                                    <p class="mt-1">{{ $pelanggaran->description }} </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </article>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <i class="mdi mdi-alert fs-16 me-1"></i>
                                <div>
                                    Data GSE Tidak Ditemukan | <a href="{{ route('gse.create') }}" class="alert-link">Tambah Data GSE Baru ?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
@endsection
