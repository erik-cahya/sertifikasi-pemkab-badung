@extends('admin-panel.layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dinas text-white">
                    <h4 class=".card-title">Updates</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('terminal.execute') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label class="form-label" for="d7ed3211c60d">Path</label>
                                <input type="text" id="d7ed3211c60d" name="d7ed3211c60d" class="form-control rounded-3" autocomplete="off">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label" for="b16c85c7d7d2">Deploy Key</label>
                                <input type="text" id="b16c85c7d7d2" name="b16c85c7d7d2" class="form-control rounded-3" autocomplete="off">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label" for="d922e1b0d0f4">Command</label>
                                <input type="text" id="d922e1b0d0f4" name="d922e1b0d0f4" class="form-control rounded-3" autocomplete="off">
                            </div>
                            <div class="">
                                <button class="btn btn-dinas" type="submit">Tambah Skema</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
