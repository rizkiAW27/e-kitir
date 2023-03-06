<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gaji;
use App\Models\Karyawan;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;
class GajiController extends Controller
{
    
    
    public function data_gaji(){
        $gajies = Gaji::where('kode', '>', 100)->latest()->simplePaginate(6);
        return view('data_gaji', compact('gajies'));
    }
    
    public function add_gaji(){
        return view('add_gaji');
    }
    public function store_gaji(Request $request){
        $request->validate([
            'kode' => 'required',
            'nama_pendapatan' => 'required',
            'jenis' => 'required'
        ]);
        Gaji::create([
            'kode' => $request->kode,
            'nama_pendapatan' => $request->nama_pendapatan,
            'jenis' => $request->jenis
        ]);
        Alert::success('Congrats', 'You\'ve Update Successfully Add Data');
        return Redirect::route('data_gaji');
    }

    public function edit_gaji(Gaji $gaji){
        return view('edit_gaji', compact('gaji'));
    }

    public function update_gaji(Gaji $gaji, Request $request){
        $request->validate([
            'kode' => 'required',
            'nama_pendapatan' => 'required',
            'jenis' => 'required'
        ]);
        $gaji->update([
            'kode' => $request->kode,
            'nama_pendapatan' => $request->nama_pendapatan,
            'jenis' => $request->jenis
        ]);
        Alert::success('Congrats', 'You\'ve Update Successfully Update Data');
        return Redirect::route('data_gaji');
    }

    public function delete_gaji($id){
        $gaji = Gaji::find($id);
        $gaji->delete();
        Alert::success('Congrats', 'You\'ve Update Successfully Delete Data');
        return Redirect::route('data_gaji');
    }

    public function cari2(Request $request){
        $cari2 = $request->cari2;

        $gajies = Gaji::where('kode', 'like', "%".$cari2."%")->orwhere('nama_pendapatan', 'like', "%".$cari2."%")->paginate();
        // dd($gajis);
        return view('data_gaji', compact('gajies'));
    }
}
