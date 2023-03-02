<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class Notifcontroller extends Controller
{
    public function sukses(){
		Session::flash('sukses','Ini notifikasi SUKSES');
		return redirect()->back();
	}
 
	public function peringatan(){
		Session::flash('peringatan','Ini notifikasi PERINGATAN');
		return redirect()->back();
	}
 
	public function gagal(){
		Session::flash('gagal','Ini notifikasi GAGAL');
		return redirect()->back();
	}
}
