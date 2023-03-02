@if (Auth::user()->hak_akses == 'super_admin' || Auth::user()->hak_akses == 'hrd')
@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h3>Edit Karyawan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('update_karyawan', $karyawan) }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="d-flex">
                            <div class="col-md-5 ms-5 me-5">
                                <div class="mb-1">
                                    <label  class="form-label">ID Karyawan</label>
                                    <input type="number" class="form-control" name="id_karyawan" value="{{ $karyawan->id_karyawan }}">
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama" value="{{ $karyawan->nama }}">
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Bagian</label>
                                    <input type="text" class="form-control" name="bagian" value="{{ $karyawan->bagian }}">
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan" value="{{ $karyawan->jabatan }}">
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Status Karyawan</label>
                                    <select name="status_karyawan" class="form-select">
                                        <option value="{{ $karyawan->status_karyawan }}">{{ $karyawan->status_karyawan }}</option>
                                        <option>--Pilih Salah Satu--</option>
                                        <option value="OJT">OJT</option>
                                        <option value="Tetap">Tetap</option>
                                        <option value="Honor">Honor</option>
                                    </select>
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Status PTKP</label>
                                    <select name="status_ptkp" class="form-select">
                                        <option value="{{ $karyawan->status_ptkp }}">{{ $karyawan->status_ptkp }}</option>
                                        <option>--Pilih Salah Satu--</option>
                                        <option value="TK0">TK0</option>
                                        <option value="TK1">TK1</option>
                                        <option value="TK2">TK2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-1">
                                    <label  class="form-label">Tanggal Bergabung</label>
                                    <input type="date" class="form-control" name="tgl_bergabung" value="{{ $karyawan->tgl_bergabung }}">
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Gaji Pokok</label>
                                    <input type="number" class="form-control" name="gaji_pokok" value="{{ $karyawan->gaji_pokok }}">
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Nama Bank</label>
                                    <select name="nama_bank" class="form-select">
                                        <option value="{{ $karyawan->nama_bank }}">{{ $karyawan->nama_bank }}</option>
                                        <option>--Pilih Salah Satu--</option>
                                        <option value="BNI">BNI</option>
                                        <option value="BRI">BRI</option>
                                        <option value="BCA">BCA</option>
                                    </select>
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">No Rekening</label>
                                    <input type="number" class="form-control" name="norek" value="{{ $karyawan->norek }}">
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Nama Pemilik Bank</label>
                                    <input type="text" class="form-control" name="namaPem_bank" value="{{ $karyawan->namaPem_bank }}">
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Update</button>
                                <a href="{{ route('data_karyawan') }}" class="btn btn-warning">Cancel</a>
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
