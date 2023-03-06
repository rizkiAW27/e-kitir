@if (Auth::user()->hak_akses == 'admin_finance')
@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Data Pendapatan Karyawan</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="ms-2">
                            <form action="{{ route('cari8') }}" method="get">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="cari8">
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
                                <th scope="col">Id Karyawan</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Bagian</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Gaji Pokok</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                    $hasil_rupiah = 0;
                                @endphp
                                @if ($karyawans->count() > 0)
                                
                                @foreach ($karyawans as $hasil)
                                    @if ($hasil->bagian == "Mandor" || $hasil->jabatan == "Juru Tulis" || $hasil->jabatan == "Inspektor QC" || $hasil->jabatan == "Security" || $hasil->jabatan == "Security Wanita / Ronda" || $hasil->jabatan == "Perawat" || $hasil->jabatan == "Driver")
                                        <tr>
                                            <input type="hidden" class="delete_id" value="{{ $hasil->id }}">
                                            <th scope="row">{{ $no++ }}</th>
                                            <td>{{ $hasil->id_karyawan }}</td>
                                            <td>{{ $hasil->nama }}</td>
                                            <td>{{ $hasil->bagian }}</td>
                                            <td>{{ $hasil->jabatan }}</td>
                                            @php 
                                                $hasil_rupiah = number_format($hasil->gaji_pokok,0,',','.');
                                            @endphp
                                            <td>Rp. {{ $hasil_rupiah }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('tambah_potongan', $hasil) }}" class="btn btn-warning btn-sm me-1">Potongan</a>
                                                    <a href="{{ route('tambah_gaji', $hasil) }}" class="btn btn-success btn-sm me-1">Tunjangan</a>
                                                    <a href="{{ route('index_lembur', $hasil) }}" class="btn btn-info btn-sm me-1">Lembur</a>
                                                    <a href="{{ route('data_ekitir', $hasil) }}" class="btn btn-primary btn-sm me-1">E-kitir</a>
                                                </div>
                                            </td>
                                        </tr> 
                                    @endif
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