<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\anfiniti_login;
class anfinitiController extends Controller
{
    public function index(){
        $mode = 1;

        return view("anfinitiView.index");
    }

    public function anfiniti(){
        return view("anfinitiView.anfiniti");
    }

    public function login(){
        $mode = 1;

        return view("anfinitiView.start", ["mode" => $mode]);
    }

    public function loginproses(Request $request){
        $mode = 1;
        if(isset($request->tombolMasuk)){
            $validatedData = $request->validate([
                'username' => 'required|string|max:255',
                'password' => 'required|string',
            ]);

            $anfinitiLogin = anfiniti_login::where("username", $validatedData['username'])->first();
            if($anfinitiLogin){
                if($anfinitiLogin->password == $validatedData['password']){
                    return redirect("/anfiniti/input");
                }else{
                    return redirect("/anfiniti/login/gagal/1");
                }
            }else{
                return redirect("/anfiniti/login/gagal/1");
            }
        };

        if(isset($request->tombolDaftar)){
            return redirect("/anfiniti/daftar");
        }
    }

    public function daftar(){
        $mode = 2;

        return view("anfinitiView.start", ["mode" => $mode]);
    }

    public function daftarproses(Request $request){
        // buatlah agar daftarprosess menginput ke database anfiniti_login dengan syarat captcha benar dan password yang kedua terkonfirmasi benar
        $mode = 2;
        if(isset($request->tombolDaftar)){
            $validatedData = $request->validate([
                'username' => 'required|string|max:255',
                'password' => 'required|string',
                'password2' => 'required|string',
                'captcha' => 'required|string',
            ]);

            if($validatedData['password'] == $validatedData['password2']){
                if($validatedData['captcha'] == session('captcha')){
                    $anfinitiLogin = new anfiniti_login;
                    $anfinitiLogin->username = $validatedData['username'];
                    $anfinitiLogin->password = $validatedData['password'];
                    $anfinitiLogin->save();
                    return redirect("/anfiniti/login");
                }else{
                    return redirect("/anfiniti/daftar/gagal/2");
                }
            }else{
                return redirect("/anfiniti/daftar/gagal/1");
            }
        }
    }

    public function daftarprosesgagal($ket){
        $mode = 2;
        $errornya = "";
        switch ($ket) {
            case 1:
                $errornya = "Maaf, Password Anda salah";
                break;
            case 2:
                $errornya = "Maaf, Captcha Anda salah";
                break;
            
        }

        return view("anfinitiView.start", ["mode" => $mode, "errornya" => $errornya]);
    }

    public function loginProsesGagal($ket){
        $mode = 1;
        $errornya = "";
        switch ($ket) {
            case 1:
                $errornya = "Maaf, Password Anda salah";
                break;
            case 2:
                $errornya = "Maaf, Captcha Anda salah";
                break;
            
        }

        return view("anfinitiView.start", ["mode" => $mode, "errornya" => $errornya]);
    }
    

    public function input(){
        $mode = 1;

        return view("anfinitiView.menu", ["mode" => $mode]);
    }

    public function edit(){
        $mode = 2;

        return view("anfinitiView.menu", ["mode" => $mode]);
    }

    public function trash(){
        $mode = 3;

        return view("anfinitiView.menu", ["mode" => $mode]);
    }
}
