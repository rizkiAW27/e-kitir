<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
class PendapatanController extends Controller
{
    
    
    public function tambah_gaji(Karyawan $karyawan){
        $gajis = Gaji::all();
        return view('tambah_gaji', compact('karyawan', 'gajis'));
    }

    public function store_tunjangan(Request $request){
       $request->validate([
        'id_karyawan' => 'required',
        'kode_tunjangan' => 'required',
        'nilai_pendapatan' => 'required|numeric',
        'status' => 'required',
        'id_tunjangan' => 'required'
       ]);
        Pendapatan::create([
            'id_karyawan' => $request->id_karyawan,
            'kode_tunjangan' => $request->kode_tunjangan,
            'nilai_pendapatan' => $request->nilai_pendapatan,
            'status' => $request->status,
            'id_tunjangan' => $request->id_tunjangan
        ]);
        Alert::success('Congrats', 'You\'ve Successfully');
        return redirect()->back();
    }

    public function data_pendapatan(){
        $pendapatan = Pendapatan::join('karyawans', 'karyawans.id_karyawan', '=', 'pendapatans.id_karyawan')->join('gajis', 'gajis.kode', '=', 'pendapatans.kode_tunjangan')->get(['pendapatans.*', 'karyawans.nama', 'gajis.nama_pendapatan']);
        // dd($pendapatans);
        $pendapatans = $pendapatan->sortBy('id_karyawan');
        return view('data_pendapatan', compact('pendapatans'));
    }

    public function edit_pendapatan(Pendapatan $pendapatan){
        return view('edit_pendapatan', compact('pendapatan'));
    }

    public function update_pendapatan(Pendapatan $pendapatan, Request $request){
        $request->validate([
            'nilai_pendapatan' => 'required|numeric',
            'status' => 'required',
           ]);
        $pendapatan->update([
            'nilai_pendapatan' => $request->nilai_pendapatan,
            'status' => $request->status
        ]);
        Alert::success('Congrats', 'You\'ve Update Successfully');
        return Redirect::route('data_pendapatan');
    }

    public function delete_pendapatan($id){
        $pendapatan = Pendapatan::find($id);
        $pendapatan->delete();
        Alert::success('Congrats', 'You\'ve Delete Successfully');
        return redirect()->back();
    }

    public function data_salary(){
        $karyawans = Karyawan::all();
        return view('data_salary', compact('karyawans'));
    }

    public function data_ekitir(Karyawan $karyawan){
        $id = 1;

        $periodes = PeriodeTanggal::where('id', $id)->get();

        foreach ($periodes as $periode) {
            $tgl1 = $periode->tgl_periode1;
            $tgl2 = $periode->tgl_periode2;
        }
        $range = [$tgl1, $tgl2];
        $gajis = Gaji::all();
        $pendapatans = Pendapatan::all();
        $lemburans = Lembur::whereBetween('created_at', [$tgl1, $tgl2])->latest()->get();
        $potongans = Potongan::whereBetween('created_at', [$tgl1, $tgl2])->latest()->get();
        // dd($karyawan);
        return view('data_ekitir', compact('karyawan','pendapatans', 'gajis', 'lemburans', 'potongans'));
    }

    public function kitir_karyawan(){
        $id_karyawan = Auth::user()->id_karyawan;
        $id = 1;

        $periodes = PeriodeTanggal::where('id', $id)->get();

        foreach ($periodes as $periode) {
            $tgl1 = $periode->tgl_periode1;
            $tgl2 = $periode->tgl_periode2;
        }

        $range = [$tgl1, $tgl2];
        $karyawans = DB::select('select * from karyawans where id_karyawan = ?', [$id_karyawan]);
        $gajis = Gaji::all();
        $pendapatans = Pendapatan::all();
        $lemburans = Lembur::whereBetween('created_at', [$tgl1, $tgl2])->latest()->get();
        $potongans = Potongan::whereBetween('created_at', [$tgl1, $tgl2])->latest()->get();

        if($karyawans == []){
            return redirect()->back();
        }else{
            foreach ($karyawans as $karyawan) {
                // dd($karyawan);
                return view('kitir_karyawan', compact('karyawan', 'pendapatans', 'gajis', 'lemburans', 'potongans'));
            }
        }
    }

    public function cari3(Request $request){
        $cari3 = $request->cari3;
        // $pendapatan = Pendapatan::join('karyawans', 'karyawans.id_karyawan', '=', 'pendapatans.id_karyawan')->join('gajis', 'gajis.kode', '=', 'pendapatans.kode_tunjangan')->get(['pendapatans.*', 'karyawans.nama', 'gajis.nama_pendapatan']);
        $pendapatans = Pendapatan::where('id_karyawan', 'like', "%".$cari3."%")->paginate();
        // dd($gajis);
        return view('data_pendapatan', compact('pendapatans'));
    }

    public function cari5(Request $request){
        $cari5 = $request->cari5;
        $karyawans = Karyawan::where('id_karyawan', 'like', "%".$cari5."%")->paginate();
        return view('data_salary', compact('karyawans'));
    }

    public function d_tunjangan(){
        $karyawans = Karyawan::all();
        return view('admin_finance.d_tunjangan', compact('karyawans'));
    }

    public function cari8(Request $request){
        $cari8 = $request->cari8;
        $karyawans = Karyawan::where('id_karyawan', 'like', "%".$cari8."%")->paginate();
        return view('admin_finance.d_tunjangan', compact('karyawans'));
    }

    public function back(){
        return Redirect::route('home');
    }
}
