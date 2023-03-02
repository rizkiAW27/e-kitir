@if (Auth::user()->hak_akses == 'super_admin' || Auth::user()->hak_akses == 'admin_finance')
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Data E-kitir</title>
    <style>
        table {
            font-size: 13px;
        }
        .blur {
            filter: blur(4px);
        }
        .size-logo{
            width: 80px;
            height: 80px;
            margin-top: 10px;
            margin-bottom: 10px;
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
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div style="width: 15rem; text-align:center; border: 1px solid;">
                    <h5>Pribadi & Rahasia</h5>
                </div>
                <img src="{{ asset('images/logo.jpg') }}" class="size-logo">
                <h5>PT Cahaya Mulia Persada Nusa</h5>
                <h6>Slip Gaji</h6>
                Periode: {{ $datetime1->format('d F Y') }} - {{ $datetime2->format('d F Y') }}
            </div>
            <div class="d-flex ">
                <div style="width: 50rem">
                    <div class="d-flex">
                        <div style="width: 10rem;">Nama</div>
                        <div style="width: 1rem;">:</div>
                        <div style="width: 10rem;">{{ $karyawan->nama }}</div>
                    </div>
                    <div class="d-flex">
                        <div style="width: 10rem;">ID Karawan</div>
                        <div style="width: 1rem;">:</div>
                        <div style="width: 10rem;">{{ $karyawan->id_karyawan }}</div>
                    </div>
                    <div class="d-flex">
                        <div style="width: 10rem;">Bagian/Departemen</div>
                        <div style="width: 1rem;">:</div>
                        <div style="width: 10rem;">{{ $karyawan->bagian }}</div>
                    </div>
                    <div class="d-flex">
                        <div style="width: 10rem;">Jabatan</div>
                        <div style="width: 1rem;">:</div>
                        <div style="width: 10rem;">{{ $karyawan->jabatan }}</div>
                    </div>
                </div>
                <div>
                    <div class="d-flex">
                        <div style="width: 10rem;">Status Karyawan</div>
                        <div style="width: 1rem;">:</div>
                        <div style="width: 10rem;">{{ $karyawan->status_karyawan }}</div>
                    </div>
                    <div class="d-flex">
                        <div style="width: 10rem;">Status PTKP</div>
                        <div style="width: 1rem;">:</div>
                        <div style="width: 10rem;">{{ $karyawan->status_ptkp }}</div>
                    </div>
                    <div class="d-flex">
                        <div style="width: 10rem;">Tanggal Bergabung</div>
                        <div style="width: 1rem;">:</div>
                        <div style="width: 10rem;">{{ $karyawan->tgl_bergabung }}</div>
                    </div>
                    @php
                        $tgl_lahir = new DateTime($karyawan->tgl_bergabung);
                        $date = new DateTime();
                        $umur = $date->diff($tgl_lahir);
                    @endphp
                    <div class="d-flex">
                        <div style="width: 10rem;">Lama Bekerja</div>
                        <div style="width: 1rem;">:</div>
                        <div style="width: 15rem;">{{ $umur->y }} Tahun, {{ $umur->m }} Bulan, {{ $umur->d }} Hari</div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div style="width: 40rem">
                    <div class="table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 30rem;">Komponen Pendapatan</th>
                                    <th style="width: 10rem">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Gaji Pokok (Basic Salary)</td>
                                    @php 
                                        $hasil_rupiah3 = number_format($karyawan->gaji_pokok,0,',','.');
                                    @endphp
                                    <td>Rp. {{ $hasil_rupiah3 }}</td>
                                </tr>
                                @if($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                @endif
                                @php
                                    $total = 0;$hasil = 0;$nTunjangan = 0;$jumlah = 0;$upahLembur = 0;$nilaiPen = 0;$jamLembur1 = 0;$jamLembur2 = 0;$pendapatanTun = 0;$jumlahpendapatan = 0;$id_karyawan = $karyawan->id_karyawan;
                                @endphp
                                @foreach ($lemburans as $lembur)
                                    @if ($lembur->id_karyawan == $id_karyawan)
                                        @php
                                            $jamLembur1 += $lembur->jam1 * 1.5;
                                            $jamLembur2 += $lembur->jam2 * 2;
                                        @endphp
                                    @endif
                                @endforeach
                                @foreach ($pendapatans as $pendapatan)
                                    @foreach ($gajis as $gaji)
                                    <tr>
                                        @if ($pendapatan->kode_tunjangan == $gaji->kode && $id_karyawan == $pendapatan->id_karyawan && $pendapatan->status == "On")
                                            @if ($pendapatan->nilai_pendapatan >= 15)
                                                @php
                                                    $total += $pendapatan->nilai_pendapatan;
                                                    $jumlah = $total + $karyawan->gaji_pokok;
                                                @endphp
                                            @endif
                                            @if ($gaji->jenis == "Tunjangan Tetap")
                                                @php
                                                    $pendapatanTun += $pendapatan->nilai_pendapatan;
                                                    $jumlahpendapatan = $pendapatanTun + $karyawan->gaji_pokok;
                                                    $totalLembur = $jamLembur1 + $jamLembur2;
                                                    $upahLembur = floor(($jumlahpendapatan * $totalLembur) / 173);
                                                    $hasil_rupiah2 = number_format($upahLembur,0,',','.');
                                                @endphp
                                            @endif
                                            @if ($gaji->jenis == "Karyawan")
                                            @elseif ($pendapatan->nilai_pendapatan <= 15)
                                                @php
                                                    $hasil = ($jumlahpendapatan * $pendapatan->nilai_pendapatan) / 100;
                                                    $hasil_rupiah = number_format($hasil,0,',','.');
                                                    $nTunjangan += $hasil;
                                                @endphp
                                                <td>{{ $gaji->nama_pendapatan }} ({{ $pendapatan->nilai_pendapatan }}% {{ $gaji->jenis }})</td>
                                                <td>Rp. {{ $hasil_rupiah }}</td>
                                            @else
                                                <td>{{ $gaji->nama_pendapatan }}</td>
                                                @php 
                                                    $hasil_rupiah1 = number_format($pendapatan->nilai_pendapatan,0,',','.');
                                                @endphp
                                                <td>Rp. {{ $hasil_rupiah1 }}</td>
                                            @endif
                                                
                                        @endif
                                    </tr>
                                    @endforeach
                                @endforeach
                                @if ($upahLembur == 0)
                                @else
                                    <tr>
                                        <td>Upah Overtime ({{ $totalLembur }} Jam)</td>
                                        <td>Rp. {{ $hasil_rupiah2 }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div style="width: 40rem">
                    <div class="table">
                         <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 30rem;">Komponen Potongan</th>
                                    <th style="width: 10rem;">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $id_karyawan = $karyawan->id_karyawan;
                                    $nilaiPotongan = 0;
                                    $nilaiPot = 0;
                                    $pots = DB::table('potongans')->get();
                                @endphp
                                @foreach ($pots as $pot)
                                    @if ($pot->jenis == 'Wajib')
                                        <tr>
                                            @if ($id_karyawan == $pot->id_karyawan)
                                                <td>{{ $pot->nama_potongan }}</td>
                                                @php 
                                                    $hasil_rupiah4 = number_format($pot->nilai_potongan,0,',','.');
                                                @endphp
                                                <td>Rp. {{ $hasil_rupiah4 }}</td>
                                                @php
                                                    $nilaiPot += $pot->nilai_potongan; 
                                                @endphp
                                            @endif
                                        </tr>
                                    @else
                                        @foreach ($potongans as $potongan)
                                        <tr>
                                            @if ($id_karyawan == $potongan->id_karyawan && $potongan->jenis == "Tidak Wajib")
                                                <td>{{ $potongan->nama_potongan }}</td>
                                                @php 
                                                    $hasil_rupiah5 = number_format($potongan->nilai_potongan,0,',','.');
                                                @endphp
                                                <td>Rp. {{ $hasil_rupiah5 }}</td>
                                                @php
                                                    $nilaiPotongan += $potongan->nilai_potongan + $nilaiPot; 
                                                @endphp
                                            @endif
                                        </tr>
                                        @endforeach
                                    @endif
                                @endforeach
                                @php
                                    $total = 0;
                                    $hasil = 0;
                                    $nilaiTun = 0;
                                    $id_karyawan = $karyawan->id_karyawan;
                                @endphp
                                @foreach ($pendapatans as $pendapatan)
                                    @foreach ($gajis as $gaji)
                                    <tr>
                                        @if ($pendapatan->kode_tunjangan == $gaji->kode && $id_karyawan == $pendapatan->id_karyawan && $pendapatan->status == "On")
                                            
                                            @if ($pendapatan->nilai_pendapatan >= 15)
                                                @php
                                                    $total += $pendapatan->nilai_pendapatan;
                                                    $jumlah = ($total + $karyawan->gaji_pokok);
                                                @endphp
                                            @endif
                                            @if ($pendapatan->nilai_pendapatan <= 15)
                                                @php
                                                    $hasil = ($jumlahpendapatan * $pendapatan->nilai_pendapatan) / 100;
                                                    $hasil_rupiah7 = number_format($hasil,0,',','.');
                                                    $nilaiTun += $hasil;
                                                @endphp
                                            <td>{{ $gaji->nama_pendapatan }} ({{ $pendapatan->nilai_pendapatan }}% {{ $gaji->jenis }})</td>
                                            <td>Rp. {{ $hasil_rupiah7 }}</td>
                                            @endif
                                        @endif
                                    </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div style="width: 40rem">
                    <div class="table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 30rem"></th>
                                    <th style="width: 10rem"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $hasilPendapatan = $jumlah + $nTunjangan + $upahLembur;
                                    $hasil_rupiah8 = number_format($hasilPendapatan,0,',','.');
                                @endphp
                                <tr>
                                    <td style="text-align: right"><b>Total Pendapatan :</b></td>
                                    @if ($jumlah == 0)
                                        @php 
                                            $hasil_rupiah9 = number_format($karyawan->gaji_pokok,0,',','.');
                                        @endphp
                                        <td><b>Rp. {{ $hasil_rupiah9 }}</b></td>
                                    @else
                                        <td><b>Rp. {{ $hasil_rupiah8 }}</b></td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div style="width: 40rem">
                    <div class="table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="30rem"></th>
                                    <th style="10rem"></th>
                                </tr>
                            </thead>
                                @if ($nilaiPotongan == 0)
                                    @php
                                        $totalPotongan = $nilaiPot + $nilaiTun;
                                        $hasil_rupiah10 = number_format($totalPotongan,0,',','.');
                                    @endphp
                                @else
                                    @php
                                        $totalPotongan = $nilaiPotongan + $nilaiTun;
                                        $hasil_rupiah10 = number_format($totalPotongan,0,',','.');
                                    @endphp
                                @endif
                            <tbody>
                                <tr>
                                    <td style="text-align: right"><b>Total Potongan :</b></td>
                                    <td style="text-align: center"><b>Rp. {{ $hasil_rupiah10 }}</b></td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @php
                $totalGajiBersih = 0;
            @endphp
            @if ($hasilPendapatan == 0)
                @php
                    $totalGajiBersih = $karyawan->gaji_pokok - $totalPotongan;
                    $hasil_rupiah12 = number_format($totalGajiBersih,0,',','.');
                @endphp
            @else
                @php
                    $totalGajiBersih = $hasilPendapatan - $totalPotongan;
                    $hasil_rupiah12 = number_format($totalGajiBersih,0,',','.');
                @endphp
            @endif
            <div>
                <table>
                    <tr style="width: 15rem">
                        <td>Total Gaji Bersih</td>
                        <td>:</td>
                        @if ($totalGajiBersih == 0)
                            @php
                                $hasil_rupiah12 = $karyawan->gaji_pokok;
                            @endphp
                            <td>Rp. {{$hasil_rupiah12}}</td>
                        @else
                            <td>Rp. {{ $hasil_rupiah12 }}</td>
                        @endif
                    </tr>
                    <tr style="width: 3rem">
                        <td>Nama Bank</td>
                        <td>:</td>
                        <td>{{ $karyawan->nama_bank }}</td>
                    </tr>
                    <tr>
                        <td>Nomer Rekening</td>
                        <td>:</td>
                        <td>{{ $karyawan->norek }}</td>
                    </tr>
                    <tr>
                        <td>Nama Pemilik Bank</td>
                        <td>:</td>
                        <td>{{ $karyawan->namaPem_bank }}</td>
                    </tr>
                </table>
            </div>
            <div class="position-absolute col-xl-10 col-lg-6 col-md-4 p-4">
                <div class="d-flex justify-content-center bg-info p-4 rounded">
                    <div align="center">
                        <h2>Selamat Ini data E-kitir Anda</h2>
                        <form action="{{ route('store_gajiBersih') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_karyawan" value="{{ $id_karyawan }}">
                            <input type="hidden" name="nama" value="{{ $karyawan->nama }}">
                            <input type="hidden" name="nama_bank" value="{{ $karyawan->nama_bank }}">
                            <input type="hidden" name="norek" value="{{ $karyawan->norek }}">
                            <input type="hidden" name="namaPem_bank" value="{{ $karyawan->namaPem_bank }}">
                            <input type="hidden" name="gaji_bersih" value="{{ $totalGajiBersih }}">
                            <input type="hidden" name="potongan" value="{{ $totalPotongan }}">
                            <input type="hidden" name="tgl_gaji" value="{{ date('Y-m-d') }}">
                            <button type="submit" class="btn btn-success rounded">Save & Cetak</button>
                            <a href="{{ route('back') }}" class="btn btn-warning">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <script>
        window.print();
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  </body>
</html>    
@endif
