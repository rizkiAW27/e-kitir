@if (Auth::user()->hak_akses == 'super_admin' || Auth::user()->hak_akses == 'admin_finance')
@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6>Data Tunjangan untuk Karyawan </h6>
                    <div>
                        Kode Karyawan :
                        {{ $karyawan->id_karyawan }}
                    </div>
                    <div>
                        Nama Karyawan :
                        {{ $karyawan->nama }}
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-bordered table-striped mb-0">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Tunjangan</th>
                                <th scope="col">Nama Tunjangan & BPJS</th>
                                <th scope="col">Jenis</th>
                                <th scope="col">Nilai</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @if ($gajis->count() > 0)
                                
                                @foreach ($gajis as $gaji)
                                <form action="{{ route('store_tunjangan') }}" method="POST">
                                    @csrf
                                <tr>
                                    <input type="hidden" name="id_karyawan" value="{{ $karyawan->id_karyawan }}">
                                    <input type="hidden" name="kode_tunjangan" value="{{ $gaji->kode }}">
                                    <input type="hidden" name="id_bpjs" value={{ $gaji->id }}>
                                    <input type="hidden" name="id_tunjangan" value={{ $gaji->id }}>
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $gaji->kode }}</td>
                                    <td>{{ $gaji->nama_pendapatan }}</td>
                                    <td>{{ $gaji->jenis }}</td>
                                    <td><input type="text" name="nilai_pendapatan" class="form-control" required></td>
                                    <td>
                                        <select name="status" class="form-select">
                                            <option value="On">On</option>
                                            <option value="Off">Off</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Tambah data Tunjangan/BPJS {{ $gaji->nama_pendapatan }}')">save</button>
                                        </div>
                                    </td>
                                </tr> 
                                </form>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="10" align="center">Tidak ada data</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endif