<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Gaji Keseluruhan</title>
    <style>
        body {
            font-family: sans-serif;
            color: #232323;
            font-size: 12px;
        }
        .table1 {
            font-family: sans-serif;
            color: #232323;
            border-collapse: collapse;
        }
         .table1, tr, th, td {
            border: 1px solid #999;
            font-size: 10px;
        }
        .font {
            font-size: 10px;
            margin-top: 10px;
        }
        .size-logo{
            width: 80px;
            height: 80px;
        }
    </style>
</head>
<body>
    @php
        $no = 1;
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
        $totalpph21 = 0;
        $potongan_koprasi = 0;
        $dbgaji = DB::table('gajis')->get();
        $dbpotongan = DB::table('potongans')->get();
        $dbpendapatan = DB::table('pendapatans')->get();
        $dbDatapotongan = DB::table('data_potongans')->get();
        $dblembur = DB::table('lemburs')->get();
        $karyawans = DB::table('karyawans')->get();
    @endphp
    <div class="container">
        @php
            $dbperiode = DB::table('periode_tanggals')->get();
        @endphp
        @foreach ($dbperiode as $periode)
            @php
                $date1 = $periode->tgl_periode1;
                $date2 = $periode->tgl_periode2;
                $datetime1 = DateTime::createFromFormat('Y-m-d', $date1);
                $datetime2 = DateTime::createFromFormat('Y-m-d', $date2);
            @endphp
        @endforeach
        <div>
            <img src="{{ asset('images/logo.jpg') }}" class="size-logo">
            <h2>PT Cahaya Mulia Persada Nusa</h2>
            <h3>Data Gaji Karyawan</h3>
            Periode : {{ $datetime1->format('d F Y') }} - {{ $datetime2->format('d F Y') }}
        </div>
        <hr>
    <table class="table1">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Tunjangan T2</th>
                <th>Tunjangan T3</th>
                <th>BPJS</th>
                <th></th>
                <th></th>
                <th>Over Time</th>
                <th></th>
                <th>Potongan Koprasi</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Gaji Pokok</th>
                <th><div style="display: flex">
                    @foreach ($dbgaji as $gaji)
                        @if ($gaji->jenis == "Tunjangan Tetap")
                            <div style="border: 1px solid #999; padding: 2px; width: 55px;">{{ $gaji->nama_pendapatan }}</div>
                        @endif
                    @endforeach
                    </div>
                </th>
                <th>
                    <div style="display: flex">
                        @foreach ($dbgaji as $gaji)
                            @if ($gaji->jenis == "Tunjangan Tidak Tetap")
                                <div style="border: 1px solid #999; padding: 2px; width: 55px;">{{ $gaji->nama_pendapatan }}</div>
                            @endif
                        @endforeach
                    </div>
                </th>
                <th>
                    <div style="display: flex">
                        @foreach ($dbgaji as $gaji)
                            @if ($gaji->jenis == "Tunjangan Tidak Tetap")
                            @elseif ($gaji->jenis == "Tunjangan Tetap" || $gaji->nama_pendapatan == "Koreksi" || $gaji->nama_pendapatan == "Tunjangan Hari Raya (THR)")
                            @else
                                @php
                                    $namadata = $gaji->nama_pendapatan;
                                    $potong_kalimat = substr($namadata,15,15);
                                @endphp
                                <div style="border: 1px solid #999; padding: 2px; width: 35px;">{{ $potong_kalimat }}</div>
                            @endif
                        @endforeach
                    </div>
                </th>
                <th>THR</th>
                <th style="width: 25px;">Gaji + Tunjangan</th>
                <th>
                    <div style="display: flex">
                        <div style="border: 1px solid #999; padding: 2px;">Jl 1</div>
                        <div style="border: 1px solid #999; padding: 2px;">Jl 2</div>
                        <div style="border: 1px solid #999; padding: 2px; width: 30px;">upah</div>
                    </div>
                </th>
                <th>
                    @foreach ($dbgaji as $gaji)
                        @if ($gaji->nama_pendapatan == "Koreksi")
                            <div style="border: 1px solid #999; padding: 2px;">{{ $gaji->nama_pendapatan }}</div>
                        @endif
                    @endforeach
                </th>
                <th>
                    <div style="display: flex">
                        @foreach ($dbDatapotongan as $datapotongan)
                            @if ($datapotongan->data_potongan == "PPh 21")
                            @else
                                <div style="border: 1px solid #999; padding: 2px;  width: 35px;">{{ $datapotongan->data_potongan }}</div>
                            @endif
                        @endforeach
                    </div>
                </th>
                <th>Total Gaji</th>
                <th>PPh 21</th>
                <th>Gaji Bersih</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($karyawans as $karyawan)
            <tr>
                <th>{{ $no++ }}</th>
                <th>{{ $karyawan->nama }}</th>
                <th>{{ $karyawan->jabatan }}</th>
                @php
                    $gp = $karyawan->gaji_pokok;
                @endphp
                <th>{{ $karyawan->gaji_pokok }}</th>
                <th><div style="display: flex">
                        @foreach ($dbpendapatan as $pendapatan)
                            @if ($pendapatan->kode_tunjangan == "2002" && $pendapatan->status == "On")
                                @if ($pendapatan->id_karyawan == $karyawan->id_karyawan)
                                    <div style="border: 1px solid #999; padding: 2px; width: 55px;">{{ $pendapatan->nilai_pendapatan }}</div>
                                @endif
                            @endif
                        @endforeach
                        @foreach ($totalPerid1 as $t1)
                           @if ($t1->id_karyawan == $karyawan->id_karyawan)
                                @php
                                    $total1 = $t1->ptotal;
                                @endphp
                           @endif
                        @endforeach
                    </div>
                </th>
                <th>
                    <div style="display: flex">
                        @foreach ($dbpendapatan as $pendapatan)
                            @if ($pendapatan->kode_tunjangan == "2003" && $pendapatan->status == "On")
                                @if ($pendapatan->id_karyawan == $karyawan->id_karyawan)
                                    <div style="border: 1px solid #999; padding: 2px; width: 55px;">{{ $pendapatan->nilai_pendapatan }}</div>
                                @endif
                            @endif
                        @endforeach
                        @foreach ($totalPerid2 as $t2)
                            @if ($t2->id_karyawan == $karyawan->id_karyawan)
                                @php
                                    $total2 = $t2->ptotal1;
                                @endphp
                            @endif
                        @endforeach
                    </div>
                </th>
                <th>
                    <div style="display: flex">
                        @foreach ($dbpendapatan as $pendapatan)
                            @if ($pendapatan->id_karyawan == $karyawan->id_karyawan)
                                @if ($pendapatan->kode_tunjangan == "2004" && $pendapatan->status == "On")
                                    @php
                                        $nbpjs = (($total1 + $gp) * $pendapatan->nilai_pendapatan) / 100;
                                    @endphp
                                    <div style="border: 1px solid #999; padding: 2px; width: 35px;">{{ $nbpjs }}</div>
                                @endif
                                @if ($pendapatan->kode_tunjangan == "2005" && $pendapatan->status == "On")
                                    @php
                                        $nbpjs1 = (($total1 + $gp) * $pendapatan->nilai_pendapatan) / 100;
                                    @endphp
                                    <div style="border: 1px solid #999; padding: 2px; width: 35px;">-{{ $nbpjs1 }}</div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </th>
                <th>
                    @foreach ($dbpendapatan as $pendapatan)
                        @if ($pendapatan->kode_tunjangan == "2007" && $pendapatan->status == "On")
                            @if ($pendapatan->id_karyawan == $karyawan->id_karyawan)
                                @php
                                    $thr = $pendapatan->nilai_pendapatan;
                                @endphp
                                <div style="border: 1px solid #999; padding: 2px; width: 35px;">{{ $pendapatan->nilai_pendapatan }}</div>
                            @endif
                        @endif
                    @endforeach
                </th>
                <th>
                    @foreach ($totalPerid4 as $ttt)
                        @if ($ttt->id_karyawan == $karyawan->id_karyawan)
                            @php
                                $tbpjs1 = $ttt->totalbpjs1;
                                $totalbpjs1 = (($gp + $total1) * $tbpjs1) / 100;
                                // $totalbpjs1 = $gp + $total1 + $total2 + $nbpjs - $nbpjs1;
                            @endphp
                        @endif
                    @endforeach
                    @foreach ($totalPerid5 as $ttt1)
                        @if ($ttt1->id_karyawan == $karyawan->id_karyawan)
                            @php
                                $tbpjs2 = $ttt1->totalbpjs2;
                                $totalbpjs2 = (($gp + $total1) * $tbpjs2) / 100;
                                $totaltun = $gp + $total1 + $total2 + $totalbpjs1 - $totalbpjs2;
                            @endphp
                           {{ $totaltun }}
                        @endif
                    @endforeach      
                </th>
                <th>
                    <div style="display: flex">
                        @foreach ($totalPerid as $total)
                            @if ($total->id_karyawan == $karyawan->id_karyawan)
                                @php
                                    $jam1 = $total->total * 1.5;
                                    $jam2 = $total->total1 * 2;
                                    $jlh = $jam1 + $jam2;
                                    $upahlembur = floor((($total1 + $gp) * $jlh) / 173);
                                @endphp
                                <div style="border: 1px solid #999; padding: 2px; width: 12px;">{{ $jam1 }}</div>
                                <div style="border: 1px solid #999; padding: 2px; width: 12px;">{{ $jam2 }}</div>
                                <div style="border: 1px solid #999; padding: 2px; width: 30px;">{{ $upahlembur }}</div>
                            @endif
                        @endforeach    
                    </div>
                </th>
                <th>
                    @foreach ($dbpendapatan as $pendapatan)
                        @if ($pendapatan->kode_tunjangan == "2006" && $pendapatan->status == "On")
                            @if ($pendapatan->id_karyawan == $karyawan->id_karyawan)
                                @php
                                    $koreksi = $pendapatan->nilai_pendapatan;
                                @endphp
                                <div style="border: 1px solid #999; padding: 2px; width: 35px;">{{ $pendapatan->nilai_pendapatan }}</div>
                            @endif
                        @endif
                    @endforeach
                </th>
                <th>
                    <div style="display: flex">
                        @foreach ($dbDatapotongan as $datapotongan)
                            @if ($datapotongan->data_potongan == "PPh 21")
                            @else
                                @foreach ($dbpotongan as $potongan)
                                    @if ($datapotongan->data_potongan == $potongan->nama_potongan)
                                        @if ($potongan->id_karyawan == $karyawan->id_karyawan)
                                            <div style="border: 1px solid #999; padding: 2px; width: 35px;"> -{{ $potongan->nilai_potongan }}</div>
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </th>
                <th>
                    @foreach ($totalPerid3 as $totpot)
                        @if ($totpot->id_karyawan == $karyawan->id_karyawan)
                            @php
                                $tpot = $totpot->totalpot;
                                $total_gaji = $totaltun + $thr + $upahlembur + $koreksi - $tpot - $totalbpjs1;
                                $potongan_koprasi += $tpot;
                            @endphp
                        {{ $total_gaji }}
                        @endif
                    @endforeach
                </th>
                <th>
                    @foreach ($totalPerid6 as $tpph)
                        @if ($tpph->id_karyawan == $karyawan->id_karyawan)
                            @php
                                $pph21 = $tpph->totalpot1;
                                $totalpph21 += $pph21;
                            @endphp
                        -{{ $pph21 }}
                        @endif
                    @endforeach
                </th>
                <th>
                @foreach ($totalPerid3 as $totpot)
                    @if ($totpot->id_karyawan == $karyawan->id_karyawan)
                        @php
                            $total_gajibersih = $total_gaji - $pph21;
                            $pengeluaran += $total_gajibersih;
                        @endphp
                    {{ $total_gajibersih }}
                    @endif
                @endforeach
                </th>
            </tr>
            @endforeach
        </tbody>
        <tbody>
            <tr>
                <td></td>
                <td>Total :</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $potongan_koprasi }}</td>
                <td></td>
                <td>{{ $totalpph21 }}</td>
                <td>{{ $pengeluaran }}</td>
            </tr>
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</body>
</html>