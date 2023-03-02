@if (Auth::user()->hak_akses == 'super_admin' || Auth::user()->hak_akses == 'hrd')
@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Data Pengguna/User E-kitir</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="ms-2">
                            <form action="{{ route('cari7') }}" method="get">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="cari7">
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
                                <th scope="col">Email</th>
                                <th scope="col">Hak Akses</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @if ($users->count() > 0)
                                
                                @foreach ($users as $user)
                                <tr>
                                    <input type="hidden" class="delete_id" value="{{ $user->id }}">
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $user->id_karyawan }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->hak_akses }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('delete_user', $user->id) }}" class="btn btn-danger btn-sm me-1">Delete</a>
                                            <a href="{{ route('edit_user', $user->id) }}" class="btn btn-primary btn-sm me-1">Edit</a>
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