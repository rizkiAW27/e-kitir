@if (Auth::user()->hak_akses == 'super_admin' || Auth::user()->hak_akses == 'hrd')
@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Setting Tanggal Periode Penggajian</h5>
                </div>
                <div class="card-body">
                    <div class="table">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal Periode Awal</th>
                                <th scope="col">Tanggal Periode Akhir</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @if ($periodeTgl->count() > 0)
                                
                                @foreach ($periodeTgl as $periode)
                                <tr>
                                    <input type="hidden" class="delete_id" value="{{ $periode->id }}">
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $periode->tgl_periode1 }}</td>
                                    <td>{{ $periode->tgl_periode2 }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('edit_periode', $periode) }}" class="btn btn-primary btn-sm me-1">Edit</a>
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