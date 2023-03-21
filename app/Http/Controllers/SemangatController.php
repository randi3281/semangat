<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SemangatController extends Controller
{
    public function index(){
        return view('semangat');
    }

    public function belajar4(){
        return view('belajar4');
    }

    public function belajar42(){
        return view('belajar42');
    }

    public function belajar5($nama){
        return view('belajar5', ["nama" => $nama]);
    }

    public function inputan(){
        return view('inputan');
    }

    public function hasil(Request $request){
        $nama = $request->nama;
        $nim = $request->nim;
        return view('hasil', ["nama" => $nama, "nim" => $nim]);
    }

    public function daftar(){
        $data = DB::table('pegawai')->get();
        return view('daftar', ["data" => $data]);
    }
}
