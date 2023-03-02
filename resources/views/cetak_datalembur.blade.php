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
            font-size: 11px;
        }
        .table1 {
            font-family: sans-serif;
            color: #232323;
            border-collapse: collapse;
        }
        
        .table1, tr, th, td {
            border: 2px solid #999;
            padding: 2px 10px;
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
        <h3>Data Lembur Karyawan</h3>
        Periode : {{ $datetime1->format('d F Y') }} - {{ $datetime2->format('d F Y') }}
    </div>
    <hr>
    <div class="table">
        <table class="table1">
            @php
                $no = 1;
                $jam1 = 0;
                $jam2 = 0;
                $totalLembur = 0;
            @endphp
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Karyawan</th>
                    <th>Nama</th>
                    <th>Keterangan Lembur</th>
                    <th>Jam Lembur 1</th>
                    <th>Jam Lembur 2</th>
                    <th>Tanggal Lembur</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                    $karyawans = DB::table('karyawans')->get();
                @endphp
                @foreach ($lemburs as $lembur)
                    @foreach ($karyawans as $karyawan)
                        @if ($lembur->id_karyawan == $karyawan->id_karyawan)
                            @php
                                $jam1 += $lembur->jam1;
                                $jam2 += $lembur->jam2;
                                $totalLembur = $jam1 + $jam2;
                            @endphp
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $lembur->id_karyawan }}</td>
                                <td>{{ $karyawan->nama }}</td>
                                <td>{{ $lembur->ket_lembur }}</td>
                                <td>{{ $lembur->jam1 }}</td>
                                <td>{{ $lembur->jam2 }}</td>
                                <td>{{ $lembur->tgl_lembur }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            </tbody>
        </table>
        <div style="margin-left: 10px;">
            <div><span>Jumlah Jam Lembur 1 : {{ $jam1 }} Jam</span></div> 
            <div><span>Jumlah Jam Lembur 2 : {{ $jam2 }} Jam</span></div> 
            <div><span>Total Jam Lembur : {{ $totalLembur }} Jam</span></div>
        </div>
    </div>
</body>
</html>