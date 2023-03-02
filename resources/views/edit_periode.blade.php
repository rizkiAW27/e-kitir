@if (Auth::user()->hak_akses == 'super_admin' || Auth::user()->hak_akses == 'hrd')
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
                    <form action="{{ route('update_periode', $tglperiode) }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="col-md-5 ms-5 me-5">
                            <div class="mb-1">
                                <label  class="form-label">Tanggal Periode Awal</label>
                                <input type="date" class="form-control" name="tgl_periode1" value="{{ $tglperiode->tgl_periode1 }}">
                            </div>
                            <div class="mb-1">
                                <label  class="form-label">Tanggal Periode Akhir</label>
                                <input type="date" class="form-control" name="tgl_periode2" value="{{ $tglperiode->tgl_periode2 }}">
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Update</button>
                            <a href="{{ route('setting_periode') }}" class="btn btn-warning mt-2">Cancel</a>
                        </div>
                    </form>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endif