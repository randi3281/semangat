<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
