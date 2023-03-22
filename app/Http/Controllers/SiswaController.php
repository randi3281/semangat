<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function index(){
        $data = DB::table('daftarsiswa')->paginate(10);
        return view('mainsiswa', ['data' => $data]);
    }
}
