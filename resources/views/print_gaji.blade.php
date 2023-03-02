@if (Auth::user()->hak_akses == 'super_admin' || Auth::user()->hak_akses == 'hrd')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
        <img src="../public/images/logo.jpg" class="size-logo">
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
                    <th>Nama Karyawan</th>
                    <th>Nama Bank</th>
                    <th>No Rekening</th>
                    <th>Nama Pemilik Bank</th>
                    <th>Gaji</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                    $total = 0;
                    $hasil_rupiah = 0;
                    $hasil_rupiah1 = 0;
                @endphp
                @foreach ($gaji as $g)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $g->nama }}</td>
                        <td>{{ $g->nama_bank }}</td>
                        <td>{{ $g->norek }}</td>
                        <td>{{ $g->namaPem_bank }}</td>
                        @php 
                            $hasil_rupiah = number_format($g->gaji_bersih,0,',','.');
                        @endphp
                        <td>RP. {{ $hasil_rupiah }}</td>
                    </tr>
                    @php
                        $total += $g->gaji_bersih;
                        $hasil_rupiah1 = number_format($total,0,',','.');
                    @endphp
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total Gaji Karyawan :</td>
                    <td>Rp. {{ $hasil_rupiah1 }}</td>
                </tr>
            </tbody>
        </table>
        <div class="element">
            <div>
                <h5 style="margin-left: 35px;">Diketahui oleh,</h5>
                <h5 style="margin-left: 25px; margin-top: -13px;">Manager Keunagan</h5>
                <div style="margin-top: 70px;">
                    (--------------------------------)
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endif