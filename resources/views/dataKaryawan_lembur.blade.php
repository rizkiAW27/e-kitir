@if (Auth::user()->hak_akses == 'super_admin' || Auth::user()->hak_akses == 'hrd' || Auth::user()->hak_akses == 'admin_finance')
@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Data Karyawan Lembur</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        @if (Auth::user()->hak_akses == "super_admin" || Auth::user()->hak_akses == 'hrd')
                            <div class="me-2">
                                <a href="{{ route('data_salary') }}" class="btn btn-primary">Form Karyawan</a>
                            </div>
                        @endif
                        <div class="ms-2">
                            <form action="{{ route('cari4') }}" method="get">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="cari4">
                                    <button class="btn btn-outline-secondary" type="submit" >Cari</button>
                                </div>
                            </form>                              
                        </div>
                        <div class="ms-2">
                            <a href="{{ route('cetak_datalembur') }}" target="_blank" class="btn btn-info">Print</a>
                        </div>
                    </div>
                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-bordered table-striped mb-0">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Id Karyawan</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Bagian</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Jam Lembur 1</th>
                                <th scope="col">Jam Lembur 2</th>
                                <th scope="col">Tanggal Lembur</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @if ($lemburs->count() > 0)
                                
                                @foreach ($lemburs as $hasil)
                                <tr>
                                    <input type="hidden" class="delete_id" value="{{ $hasil->id }}">
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $hasil->id_karyawan }}</td>
                                    <td>{{ $hasil->nama }}</td>
                                    <td>{{ $hasil->bagian }}</td>
                                    <td>{{ $hasil->jabatan }}</td>
                                    <td>{{ $hasil->jam1 }}</td>
                                    <td>{{ $hasil->jam2 }}</td>
                                    <td>{{ $hasil->tgl_lembur }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('edit_lembur', $hasil->id) }}" class="btn btn-primary btn-sm me-1">Edit</a>
                                            <a href="{{ route('delete_lembur', $hasil) }}" class="btn btn-danger btn-sm me-1" onclick="return confirm('Apaka Anda yakin ingin menghapus Data ini?')">Delete</a>
                                        </div>
                                    </td>
                                </tr> 
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