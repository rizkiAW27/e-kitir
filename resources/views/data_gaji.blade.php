@if (Auth::user()->hak_akses == 'super_admin' || Auth::user()->hak_akses == 'admin_finance')
@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Data Tunjangan & BPJS</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        @if (Auth::user()->hak_akses == "super_admin")
                            <div class="me-2">
                                <a href="{{ route('add_gaji') }}" class="btn btn-primary">Add Tunjangan</a>
                            </div>
                        @endif
                        <div class="ms-2">
                            <form action="{{ route('cari2') }}" method="get">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="cari2">
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
                                <th scope="col">Kode</th>
                                <th scope="col">Nama Pendapatan</th>
                                <th scope="col">Jenis Pendapatan</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @if ($gajies->count() > 0)
                                
                                @foreach ($gajies as $gaji)
                                <tr>
                                    <input type="hidden" value="{{ $gaji->id }}">
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $gaji->kode }}</td>
                                    <td>{{ $gaji->nama_pendapatan }}</td>
                                    <td>{{ $gaji->jenis }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('edit_gaji', $gaji) }}" class="btn btn-primary btn-sm me-1">Edit</a>
                                            <a href="{{ route('delete_gaji', $gaji->id) }}" class="btn btn-danger btn-sm me-1" onclick="return confirm('Apaka Anda yakin ingin menghapus Data ini?')">Hapus</a>
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
                            {{ $gajies->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endif