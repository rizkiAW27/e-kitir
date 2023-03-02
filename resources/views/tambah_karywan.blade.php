@if (Auth::user()->hak_akses == 'super_admin' || Auth::user()->hak_akses == 'hrd')
@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h3>Tambah Karyawan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('store_karyawan') }}" method="POST">
                        @csrf
                        <div class="d-flex">
                            <div class="col-md-5 ms-5 me-5">
                                <div class="mb-1">
                                    <label  class="form-label">ID Karyawan</label>
                                    <input type="number" class="form-control" name="id_karyawan">
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama">
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Bagian</label>
                                    <input type="text" class="form-control" name="bagian">
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan">
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Status Karyawan</label>
                                    <select name="status_karyawan" class="form-select">
                                        <option selected>--Pilih Salah Satu--</option>
                                        <option value="OJT">OJT</option>
                                        <option value="Tetap">Tetap</option>
                                        <option value="Honor">Honor</option>
                                    </select>
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Status PTKP</label>
                                    <select name="status_ptkp" class="form-select">
                                        <option selected>--Pilih Salah Satu--</option>
                                        <option value="TK0">TK0</option>
                                        <option value="TK1">TK1</option>
                                        <option value="TK2">TK2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-1">
                                    <label  class="form-label">Tanggal Bergabung</label>
                                    <input type="date" class="form-control" name="tgl_bergabung">
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Gaji Pokok</label>
                                    <input type="number" class="form-control" name="gaji_pokok">
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Nama Bank</label>
                                    <select name="nama_bank" class="form-select">
                                        <option selected>--Pilih Salah Satu--</option>
                                        <option value="BNI">BNI</option>
                                        <option value="BRI">BRI</option>
                                        <option value="BCA">BCA</option>
                                    </select>
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">No Rekening</label>
                                    <input type="number" class="form-control" name="norek">
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Nama Pemilik Bank</label>
                                    <input type="text" class="form-control" name="namaPem_bank">
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                                <button type="reset" class="btn btn-warning mt-2">Cencel</button>
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