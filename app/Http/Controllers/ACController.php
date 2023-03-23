<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ACController extends Controller
{
    public function index(){
        $mode = 1;
        return view('anficititate.index', ['mode' => $mode]);
    }
}
