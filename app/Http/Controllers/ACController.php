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
        }else if($ucapan == "takada"){
            $pesan = "Maaf, Username tidak ditemukan";
        }else if($ucapan == "terancam"){
            $pesan = "Maaf, Akun Anda dalam bahaya, silahkan hubungi Administrator";
        }else if($ucapan == "takadapass"){
            $pesan = "Maaf, Kata sandi Anda salah";
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

    public function slc_repo(){
        session_start();
        $acdsession = DB::table('acsession')->get();
        $bisamasuk = 0;
        foreach($acdsession as $datasession){
            if($_SESSION['kode'] == $datasession->sessionlog1){
                $bisamasuk = 1;
            }
        }
        if($bisamasuk == 1){
            echo "hy";
        }else{
            return redirect('/anficititate');
        }
    }

    public function slc_repog(){
        $mode = 3;
        return view('anficititate.index', ['mode' => $mode]);
    }

    public function slc_repop(Request $request){
        session_start();

        $_SESSION['kode'] = "";
        // $acdcaptcha = DB::table('accaptcha')->get();
        $acd1login = DB::table('aclogin')->get();
        $acdlogin = DB::table('aclogin')->where('username', $request->username)->get();

        // Variabel
        $cekcaptcha = $_SESSION['Captcha'];
        $captcha = 0;
        $keslog = "";
        $username = "";
        $password = "";
        $adausername = 0;
        $adapassword = 0;
        // End Variabel

        // Captcha
        if($request->captcha !== $cekcaptcha){
            return redirect('/anficititate/ket/captcha');
        }
        // foreach($acdcaptcha as $datacaptcha){
        //     if($request->captcha == $datacaptcha->captcha){
        //         $captcha = 1;
        //         DB::table('accaptcha')->where('captcha', $request->captcha)->delete();
        //     }
        // }
        // End Captpcha

        // Keslog
        foreach($acd1login as $data1login){
            if($data1login->username == $request->username){
                $adausername = 1;
            }
            if($data1login->password == $request->password){
                $adapassword = 1;
            }
        }

        if($adausername == 1){
            if($adapassword == 1){
                $user = "";
                foreach($acdlogin as $datalogin){
                    if($datalogin->keslog == 0){
                        return redirect('/anficititate/ket/terancam');
                    }
                    $user = $datalogin->username;
                }

                $ceksesi = DB::table('acsession')->where('username', $user)->get();
                $bisasesi = 0;
                $jumlahsesi = 0;
                foreach($ceksesi as $checksesi){
                    $jumlahsesi += 1 ;
                }

                if($jumlahsesi > 2){
                    $sisi = DB::table('acsession')->where('username', $user)->get();
                    foreach($sisi as $checksisi){
                        DB::table('acsession')->where('urutansesi', 1)->delete();
                    }
                    foreach($sisi as $checksisi){
                        if($checksisi->urutansesi == 2){
                            DB::table('acsession')->where('urutansesi', 2)->update([
                                'urutansesi' => 1
                            ]);
                        }else if($checksisi->urutansesi == 3){
                            DB::table('acsession')->where('urutansesi', 3)->update([
                                'urutansesi' => 2
                            ]);
                        }
                    }
                    $bisasesi = 1;
                }else{
                    $bisasesi = 1;
                }

                if($bisasesi == 1){
                    $kode = 0;
                    for($i = 0; $i < 7; $i++){
                        $kode .= rand(0, 9);
                    }
                    $_SESSION['kode'] = $kode;
                    DB::table('acsession')->insert([
                        'sessionlog1' => $kode,
                        'sessionlog2' => 0,
                        'username' => $user,
                        'urutansesi' => 3
                    ]);
                    return redirect('/anficititate/slc_repo');
                }
                // return redirect('/anficititate/slc_repo');
            } else{
                return redirect('/anficititate/ket/takadapass');
            }
            // echo $request->username;
        }else{
            return redirect('/anficititate/ket/takada');
            // echo $request->username;
        }
        // End Keslog
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
