<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TunjanganController;
use App\Http\Controllers\PotonganController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotifController;
use App\Http\Controllers\LemburController;
use App\Http\Controllers\TtdStatusController;
use App\Http\Controllers\GajiBersihController;
use App\Http\Controllers\PeriodeTanggalController;
use App\Http\Controllers\PendapatanController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Redirect::route('login');
});
//area admin

Auth::routes(['register' => false,]);
//midelware
Route::middleware(['auth'])->group(function () {

        Auth::routes(['register' => true, 'login' => false]);
        //karyawan
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('/data_karyawan', [KaryawanController::class, 'data_karyawan'])->name('data_karyawan');
        Route::get('/tambah_karyawan', [KaryawanController::class, 'tambah_karyawan'])->name('tambah_karyawan');
        Route::post('/store_karyawan/tambah', [KaryawanController::class, 'store_karyawan'])->name('store_karyawan');
        Route::get('/edit_karyawan/{karyawan}/edit', [KaryawanController::class, 'edit_karyawan'])->name('edit_karyawan');
        Route::patch('/edit_karyawan/{karyawan}/update', [KaryawanController::class, 'update_karyawan'])->name('update_karyawan');
        Route::get('/edit_karyawan/{id}', [KaryawanController::class, 'delete_karyawan'])->name('delete_karyawan');
        Route::get('/data_karyawan/cari', [KaryawanController::class, 'cari1'])->name('cari1');

        //tambah gaji
        Route::get('/data_gaji', [GajiController::class, 'data_gaji'])->name('data_gaji');
        Route::get('/data_gaji/cari', [GajiController::class, 'cari2'])->name('cari2');
        Route::get('/tambah_gaji/', [GajiController::class, 'add_gaji'])->name('add_gaji');
        Route::post('/tambah_gaji/store', [GajiController::class, 'store_gaji'])->name('store_gaji');
        Route::get('/edit_gaji/{gaji}/edit', [GajiController::class, 'edit_gaji'])->name('edit_gaji');
        Route::patch('/edit_gaji/{gaji}/update', [GajiController::class, 'update_gaji'])->name('update_gaji');
        Route::get('delete_gaji/{id}', [GajiController::class, 'delete_gaji'])->name('delete_gaji');

        //tambah potongan
        Route::get('/data_potongan', [PotonganController::class, 'data_potongan'])->name('data_potongan');
        Route::get('/tambah_potongan/{karyawan}', [PotonganController::class, 'tambah_potongan'])->name('tambah_potongan');
        Route::post('/tambah_potongan', [PotonganController::class, 'store_potongan'])->name('store_potongan');
        Route::get('/edit_potongan/{potongan}/edit', [PotonganController::class, 'edit_potongan'])->name('edit_potongan');
        Route::patch('/edit_potongan/{potongan}/update', [PotonganController::class, 'update_potongan'])->name('update_potongan');
        Route::get('/delete_potongan/{id}/delete', [PotonganController::class, 'delete_potongan'])->name('delete_potongan');
        Route::get('/cari/data/potongan/karyawan/', [PotonganController::class, 'cari6'])->name('cari6');
        Route::post('/data/potongan/tambah', [PotonganController::class, 'storeDataPotongan'])->name('storeDataPotongan');
        Route::get('/editdatapotongan/{datapotongan}/edit', [PotonganController::class, 'editdatapotongan'])->name('editdatapotongan');
        Route::patch('/editdatapotongan/{datapotongan}/update', [PotonganController::class, 'updatedatapotongan'])->name('updatedatapotongan');
        Route::get('/deletedatapotongan/{id}/delete', [PotonganController::class, 'deletedatapotongan'])->name('deletedatapotongan');
        
        //tambah Gaji
        Route::get('/tambah_gaji/{karyawan}', [PendapatanController::class, 'tambah_gaji'])->name('tambah_gaji');
        Route::post('/tambah_pendapatan', [PendapatanController::class, 'store_tunjangan'])->name('store_tunjangan');
        Route::get('/data_pendapatan', [PendapatanController::class, 'data_pendapatan'])->name('data_pendapatan');
        Route::get('/data_pendapatan/cari', [PendapatanController::class, 'cari3'])->name('cari3');
        Route::get('/edit_pendapatan/{pendapatan}/edit', [PendapatanController::class, 'edit_pendapatan'])->name('edit_pendapatan');
        Route::patch('/edit_pendapatan/{pendapatan}/update', [PendapatanController::class, 'update_pendapatan'])->name('update_pendapatan');
        Route::get('/edit_pendapatan/{pendapatan}/delete', [PendapatanController::class, 'delete_pendapatan'])->name('delete_pendapatan');
        Route::get('/data_salary', [PendapatanController::class, 'data_salary'])->name('data_salary');
        Route::get('/data_salary/cari', [PendapatanController::class, 'cari5'])->name('cari5');
        Route::get('/data_salary/{karyawan}/edit', [PendapatanController::class, 'data_ekitir'])->name('data_ekitir');

        //lembur
        Route::get('/index_lembur/{karyawan}', [LemburController::class, 'index_lembur'])->name('index_lembur');
        Route::get('/index_lembur/{karyawan}/tambah_lemburan', [LemburController::class, 'data_lembur'])->name('data_lembur');
        Route::post('/index_lembur/tambah_lemburan', [LemburController::class, 'store_lembur'])->name('store_lembur');
        Route::get('/index_lembur/data/karyawan/lembur', [LemburController::class, 'dataKaryawan_lembur'])->name('dataKaryawan_lembur');
        Route::get('/index_lembur/data/karyawan/lembur/cari4', [LemburController::class, 'cari4'])->name('cari4');
        Route::get('/index_lembur/{lembur}/edit', [LemburController::class, 'edit_lembur'])->name('edit_lembur');
        Route::patch('/index_lembur/{lembur}/update', [LemburController::class, 'update_lembur'])->name('update_lembur');
        Route::get('/index_lembur/{id}/delete', [LemburController::class, 'delete_lembur'])->name('delete_lembur');
        Route::get('/data/rekap/lembur/karyawan', [LemburController::class, 'rekap_lembur'])->name('rekap_lembur');
        Route::get('/cetak/lembur/karyawan', [LemburController::class, 'cetak_lembur'])->name('cetak_lembur');
        Route::get('/cetak/data/lembur/karyawan', [LemburController::class, 'cetak_datalembur'])->name('cetak_datalembur');

        //Gaji Bersih
        Route::get('/laporan/gaji_bersih/karyawan', [GajiBersihController::class, 'data_gajiBersih'])->name('data_gajiBersih');
        Route::post('/laporan/simpan/gaji_bersih', [GajiBersihController::class, 'store_gajiBersih'])->name('store_gajiBersih');
        Route::get('/laporan/gaji_bersih/karyawan/cari', [GajiBersihController::class, 'cari'])->name('cari');
        Route::get('/laporan/gaji/karyawan', [GajiBersihController::class, 'print_gaji'])->name('print_gaji');
        Route::get('/laporan/gaji_bersih/{id}/delete', [GajiBersihController::class, 'delete_gajiBersih'])->name('delete_gajiBersih');

        //periodeTanggal
        Route::get('/setting', [PeriodeTanggalcontroller::class, 'setting_periode'])->name('setting_periode');
        Route::get('/setting/{tglperiode}/edit',[periodetanggalController::class, 'edit_periode'])->name('edit_periode');
        Route::patch('/setting/{tglperiode}/update', [PeriodeTanggalController::class, 'update_periode'])->name('update_periode');

        //halaman Karyawan
        Route::get('/data/ekitir/karyawan', [PendapatanController::class, 'kitir_karyawan'])->name('kitir_karyawan');

        //notifikasi
        Route::get('/pesan/sukses',[NotifController::class, 'sukses'])->name('sukses');
        Route::get('/pesan/peringatan',[NotifController::class, 'peringatan'])->name('peringatan');
        Route::get('/pesan/gagal',[NotifController::class, 'gagal'])->name('gagal');

        //profile
        Route::get('/data/users', [UserController::class, 'data_user'])->name('data_user');
        Route::get('/data/users/{user}/edit', [UserController::class, 'edit_user'])->name('edit_user');
        Route::patch('/data/users/{user}/update', [UserController::class, 'update_user'])->name('update_user');
        Route::get('/data/users/{id}/delete', [UserController::class, 'delete_user'])->name('delete_user');
        Route::get('/profile/user', [UserController::class, 'profile'])->name('profile');
        Route::get('/profile/user/cari', [UserController::class, 'cari7'])->name('cari7');

        //upload image
        Route::get('/upload/image', [UserController::class, 'upload_image'])->name('upload_image');
        Route::post('/upload/image/upload', [UserController::class, 'store_upload'])->name('store_upload');
        

        //halaman admin finance
        Route::get('/index/admin/data/tunjangan/karyawan', [PendapatanController::class, 'd_tunjangan'])->name('d_tunjangan');
        Route::get('/data_salary/cari8', [PendapatanController::class, 'cari8'])->name('cari8');
        Route::get('/back/data/', [PendapatanController::class, 'back'])->name('back');

        //gaji karyawan
        Route::get('/data/gaji/karyawan/seluruh', [GajiBersihController::class, 'gaji_karyawan'])->name('gaji_karyawan');

        //ttd status tanda tangan
        Route::get('/data/status/tanda/tangan', [KaryawanController::class, 'index_status'])->name('index_status');
        Route::get('/data/status/tanda/tangan/{ttd}/edit', [KaryawanController::class, 'edit_ttd'])->name('edit_ttd');
        Route::patch('/data/status/tanda/tangan/{ttd}/update', [KaryawanController::class, 'update_ttd'])->name('update_ttd');
        Route::get('/data/status/tanda/tangan/cari9', [KaryawanController::class, 'cari9'])->name('cari9');
});

// Route::middleware(['karyawan'])->group(function () {
//     //halaman Karyawan
// });

// Route::middleware(['hrd'])->group(function () {
//     //halaman HRD
// });

