<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

     public function __construct()
     {
         $this->middleware('auth');
     }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'hak_akses' => ['required', 'string', 'max:255'],
            'id_karyawan' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $kry = Karyawan::count();
        if($kry == 0){
            Alert::warning('Sorry', 'Your Employ Not Avallible');
            return Redirect::route('home');
        }elseif($karyawans = Karyawan::where('id_karyawan', $data['id_karyawan'])->get()){
            foreach ($karyawans as $karyawan) {
                $id_karyawan = $karyawan->id_karyawan;
                if($id_karyawan == $data['id_karyawan']){
                    $users = User::create([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'hak_akses' => $data['hak_akses'],
                        'id_karyawan' => $data['id_karyawan'],
                        'password' => Hash::make($data['password']),
                    ]);
                    Alert::success('Congrats', 'You\'ve Successfully Registered');
                    return Redirect::route('home');
                }
            }
            $id = $karyawans->count();
            if($id == 0){
                Alert::warning('Sorry', 'Your ID Not Avallible');
                return Redirect::route('home');
            }
        }
    }
}
