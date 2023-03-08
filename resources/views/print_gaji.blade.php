@if (Auth::user()->hak_akses == 'super_admin' || Auth::user()->hak_akses == 'hrd')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Data Laporan Gaji Karyawan</title>
    <style>
        /*design table 1*/
        body{
            margin: 0;
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
        }
        .table1 {
            font-family: sans-serif;
            color: #232323;
            border-collapse: collapse;
        }
        
        .table1, tr, th, td {
            border: 2px solid #999;
            padding: 3px 16px;
        }
        .element {
        position: static;
        border: 0;
        margin-left: 550px;
        width: 200px;
        }
        .size-logo{
            width: 80px;
            height: 80px;
        }
    </style>
</head>
<body>
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
        <div class="table">
            <table class="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nama Bank</th>
                        <th>No Rekening</th>
                        <th>Nama Pemilik Bank</th>
                        <th>Total Gaji</th>
                        <th>Per Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                        $hasil_rupiah = 0;
                        $date = $date2;
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
                        $tpot1 = 0;
                        $Twajib = 0;
                        $koreksi = 0;
                        $pph21 = 0;
                        $tbpjs1 = 0;
                        $tbpjs2 = 0;
                        $totalbpjs1 = 0;
                        $totalbpjs2 = 0;
                        $total_gaji = 0;
                        $total_gajibersih = 0;
                        $pengeluaran = 0;
                        $hasil_rupiah = 0;
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
                                @else 
                                    @php
                                        $upahlembur = 0;
                                    @endphp
                                @endif
                            @endforeach  
                            @foreach ($totalPerid6 as $totalpot1)
                                @if ($totalpot1->id_karyawan == $karyawan->id_karyawan)
                                    @php
                                        $Twajib = $totalpot1->totalpot1;
                                    @endphp
                                @else
                                    @php
                                        $Twajib = 0;
                                    @endphp
                                @endif
                            @endforeach
                            @foreach ($totalPerid7 as $tpotongan)
                                @if ($tpotongan->id_karyawan == $karyawan->id_karyawan)
                                    @php
                                            $pph21 = $tpotongan->totalpot2;
                                    @endphp
                                @else
                                    @php
                                            $pph21 = 0;
                                    @endphp
                                @endif
                            @endforeach
                            @foreach ($totalPerid3 as $totalpot)
                                @if ($totalpot->id_karyawan == $karyawan->id_karyawan)
                                    @php
                                        $tpot = $totalpot->totalpot;
                                        $total_gaji = $totaltun + $thr + $upahlembur + $koreksi - $tpot - $Twajib - $totalbpjs1;
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
                                @php 
                                    $hasil_rupiah = number_format($total_gajibersih,0,',','.');
                                @endphp
                                <td>{{ $hasil_rupiah }}</td>
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
            <div class="element mt-3">
                <div>
                    <span style="margin-left: 65px;">Diketahui oleh,</span>
                    <span style="margin-left: 55px; margin-top: -13px;">Manager Keunagan</span>
                    <div style="margin-top: 70px; margin-left: 30px;">
                        (-----------------------------------)
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>
@endif