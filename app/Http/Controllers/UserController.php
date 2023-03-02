<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function data_user(){
        $users = User::all();
        return view('data_user', compact('users'));
    }

    public function edit_user(User $user){
        return view('edit_user', compact('user'));
    }

    public function update_user(Request $request, User $user){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'hak_akses' => ['required', 'string', 'max:255'],
            'id_karyawan' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update([
            'name' => $request->name,
            'hak_akses' => $request->hak_akses,
            'id_karyawan' => $request->id_karyawan,
            'password' => Hash::make($request->password),
        ]);
        Alert::success('Congrats', 'You\'ve Successfully Update Data');
        return Redirect::route('data_user');
    }

    public function delete_user($id){
        $user = User::find($id);
        $user->delete();
        Alert::success('Congrats', 'You\'ve Successfully Delete Data');
        return Redirect::route('data_user');
    }

    public function upload_image(){
        return view('upload_image');
    }

    public function store_upload(Request $request){
        $request->validate([
            'image' => 'required',
            'id_user' => 'required'
        ]);

        $file = $request->file('image');
        $path = time() . '_' . $request->id_user . '.' . $file->getClientOriginalExtension();

        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        Image::create([
            'image' => $path,
            'id_user' => $request->id_user,
        ]);
        Alert::success('Congrats', 'You\'ve Successfully Add Foto');
        return Redirect::route('home');
    }

    public function profile(){
        $id = Auth::user()->id;
        $images = Image::where('id_user', $id)->get();
        return view('profile', compact('images'));
    }

    public function cari7(Request $request){
        $cari7 = $request->cari7;

        $users = User::where('id_karyawan', 'like', '%'.$cari7.'%')->paginate();

        return view('data_user', compact('users'));
    }
}
