<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai2;

class Belajar20Controller extends Controller
{
    public function eloquent(){
        $pegawai = Pegawai2::all();
        return view('Belajar20.eloquent', ['pegawai' => $pegawai]);
    }
}
