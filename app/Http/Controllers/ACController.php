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

    public function register(){
        $mode = 2;
        return view('anficititate.index', ['mode' => $mode]);
    }

    public function login(){
        return redirect('anficititate');
    }

    public function cek(Request $request){
        $mode = 3;
        return view('anficititate.index', ['mode' => $mode]);
    }

    public function slc_repo(){
        $mode = 3;
        return view('anficititate.index', ['mode' => $mode]);
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
    public function footnote(Request $request){
        return view('anficititate.footnote');
    }
    // End Footnote
}
