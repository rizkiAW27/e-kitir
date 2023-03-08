<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Pendapatan;
use App\Models\Gaji;
use App\Models\Lembur;
use App\Models\Potongan;
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
        $id = 1;
        $periodes = PeriodeTanggal::where('id', $id)->get();

        foreach ($periodes as $periode) {
            $tgl1 = $periode->tgl_periode1;
            $tgl2 = $periode->tgl_periode2;
        }

        $range = [$tgl1, $tgl2];
        $karyawans = DB::table('karyawans')->get();
        $totalPerid = Lembur::groupBy('id_karyawan')->selectRaw('id_karyawan, sum(jam1) as total')->selectRaw('id_karyawan, sum(jam2) as total1')->whereBetween('tgl_lembur', [$tgl1, $tgl2])->get();
        $totalPerid1 = DB::table('pendapatans')->select('id_karyawan', DB::raw('SUM(nilai_pendapatan) as ptotal'))->where('kode_tunjangan', '2002')->groupBy('id_karyawan')->get();
        $totalPerid2 = DB::table('pendapatans')->select('id_karyawan', DB::raw('SUM(nilai_pendapatan) as ptotal1'))->where('kode_tunjangan', '2003')->groupBy('id_karyawan')->get();
        $totalPerid3 = DB::table('potongans')->select('id_karyawan', DB::raw('SUM(nilai_potongan) as totalpot'))->where('jenis', 'Wajib')->groupBy('id_karyawan')->get();
        $totalPerid4 = DB::table('pendapatans')->select('id_karyawan', DB::raw('SUM(nilai_pendapatan) as totalbpjs1'))->where('kode_tunjangan', '2004')->groupBy('id_karyawan')->get();
        $totalPerid5 = DB::table('pendapatans')->select('id_karyawan', DB::raw('SUM(nilai_pendapatan) as totalbpjs2'))->where('kode_tunjangan', '2005')->groupBy('id_karyawan')->get();
        $totalPerid6 = DB::table('potongans')->select('id_karyawan', DB::raw('SUM(nilai_potongan) as totalpot1'))->where('jenis', 'Tidak Wajib')->groupBy('id_karyawan')->get();
        $totalPerid7 = DB::table('potongans')->select('id_karyawan', DB::raw('SUM(nilai_potongan) as totalpot2'))->where('jenis', 'PPh 21')->groupBy('id_karyawan')->get();
        
        return view('data_gajiBersih', compact('karyawans', 'totalPerid', 'totalPerid1', 'totalPerid2', 'totalPerid3', 'totalPerid4', 'totalPerid5', 'totalPerid6', 'tgl2', 'totalPerid7'));
    }

    public function cari(Request $request){
        $cari = $request->cari;
        $id = 1;
        $periodes = PeriodeTanggal::where('id', $id)->get();

        foreach ($periodes as $periode) {
            $tgl1 = $periode->tgl_periode1;
            $tgl2 = $periode->tgl_periode2;
        }
        $karyawans = Karyawan::where('id_karyawan', 'like', "%".$cari."%")->orwhere('nama', 'like', "%".$cari."%")->paginate(5);
        // dd($gBersihs);
        $totalPerid = Lembur::groupBy('id_karyawan')->selectRaw('id_karyawan, sum(jam1) as total')->selectRaw('id_karyawan, sum(jam2) as total1')->whereBetween('tgl_lembur', [$tgl1, $tgl2])->get();
        $totalPerid1 = DB::table('pendapatans')->select('id_karyawan', DB::raw('SUM(nilai_pendapatan) as ptotal'))->where('kode_tunjangan', '2002')->groupBy('id_karyawan')->get();
        $totalPerid2 = DB::table('pendapatans')->select('id_karyawan', DB::raw('SUM(nilai_pendapatan) as ptotal1'))->where('kode_tunjangan', '2003')->groupBy('id_karyawan')->get();
        $totalPerid3 = DB::table('potongans')->select('id_karyawan', DB::raw('SUM(nilai_potongan) as totalpot'))->where('jenis', 'Wajib')->groupBy('id_karyawan')->get();
        $totalPerid4 = DB::table('pendapatans')->select('id_karyawan', DB::raw('SUM(nilai_pendapatan) as totalbpjs1'))->where('kode_tunjangan', '2004')->groupBy('id_karyawan')->get();
        $totalPerid5 = DB::table('pendapatans')->select('id_karyawan', DB::raw('SUM(nilai_pendapatan) as totalbpjs2'))->where('kode_tunjangan', '2005')->groupBy('id_karyawan')->get();
        $totalPerid6 = DB::table('potongans')->select('id_karyawan', DB::raw('SUM(nilai_potongan) as totalpot1'))->where('jenis', 'Tidak Wajib')->groupBy('id_karyawan')->get();
        $totalPerid7 = DB::table('potongans')->select('id_karyawan', DB::raw('SUM(nilai_potongan) as totalpot2'))->where('jenis', 'PPh 21')->groupBy('id_karyawan')->get();
        
        return view('data_gajiBersih', compact('karyawans', 'totalPerid', 'totalPerid1', 'totalPerid2', 'totalPerid3', 'totalPerid4', 'totalPerid5', 'totalPerid6', 'tgl2', 'totalPerid7'));

    }

    public function print_gaji(){

        $id = 1;
        $periodes = PeriodeTanggal::where('id', $id)->get();

        foreach ($periodes as $periode) {
            $tgl1 = $periode->tgl_periode1;
            $tgl2 = $periode->tgl_periode2;
        }

        $range = [$tgl1, $tgl2];
        $karyawans = DB::table('karyawans')->get();
        $totalPerid = Lembur::groupBy('id_karyawan')->selectRaw('id_karyawan, sum(jam1) as total')->selectRaw('id_karyawan, sum(jam2) as total1')->whereBetween('tgl_lembur', [$tgl1, $tgl2])->get();
        $totalPerid1 = DB::table('pendapatans')->select('id_karyawan', DB::raw('SUM(nilai_pendapatan) as ptotal'))->where('kode_tunjangan', '2002')->groupBy('id_karyawan')->get();
        $totalPerid2 = DB::table('pendapatans')->select('id_karyawan', DB::raw('SUM(nilai_pendapatan) as ptotal1'))->where('kode_tunjangan', '2003')->groupBy('id_karyawan')->get();
        $totalPerid3 = DB::table('potongans')->select('id_karyawan', DB::raw('SUM(nilai_potongan) as totalpot'))->where('jenis', 'Wajib')->groupBy('id_karyawan')->get();
        $totalPerid4 = DB::table('pendapatans')->select('id_karyawan', DB::raw('SUM(nilai_pendapatan) as totalbpjs1'))->where('kode_tunjangan', '2004')->groupBy('id_karyawan')->get();
        $totalPerid5 = DB::table('pendapatans')->select('id_karyawan', DB::raw('SUM(nilai_pendapatan) as totalbpjs2'))->where('kode_tunjangan', '2005')->groupBy('id_karyawan')->get();
        $totalPerid6 = DB::table('potongans')->select('id_karyawan', DB::raw('SUM(nilai_potongan) as totalpot1'))->where('jenis', 'Tidak Wajib')->groupBy('id_karyawan')->get();
        $totalPerid7 = DB::table('potongans')->select('id_karyawan', DB::raw('SUM(nilai_potongan) as totalpot2'))->where('jenis', 'PPh 21')->groupBy('id_karyawan')->get();
        
        return view('print_gaji', compact('karyawans', 'totalPerid', 'totalPerid1', 'totalPerid2', 'totalPerid3', 'totalPerid4', 'totalPerid5', 'totalPerid6', 'tgl2', 'totalPerid7'));

           
    }

    public function delete_gajiBersih($id){
        $gajiBersih = GajiBersih::find($id);
        // dd($gajiBersih);
        $gajiBersih->delete();
        Alert::success('Congrats', 'You\'ve Successfully Delete Data');
        return Redirect::route('data_gajiBersih');
    }

    public function gaji_karyawan(){
        $id = 1;

        $periodes = PeriodeTanggal::where('id', $id)->get();

        foreach ($periodes as $periode) {
            $tgl1 = $periode->tgl_periode1;
            $tgl2 = $periode->tgl_periode2;
        }

        $range = [$tgl1, $tgl2];

        $totalPerid = Lembur::groupBy('id_karyawan')->selectRaw('id_karyawan, sum(jam1) as total')->selectRaw('id_karyawan, sum(jam2) as total1')->whereBetween('tgl_lembur', [$tgl1, $tgl2])->get();
        $totalPerid1 = DB::table('pendapatans')->select('id_karyawan', DB::raw('SUM(nilai_pendapatan) as ptotal'))->where('kode_tunjangan', '2002')->groupBy('id_karyawan')->get();
        $totalPerid2 = DB::table('pendapatans')->select('id_karyawan', DB::raw('SUM(nilai_pendapatan) as ptotal1'))->where('kode_tunjangan', '2003')->groupBy('id_karyawan')->get();
        $totalPerid4 = DB::table('pendapatans')->select('id_karyawan', DB::raw('SUM(nilai_pendapatan) as totalbpjs1'))->where('kode_tunjangan', '2004')->groupBy('id_karyawan')->get();
        $totalPerid5 = DB::table('pendapatans')->select('id_karyawan', DB::raw('SUM(nilai_pendapatan) as totalbpjs2'))->where('kode_tunjangan', '2005')->groupBy('id_karyawan')->get();
        // $totalPerid6 = DB::table('pendapatans')->select('id_karyawan', DB::raw('SUM(nilai_pendapatan) as totalbpjs3'))->where('kode_tunjangan', '2006')->groupBy('id_karyawan')->get();
          // dd($totalPerid1);
        $totalPerid3 = DB::table('potongans')->select('id_karyawan', DB::raw('SUM(nilai_potongan) as totalpot'))->where('jenis', 'Wajib')->groupBy('id_karyawan')->get();
        $totalPerid7 = DB::table('potongans')->select('id_karyawan', DB::raw('SUM(nilai_potongan) as totalpot2'))->where('jenis', 'Tidak Wajib')->groupBy('id_karyawan')->get();
        $totalPerid6 = DB::table('potongans')->select('id_karyawan', DB::raw('SUM(nilai_potongan) as totalpot1'))->where('jenis', 'PPh 21')->groupBy('id_karyawan')->get();
        return view('gaji_karyawan', compact('totalPerid', 'totalPerid1', 'totalPerid2', 'totalPerid3', 'totalPerid4', 'totalPerid5', 'totalPerid6', 'totalPerid7'));
    }
}
