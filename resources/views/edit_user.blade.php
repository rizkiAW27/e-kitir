@if (Auth::user()->hak_akses == 'super_admin' || Auth::user()->hak_akses == 'hrd')
@extends('layouts.dashbord')
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h3>Edit User</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('update_user', $user) }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="hak_akses" class="col-md-4 col-form-label text-md-end">
                                {{ __('Hak Akses') }}
                            </label>
                        
                            <div class="col-md-6">
                                <select id="hak_akses" type="text" class="form-control @error('hak_akses') is-invalid @enderror" name="hak_akses" value="{{ old('hak-akses') }}" required autocomplete="hak_akses" autofocus>
                                    <option value="{{ $user->hak_akses }}">{{ $user->hak_akses }}</option>
                                    <option value="karyawan">Karyawan</option>
                                    <option value="hrd">HRD</option>
                                    <option value="super_admin">Super Admin</option>
                                    <option value="admin_finance">Admin Finance</option>
                                </select>
                                @error('hak_akses')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="id_karyawan" class="col-md-4 col-form-label text-md-end">
                                {{ __('Id Karyawan') }}
                            </label>
                        
                            <div class="col-md-6">
                                <input id="id_karyawan" type="number" class="form-control @error('id_karyawan') is-invalid @enderror" name="id_karyawan" value="{{ $user->id_karyawan }}" required autocomplete="id_karyawan" autofocus>
                        
                                @error('id_karyawan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                                <a href="{{ route('data_user') }}" class="btn btn-warning">Cancel</a>
                            </div>
                        </div>
                      </form>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endif