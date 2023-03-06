@if (Auth::user()->hak_akses == 'super_admin' || Auth::user()->hak_akses == 'admin_finance')
@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h3>Tambah Potongan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('update_potongan', $potongan) }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="d-flex">
                            <div class="col-md-5 ms-5 me-5">
                                <div class="mb-1">
                                    <label  class="form-label">Kode</label>
                                    <input type="number" class="form-control" name="kode" value="{{ $potongan->kode }}">
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Nama Potongan</label>
                                    @php
                                        $dbdataPot = DB::table('data_potongans')->get();
                                    @endphp
                                    <select name="nama_potongan" class="form-select">
                                        <option {{ $potongan->nama_potongan }}>{{ $potongan->nama_potongan }}</option>
                                        @foreach ($dbdataPot as $dataPot)
                                            <option {{ $dataPot->data_potongan }}>{{ $dataPot->data_potongan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-1">
                                    <label  class="form-label">Nilai</label>
                                    <input type="number" class="form-control" name="nilai_potongan" value="{{ $potongan->nilai_potongan }}">
                                </div>
                                <div class="mb-1">
                                    <label  class="form-label">Jenis</label>
                                    <select name="jenis" class="form-select">
                                        <option value="{{ $potongan->jenis }}">{{ $potongan->jenis }}</option>
                                        <option >--Pilih Salah Satu--</option>
                                        <option value="Wajib">Wajib</option>
                                        <option value="Tidak Wajib">Tidak Wajib</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Update</button>
                                <a href="{{ route('data_potongan') }}" class="btn btn-warning mt-2">Cancel</a>
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