<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    
    
    public function data_karyawan(){
        $karyawans = Karyawan::where('id_karyawan', '>', 100)->latest()->simplePaginate(6);
        return view('data_karyawan', compact('karyawans'));
    }
    public function tambah_karyawan(){

        return view('tambah_karywan');
    }
    public function store_karyawan(Request $request){
        $request->validate([
            'id_karyawan' => 'required',
            'nama' => 'required',
            'bagian' => 'required',
            'jabatan' => 'required',
            'status_karyawan' => 'required',
            'status_ptkp' => 'required',
            'tgl_bergabung' => 'required',
            'gaji_pokok' => 'required',
            'nama_bank' => 'required',
            'norek' => 'required',
            'namaPem_bank' => 'required',
        ]);
        Karyawan::create([
            'id_karyawan' => $request->id_karyawan,
            'nama' => $request->nama,
            'bagian' => $request->bagian,
            'jabatan' => $request->jabatan,
            'status_karyawan' => $request->status_karyawan,
            'status_ptkp' => $request->status_ptkp,
            'tgl_bergabung' => $request->tgl_bergabung,
            'gaji_pokok' => $request->gaji_pokok,
            'nama_bank' => $request->nama_bank,
            'norek' => $request->norek,
            'namaPem_bank' => $request->namaPem_bank,
        ]);
        Alert::success('Congrats', 'You\'ve Update Successfully Add Data');
        return Redirect::route('data_karyawan');
    }

    public function edit_karyawan(Karyawan $karyawan){
        return view('edit_karyawan', compact('karyawan'));
    }
    public function update_karyawan(Karyawan $karyawan, Request $request){
        $request->validate([
            'id_karyawan' => 'required',
            'nama' => 'required',
            'bagian' => 'required',
            'jabatan' => 'required',
            'status_karyawan' => 'required',
            'status_ptkp' => 'required',
            'tgl_bergabung' => 'required',
            'gaji_pokok' => 'required',
            'nama_bank' => 'required',
            'norek' => 'required',
            'namaPem_bank' => 'required',
        ]);
        $karyawan->update([
            'id_karyawan' => $request->id_karyawan,
            'nama' => $request->nama,
            'bagian' => $request->bagian,
            'jabatan' => $request->jabatan,
            'status_karyawan' => $request->status_karyawan,
            'status_ptkp' => $request->status_ptkp,
            'tgl_bergabung' => $request->tgl_bergabung,
            'gaji_pokok' => $request->gaji_pokok,
            'nama_bank' => $request->nama_bank,
            'norek' => $request->norek,
            'namaPem_bank' => $request->namaPem_bank,
        ]);
        Alert::success('Congrats', 'You\'ve Update Successfully Update Data');
        return Redirect::route('data_karyawan');
    }
    public function delete_karyawan($id){
        $karyawan = Karyawan::find($id);
        $karyawan->delete();
        Alert::success('Congrats', 'You\'ve Update Successfully Delete Data');
        return Redirect::route('data_karyawan');
    }
   
    public function cari1(Request $request){
        $cari1 = $request->cari1;

        $karyawans = Karyawan::where('id_karyawan', 'like', "%".$cari1."%")->orwhere('nama', 'like', "%".$cari1."%")->paginate();
        // dd($karyawans);
        return view('data_karyawan', compact('karyawans'));
    }

    public function index_status(){
        $employs = DB::table('karyawans')->get();
        return view('index_status', compact('employs'));       
    }

    public function edit_ttd(Karyawan $ttd){
        return view('edit_ttd', compact('ttd'));
    }

    public function update_ttd(Karyawan $ttd, Request $request){
        $request->validate([
            'status_ttd' => 'required',
        ]);
        $ttd->update([
            'status_ttd' => $request->status_ttd,
        ]);
        Alert::success('Congrats', 'You\'ve Update Successfully Update Data');
        return Redirect::route('index_status');
    }

    public function cari9(Request $request){
        $cari9 = $request->cari9;

        $employs = Karyawan::where('id_karyawan', 'like', "%".$cari9."%")->orwhere('nama', 'like', "%".$cari9."%")->paginate(5);
        // dd($employs);
        return view('index_status', compact('employs'));
    }
}
