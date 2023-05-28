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
Route::get('anficititate/back', 'ACController@back');
Route::get('anficititate/ket/{ucapan}', 'ACController@ucapan');
Route::get('anficititate/daftar', 'ACController@daftar');
Route::get('anficititate/login', 'ACController@login');
Route::post('anficititate/login', 'ACController@login');
Route::post('anficititate/daftarakun', 'ACController@daftarakun');
Route::get('anficititate/lupa_sandi', 'ACController@lupa_sandi');
Route::get('anficititate/lupa_sandi/{error}', 'ACController@lupa_sandi_error');
Route::post('anficititate/lupa_kata_sandi', 'ACController@lupa_kata_sandi');
Route::get('anficititate/lupa_pin', 'ACController@lupa_pin');
Route::get('anficititate/lupa_pin/{error}', 'ACController@lupa_pin_error');
Route::post('anficititate/lupa_pin_nya', 'ACController@lupa_pin_nya');
Route::post('anficititate/slc_repo', 'ACController@slc_repop');
Route::get('anficititate/slc_repo', 'ACController@slc_repo');
Route::get('anficititate/slc_repo_err/{error}', 'ACController@slc_repo_error');
Route::get('anficititate/del_repo', 'ACController@del_repo');
Route::get('anficititate/upd_repo', 'ACController@upd_repo');
Route::get('anficititate/new_repo_home', 'ACController@new_repo_home');
Route::get('anficititate/new_repo_home/{ket}', 'ACController@new_repo_home_ket');
Route::post('anficititate/new_repo', 'ACController@new_repo');
Route::post('anficititate/delete_repo', 'ACController@delete_repo');
Route::get('anficititate/del_repo/{ket}', 'ACController@del_repo_ket');
Route::post('anficititate/upd_repo', 'ACController@update_repo');
Route::get('anficititate/upd_repo/{ket}', 'ACController@upd_repo_ket');
Route::post('anficititate/home', 'ACController@home');
Route::get('anficititate/repo_core', 'FootnoteController@index');
Route::get('anficititate/repo_core/{jumlahpenulis}', 'FootnoteController@indexpenulis');
Route::get('anficititate/core_repo_edit/{ft}', 'FootnoteController@core_repo_edit');
Route::get('anficititate/core_repo_hapus/{ft}', 'FootnoteController@core_repo_hapus');
Route::post('anficititate/kelola', 'FootnoteController@kelola');
// End Anficititate

// Belajar Mulai dari eps 20 malasngoding.com
Route::get('eloquent', 'Belajar20Controller@eloquent');
// End Belajar Mulai dari eps 20 malasngoding.com
