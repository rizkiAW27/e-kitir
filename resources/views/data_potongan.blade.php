@if (Auth::user()->hak_akses == 'super_admin' || Auth::user()->hak_akses == 'admin_finance')
@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Data Potongan</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="ms-2">
                            <form action="{{ route('cari6') }}" method="get">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="cari6">
                                    <button class="btn btn-outline-secondary" type="submit" >Cari</button>
                                </div>   
                            </form>                           
                        </div>
                    </div>
                    <div class="table">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">ID Karyawan</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Nilai</th>
                                <th scope="col">Jenis</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                    $hasil_rupiah = 0;
                                @endphp
                                @if ($potongans->count() > 0)
                                
                                @foreach ($potongans as $potongan)
                                <tr>
                                    <input type="hidden" class="delete_id" value="{{ $potongan->id }}">
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $potongan->id_karyawan }}</td>
                                    <td>{{ $potongan->kode }}</td>
                                    <td>{{ $potongan->nama_potongan }}</td>
                                    @php 
                                        $hasil_rupiah = number_format($potongan->nilai_potongan,0,',','.');
                                    @endphp
                                    <td>Rp. {{ $hasil_rupiah }}</td>
                                    <td>{{ $potongan->jenis }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('edit_potongan', $potongan) }}" class="btn btn-primary btn-sm me-1">Edit</a>
                                            <a href="{{ route('delete_potongan', $potongan->id) }}" class="btn btn-danger btn-sm me-1" onclick="return confirm('Apaka Anda yakin ingin menghapus Data ini?')">Hapus</a>
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
                        <div align="center">
                            {{ $potongans->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endif