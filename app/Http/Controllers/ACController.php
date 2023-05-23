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
        // $_SESSION['kode'] = 0;
        if(isset($_SESSION['kode'])){
            foreach($acdsession as $datasession){
                if($_SESSION['kode'] == $datasession->sessionlog1){
                    $bisamasuk = 1;
                }
            }
            if($bisamasuk == 1){
                return redirect('/anficititate/slc_repo');
            }
        }
        $mode = 1;
        return view('anficititate.index', ['mode' => $mode]);
    }
    public function back(){
        session_start();
        $_SESSION['kode'] = "";
        $_SESSION['jenisTabel'] = "footnote";
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
        $acdkampus =  DB::table('ackampus')->get();
        $mode = 2;
        return view('anficititate.index', ['mode' => $mode, 'kampus' =>$acdkampus]);
    }

    public function login(){
        if(!isset($_SESSION['kode'])){
            return redirect('/anficititate');
        }
        return redirect('anficititate');
    }

    public function daftarakun(Request $request){
        $acdlogin =  DB::table('aclogin')->where('username', $request->username)->get();
        $bisa = 1;
        $ceknama = strtolower($request->username);

        foreach($acdlogin as $datalogin){
            $ceknamadata = strtolower($datalogin->username);
            if($ceknamadata == $ceknama){
                $bisa=0;
            }
        }
        if($bisa == 1){
            DB::table('aclogin')->insert([
                'username' => $request->username,
                'password' => $request->password,
                'pin' => $request->pin,
                'keslog' => 3,
                'kampus' => $request->kampus
            ]);
            return redirect('anficititate/ket/selamat');
        }else{
            $mode = 2;
            $pesan = "Maaf, Username sudah ada";
            return view('anficititate.index', ['pesan' => $pesan, 'mode' => $mode]);
        }

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
            return redirect('https://wa.me/6287856531788?text=Halo,%20mau%20minta%20kode%20konfirmasi%20lupa%20kata%20sandi%20kak,%20ini%20username%20saya:%20....%20(isi%20username%20kamu%20disini)');
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
    public function lupa_pin(){
        $mode = 8;

        return view('anficititate.index', ['mode' => $mode]);
    }

    public function lupa_pin_error($error){
        $mode = 8;
        $pesan = "";
        if($error == "kodeerror"){
            $pesan = "Maaf, kode konfirmasi Kamu salah";
        } elseif ($error == "usernamesalah"){
            $pesan = "Maaf, username Kamu tidak ditemukan";
        } elseif ($error == "tidaksama"){
            $pesan = "Maaf, Konfirmasi pin baru Kamu tidak sama";
        } elseif ($error == "selamat"){
            $pesan = "Selamat, PIN Kamu berhasil diubah!";
        } else{
            return redirect('/anficititate');
        }
        return view('anficititate.index', ['mode' => $mode, 'pesan' => $pesan]);
    }

    public function lupa_pin_nya(Request $request){
        if(isset($request->minkode)){
            return redirect('https://wa.me/6287856531788?text=Halo,%20mau%20minta%20kode%20konfirmasi%20lupa%20pin%20kak,%20ini%20username%20saya:%20....%20(isi%20username%20kamu%20disini)');
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
                return redirect('anficititate/lupa_pin/usernamesalah');
            }else{

            }
            $datauser = DB::table('aclogin')->where('username', $request->username)->get();
            foreach($datauser as $data){
                if($data->minkode == $request->kodekonfir){
                    if($request->new_pin == $request->confirm_new_pin){
                        DB::table('aclogin')->where('username', $request->username)->update([
                            'pin' => $request->new_pin,
                            'minkode' => null
                        ]);
                    } else{
                        return redirect('anficititate/lupa_pin/tidaksama');
                    }
                }else{
                    return redirect('anficititate/lupa_pin/kodeerror');
                }
            }
            return redirect("anficititate/lupa_pin/selamat");
        }
    }
    // public function cek(Request $request){
    //     $mode = 3;
    //     if(!isset($_SESSION['kode'])){
    //         return redirect('/anficititate');
    //     }
    //     return view('anficititate.index', ['mode' => $mode]);
    // }

    // public function slc_repog(){
    //     $mode = 3;
    //     if(!isset($_SESSION['kode'])){
    //         return redirect('/anficititate');
    //     }
    //     return view('anficititate.index', ['mode' => $mode]);
    // }


    public function slc_repop(Request $request){
        session_start();
        $acd1login = DB::table('aclogin')->get();
        $acdlogin = DB::table('aclogin')->where('username', $request->username)->get();

        // Variabel
        $_SESSION['kode'] = "";
        $_SESSION['username'] = "";
        $cekcaptcha = $_SESSION['Captcha'];
        $adausername = 0;
        $adapassword = 0;
        // End Variabel

        // Captcha
        if($request->captcha !== $cekcaptcha){
            return redirect('/anficititate/ket/captcha');
        }
        // End Captcha

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
                    if($datalogin->keslog < 1){
                        return redirect('/anficititate/ket/terancam');
                    }
                    $user = $datalogin->username;
                    $_SESSION['keslog'] = $datalogin->keslog;
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
                    $_SESSION['username'] = $request->username;
                    $kode = 0;
                    for($i = 0; $i < 9; $i++){
                        $kode .= rand(1, 9);
                    }
                    // cek Kode
                    $kodecek = DB::table('acsession')->where('username', $_SESSION['username'])->get();
                    foreach($kodecek as $cekkode){
                        if($cekkode->sessionlog1 == $kode){
                            $kode = 0;
                            for($i = 0; $i < 9; $i++){
                                $kode .= rand(1, 9);
                            }
                        }
                    }
                    // End Cek Kode

                    $_SESSION['kode'] = $kode;

                    DB::table('acsession')->insert([
                        'sessionlog1' => $kode,
                        'sessionlog2' => 0,
                        'username' => $user,
                        'urutansesi' => 3
                    ]);
                    return redirect('/anficititate/slc_repo');
                }
            } else{
                return redirect('/anficititate/ket/takadapass');
            }
        }else{
            return redirect('/anficititate/ket/takada');
        }
    }

    public function slc_repo(){
        session_start();
        $acdsession = DB::table('acsession')->get();


        $bisamasuk = 0;

        if(!isset($_SESSION['kode'])){
            return redirect('/anficititate');
        }
        $acdrepo = DB::table('acrepo')->where('username', $_SESSION['username'])->get();
        foreach($acdsession as $datasession){
            if($_SESSION['kode'] == $datasession->sessionlog1){
                $bisamasuk = 1;
            }
        }

        if($bisamasuk == 1){
            $acdkampus =  DB::table('ackampus')->get();
            $acdkampuslogin =  DB::table('aclogin')->where('username', $_SESSION['username'])->get();
            $kampusnya = "";
            foreach($acdkampuslogin as $cekkampus){
                $kampusnya = $cekkampus->kampus;
            }
            $mode = 3;
            return view('anficititate.index', ['mode' => $mode, 'datarepo' =>  $acdrepo, 'kampus' => $acdkampus, 'kampusnya' => $kampusnya]);
        }else{
            return redirect('/anficititate');
        }

    }

    public function slc_repo_error($error){
        session_start();
        $acdsession = DB::table('acsession')->get();


        $bisamasuk = 0;

        if(!isset($_SESSION['kode'])){
            return redirect('/anficititate');
        }
        $acdrepo = DB::table('acrepo')->where('username', $_SESSION['username'])->get();
        foreach($acdsession as $datasession){
            if($_SESSION['kode'] == $datasession->sessionlog1){
                $bisamasuk = 1;
            }
        }

        if($bisamasuk == 1){
            $mode = 3;
            $pesan = "";
            if($error == "pinerror"){
                $pesan = "Maaf, PIN Kamu salah";
            }

            return view('anficititate.index', ['mode' => $mode, 'datarepo' =>  $acdrepo, 'pesan' => $pesan]);
        }else{
            return redirect('/anficititate');
        }

    }

    public function del_repo(){
        session_start();

        $acdsession = DB::table('acsession')->get();
        $acc = 1;


        if(!isset($_SESSION['kode'])){
            return redirect('/anficititate');
        } else {
            foreach($acdsession as $acsession){
                if($_SESSION['kode'] == $acsession->sessionlog1){
                    $acc = 0;
                }
            }

            if($acc == 1){
                return redirect('/anficititate');
            }
        }

        $acdrepo = DB::table('acrepo')->where('username', $_SESSION['username'])->get();
        $mode = 4;

        return view('anficititate.index', ['mode' => $mode, 'datarepo' =>  $acdrepo]);
    }


    public function upd_repo(){
        session_start();

        $acdsession = DB::table('acsession')->get();
        $acc = 1;


        if(!isset($_SESSION['kode'])){
            return redirect('/anficititate');
        } else {
            foreach($acdsession as $acsession){
                if($_SESSION['kode'] == $acsession->sessionlog1){
                    $acc = 0;
                }
            }

            if($acc == 1){
                return redirect('/anficititate');
            }
        }

        $acdrepo = DB::table('acrepo')->where('username', $_SESSION['username'])->get();
        $mode = 5;

        return view('anficititate.index', ['mode' => $mode, 'datarepo' =>  $acdrepo]);
    }

    public function new_repo_home(){
        session_start();

        $acdsession = DB::table('acsession')->get();
        $acc = 1;


        if(!isset($_SESSION['kode'])){
            return redirect('/anficititate');
        } else {
            foreach($acdsession as $acsession){
                if($_SESSION['kode'] == $acsession->sessionlog1){
                    $acc = 0;
                }
            }

            if($acc == 1){
                return redirect('/anficititate');
            }
        }

        $mode = 6;
        return view('anficititate.index', ['mode' => $mode]);
    }

    public function new_repo_home_ket($ket){
        session_start();

        $acdsession = DB::table('acsession')->get();
        $acc = 1;


        if(!isset($_SESSION['kode'])){
            return redirect('/anficititate');
        } else {
            foreach($acdsession as $acsession){
                if($_SESSION['kode'] == $acsession->sessionlog1){
                    $acc = 0;
                }
            }

            if($acc == 1){
                return redirect('/anficititate');
            }
        }

        $mode = 6;
        $pesan = "";

        if($ket == "repoada"){
            $pesan = "Maaf, nama repositori itu sudah ada";
        }elseif($ket == "berhasil"){
            $pesan = "Selamat, repositori Kamu berhasil dibuat!";
        }elseif($ket == "pinsalah"){
            $pesan = "Pin Kamu salah, ayo ulangi lagi!";
        }else{
            return redirect('/anficititate');
        }

        return view('anficititate.index', ['mode' => $mode, 'pesan' =>$pesan]);
    }

    public function new_repo(Request $request){
        session_start();

        if(isset($request->new)){
            $repodata = DB::table('acrepo')->where('username', $_SESSION['username'])->get();
            $logindata = DB::table('aclogin')->where('username', $_SESSION['username'])->get();

            $pinbenar = 0;
            $bisamasuk = 1;

            foreach($logindata as $datalogin){
                if($datalogin->pin == $request->pin){
                    $pinbenar = 1;
                }
            }

            if($pinbenar == 1){
                foreach($repodata as $datarepo){
                    if($request->nama_repo == $datarepo->repositori){
                        $bisamasuk = 0;
                    }
                }

                if($bisamasuk == 0){
                    return redirect('/anficititate/new_repo_home/repoada');
                }

                DB::table('acrepo')->insert([
                    'repositori' => $request->nama_repo,
                    'username' => $_SESSION['username']
                ]);
                return redirect('/anficititate/new_repo_home/berhasil');
            }

            return redirect('/anficititate/new_repo_home/pinsalah');
        }

        if(isset($request->enter)){
            return redirect("/anficititate/slc_repo");
        }

    }

    public function delete_repo(Request $request){
        session_start();

        if(isset($request->delete)){
            $logindata = DB::table('aclogin')->where('username', $_SESSION['username'])->get();

            $pinbenar = 0;

            foreach($logindata as $datalogin){
                if($datalogin->pin == $request->pin){
                    $pinbenar = 1;
                }
            }

            if($pinbenar == 1){
                DB::table('acrepo')->where('repositori', $request->repository)->delete();
                return redirect('/anficititate/del_repo/berhasil');
            }

            return redirect('/anficititate/del_repo/pinsalah');
        }

    }

    public function del_repo_ket($ket){
        session_start();

        $acdsession = DB::table('acsession')->get();
        $acdrepo = DB::table('acrepo')->where('username', $_SESSION['username'])->get();
        $acc = 1;


        if(!isset($_SESSION['kode'])){
            return redirect('/anficititate');
        } else {
            foreach($acdsession as $acsession){
                if($_SESSION['kode'] == $acsession->sessionlog1){
                    $acc = 0;
                }
            }

            if($acc == 1){
                return redirect('/anficititate');
            }
        }

        $mode = 4;
        $pesan = "";

        if($ket == "berhasil"){
            $pesan = "Selamat, repositori Kamu berhasil dihapus!";
        }elseif($ket == "pinsalah"){
            $pesan = "Pin Kamu salah, ayo ulangi lagi!";
        }

        return view('anficititate.index', ['mode' => $mode, 'pesan' =>$pesan, 'datarepo' =>  $acdrepo]);
    }
    public function update_repo(Request $request){
        session_start();

        if(isset($request->enter)){
            $logindata = DB::table('aclogin')->where('username', $_SESSION['username'])->get();

            $pinbenar = 0;

            foreach($logindata as $datalogin){
                if($datalogin->pin == $request->pin){
                    $pinbenar = 1;
                }
            }

            if($pinbenar == 1){
                DB::table('acrepo')->where('repositori', $request->repository)->update([
                    'repositori' => $request->namabaru
                ]);
                return redirect('/anficititate/upd_repo/berhasil');
            }

            return redirect('/anficititate/upd_repo/pinsalah');
        }

    }

    public function upd_repo_ket($ket){
        session_start();

        $acdsession = DB::table('acsession')->get();
        $acdrepo = DB::table('acrepo')->where('username', $_SESSION['username'])->get();
        $acc = 1;


        if(!isset($_SESSION['kode'])){
            return redirect('/anficititate');
        } else {
            foreach($acdsession as $acsession){
                if($_SESSION['kode'] == $acsession->sessionlog1){
                    $acc = 0;
                }
            }

            if($acc == 1){
                return redirect('/anficititate');
            }
        }

        $mode = 5;
        $pesan = "";

        if($ket == "berhasil"){
            $pesan = "Selamat, repositori Kamu berhasil diubah!";
        }elseif($ket == "pinsalah"){
            $pesan = "Pin Kamu salah, ayo ulangi lagi!";
        }else{
            return redirect('/anficititate');
        }

        return view('anficititate.index', ['mode' => $mode, 'pesan' =>$pesan, 'datarepo' =>  $acdrepo]);
    }
    // End Footnote

    public function home(Request $request){
        session_start();

        if(isset($request->enter)){
            $datapin = DB::table('aclogin')->where('username', $_SESSION['username'])->get();

            $cekpin = 0;

            foreach($datapin as $pindata){
                if($request->pin == $pindata->pin){
                    $cekpin = 1;
                }else{
                    $_SESSION['keslog'] -= 1;
                    DB::table('aclogin')->where('username', $_SESSION['username'])->update([
                        'keslog' => $_SESSION['keslog']
                    ]);
                    return redirect('/anficititate/slc_repo_err/pinerror');
                }
            }

            if($cekpin == 1){
                $_SESSION['repo'] = $request->repository;
                $kode = 0;
                    for($i = 0; $i < 9; $i++){
                        $kode .= rand(1, 9);
                    }
                    // cek Kode
                    $kodecek = DB::table('acsession')->where('username', $_SESSION['username'])->get();
                    foreach($kodecek as $cekkode){
                        if($cekkode->sessionlog1 == $kode){
                            $kode = 0;
                            for($i = 0; $i < 9; $i++){
                                $kode .= rand(1, 9);
                            }
                        }
                    }
                    // End Cek Kode

                    $_SESSION['kode2'] = $kode;
                    DB::table('acsession')->where('username', $_SESSION['username'])->where('sessionlog1', $_SESSION['kode'])->update([
                        'sessionlog2' => $kode,
                        'repo' => $_SESSION['repo']
                    ]);
                    DB::table('aclogin')->where('username', $_SESSION['username'])->update([
                        'keslog' => 3
                    ]);
                    $_SESSION['jenis'] = 1;
                    $_SESSION['jumlahpenulis'] = 1;
                    $_SESSION['apakahedit'] = 0;
                    $_SESSION['jenistabel'] = 0;
                    $_SESSION['editan'] = 1;
                    $_SESSION['kampus'] = $request->kampus;

            }

            return redirect('/anficititate/repo_core');
        }

        if(isset($request->new)){
            return redirect('/anficititate/new_repo_home');
        }
    }
}
