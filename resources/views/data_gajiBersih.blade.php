@if (Auth::user()->hak_akses == 'super_admin' || Auth::user()->hak_akses == 'hrd')
@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Data Gaji Karyawan</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="me-2">
                            <a href="{{ route('print_gaji') }}" target="_blank" class="btn btn-primary">Cetak Laporan</a>
                        </div>
                        <div class="ms-2">
                            <form action="{{ route('cari') }}" method="get">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="cari" placeholder="cari data...">
                                    <button class="btn btn-outline-secondary" type="submit" >Cari</button>
                                </div>
                            </form>                              
                        </div>
                    </div>          
                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-bordered table-striped mb-0">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Nama Bank</th>
                                <th scope="col">No Rekening</th>
                                <th scope="col">Nama Pemilik Bank</th>
                                <th scope="col">Total Gaji</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                    $hasil_rupiah = 0;
                                @endphp
                                @if ($gBersihs->count() > 0)
                                
                                @foreach ($gBersihs as $hasil)
                                <tr>
                                    <input type="hidden" class="delete_id" value="{{ $hasil->id }}">
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $hasil->nama }}</td>
                                    <td>{{ $hasil->nama_bank }}</td>
                                    <td>{{ $hasil->norek }}</td>
                                    <td>{{ $hasil->namaPem_bank }}</td>
                                    @php 
                                        $hasil_rupiah = number_format($hasil->gaji_bersih,0,',','.');
                                    @endphp
                                    <td>Rp. {{ $hasil_rupiah }}</td>
                                    <td>{{ $hasil->tgl_gaji }}</td>
                                    <td>
                                        <a href="{{ route('delete_gajiBersih', $hasil->id) }}" class="btn btn-danger btn-sm me-1" onclick="return confirm('Apaka Anda yakin ingin menghapus Data ini?')">Delete</a>
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