<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function daftar(){
        $mode = 2;

        return view("anfinitiView.start", ["mode" => $mode]);
    }
}
