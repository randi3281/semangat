<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ACController extends Controller
{
    // Start Login
    public function index(){
        $mode = 1;
        return view('anficititate.index', ['mode' => $mode]);
    }
    // Start Login
    public function ucapan($ucapan){
        $mode = 1;
        $pesan = "";
        if($ucapan == "selamat"){
            $pesan = "Selamat, akun Anda berhasil dibuat";
        }else if($ucapan == "captcha"){
            $pesan = "Maaf, Captcha salah";
        }
        return view('anficititate.index', ['mode' => $mode, 'pesan' => $pesan]);
    }

    public function daftar(){
        $mode = 2;
        return view('anficititate.index', ['mode' => $mode]);
    }

    public function login(){
        return redirect('anficititate');
    }

    public function daftarakun(Request $request){
        $acdlogin =  DB::table('aclogin')->get();
        $bisa = 1;
        $pesan = "";
        foreach($acdlogin as $datalogin){
            if($request->username == $datalogin->username){
                $bisa=0;
            }
        }
        if($bisa == 1){
            DB::table('aclogin')->insert([
                'username' => $request->username,
                'password' => $request->password,
                'pin' => $request->pin,
                'keslog' => 3
            ]);
            return redirect('anficititate/ket/selamat');
        }else{
            $mode = 2;
            $pesan = "Maaf, Username sudah ada";
            return view('anficititate.index', ['pesan' => $pesan, 'mode' => $mode]);
        }

    }

    public function cek(Request $request){
        $mode = 3;
        return view('anficititate.index', ['mode' => $mode]);
    }

    public function slc_repoe(){
        return redirect('/anficititate');
    }

    public function slc_repog(){
        $mode = 3;
        return view('anficititate.index', ['mode' => $mode]);
    }

    public function slc_repop(Request $request){
        session_start();
        $acdcaptcha = DB::table('accaptcha')->get();
        $acdlogin = DB::table('aclogin')->where('username', $request->username)->get();

        // Variabel
        $cekcaptcha = $_SESSION['Captcha'];
        $captcha = 0;
        $keslog = "";
        $username = "";
        $password = "";
        // End Variabel

        // Captcha
        if($request->captcha == $cekcaptcha){
            $captcha = 1;
        }

        // foreach($acdcaptcha as $datacaptcha){
        //     if($request->captcha == $datacaptcha->captcha){
        //         $captcha = 1;
        //         DB::table('accaptcha')->where('captcha', $request->captcha)->delete();
        //     }
        // }

        if($captcha == 0){
            return redirect('/anficititate/ket/captcha');
        }
        // End Captpcha

    }

    public function del_repo(){
        $mode = 4;
        return view('anficititate.index', ['mode' => $mode]);
    }

    public function upd_repo(){
        $mode = 5;
        return view('anficititate.index', ['mode' => $mode]);
    }
    // End Login

    // Start Footnote
    public function home(Request $request){
        return view('anficititate.home');
    }
    // End Footnote
}
