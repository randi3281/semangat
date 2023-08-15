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
        $login = anfiniti_login::all();

        return view("anfinitiView.start");
    }

    public function daftar(){
        $mode = 2;

        return view("anfinitiView.start", ["mode" => $mode]);
    }

    public function daftarproses(Request $request){
        $mode = 2;
        if(isset($request->tombolDaftar)){
            $validatedData = $request->validate([
                'username' => 'required|string|max:255',
                'password' => 'required|string',
            ]);

            $anfinitiLogin = new anfiniti_login();
            $anfinitiLogin->username = $validatedData['username'];
            $anfinitiLogin->password = $validatedData['password'];
            $anfinitiLogin->save();

            
            return redirect()->back()->with('success', 'Anfiniti login created successfully');
        };
        
        if(isset($request->tombolMasuk)){
            return redirect("/anfiniti/login");
        }
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
