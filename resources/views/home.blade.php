@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (Auth::user()->hak_akses == 'super_admin' || Auth::user()->hak_akses == 'admin_finance' || Auth::user()->hak_akses == 'hrd')
            <div class="col-md-12 bg-light mb-4">
                <div class="d-flex justify-content-center p-3">
                    <div class="ikon">
                        <div class="d-flex">
                            <img src="{{ asset('images/gambar-jam-png-1.png') }}" class="ikon-logo">
                            <div class="ms-2 mt-2"><h5>{{ date('d-m-Y') }}</h5></div>
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            <h2 id="jam"></h2>
                            <h2>:</h2>
                            <h2 id="menit"></h2>
                            <h2>:</h2>
                            <h2 id="detik"></h2>
                        </div>
                    </div>
                    <div class="ikon1 ms-4">
                        <div class="d-flex">
                            <img src="{{ asset('images/user.png') }}" class="ikon-logo">
                            <div class="ms-2 mt-2"><h5>Employe</h5></div>
                        </div>
                        @php
                            $dbKaryawan = DB::table('karyawans')->get()->count();
                        @endphp
                        <div class="d-flex justify-content-center">
                            <b><h1>{{ $dbKaryawan }}</h1></b>
                        </div>
                    </div>
                    <div class="ikon2 ms-4">
                        <div class="d-flex">
                            <img src="{{ asset('images/user.png') }}" class="ikon-logo">
                            <div class="ms-2 mt-2"><h5>Users</h5></div>
                        </div>
                            @php
                                $users = DB::table('users')->get()->count();
                            @endphp
                            <div class="d-flex justify-content-center">
                                <b><h1>{{ $users }}</h1></b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-center mb-4">
                        <img src="{{ asset('images/logo.jpg') }}" class="rounded-circle">
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="d-flex justify-content-center">
                        <center><h3>Selamat Datang di Aplikasi E-kitir PT. Cahaya Mulia Persada Nusa</h3></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
