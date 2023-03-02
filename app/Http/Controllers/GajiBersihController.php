<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Pendapatan;
use App\Models\Gaji;
use App\Models\PeriodeTanggal;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;
use App\Models\GajiBersih;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
class GajiBersihController extends Controller
{
    
    public function store_gajiBersih(Request $request){
        $request->validate([
            'id_karyawan' => 'required',
            'nama' => 'required',
            'nama_bank' => 'required',
            'norek' => 'required',
            'namaPem_bank' => 'required',
            'gaji_bersih' => 'required',
            'potongan' => 'required',
            'tgl_gaji' => 'required'
        ]);

        GajiBersih::create([
            'id_karyawan' => $request->id_karyawan,
            'nama' => $request->nama,
            'nama_bank' => $request->nama_bank,
            'norek' => $request->norek,
            'namaPem_bank' => $request->namaPem_bank,
            'gaji_bersih' => $request->gaji_bersih,
            'potongan' => $request->potongan,
            'tgl_gaji' => $request->tgl_gaji,
        ]);

        Alert::success('Congrats', 'You\'ve Successfully Add Data');
        return Redirect::route('data_salary');
    }
    public function data_gajiBersih(){
        $gBersih = GajiBersih::all();
        $gBersihs =  $gBersih->sortBy('id_karyawan');
        return view('data_gajiBersih', compact('gBersihs'));
    }

    public function cari(Request $request){
        $cari = $request->cari;

        $gBersihs = GajiBersih::where('id_karyawan', 'like', "%".$cari."%")->paginate();
        // dd($gBersihs);
        return view('data_gajiBersih', compact('gBersihs'));
    }

    public function print_gaji(){

        $id = 1;

        $periodes = PeriodeTanggal::where('id', $id)->get();

        foreach ($periodes as $periode) {
            $tgl1 = $periode->tgl_periode1;
            $tgl2 = $periode->tgl_periode2;
        }

        $range = [$tgl1, $tgl2];

        $gajis = GajiBersih::all();
        $g = $gajis->sortBy('id_karyawan');

        $gaji = $g->whereBetween('tgl_gaji', [$tgl1, $tgl2])->values()->all();

        $pdf = PDF::loadView('print_gaji', ['gaji' => $gaji])->setPaper('A4', 'potrait');
        return $pdf->stream('Laporan-Data-Keuangan.pdf');
    }

    public function delete_gajiBersih($id){
        $gajiBersih = GajiBersih::find($id);
        // dd($gajiBersih);
        $gajiBersih->delete();
        Alert::success('Congrats', 'You\'ve Successfully Delete Data');
        return Redirect::route('data_gajiBersih');
    }
}
