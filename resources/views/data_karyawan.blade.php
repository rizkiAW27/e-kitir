@if (Auth::user()->hak_akses == 'super_admin' || Auth::user()->hak_akses == 'hrd')
@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Data Karyawan</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="me-2">
                            <a href="{{ route('tambah_karyawan') }}" class="btn btn-primary">Add Karyawan</a>
                        </div>
                        <div class="ms-2">
                            <form action="{{ route('cari1') }}" method="get">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="cari1">
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
                                <th scope="col">Id Karyawan</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Bagian</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Status Karyawan</th>
                                @if (Auth::user()->hak_akses == 'admin')
                                    <th scope="col">Aksi</th>
                                @endif
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @if ($karyawans->count() > 0)
                                
                                @foreach ($karyawans as $hasil)
                                <tr>
                                    <input type="hidden" class="delete_id" value="{{ $hasil->id }}">
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $hasil->id_karyawan }}</td>
                                    <td>{{ $hasil->nama }}</td>
                                    <td>{{ $hasil->bagian }}</td>
                                    <td>{{ $hasil->jabatan }}</td>
                                    <td>{{ $hasil->status_karyawan }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('edit_karyawan', $hasil) }}" class="btn btn-primary btn-sm me-1">Edit</a>
                                            <a href="{{ route('delete_karyawan', $hasil->id) }}" class="btn btn-danger btn-sm me-1" onclick="return confirm('Apaka Anda yakin ingin menghapus Data ini?')">Delete</a>
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
                            {{ $karyawans->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endif
