@if (Auth::user()->hak_akses == 'super_admin' || Auth::user()->hak_akses == 'admin_finance')
@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h3>Edit Pendapatan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('update_pendapatan', $pendapatan) }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="d-flex">
                            <div class="col-md-5 ms-5 me-5">
                                <div class="mb-1">
                                    <label  class="form-label">Nilai</label>
                                    <input type="text" class="form-control" required name="nilai_pendapatan" value="{{ $pendapatan->nilai_pendapatan }}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-1">
                                    <label  class="form-label">Jenis</label>
                                    <select name="status" class="form-select" required>
                                        <option value="{{ $pendapatan->status }}">{{ $pendapatan->status }}</option>
                                        <option >--Pilih Salah Satu--</option>
                                        <option value="On">On</option>
                                        <option value="Off">Off</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Update</button>
                                <a href="{{ route('data_pendapatan') }}" class="btn btn-warning mt-2">Cancel</a>
                            </div>
                        </div>
                      </form>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endif