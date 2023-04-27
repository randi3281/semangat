<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ACController extends Controller
{
    // Start Login
    public function index(){
        session_start();
        $acdsession = DB::table('acsession')->get();
        $bisamasuk = 0;
        $_SESSION['kode'] = 0;
        foreach($acdsession as $datasession){
            if($_SESSION['kode'] == $datasession->sessionlog1){
                $bisamasuk = 1;
            }
        }
        if($bisamasuk == 1){
            return redirect('/anficititate/slc_repo');
        }
        $mode = 1;
        return view('anficititate.index', ['mode' => $mode]);
    }
    public function back(){
        session_start();
        $_SESSION['kode'] = "";
        return redirect('/anficititate');
    }
    // Start Login
    public function ucapan($ucapan){
        $mode = 1;
        $pesan = "";
        if($ucapan == "selamat"){
            $pesan = "Selamat, akun Kamu berhasil dibuat";
        }else if($ucapan == "captcha"){
            $pesan = "Maaf, Captcha salah";
        }else if($ucapan == "takada"){
            $pesan = "Maaf, Username tidak ditemukan";
        }else if($ucapan == "terancam"){
            $pesan = "Maaf, Akun Kamu dalam bahaya, silahkan hubungi Administrator, WA saja : 085314410358";
        }else if($ucapan == "takadapass"){
            $pesan = "Maaf, Kata sandi Kamu salah";
        }else if($ucapan == "sandidiubah"){
            $pesan = "Selamat, Kata Sandi Kamu berhasil diubah!";
        }
        return view('anficititate.index', ['mode' => $mode, 'pesan' => $pesan]);
    }

    public function daftar(){
        $mode = 2;
        return view('anficititate.index', ['mode' => $mode]);
    }

    public function login(){
        if(!isset($_SESSION['kode'])){
            return redirect('/anficititate');
        }
        return redirect('anficititate');
    }

    public function daftarakun(Request $request){
        $acdlogin =  DB::table('aclogin')->get();
        $bisa = 1;
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
        if(!isset($_SESSION['kode'])){
            return redirect('/anficititate');
        }
        return view('anficititate.index', ['mode' => $mode]);
    }

    public function slc_repo(){
        session_start();
        $acdsession = DB::table('acsession')->get();
        $bisamasuk = 0;
        if(!isset($_SESSION['kode'])){
            return redirect('/anficititate');
        }
        foreach($acdsession as $datasession){
            if($_SESSION['kode'] == $datasession->sessionlog1){
                $bisamasuk = 1;
            }
        }
        if($bisamasuk == 1){
            $mode = 3;
            return view('anficititate.index', ['mode' => $mode]);
        }else{
            return redirect('/anficititate');
        }
    }

    public function slc_repog(){
        $mode = 3;
        if(!isset($_SESSION['kode'])){
            return redirect('/anficititate');
        }
        return view('anficititate.index', ['mode' => $mode]);
    }

    public function slc_repop(Request $request){
        session_start();
        if(!isset($_SESSION['kode'])){
            return redirect('/anficititate');
        }
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

                $ceksesi = DB::table('acsession')->where('username', $request->username)->get();
                $bisasesi = 0;
                $jumlahsesi = 0;
                foreach($ceksesi as $checksesi){
                    $jumlahsesi += 1 ;
                }

                if($jumlahsesi > 2){
                    $sisi = DB::table('acsession')->where('username', $user)->get();
                    foreach($sisi as $checksisi){
                        if($checksisi->urutansesi == 1){
                            DB::table('acsession')->where('urutansesi', 1)->where('username', $user)->delete();
                        }else if($checksisi->urutansesi == 2){
                            DB::table('acsession')->where('urutansesi', 2)->where('username', $user)->update([
                                'urutansesi' => 1
                            ]);
                        }else if($checksisi->urutansesi == 3){
                            DB::table('acsession')->where('urutansesi', 3)->where('username', $user)->update([
                                'urutansesi' => 2
                            ]);
                        }
                    }
                    $bisasesi = 1;
                }else{
                    $sisi = DB::table('acsession')->where('username', $user)->get();
                    foreach($sisi as $checksisi){
                        if($checksisi->urutansesi == 1){
                            DB::table('acsession')->where('urutansesi', 1)->where('username', $user)->delete();
                        } else if($checksisi->urutansesi == 2){
                            DB::table('acsession')->where('urutansesi', 2)->where('username', $user)->update([
                                'urutansesi' => 1
                            ]);
                        }else if($checksisi->urutansesi == 3){
                            DB::table('acsession')->where('urutansesi', 3)->where('username', $user)->update([
                                'urutansesi' => 2
                            ]);
                        }
                    }
                    $bisasesi = 1;
                }

                if($bisasesi == 1){
                    $kode = 0;
                    for($i = 0; $i < 7; $i++){
                        $kode .= rand(1, 9);
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
        session_start();
        $mode = 4;
        if(!isset($_SESSION['kode'])){
            return redirect('/anficititate');
        }
        return view('anficititate.index', ['mode' => $mode]);
    }

    public function lupa_sandi(){
        $mode = 7;
        return view('anficititate.index', ['mode' => $mode]);
    }

    public function lupa_sandi_error($error){
        $mode = 7;
        $pesan = "";
        if($error == "kodeerror"){
            $pesan = "Maaf, kode konfirmasi Kamu salah";
        } elseif ($error == "usernamesalah"){
            $pesan = "Maaf, username Kamu tidak ditemukan";
        } elseif ($error == "tidaksama"){
            $pesan = "Maaf, Konfirmasi kata sandi baru Kamu tidak sama";
        } elseif ($error == "selamat"){
            $pesan = "Selamat, Kata Sandi Kamu berhasil diubah!";
        }
        return view('anficititate.index', ['mode' => $mode, 'pesan' => $pesan]);
    }

    public function lupa_kata_sandi(Request $request){
        if(isset($request->minkode)){
            return redirect('https://wa.me/6285314410358?text=Halo,%20mau%20minta%20kode%20konfirmasi%20lupa%20kata%20sandi%20kak,%20ini%20username%20saya:%20....%20(isi%20username%20kamu%20disini)');
        }

        if(isset($request->enter)){
            $datausern = DB::table('aclogin')->get();
            $adausername = 0;
            foreach($datausern as $data){
                if($data->username == $request->username){
                    $adausername = 1;
                }
            }
            if($adausername == 0){
                return redirect('anficititate/lupa_sandi/usernamesalah');
            }else{

            }
            $datauser = DB::table('aclogin')->where('username', $request->username)->get();
            foreach($datauser as $data){
                if($data->minkode == $request->kodekonfir){
                    if($request->new_pass == $request->confirm_new_pass){
                        DB::table('aclogin')->where('username', $request->username)->update([
                            'password' => $request->new_pass,
                            'minkode' => null
                        ]);
                    } else{
                        return redirect('anficititate/lupa_sandi/tidaksama');
                    }
                }else{
                    return redirect('anficititate/lupa_sandi/kodeerror');
                }
            }
            return redirect("anficititate/ket/sandidiubah");
        }
    }

    public function upd_repo(){
        session_start();
        $mode = 5;
        if(!isset($_SESSION['kode'])){
            return redirect('/anficititate');
        }
        return view('anficititate.index', ['mode' => $mode]);
    }

    // End Login

    // Start Footnote
    public function home(Request $request){
        session_start();

        if(isset($request->enter)){
            if(!isset($_SESSION['kode'])){
                return redirect('/anficititate');
            }
            return redirect('/anficititate/homee');
        }

        if(isset($request->new)){
            $mode = 6;
            return view('anficititate.index', ['mode' => $mode]);
        }
    }

    public function new_repo(Request $request){
        session_start();

        if(isset($request->enter)){
            if(!isset($_SESSION['kode'])){
                return redirect('/anficititate/slc_repo');
            }
            return redirect('/anficititate/slc_repo');
        }

        if(isset($request->new)){
        }
    }
    // End Footnote
}
