<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/semangat', 'SemangatController@index');
Route::get('/belajar4', 'SemangatController@belajar4');
Route::get('/belajar42', 'SemangatController@belajar42');
Route::get('/belajar5/{nama}', 'SemangatController@belajar5');
Route::get('/inputan', 'SemangatController@inputan');
Route::post('/inputan/hasil', 'SemangatController@hasil');
Route::get('/daftarpegawai', 'SemangatController@daftar');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/siswa', 'SiswaController@index');
Route::get('/siswa/hapus/{nim}', 'SiswaController@hapus');
Route::post('/siswa/input', 'SiswaController@input');
