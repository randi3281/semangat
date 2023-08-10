<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class perpusSd1PlanjanController extends Controller
{
    public function index(){
        session_start();
        $mode = 1;
        return view('pssp.index', ['mode' => $mode]);
    }
}
