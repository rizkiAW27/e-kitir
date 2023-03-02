@if (Auth::user()->hak_akses == 'super_admin' || Auth::user()->hak_akses == 'admin_finance')
@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h3>Tambah Tunjangan & BPJS</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('store_gaji') }}" method="POST">
                        @csrf
                        <div class="d-flex">
                            <div class="col-md-5 ms-5 me-5">
                                <div class="mb-1">
                                    <label  class="form-label">Kode</label>
                                    <input type="number" class="form-control" name="kode">
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Nama Pendapatan</label>
                                    <input type="text" class="form-control" name="nama_pendapatan">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-1">
                                    <label  class="form-label">Jenis</label>
                                    <select name="jenis" class="form-select">
                                        <option selected>--Pilih Salah Satu--</option>
                                        <option value="Pnedapatan Tetap">Pendapatan Tetap</option>
                                        <option value="Tunjangan Tetap">Tunjangan Tetap</option>
                                        <option value="Tunjangan Tidak Tetap">Tunjangan Tidak Tetap</option>
                                        <option value="Perusahaan">Perusahaan</option>
                                        <option value="Karyawan">Karyawan</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                                <button type="reset" class="btn btn-warning mt-2">Cancel</button>
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