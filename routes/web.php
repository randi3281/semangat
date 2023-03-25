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
// Belajar
Route::get('/', function () {
    return view('portofolio.portofolio');
});
Route::get('/semangat', 'SemangatController@index');
Route::get('/belajar4', 'SemangatController@belajar4');
Route::get('/belajar42', 'SemangatController@belajar42');
Route::get('/belajar5/{nama}', 'SemangatController@belajar5');
Route::get('/inputan', 'SemangatController@inputan');
Route::post('/inputan/hasil', 'SemangatController@hasil');
Route::get('/daftarpegawai', 'SemangatController@daftar');
// End Belajar

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Siswa
Route::get('siswa', 'SiswaController@index');
Route::get('siswa/hapus/{nim}', 'SiswaController@hapus');
Route::get('siswa/update/{nim}', 'SiswaController@update');
Route::post('siswa/input', 'SiswaController@input');
Route::post('siswa/update/updatingdata', 'SiswaController@updating');
// End Siswa

// Anficititate
Route::get('anficititate', 'ACController@index');
Route::get('anficititate/ket/{ucapan}', 'ACController@ucapan');
Route::get('anficititate/daftar', 'ACController@daftar');
Route::get('anficititate/login', 'ACController@login');
Route::post('anficititate/login', 'ACController@login');
Route::post('anficititate/daftarakun', 'ACController@daftarakun');
Route::get('anficititate/del_repo', 'ACController@del_repo');
Route::get('anficititate/upd_repo', 'ACController@upd_repo');
Route::get('anficititate/slc_repo', 'ACController@slc_repo');
Route::post('anficititate/slc_repo', 'ACController@slc_repo');
Route::post('anficititate/home', 'ACController@home');
// Route::get('anficititate/{jenis}/{penulis}', 'ACController@indexpenulis');
// Route::get('anficititate/hapus/{ft}', 'ACController@hapus');
// Route::get('anficititate/dapus/{jenis}/{penulis}', 'ACController@dapus');
// Route::get('anficititate/edit/{jenis}/{penulis}/{ft}', 'ACController@tampiledit');
// Route::post('anficititate/kelola', 'ACController@kelola');
// End Anficititate
