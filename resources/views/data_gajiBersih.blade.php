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
                        @if (Auth::user()->hak_akses == "super_admin")
                            <div class="me-2">
                                <a href="{{ route('gaji_karyawan') }}" target="_blank" class="btn btn-primary ms-3">Data Gaji</a>
                            </div>
                        @endif
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
                                <th scope="col">Per Tanggal</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                    $hasil_rupiah = 0;
                                    $date = $tgl2;
                                    $datetime = DateTime::createFromFormat('Y-m-d', $date);
                                    $gp = 0;
                                    $totaltun = 0;
                                    $total1 = 0;
                                    $total2 = 0;
                                    $jlh = 0;
                                    $nbpjs = 0;
                                    $nbpjs1 = 0;
                                    $upahlembur = 0;
                                    $jlhtotalgaji = 0;
                                    $thr = 0;
                                    $tpot = 0;
                                    $koreksi = 0;
                                    $pph21 = 0;
                                    $tbpjs1 = 0;
                                    $tbpjs2 = 0;
                                    $totalbpjs1 = 0;
                                    $totalbpjs2 = 0;
                                    $total_gaji = 0;
                                    $total_gajibersih = 0;
                                    $pengeluaran = 0;
                                    $dbpendapatan = DB::table('pendapatans')->get();
                                @endphp
                                @if ($karyawans->count() > 0)
                                    @foreach ($karyawans as $karyawan)
                                        @php
                                            $gp = $karyawan->gaji_pokok;
                                        @endphp
                                        @foreach ($totalPerid1 as $t1)
                                            @if ($t1->id_karyawan == $karyawan->id_karyawan)
                                                @php
                                                    $total1 = $t1->ptotal;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @foreach ($totalPerid2 as $t2)
                                            @if ($t2->id_karyawan == $karyawan->id_karyawan)
                                                @php
                                                    $total2 = $t2->ptotal1;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @foreach ($totalPerid4 as $ttt)
                                            @if ($ttt->id_karyawan == $karyawan->id_karyawan)
                                                @php
                                                    $tbpjs1 = $ttt->totalbpjs1;
                                                    $totalbpjs1 = (($gp + $total1) * $tbpjs1) / 100;
                                                    // $totalbpjs1 = $gp + $total1 + $total2 + $nbpjs - $nbpjs1;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @foreach ($dbpendapatan as $pendapatan)
                                            @if ($pendapatan->kode_tunjangan == "2007" && $pendapatan->status == "On")
                                                @if ($pendapatan->id_karyawan == $karyawan->id_karyawan)
                                                    @php
                                                        $thr = $pendapatan->nilai_pendapatan;
                                                    @endphp
                                                @endif
                                            @endif
                                        @endforeach
                                        @foreach ($dbpendapatan as $pendapatan)
                                            @if ($pendapatan->kode_tunjangan == "2006" && $pendapatan->status == "On")
                                                @if ($pendapatan->id_karyawan == $karyawan->id_karyawan)
                                                    @php
                                                        $koreksi = $pendapatan->nilai_pendapatan;
                                                    @endphp
                                                @endif
                                            @endif
                                        @endforeach
                                        @foreach ($totalPerid5 as $ttt1)
                                            @if ($ttt1->id_karyawan == $karyawan->id_karyawan)
                                                @php
                                                    $tbpjs2 = $ttt1->totalbpjs2;
                                                    $totalbpjs2 = (($gp + $total1) * $tbpjs2) / 100;
                                                    $totaltun = $gp + $total1 + $total2 + $totalbpjs1 - $totalbpjs2;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @foreach ($totalPerid as $total)
                                            @if ($total->id_karyawan == $karyawan->id_karyawan)
                                                @php
                                                    $jam1 = $total->total * 1.5;
                                                    $jam2 = $total->total1 * 2;
                                                    $jlh = $jam1 + $jam2;
                                                    $upahlembur = floor((($total1 + $gp) * $jlh) / 173);
                                                @endphp
                                            @endif
                                        @endforeach  
                                        @foreach ($totalPerid3 as $totpot)
                                            @if ($totpot->id_karyawan == $karyawan->id_karyawan)
                                                @php
                                                    $tpot = $totpot->totalpot;
                                                    $total_gaji = $totaltun + $thr + $upahlembur + $koreksi - $tpot - $totalbpjs1;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @foreach ($totalPerid6 as $tpph)
                                            @if ($tpph->id_karyawan == $karyawan->id_karyawan)
                                                @php
                                                    $pph21 = $tpph->totalpot1;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @foreach ($totalPerid3 as $totpot)
                                            @if ($totpot->id_karyawan == $karyawan->id_karyawan)
                                                @php
                                                    $total_gajibersih = $total_gaji - $pph21;
                                                    $pengeluaran += $total_gajibersih;
                                                @endphp
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $karyawan->nama }}</td>
                                            <td>{{ $karyawan->nama_bank }}</td>
                                            <td>{{ $karyawan->norek }}</td>
                                            <td>{{ $karyawan->namaPem_bank }}</td>
                                            <td>{{ $total_gajibersih }}</td>
                                            <td>
                                                {{ $datetime->format('d F Y') }}
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