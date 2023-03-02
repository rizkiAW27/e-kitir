@if (Auth::user()->hak_akses == 'super_admin' || Auth::user()->hak_akses == 'admin_finance' || Auth::user()->hak_akses == 'hrd')
@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h3>Tambah Lemburan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('store_lembur', $karyawan) }}" method="POST">
                        @csrf
                        <div class="d-flex">
                            <div class="col-md-5 ms-5 me-5">
                                <div class="mb-1">
                                    <label  class="form-label">ID Karyawan</label>
                                    <input type="number" class="form-control" required name="id_karyawan" value="{{ $karyawan->id_karyawan }}">
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Keterangan Lembur</label>
                                    <input type="text" class="form-control" required name="ket_lembur">
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Lembur Jam 1</label>
                                    <input type="text" class="form-control" required name="jam1">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-1">
                                    <label  class="form-label">Lembur Jam 2</label>
                                    <input type="text" class="form-control" required name="jam2">
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Tanggal Lembur</label>
                                    <input type="date" class="form-control" required name="tgl_lembur">
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                                <a href="{{ route('data_salary') }}" class="btn btn-warning mt-2">Cancel</a>
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