<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kota;

class kotaController extends Controller
{
    public function index(){
        $kota = kota::orderBy('jarak', 'ASC')->get();

        return view('kota', ['kota' => $kota]);
    }
}
