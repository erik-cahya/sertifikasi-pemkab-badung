@extends('admin-panel.layouts.app')

@section('content')
    @foreach ($dataDepartemen as $item)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class=".card-title">Edit Data Departemen</h4>
                    </div>
                    <form action="{{ route('departemen.update', $item->ref) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Nama Departemen</label><span class="text-danger">*</span>
                                        <input type="text" id="simpleinput" class="form-control rounded-3" name="departemen_nama" required value="{{$item->departemen_nama }}">
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-outline-primary rounded-3"><i class="ri-save-3-line"></i> Edit</button>
                                    </div>
                                </div>
                            </div><!-- end row-->
                        </div> <!-- end card-body -->
                    </form>
                </div> <!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->
    @endforeach

@endsection
