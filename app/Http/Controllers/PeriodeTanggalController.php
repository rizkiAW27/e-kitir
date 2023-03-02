<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Pendapatan;
use App\Models\Gaji;
use App\Models\PeriodeTanggal;
use PDF;
use App\Models\GajiBersih;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
class PeriodeTanggalController extends Controller
{
    
    
    public function setting_periode(){
        $periodeTgl = PeriodeTanggal::all();
        // dd($periodeTgl);
        return view('setting_periode', compact('periodeTgl'));
    }
    
    public function edit_periode(PeriodeTanggal $tglperiode){
        return view('edit_periode', compact('tglperiode'));
    }

    public function update_periode(Request $request){
        $request->validate([
            'tgl_periode1' => 'required',
            'tgl_periode2' => 'required',
        ]);

        // $tgl1 = $request->tgl_periode1;
        // $tgl2 = $request->tgl_periode2;

        $periodeTanggal = DB::table('periode_tanggals');

        $periodeTanggal->update([
            'tgl_periode1' => $request->tgl_periode1,
            'tgl_periode2' => $request->tgl_periode2,
        ]);
        // dd($tgl1, $tgl2, $periodeTanggal);
        Alert::success('Congrats', 'You\'ve Successfully Update Data');
        return Redirect::route('setting_periode');
    }
}
