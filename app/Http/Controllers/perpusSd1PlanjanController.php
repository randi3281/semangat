<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class perpusSd1PlanjanController extends Controller
{
    public function index(){
        session_start();
        return view('pssp.index');
    }
}
