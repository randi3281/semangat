<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function index(){
        $data = DB::table('daftarsiswa')->paginate(10);
        return view('mainsiswa', ['data' => $data]);
    }

    public function input(Request $request){
        DB::table('daftarsiswa')->insert([
            "nama" => $request->nama,
            "nim" => $request->nim,
            "kelas" => $request->kelas,
        ]);

        return redirect('/siswa');
    }

    public function hapus($nim){
        DB::table('daftarsiswa')->where('nim', $nim)->delete();
        return redirect('/siswa');
    }
}
