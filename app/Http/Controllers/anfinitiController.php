<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class anfinitiController extends Controller
{
    public function index(){
        return view("anfinitiView.index");
    }

    public function anfiniti(){
        return view("anfinitiView.anfiniti");
    }

    public function login(){
        return view("anfinitiView.login");
    }
    public function daftar(){
        return view("anfinitiView.daftar");
    }
}
