<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai2;
use App\Models\siswa;

class Belajar20Controller extends Controller
{
    public function eloquent(){
        $pegawai = Pegawai2::all();
        $pegawaiPertama = Pegawai2::first();
        $pegawaiKedua = Pegawai2::find(2);
        $pegawaiKetiga = Pegawai2::where('nama', 'Dadap Wibowo')->get();
        $pegawaiKeempat = Pegawai2::where('nama', '=', 'Dadap Wibowo')->get();
        $pegawaiKelima = Pegawai2::where('id', '<=', 5)->get();
        $pegawaiKeenam = Pegawai2::where('nama', 'like', '%a%')->get();
        $pegawaiKetujuh = Pegawai2::paginate(3);
        return view('Belajar20.eloquent', ['pegawai' => $pegawai,'pegawaiPertama' => $pegawaiPertama,'pegawaiKedua' => $pegawaiKedua,'pegawaiKetiga' => $pegawaiKetiga,'pegawaiKeempat' => $pegawaiKeempat, 'pegawaiKelima' => $pegawaiKelima, 'pegawaiKeenam' => $pegawaiKeenam, 'pegawaiKetujuh' => $pegawaiKetujuh]);
    }

    public function belajareloquent(){
        $siswa = siswa::paginate(10);
        return view('Belajar20.belajareloquent', ['siswa' => $siswa]);
    }
}
