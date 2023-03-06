<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;
use App\Models\Pendapatan;
use App\Models\Potongan;
use App\Models\PeriodeTanggal;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Gaji;
use App\Models\Lembur;
use PDF;
use App\Models\GajiBersih;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class LemburController extends Controller
{
    
    public function index_lembur(Karyawan $karyawan){
        return view('index_lembur', compact('karyawan'));
    }

    public function data_lembur(Karyawan $karyawan){
        return view('data_lembur', compact('karyawan'));
    }

    public function store_lembur(Request $request){
        $request->validate([
            'id_karyawan' => 'required',
            'ket_lembur' => 'required',
            'jam1' => 'required|numeric',
            'jam2' => 'required|numeric',
            'tgl_lembur' => 'required'
        ]);
        Lembur::create([
            'id_karyawan' => $request->id_karyawan,
            'ket_lembur' => $request->ket_lembur,
            'jam1' => $request->jam1,
            'jam2' => $request->jam2,
            'tgl_lembur' => $request->tgl_lembur
        ]);
        Alert::success('Congrats', 'You\'ve Successfully Add Data');
        return Redirect::route('data_salary');
    }

    public function dataKaryawan_lembur(){
        $lemburs = Karyawan::join('lemburs', 'lemburs.id_karyawan', '=', 'karyawans.id_karyawan')->get(['karyawans.*', 'lemburs.*']);
        return view('dataKaryawan_lembur', compact('lemburs'));
    }

    public function edit_lembur(Lembur $lembur){
        return view('edit_lembur', compact('lembur'));
    }

    public function update_lembur(Request $request, Lembur $lembur){
        $request->validate([
            'ket_lembur' => 'required',
            'jam1' => 'required|numeric',
            'jam2' => 'required|numeric',
            'tgl_lembur' => 'required'
        ]);
        $lembur->update([
            'ket_lembur' => $request->ket_lembur,
            'jam1' => $request->jam1,
            'jam2' => $request->jam2,
            'tgl_lembur' => $request->tgl_lembur
        ]);
        Alert::success('Congrats', 'You\'ve Successfully Update Data');
        return Redirect::route('dataKaryawan_lembur');
    }

    public function delete_lembur($id){
        $lembur = Lembur::find($id);
        $lembur->delete();
        Alert::success('Congrats', 'You\'ve Successfully Delete Data');
        return Redirect::route('dataKaryawan_lembur');
    }

    public function rekap_lembur(){
        return view('rekap_lembur');
    }

    public function cetak_lembur(){
        $id = 1;
        $id_karyawan = Auth::user()->id_karyawan;
        $periodes = PeriodeTanggal::where('id', $id)->get();
        $lemburs = Lembur::where('id_karyawan', $id_karyawan)->get();
        foreach ($periodes as $periode) {
            $tgl1 = $periode->tgl_periode1;
            $tgl2 = $periode->tgl_periode2;
        }
        foreach ($lemburs as $lembur) {
            $dataLembur = $lembur;
        }
        $range = [$tgl1, $tgl2];

        $dLembur = $dataLembur->whereBetween('tgl_lembur', [$tgl1, $tgl2])->latest()->get();

        $pdf = PDF::loadView('cetak_lembur', ['dLembur' => $dLembur])->setPaper('A4', 'potrait');
        return $pdf->stream('Laporan-Data-Lembur-'.$id_karyawan.'.pdf');
    }

    public function cari4(Request $request){
        $cari4 = $request->cari4;
        $lemburs = Lembur::where('id_karyawan', 'like', "%".$cari4."%")->orwhere('ket_lembur', 'like', "%".$cari4."%")->paginate();
        return view('dataKaryawan_lembur', compact('lemburs'));
    }

    public function cetak_datalembur(){
        $id = 1;
        $periodes = PeriodeTanggal::where('id', $id)->get();
        foreach ($periodes as $periode) {
            $tgl1 = $periode->tgl_periode1;
            $tgl2 = $periode->tgl_periode2;
        }
        $range = [$tgl1, $tgl2];

        $lembur = Lembur::all();
        $lemburd = $lembur->sortBy('id_karyawan');

        $lemburs = $lemburd->whereBetween('tgl_lembur', [$tgl1, $tgl2])->values()->all();

        $pdf = PDF::loadView('cetak_datalembur', ['lemburs' => $lemburs])->setPaper('A4', 'potrait');
        return $pdf->stream('Laporan-Data-Lembur-Karyawan.pdf');
    }
}

