<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Potongan;
use App\Models\DataPotongan;
use App\Models\Karyawan;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;

class PotonganController extends Controller
{
    
    
    public function data_potongan(){
        $potongans = Potongan::all();
        $Datapotongans = DataPotongan::all();
        return view('data_potongan', compact('potongans', 'Datapotongans'));
    }
    public function tambah_potongan(Karyawan $karyawan){
        return view('tambah_potongan', compact('karyawan'));
    }
    public function store_potongan(Request $request){
        $request->validate([
            'id_karyawan' => 'required',
            'kode' => 'required',
            'nama_potongan' => 'required',
            'nilai_potongan' => 'required',
            'jenis' => 'required'
        ]);
        $id_karyawan = $request->id_karyawan;
        // dd($id_karyawan);
        Potongan::create([
            'id_karyawan' => $id_karyawan,
            'kode' => $request->kode,
            'nama_potongan' => $request->nama_potongan,
            'nilai_potongan' => $request->nilai_potongan,
            'jenis' => $request->jenis
        ]);
        Alert::success('Congrats', 'You\'ve Successfully Add Data');
        return Redirect::route('data_potongan');
    }
    public function edit_potongan(Potongan $potongan){
        return view('edit_potongan', compact('potongan'));
    }

    public function update_potongan(Potongan $potongan, Request $request){
        $request->validate([
            'kode' => 'required',
            'nama_potongan' => 'required',
            'nilai_potongan' => 'required',
            'jenis' => 'required'
        ]);
        $potongan->update([
            'kode' => $request->kode,
            'nama_potongan' => $request->nama_potongan,
            'nilai_potongan' => $request->nilai_potongan,
            'jenis' => $request->jenis
        ]);
        Alert::success('Congrats', 'You\'ve Successfully Update Data');
        return Redirect::route('data_potongan');
    }

    public function delete_potongan($id){
        $potongan = Potongan::find($id);
        $potongan->delete();
        Alert::success('Congrats', 'You\'ve Successfully Delete Data');
        return Redirect::route('data_potongan');
    }
    public function cari6(Request $request){
        $cari6 = $request->cari6;
        $potongans = Potongan::where('id_karyawan', 'like', "%".$cari6."%")->orwhere('nama_potongan', 'like', "%".$cari6."%")->paginate();
        $Datapotongans = DataPotongan::latest()->paginate(5);
        // dd($gajis);
        return view('data_potongan', compact('potongans', 'Datapotongans'));
    }

    public function storeDataPotongan(Request $request){
        $request->validate([
            'data_potongan' => 'required',
        ]);
        DataPotongan::create([
            'data_potongan' => $request->data_potongan,
        ]);
        Alert::success('Congrats', 'You\'ve Successfully Add Data');
        return redirect()->back();
    }

    public function editdatapotongan(DataPotongan $datapotongan){
        return view('editdatapotongan', compact('datapotongan'));
    }

    public function updatedatapotongan(Request $request, DataPotongan $datapotongan){
        $request->validate([
            'data_potongan' => 'required',
        ]);
        $datapotongan->update([
            'data_potongan' => $request->data_potongan,
        ]);
        Alert::success('Congrats', 'You\'ve Successfully Update Data');
        $potongans = Potongan::latest()->paginate(5);
        $Datapotongans = DataPotongan::latest()->paginate(5);
        return view('home', compact('potongans', 'Datapotongans'));
    }

    public function deletedatapotongan($id){
        $datapotongan = DataPotongan::find($id);
        $datapotongan->delete();
        Alert::success('Congrats', 'You\'ve Successfully Delete Data');
        $potongans = Potongan::latest()->paginate(5);
        $Datapotongans = DataPotongan::latest()->paginate(5);
        return view('home', compact('potongans', 'Datapotongans'));
    }
}
