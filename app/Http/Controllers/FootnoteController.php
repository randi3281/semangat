<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FootnoteController extends Controller
{
    public function index(){
        session_start();

        // Validasi
        if(isset($_SESSION['username'])){
                // Session
                    $datasession = DB::table('acsession')->where('username', $_SESSION['username'])->get();
                    $bisamasuk = 0;
                    $ceksesi1 = 0;
                    foreach($datasession as $sessiondata){
                        if($_SESSION['kode'] == $sessiondata->sessionlog1){
                            $ceksesi1 = 1;
                        }
                        if($ceksesi1 == 1){
                            if($_SESSION['kode2'] == $sessiondata->sessionlog2){
                                $bisamasuk = 1;
                            }
                        }
                    }
                    if($bisamasuk == 0){
                        return redirect('/anficititate');
                    }
                // End Sessiong



            $data = DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->orderBy('id', 'DESC')->paginate(10);
            $datapus = DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->get();
            $dataEdit = DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->get();
            $nom = DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->orderBy('id', 'DESC')->first();

            $nomo = 1;
            if(isset($nom)){
                foreach($nom as $mon){
                        $nomo = $nom->id + 1;
                }
            }


            return view('anficititate.footnote', ['jenis' => $_SESSION['jenis'], 'jumlahpenulis' => $_SESSION['jumlahpenulis'], 'data' => $data, 'nomor' => $nomo, 'apakahedit' => $_SESSION['apakahedit'], 'dapus' => $_SESSION['jenistabel'], 'editan' => $dataEdit, 'datapus' =>$datapus]);
        } else {
            return redirect('/anficititate');
        }
        // End Validasi
    }

    public function indexpenulis($jumlahpenulis){
        session_start();
        $_SESSION['jumlahpenulis'] = $jumlahpenulis;
        return redirect('/anficititate/repo_core');
    }

    public function core_repo_hapus($ft){
        DB::table('footnote')->where('id', $ft)->delete();
        $angka = 0;
        $nom = DB::table('footnote')->orderBy('id', 'DESC')->first();
        for($u = $ft; $u <= $nom->id; $u++){
            $datanya = DB::table('footnote')->where('id', $u)->first();
            if(!isset($datanya)){
                $angka = $angka + 1;
            }else{
                $kurang = $datanya->id - $angka;
                DB::table('footnote')->where('id', $u)->update([
                    'id' => $kurang
                ]);
            }
        }
        return redirect('anficititate/home');
    }

    public function core_repo_edit($ft){
        session_start();
        $dataEdit = DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->get();

        foreach($dataEdit as $editData){
            $_SESSION['jumlahpenulis'] = $editData->jumlah_penulis;
        }
        $_SESSION['edit_id'] = $ft;
        $_SESSION['apakahedit'] = 1;
        return redirect('/anficititate/repo_core');
        // $data = DB::table('footnote')->orderBy('id', 'DESC')->paginate(10);
        // $nom = DB::table('footnote')->orderBy('id', 'DESC')->first();
        // $editan = DB::table('footnote')->where('id', $ft)->get();
        // $nomo = 0;
        // $dapus = 0;
        // foreach($editan as $ediit){
        //     $nomo = $ediit->id;
        // }
        // $apakahedit = 1;
        // return view('anficititate.footnote', ['jenis' => $jenis, 'jumlahpenulis' => $jumlahpenulis, 'data' => $data, 'nomor' => $nomo, , 'apakahedit' => $apakahedit, 'dapus' => $dapus]);
    }
















    public function kelola(Request $request){
        session_start();
        if(isset($request->tomboljenis)){
            $_SESSION['jenis'] = $request->jenis_footnote;
            return redirect("/anficititate/repo_core");
        }

        if(isset($request->input)){
            if($_SESSION['jenis'] == 1){
                $urutan = $request->urut + 1;
                if($request->nourut !== $request->$urutan){
                    for($i = $request->urut; $i >= $request->nourut; $i--){
                        $x = $i + 1;
                        DB::table('footnote')->where('id', $i)->update([
                            'id' => $x
                        ]);
                    }
                }
                if($_SESSION['jumlahpenulis'] == 3){
                    DB::table('footnote')->insert([
                        'id' => $request->nourut,
                        'penulis_1' => $request->penulis_1,
                        'penulis_2' => $request->penulis_2,
                        'penulis_3' => $request->penulis_3,
                        'judul' => $request->judul,
                        'kota' => $request->kota,
                        'sumber' => $request->sumber,
                        'volume' => $request->volume,
                        'nomor' => $request->nomor,
                        'tahun' => $request->tahun,
                        'jenis' => $_SESSION['jenis'],
                        'halaman_awal' => $request->halaman_awal,
                        'halaman_akhir' => $request->halaman_akhir,
                        'jumlah_penulis' => $request->jumlah_penulis,
                        'repositori' => $_SESSION['repo'],
                        'username' => $_SESSION['username']
                    ]);
                } elseif ($_SESSION['jumlahpenulis'] == 2){
                    DB::table('footnote')->insert([
                        'id' => $request->nourut,
                        'penulis_1' => $request->penulis_1,
                        'penulis_2' => $request->penulis_2,
                        'judul' => $request->judul,
                        'kota' => $request->kota,
                        'sumber' => $request->sumber,
                        'volume' => $request->volume,
                        'nomor' => $request->nomor,
                        'tahun' => $request->tahun,
                        'jenis' => $_SESSION['jenis'],
                        'halaman_awal' => $request->halaman_awal,
                        'halaman_akhir' => $request->halaman_akhir,
                        'jumlah_penulis' => $request->jumlah_penulis,
                        'repositori' => $_SESSION['repo'],
                        'username' => $_SESSION['username']
                    ]);
                } elseif ($_SESSION['jumlahpenulis'] == 1 || $_SESSION['jumlahpenulis'] == 4){
                    DB::table('footnote')->insert([
                        'id' => $request->nourut,
                        'penulis_1' => $request->penulis_1,
                        'judul' => $request->judul,
                        'kota' => $request->kota,
                        'sumber' => $request->sumber,
                        'volume' => $request->volume,
                        'nomor' => $request->nomor,
                        'tahun' => $request->tahun,
                        'jenis' => $_SESSION['jenis'],
                        'halaman_awal' => $request->halaman_awal,
                        'halaman_akhir' => $request->halaman_akhir,
                        'jumlah_penulis' => $request->jumlah_penulis,
                        'repositori' => $_SESSION['repo'],
                        'username' => $_SESSION['username']
                    ]);
                }
                $_SESSION['apakahedit'] = 0;
                return redirect('/anficititate/repo_core');
            } elseif($_SESSION['jenis']== 2){
                $urutan = $request->urut + 1;
                if($request->nourut !== $request->$urutan){
                    for($i = $request->urut; $i >= $request->nourut; $i--){
                        $x = $i + 1;
                        DB::table('footnote')->where('id', $i)->update([
                            'id' => $x
                        ]);
                    }
                }
                DB::table('footnote')->insert([
                    'id' => $request->nourut,
                    'judul_web' => $request->judul_web,
                    'deskripsi_web' => $request->deskripsi_web,
                    'tahun_web' => $request->tahun_web,
                    'link_web' => $request->link_web,
                    'jenis' => $_SESSION['jenis'],
                    'jumlah_penulis' => 1,
                    'tanggal_diakses_web' => $request->tanggal_diakses_web,
                    'repositori' => $_SESSION['repo'],
                    'username' => $_SESSION['username']
                ]);
                $_SESSION['apakahedit'] = 0;
                return redirect('/anficititate/repo_core');
            }

        }

        if(isset($request->edit)){
            if($request->nourut > $request->idedita){
                $nom = DB::table('footnote')->orderBy('id', 'DESC')->first();
                $urutan = $request->urut + 1;
                if($request->nourut !== $request->$urutan){
                    for($i = $nom->id; $i > $request->nourut; $i--){
                        $x = $i + 1;
                        DB::table('footnote')->where('id', $i)->update([
                            'id' => $x
                        ]);
                    }
                }

                if($request->jenisf == 1){
                    if(isset($request->penulis_1)&&isset($request->penulis_2)&&isset($request->penulis_3)){
                        DB::table('footnote')->where('id', $request->idedita)->update([
                            'id' => $request->nourut+1,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penulis_3' => $request->penulis_3,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'jenis' => $request->jenisf,
                            'nomor' => $request->nomor,
                            'kota' => $request->kota,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis
                        ]);
                    } elseif (isset($request->penulis_1)&&isset($request->penulis_2)){
                        DB::table('footnote')->where('id', $request->idedita)->update([
                            'id' => $request->nourut+1,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'nomor' => $request->nomor,
                            'kota' => $request->kota,
                            'judul' => $request->judul,
                            'jenis' => $request->jenisf,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis
                        ]);
                    } elseif (isset($request->penulis_1)){
                        DB::table('footnote')->where('id', $request->idedita)->update([
                            'id' => $request->nourut+1,
                            'penulis_1' => $request->penulis_1,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'kota' => $request->kota,
                            'nomor' => $request->nomor,
                            'tahun' => $request->tahun,
                            'jenis' => $request->jenisf,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis
                        ]);
                    }$angka = 0;
                    $nom = DB::table('footnote')->orderBy('id', 'DESC')->first();
                    for($u = 1; $u <= $nom->id; $u++){
                        $datanya = DB::table('footnote')->where('id', $u)->first();
                        if(!isset($datanya)){
                            $angka = $angka + 1;
                        }else{
                            $kurang = $datanya->id - $angka;
                            DB::table('footnote')->where('id', $u)->update([
                                'id' => $kurang
                            ]);
                        }
                    }
                    return redirect('/');
                } elseif($request->jenisf == 2){
                    DB::table('footnote')->where('id', $request->idedita)->update([
                        'id' => $request->nourut+1,
                        'judul_web' => $request->judul_web,
                        'deskripsi_web' => $request->deskripsi_web,
                        'tahun_web' => $request->tahun_web,
                        'link_web' => $request->link_web,
                        'jenis' => $request->jenisf,
                        'jumlah_penulis' => 1,
                        'tanggal_diakses_web' => $request->tanggal_diakses_web
                    ]);
                    $angka = 0;
                    $nom = DB::table('footnote')->orderBy('id', 'DESC')->first();
                    for($u = 1; $u <= $nom->id; $u++){
                        $datanya = DB::table('footnote')->where('id', $u)->first();
                        if(!isset($datanya)){
                            $angka = $angka + 1;
                        }else{
                            $kurang = $datanya->id - $angka;
                            DB::table('footnote')->where('id', $u)->update([
                                'id' => $kurang
                            ]);
                        }
                    }
                    return redirect('/2/'.$request->jenisf);
                }
            } elseif($request->nourut < $request->idedita){
                $nom = DB::table('footnote')->orderBy('id', 'DESC')->first();
                $urutan = $request->urut + 1;
                if($request->nourut !== $request->$urutan){
                    for($i = $nom->id; $i >= $request->nourut; $i--){
                        $x = $i + 1;
                        DB::table('footnote')->where('id', $i)->update([
                            'id' => $x
                        ]);
                    }
                }
                if($request->jenisf == 1){
                    if(isset($request->penulis_1)&&isset($request->penulis_2)&&isset($request->penulis_3)){
                        DB::table('footnote')->where('id', $request->idedita+1)->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penulis_3' => $request->penulis_3,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'jenis' => $request->jenisf,
                            'nomor' => $request->nomor,
                            'tahun' => $request->tahun,
                            'kota' => $request->kota,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis
                        ]);
                    } elseif (isset($request->penulis_1)&&isset($request->penulis_2)){
                        DB::table('footnote')->where('id', $request->idedita+1)->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'nomor' => $request->nomor,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'jenis' => $request->jenisf,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis
                        ]);
                    } elseif (isset($request->penulis_1)){
                        DB::table('footnote')->where('id', $request->idedita+1)->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'nomor' => $request->nomor,
                            'kota' => $request->kota,
                            'tahun' => $request->tahun,
                            'jenis' => $request->jenisf,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis
                        ]);
                    }
                    return redirect('/');
                } elseif($request->jenisf == 2){
                    DB::table('footnote')->where('id', $request->idedita+1)->update([
                        'id' => $request->nourut,
                        'judul_web' => $request->judul_web,
                        'deskripsi_web' => $request->deskripsi_web,
                        'tahun_web' => $request->tahun_web,
                        'link_web' => $request->link_web,
                        'jenis' => $request->jenisf,
                        'jumlah_penulis' => 1,
                        'tanggal_diakses_web' => $request->tanggal_diakses_web
                    ]);
                    return redirect('/2/'.$request->jenisf);
                }
            }else{
                if($request->jenisf == 1){
                    if(isset($request->penulis_1)&&isset($request->penulis_2)&&isset($request->penulis_3)){
                        DB::table('footnote')->where('id', $request->idedita)->update([
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penulis_3' => $request->penulis_3,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'kota' => $request->kota,
                            'jenis' => $request->jenisf,
                            'nomor' => $request->nomor,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis
                        ]);
                    } elseif (isset($request->penulis_1)&&isset($request->penulis_2)){
                        DB::table('footnote')->where('id', $request->idedita)->update([
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'nomor' => $request->nomor,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'jenis' => $request->jenisf,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis
                        ]);
                    } elseif (isset($request->penulis_1)){
                        DB::table('footnote')->where('id', $request->idedita)->update([
                            'penulis_1' => $request->penulis_1,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'nomor' => $request->nomor,
                            'kota' => $request->kota,
                            'tahun' => $request->tahun,
                            'jenis' => $request->jenisf,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis
                        ]);
                    }
                    return redirect('/');
                } elseif($request->jenisf == 2){
                    DB::table('footnote')->where('id', $request->idedita)->update([
                        'judul_web' => $request->judul_web,
                        'deskripsi_web' => $request->deskripsi_web,
                        'tahun_web' => $request->tahun_web,
                        'link_web' => $request->link_web,
                        'jenis' => $request->jenisf,
                        'jumlah_penulis' => 1,
                        'tanggal_diakses_web' => $request->tanggal_diakses_web
                    ]);
                    return redirect('/2/'.$request->jenisf);
                }
            }
        }

        if(isset($request->keluar)){
            return redirect('/anficititate/back');
        }

        if(isset($request->select)){
            return redirect('/anficititate/slc_repo');
        }

        if(isset($request->rapi)){
            $angka = 0;
            $nom = DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->orderBy('id', 'DESC')->first();
            for($u = 1; $u <= $nom->id; $u++){
                $datanya = DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $u)->first();
                if(!isset($datanya)){
                    $angka = $angka + 1;
                }else{
                    $kurang = $datanya->id - $angka;
                    DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $u)->update([
                        'id' => $kurang
                    ]);
                }
            }

            $_SESSION['jenistabel'] = 0;
            return redirect('/anficititate/repo_core');
        }

        if(isset($request->reset)){
            $_SESSION['apakahedit'] = 0;
            $_SESSION['jumlahpenulis'] = 0;
            return redirect('/anficititate/repo_core');
        }

        if(isset($request->dapus)){
            $_SESSION['jenistabel'] = 1;
            return redirect('/anficititate/repo_core');
        }

    }
}
