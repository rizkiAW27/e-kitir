@if (Auth::user()->hak_akses == 'super_admin')
@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Data Status Tandatangan Karyawan</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="ms-2">
                            <form action="{{ route('cari9') }}" method="get">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="cari9">
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
                                <th scope="col">Jabatan</th>
                                <th scope="col">Status Ttd</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @if ($employs->count() > 0)
                                    @foreach ($employs as $employe)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $employe->id_karyawan }}</td>
                                            <td>{{ $employe->nama }}</td>
                                            <td>{{ $employe->jabatan }}</td>
                                            <td>{{ $employe->status_ttd }}</td>
                                            <td>
                                                <a href="{{ route('edit_ttd', $employe->id) }}" class="btn btn-primary">Edit Ttd</a>
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
