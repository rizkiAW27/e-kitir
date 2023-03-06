<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>E-Kitir PT. CMPN</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- Scripts -->
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @include('sweetalert::alert')
    <div class="d-flex">
        <div class="bg-white dashbord">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo.jpg') }}" class="size-logo">
            </a>
            <hr>
            <ul class="navbar-nav ms-auto">
                @if (Auth::user()->hak_akses == 'hrd')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('data_karyawan') }}">Data Karyawan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dataKaryawan_lembur') }}">Data Karyawan Lembur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kitir_karyawan') }}" target="_blank" style="color: black">Data E-kitir</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('rekap_lembur') }}" style="color: black">Data Overtime</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}" style="color: black">Profile</a>
                    </li>
                @elseif (Auth::user()->hak_akses == 'karyawan')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kitir_karyawan') }}" target="_blank" style="color: black">E-kitir</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('rekap_lembur') }}" style="color: black">Data Overtime</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}" style="color: black">Profile</a>
                    </li>
                @elseif(Auth::user()->hak_akses == 'super_admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('data_karyawan') }}">Data Karyawan</a>
                    </li>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Tunjangan & BPJS
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <a class="dropdown-item" href="{{ route('data_gaji') }}">Tunjangan</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('data_pendapatan') }}">Data Tunjangan & BPJS</a>
                            </li>
                        </ul>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('data_potongan') }}">Data Potongan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dataKaryawan_lembur') }}">Data Karyawan Lembur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('data_salary') }}">Data Pendapatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('data_gajiBersih') }}">Data Gaji Bersih</a>
                    </li>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Setting
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ route('index_status') }}">Kelola Status TTD</a></li>
                        <li><a class="dropdown-item" href="{{ route('data_user') }}">Kelola Users</a></li>
                        <li><a class="dropdown-item" href="{{ route('register') }}">Registrasi Akun</a></li>
                        <li><a class="dropdown-item" href="{{ route('setting_periode') }}">Periode</a></li>
                        <li><a class="dropdown-item" href="{{ route('upload_image') }}">Upload Image</a></li>
                        </ul>
                    </div>
                @elseif (Auth::user()->hak_akses == "admin_finance")
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('d_tunjangan') }}">Data Pendapatan</a>
                    </li>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Tunjangan & BPJS
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <a class="dropdown-item" href="{{ route('data_gaji') }}">Tunjangan</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('data_pendapatan') }}">Data Tunjangan & BPJS</a>
                            </li>
                        </ul>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('data_potongan') }}">Data Potongan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dataKaryawan_lembur') }}">Data Karyawan Lembur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}" style="color: black">Profile</a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="kontent">
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        window.setTimeout("waktu()", 1000);
     
        function waktu() {
            var waktu = new Date();
            setTimeout("waktu()", 1000);
            document.getElementById("jam").innerHTML = waktu.getHours();
            document.getElementById("menit").innerHTML = waktu.getMinutes();
            document.getElementById("detik").innerHTML = waktu.getSeconds();
        }
    </script>
</body>
</html>
