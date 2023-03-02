@if (Auth::user()->hak_akses == 'super_admin' || Auth::user()->hak_akses == 'hrd' || Auth::user()->hak_akses == 'admin_finance')
@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h3>Edit Lemburan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('update_lembur', $lembur) }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="d-flex">
                            <div class="col-md-5 ms-5 me-5">
                                <div class="mb-1">
                                    <label  class="form-label">Keterangan Lembur</label>
                                    <input type="text" class="form-control" required name="ket_lembur" value="{{ $lembur->ket_lembur }}">
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Lembur Jam 1</label>
                                    <input type="text" class="form-control" required name="jam1" value="{{ $lembur->jam1 }}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-1">
                                    <label  class="form-label">Lembur Jam 2</label>
                                    <input type="text" class="form-control" required name="jam2" value="{{ $lembur->jam2 }}">
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Tanggal Lembur</label>
                                    <input type="date" class="form-control" required name="tgl_lembur" value="{{ $lembur->tgl_lembur }}">
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Update</button>
                                <a href="{{ route('dataKaryawan_lembur') }}" class="btn btn-warning mt-2">Cancel</a>
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