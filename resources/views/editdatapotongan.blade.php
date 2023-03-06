@if (Auth::user()->hak_akses == 'super_admin')
@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h3>Update Periode</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('updatedatapotongan', $datapotongan) }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="col-md-5 ms-5 me-5">
                            <div class="mb-1">
                                <label  class="form-label">Data Potongan</label>
                                <input type="text" class="form-control" name="data_potongan" value="{{ $datapotongan->data_potongan }}">
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Update</button>
                            <a href="{{ route('data_potongan') }}" class="btn btn-warning mt-2">Cancel</a>
                        </div>
                    </form>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endif