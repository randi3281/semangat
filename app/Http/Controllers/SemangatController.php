<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;


class SemangatController extends Controller
{
    public function index(){
        return view('belajar.semangat');
    }

    public function belajar4(){
        return view('belajar.belajar4');
    }

    public function belajar42(){
        return view('belajar.belajar42');
    }

    public function belajar5($nama){
        return view('belajar.belajar5', ["nama" => $nama]);
    }

    public function inputan(){
        return view('belajar.inputan');
    }

    public function hasil(Request $request){
        $nama = $request->nama;
        $nim = $request->nim;
        return view('belajar.hasil', ["nama" => $nama, "nim" => $nim]);
    }

    public function daftar(){
        $data = DB::table('pegawai')->paginate(10);
        return view('belajar.daftar', ["data" => $data]);
    }
}
