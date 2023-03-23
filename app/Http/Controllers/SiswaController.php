<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function index(){
        $data = DB::table('daftarsiswa')->paginate(10);
        $kelola = 1;
        return view('siswa.mainsiswa', ['data' => $data, 'kelola' => $kelola]);
    }

    public function input(Request $request){
        DB::table('daftarsiswa')->insert([
            "nama" => $request->nama,
            "nim" => $request->nim,
            "kelas" => $request->kelas,
        ]);

        return redirect('siswa');
    }

    public function hapus($nim){
        DB::table('daftarsiswa')->where('nim', $nim)->delete();
        return redirect('siswa');
    }

    public function update($nim){
        $dataupdate = DB::table('daftarsiswa')->where('nim', $nim)->get();
        $data = DB::table('daftarsiswa')->paginate(10);
        $kelola = 2;
        return view('siswa.mainsiswa', ['data' => $data, 'kelola' => $kelola, 'dataupdate' => $dataupdate]);
    }

    public function updating(Request $request){
        if(isset($request->batal)){
            return redirect('siswa');
        } elseif(isset($request->update)){
            DB::table('daftarsiswa')->where('nim', $request->hiddennim)->update([
                'nama' => $request->nama,
                'nim' => $request->nim,
                'kelas' => $request->kelas,
            ]);
            return redirect('siswa');
        }
    }
}
