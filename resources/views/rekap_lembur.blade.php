@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Data Rekap Lembur {{ Auth::user()->name }}
                </div>
                <div class="card-body">
                    @php
                        $lemburs = DB::table('lemburs')->get();
                    @endphp
                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-bordered table-striped mb-0">
                            <thead>
                              <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Lembur 1</td>
                                <td>Lembur 2</td>
                                <td>Tanggal Lembur</td>
                                <td>Aksi</td>
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                    $jam1 = 0;
                                    $jam2 = 0;
                                    $totalLembur = 0;
                                @endphp
                                
                                @foreach ($lemburs as $hasil)
                                @if ($hasil->id_karyawan == Auth::user()->id_karyawan)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $hasil->ket_lembur }}</td>
                                    <td>{{ $hasil->jam1 }} Jam</td>
                                    <td>{{ $hasil->jam2 }} Jam</td>
                                    <td>{{ $hasil->tgl_lembur }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('cetak_lembur') }}" style="color: black" target="_blank"><i class="bi bi-printer-fill"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @php
                                    $jam1 += $hasil->jam1;
                                    $jam2 += $hasil->jam2;
                                    $totalLembur = $jam1 + $jam2;
                                @endphp 
                                @else
                                <tr>
                                    <td colspan="10" align="center">Tidak ada data</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            <div><span>Jumlah Jam Lembur 1 : {{ $jam1 }} Jam</span></div> 
                            <div><span>Jumlah Jam Lembur 2 : {{ $jam2 }} Jam</span></div> 
                            <div><span>Total Jam Lembur : {{ $totalLembur }} Jam</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
