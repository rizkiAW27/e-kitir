@if (Auth::user()->hak_akses == 'super_admin' || Auth::user()->hak_akses == 'hrd')
@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h3>Update Status Tandatangan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('update_ttd', $ttd) }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="col-md-5 ms-5 me-5">
                            <div class="mb-1">
                                <label  class="form-label">Status TTD</label>
                                <select name="status_ttd" class="form-select">
                                    <option value="{{ $ttd->status_ttd }}">{{ $ttd->status_ttd }}</option>
                                    <option value="sudah">sudah</option>
                                    <option value="belum">belum</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Update</button>
                            <a href="{{ route('index_status') }}" class="btn btn-warning mt-2">Cancel</a>
                        </div>
                    </form>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endif