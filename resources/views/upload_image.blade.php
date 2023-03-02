@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h3>Upload Image</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('store_upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex justify-content-center">
                            <div class="col-md-5 ms-5 me-5">
                                <div class="mb-1">
                                    <label  class="form-label">Pilih Gambar</label>
                                    <input type="file" class="form-control" name="image" required>
                                    <input type="hidden" class="form-control" name="id_user" value="{{ Auth::user()->id }}">
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Upload</button>
                                <a href="{{ route('home') }}" class="btn btn-warning mt-2">Cancel</a>
                            </div>
                        </div>
                      </form>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
