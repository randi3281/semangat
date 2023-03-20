<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SemangatController extends Controller
{
    public function index(){
        return view('semangat');
    }

    public function belajar4(){
        return view('belajar4');
    }

    public function belajar42(){
        return view('belajar42');
    }
}
