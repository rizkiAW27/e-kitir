@if (Auth::user()->hak_akses == 'super_admin' || Auth::user()->hak_akses == 'admin_finance')
@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Data Karyawan yang Memiliki Tunjangan & BPJS</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="ms-2">
                           <form action="{{ route('cari3') }}" method="get">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="cari3">
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
                                <th scope="col">ID Karyawan</th>
                                <th scope="col">Nama Karyawan</th>
                                <th scope="col">Kode Tunjangan</th>
                                <th scope="col">Nama Tunjangan</th>
                                <th scope="col">Nilai</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                    $hasil_rupiah = 0;
                                @endphp
                                @if ($pendapatans->count() > 0)
                                
                                @foreach ($pendapatans as $pendapatan)
                                <tr>
                                    <input type="hidden" class="delete_id" value="{{ $pendapatan->id }}">
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $pendapatan->id_karyawan }}</td>
                                    <td>{{ $pendapatan->nama }}</td>
                                    <td>{{ $pendapatan->kode_tunjangan }}</td>
                                    <td>{{ $pendapatan->nama_pendapatan }}</td>
                                    @if ($pendapatan->nilai_pendapatan > 30)
                                        @php 
                                            $hasil_rupiah = number_format($pendapatan->nilai_pendapatan,0,',','.');
                                        @endphp
                                        <td>Rp. {{ $hasil_rupiah }}</td>
                                    @else
                                        @php 
                                            $hasil_rupiah = $pendapatan->nilai_pendapatan;
                                        @endphp
                                        <td>{{ $hasil_rupiah }} %</td>
                                    @endif
                                    {{-- <td>Rp. {{ $hasil_rupiah }}</td> --}}
                                    <td>{{ $pendapatan->status }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('edit_pendapatan', $pendapatan) }}" class="btn btn-primary btn-sm me-1">Edit</a>
                                            <a href="{{ route('delete_pendapatan', $pendapatan->id) }}" class="btn btn-danger btn-sm me-1" onclick="return confirm('Apaka Anda yakin ingin menghapus Data ini?')">Hapus</a>
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