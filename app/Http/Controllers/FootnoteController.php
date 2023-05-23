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
            $datapus = DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->orderBy('id', 'ASC')->get();

            if(isset($_SESSION['edit_id'])){
            $dataEdit = DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->get();}else{
                $dataEdit = "";
            }

            $nom = DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->orderBy('id', 'DESC')->first();

            $nomo = 1;
            if(isset($nom)){
                foreach($nom as $mon){
                        $nomo = $nom->id + 1;
                }
            }
            $_SESSION['urut_id'] = $nomo;
            if($_SESSION['jumlahpenulis'] == 0 ){
                if($_SESSION['jenis'] == 6){
                    $_SESSION['jumlahpenulis'] = 0;
                }else{
                    $_SESSION['jumlahpenulis'] = 1;
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
        session_start();
        DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $ft)->delete();
        $angka = 0;
        $nom = DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->orderBy('id', 'DESC')->first();
        for($u = $ft; $u <= $nom->id; $u++){
            $datanya = DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $u)->first();
            if(!isset($datanya)){
                $angka = $angka + 1;
            }else{
                $kurang = $datanya->id - $angka;
                DB::table('footnote')->where('id', $u)->update([
                    'id' => $kurang
                ]);
            }
        }
        return redirect('/anficititate/repo_core');
    }

    public function core_repo_edit($ft){
        session_start();
        $_SESSION['lagiNgedit'] = 1;
        $_SESSION['edit_id'] = $ft;
        $dataEdit = DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->get();

        foreach($dataEdit as $editData){
            $_SESSION['jumlahpenulis'] = $editData->jumlah_penulis;
            $_SESSION['jenis'] = $editData->jenis;
        }
        $_SESSION['apakahedit'] = 1;
        return redirect('/anficititate/repo_core');
    }

    public function kelola(Request $request){
        session_start();

        if(isset($request->tomboljenis)){
            $_SESSION['jenis'] = $request->jenis_footnote;
            if(isset($_SESSION['lagiNgedit'])){
                if($_SESSION['lagiNgedit'] == 1){
                    $nom = DB::table('footnote')->where('username', $_SESSION['username'])->where('id', $_SESSION['edit_id'])->where('repositori', $_SESSION['repo'])->get();
                    foreach($nom as $mon){
                        $jumlahfootnoteyangada = $mon->jumlahfootnoteyangada;
                    }
                    DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                        'jenis' => $_SESSION['jenis']
                    ]);
                }
            }
            return redirect("/anficititate/repo_core");
        }

        if(isset($request->input)){
            $_SESSION['lagiNgedit'] = 0;
            if($_SESSION['jenis'] == 1){
                $urutan = $_SESSION['urut_id'];
                if($request->nourut !== $urutan){
                    for($i = $urutan; $i >= $request->nourut; $i--){
                        $x = $i + 1;
                        DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $i)->update([
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
                        'bulan' => $request->bulan,
                        'tahun' => $request->tahun,
                        'asing' => $request->asing,
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
                        'bulan' => $request->bulan,
                        'tahun' => $request->tahun,
                        'asing' => $request->asing,
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
                        'bulan' => $request->bulan,
                        'tahun' => $request->tahun,
                        'asing' => $request->asing,
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
                $urutan = $_SESSION['urut_id'];
                if($request->nourut !== $urutan){
                    for($i = $urutan; $i >= $request->nourut; $i--){
                        $x = $i + 1;
                        DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $i)->update([
                            'id' => $x
                        ]);
                    }
                }
                DB::table('footnote')->insert([
                    'id' => $request->nourut,
                    'penulis_1' => $request->penulisArtikel,
                    'judul_web' => $request->judul_web,
                    'deskripsi_web' => $request->judulArtikel,
                    'tanggal' => $request->tanggal_website,
                    'link_web' => $request->link_web,
                    'jenis' => $_SESSION['jenis'],
                    'tanggal_diakses_web' => $request->tanggal_diakses_web,
                    'repositori' => $_SESSION['repo'],
                    'username' => $_SESSION['username']
                ]);
                $_SESSION['apakahedit'] = 0;
                return redirect('/anficititate/repo_core');
            }elseif($_SESSION['jenis'] == 3){
                $urutan = $_SESSION['urut_id'];
                if($request->nourut !== $urutan){
                    for($i = $urutan; $i >= $request->nourut; $i--){
                        $x = $i + 1;
                        DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $i)->update([
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
                        'penerjemah' => $request->penerjemah,
                        'jenisBuku' => $request->jenisBuku,
                        'judul' => $request->judul,
                        'kota' => $request->kota,
                        'sumber' => $request->sumber,
                        'volume' => $request->volume,
                        'nomor' => $request->nomor,
                        'tahun' => $request->tahun,
                        'asing' => $request->asing,
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
                        'penerjemah' => $request->penerjemah,
                        'jenisBuku' => $request->jenisBuku,
                        'judul' => $request->judul,
                        'kota' => $request->kota,
                        'sumber' => $request->sumber,
                        'volume' => $request->volume,
                        'nomor' => $request->nomor,
                        'tahun' => $request->tahun,
                        'asing' => $request->asing,
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
                        'penerjemah' => $request->penerjemah,
                        'jenisBuku' => $request->jenisBuku,
                        'judul' => $request->judul,
                        'kota' => $request->kota,
                        'sumber' => $request->sumber,
                        'volume' => $request->volume,
                        'nomor' => $request->nomor,
                        'tahun' => $request->tahun,
                        'asing' => $request->asing,
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
            }elseif($_SESSION['jenis'] == 4){
                $urutan = $_SESSION['urut_id'];
                if($request->nourut !== $urutan){
                    for($i = $urutan; $i >= $request->nourut; $i--){
                        $x = $i + 1;
                        DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $i)->update([
                            'id' => $x
                        ]);
                    }

                }
                    DB::table('footnote')->insert([
                        'id' => $request->nourut,
                        'penulis_1' => $request->penulis_1,
                        'judul' => $request->judul,
                        'kota' => $request->kota,
                        'sumber' => $request->sumber,
                        'tahun' => $request->tahun,
                        'jenis' => $_SESSION['jenis'],
                        'halaman_awal' => $request->halaman_awal,
                        'halaman_akhir' => $request->halaman_akhir,
                        'jumlah_penulis' => $request->jumlah_penulis,
                        'repositori' => $_SESSION['repo'],
                        'username' => $_SESSION['username']
                    ]);
                $_SESSION['apakahedit'] = 0;
                return redirect('/anficititate/repo_core');
            }elseif($_SESSION['jenis'] == 5){
                $urutan = $_SESSION['urut_id'];
                if($request->nourut !== $urutan){
                    for($i = $urutan; $i >= $request->nourut; $i--){
                        $x = $i + 1;
                        DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $i)->update([
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
                        'cetakan' => $request->cetakan,
                        'jilid' => $request->jilid,
                        'tahun' => $request->tahun,
                        'asing' => $request->asing,
                        'penerbit' => $request->penerbit,
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
                        'cetakan' => $request->cetakan,
                        'jilid' => $request->jilid,
                        'tahun' => $request->tahun,
                        'asing' => $request->asing,
                        'penerbit' => $request->penerbit,
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
                        'cetakan' => $request->cetakan,
                        'jilid' => $request->jilid,
                        'tahun' => $request->tahun,
                        'asing' => $request->asing,
                        'penerbit' => $request->penerbit,
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
            }elseif($_SESSION['jenis'] == 6){
                $urutan = $_SESSION['urut_id'];
                if($request->nourut !== $urutan){
                    for($i = $urutan; $i >= $request->nourut; $i--){
                        $x = $i + 1;
                        DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $i)->update([
                            'id' => $x
                        ]);
                    }

                }
                if($_SESSION['jumlahpenulis'] == 1){
                    DB::table('footnote')->insert([
                        'id' => $request->nourut,
                        'penulis_1' => $request->penulis_1,
                        'judul' => $request->judul,
                        'kota' => $request->kota,
                        'sumber' => $request->sumber,
                        'tanggal' => $request->tanggal,
                        'bulan' => $request->bulan,
                        'tahun' => $request->tahun,
                        'asing' => $request->asing,
                        'jenis' => $_SESSION['jenis'],
                        'halaman_awal' => $request->halaman_awal,
                        'halaman_akhir' => $request->halaman_akhir,
                        'jumlah_penulis' => $request->jumlah_penulis,
                        'repositori' => $_SESSION['repo'],
                        'username' => $_SESSION['username']
                    ]);
                } else {
                    DB::table('footnote')->insert([
                        'id' => $request->nourut,
                        'judul' => $request->judul,
                        'kota' => $request->kota,
                        'sumber' => $request->sumber,
                        'tanggal' => $request->tanggal,
                        'bulan' => $request->bulan,
                        'tahun' => $request->tahun,
                        'asing' => $request->asing,
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
            }elseif($_SESSION['jenis'] == 7){
                $urutan = $_SESSION['urut_id'];
                if($request->nourut !== $urutan){
                    for($i = $urutan; $i >= $request->nourut; $i--){
                        $x = $i + 1;
                        DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $i)->update([
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
                        'sumber' => $request->sumber,
                        'tahun' => $request->tahun,
                        'halaman_awal' => $request->halaman_awal,
                        'halaman_akhir' => $request->halaman_akhir,
                        'kota' => $request->kota,
                        'penerbit' => $request->penerbit,
                        'asing' => $request->asing,
                        'jenis' => $_SESSION['jenis'],
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
                        'sumber' => $request->sumber,
                        'tahun' => $request->tahun,
                        'halaman_awal' => $request->halaman_awal,
                        'halaman_akhir' => $request->halaman_akhir,
                        'kota' => $request->kota,
                        'penerbit' => $request->penerbit,
                        'asing' => $request->asing,
                        'jenis' => $_SESSION['jenis'],
                        'jumlah_penulis' => $request->jumlah_penulis,
                        'repositori' => $_SESSION['repo'],
                        'username' => $_SESSION['username']
                    ]);
                } elseif ($_SESSION['jumlahpenulis'] == 1 || $_SESSION['jumlahpenulis'] == 4){
                    DB::table('footnote')->insert([
                        'id' => $request->nourut,
                        'penulis_1' => $request->penulis_1,
                        'judul' => $request->judul,
                        'sumber' => $request->sumber,
                        'tahun' => $request->tahun,
                        'halaman_awal' => $request->halaman_awal,
                        'halaman_akhir' => $request->halaman_akhir,
                        'kota' => $request->kota,
                        'penerbit' => $request->penerbit,
                        'asing' => $request->asing,
                        'jenis' => $_SESSION['jenis'],
                        'jumlah_penulis' => $request->jumlah_penulis,
                        'repositori' => $_SESSION['repo'],
                        'username' => $_SESSION['username']
                    ]);
                }
                $_SESSION['apakahedit'] = 0;
                return redirect('/anficititate/repo_core');
            }elseif($_SESSION['jenis'] == 8){
                $urutan = $_SESSION['urut_id'];
                if($request->nourut !== $urutan){
                    for($i = $urutan; $i >= $request->nourut; $i--){
                        $x = $i + 1;
                        DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $i)->update([
                            'id' => $x
                        ]);
                    }

                }
                    DB::table('footnote')->insert([
                        'id' => $request->nourut,
                        'penulis_1' => $request->penulis_1,
                        'jabatan' => $request->jabatan,
                        'sumber' => $request->sumber,
                        'jenisWawancara' => $request->jenisWawancara,
                        'tanggal' => $request->tanggal,
                        'bulan' => $request->bulan,
                        'tahun' => $request->tahun,
                        'halaman_awal' => $request->halaman_awal,
                        'halaman_akhir' => $request->halaman_akhir,
                        'kota' => $request->kota,
                        'jenis' => $_SESSION['jenis'],
                        'repositori' => $_SESSION['repo'],
                        'username' => $_SESSION['username']
                    ]);
                $_SESSION['apakahedit'] = 0;
                return redirect('/anficititate/repo_core');
            }elseif($_SESSION['jenis'] == 9){
                $urutan = $_SESSION['urut_id'];
                if($request->nourut !== $urutan){
                    for($i = $urutan; $i >= $request->nourut; $i--){
                        $x = $i + 1;
                        DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $i)->update([
                            'id' => $x
                        ]);
                    }

                }
                    DB::table('footnote')->insert([
                        'id' => $request->nourut,
                        'penulis_1' => $request->penulis_1,
                        'judul' => $request->judul,
                        'sumber' => $request->sumber,
                        'hari' => $request->tanggal,
                        'tanggal' => $request->hari,
                        'bulan' => $request->bulan,
                        'tahun' => $request->tahun,
                        'waktu' => $request->waktu,
                        'jenis' => $_SESSION['jenis'],
                        'repositori' => $_SESSION['repo'],
                        'username' => $_SESSION['username']
                    ]);
                $_SESSION['apakahedit'] = 0;
                return redirect('/anficititate/repo_core');
            }elseif($_SESSION['jenis'] == 10){
                $urutan = $_SESSION['urut_id'];
                if($request->nourut !== $urutan){
                    for($i = $urutan; $i >= $request->nourut; $i--){
                        $x = $i + 1;
                        DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $i)->update([
                            'id' => $x
                        ]);
                    }

                }
                    DB::table('footnote')->insert([
                        'id' => $request->nourut,
                        'penulis_1' => $request->penulis_1,
                        'judul' => $request->komentar,
                        'tahun' => $request->tahun,
                        'halaman_awal' => $request->halaman_awal,
                        'halaman_akhir' => $request->halaman_akhir,
                        'jenis' => $_SESSION['jenis'],
                        'repositori' => $_SESSION['repo'],
                        'username' => $_SESSION['username']
                    ]);
                $_SESSION['apakahedit'] = 0;
                return redirect('/anficititate/repo_core');
            }elseif($_SESSION['jenis'] == 11){
                $urutan = $_SESSION['urut_id'];
                if($request->nourut !== $urutan){
                    for($i = $urutan; $i >= $request->nourut; $i--){
                        $x = $i + 1;
                        DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $i)->update([
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
                        'penerjemah' => $request->penerjemah,
                        'judul' => $request->judul,
                        'sumber' => $request->sumber,
                        'volume' => $request->volume,
                        'tahun' => $request->tahun,
                        'halaman_awal' => $request->halaman_awal,
                        'halaman_akhir' => $request->halaman_akhir,
                        'kota' => $request->kota,
                        'penerbit' => $request->penerbit,
                        'asing' => $request->asing,
                        'jenis' => $_SESSION['jenis'],
                        'jumlah_penulis' => $request->jumlah_penulis,
                        'repositori' => $_SESSION['repo'],
                        'username' => $_SESSION['username']
                    ]);
                } elseif ($_SESSION['jumlahpenulis'] == 2){
                    DB::table('footnote')->insert([
                        'id' => $request->nourut,
                        'penulis_1' => $request->penulis_1,
                        'penulis_2' => $request->penulis_2,
                        'penerjemah' => $request->penerjemah,
                        'judul' => $request->judul,
                        'sumber' => $request->sumber,
                        'volume' => $request->volume,
                        'tahun' => $request->tahun,
                        'halaman_awal' => $request->halaman_awal,
                        'halaman_akhir' => $request->halaman_akhir,
                        'kota' => $request->kota,
                        'penerbit' => $request->penerbit,
                        'asing' => $request->asing,
                        'jenis' => $_SESSION['jenis'],
                        'jumlah_penulis' => $request->jumlah_penulis,
                        'repositori' => $_SESSION['repo'],
                        'username' => $_SESSION['username']
                    ]);
                } elseif ($_SESSION['jumlahpenulis'] == 1 || $_SESSION['jumlahpenulis'] == 4){
                    DB::table('footnote')->insert([
                        'id' => $request->nourut,
                        'penulis_1' => $request->penulis_1,
                        'penerjemah' => $request->penerjemah,
                        'judul' => $request->judul,
                        'sumber' => $request->sumber,
                        'volume' => $request->volume,
                        'tahun' => $request->tahun,
                        'halaman_awal' => $request->halaman_awal,
                        'halaman_akhir' => $request->halaman_akhir,
                        'kota' => $request->kota,
                        'penerbit' => $request->penerbit,
                        'asing' => $request->asing,
                        'jenis' => $_SESSION['jenis'],
                        'jumlah_penulis' => $request->jumlah_penulis,
                        'repositori' => $_SESSION['repo'],
                        'username' => $_SESSION['username']
                    ]);
                }
                $_SESSION['apakahedit'] = 0;
                return redirect('/anficititate/repo_core');
            }elseif($_SESSION['jenis'] == 12){
                $urutan = $_SESSION['urut_id'];
                if($request->nourut !== $urutan){
                    for($i = $urutan; $i >= $request->nourut; $i--){
                        $x = $i + 1;
                        DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $i)->update([
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
                        'asing' => $request->asing,
                        'judul' => $request->judul,
                        'acara' => $request->acara,
                        'judulAcara' => $request->judulAcara,
                        'penyelenggaraAcara' => $request->penyelenggaraAcara,
                        'tanggal' => $request->tanggal,
                        'bulan' => $request->bulan,
                        'tahun' => $request->tahun,
                        'jenis' => $_SESSION['jenis'],
                        'jumlah_penulis' => $request->jumlah_penulis,
                        'repositori' => $_SESSION['repo'],
                        'username' => $_SESSION['username']
                    ]);
                } elseif ($_SESSION['jumlahpenulis'] == 2){
                    DB::table('footnote')->insert([
                        'id' => $request->nourut,
                        'penulis_1' => $request->penulis_1,
                        'penulis_2' => $request->penulis_2,
                        'asing' => $request->asing,
                        'judul' => $request->judul,
                        'acara' => $request->acara,
                        'judulAcara' => $request->judulAcara,
                        'penyelenggaraAcara' => $request->penyelenggaraAcara,
                        'tanggal' => $request->tanggal,
                        'bulan' => $request->bulan,
                        'tahun' => $request->tahun,
                        'jenis' => $_SESSION['jenis'],
                        'jumlah_penulis' => $request->jumlah_penulis,
                        'repositori' => $_SESSION['repo'],
                        'username' => $_SESSION['username']
                    ]);
                } elseif ($_SESSION['jumlahpenulis'] == 1 || $_SESSION['jumlahpenulis'] == 4){
                    DB::table('footnote')->insert([
                        'id' => $request->nourut,
                        'penulis_1' => $request->penulis_1,
                        'asing' => $request->asing,
                        'judul' => $request->judul,
                        'acara' => $request->acara,
                        'judulAcara' => $request->judulAcara,
                        'penyelenggaraAcara' => $request->penyelenggaraAcara,
                        'tanggal' => $request->tanggal,
                        'bulan' => $request->bulan,
                        'tahun' => $request->tahun,
                        'jenis' => $_SESSION['jenis'],
                        'jumlah_penulis' => $request->jumlah_penulis,
                        'repositori' => $_SESSION['repo'],
                        'username' => $_SESSION['username']
                    ]);
                }
                $_SESSION['apakahedit'] = 0;
                return redirect('/anficititate/repo_core');
            }

        }



        if(isset($request->edit)){
            if($request->nourut > $_SESSION['edit_id']){
                $_SESSION['lagiNgedit'] = 0;
                $nom = DB::table('footnote')->where('username', $_SESSION['username'])->where('id', $_SESSION['edit_id'])->where('repositori', $_SESSION['repo'])->get();
                foreach($nom as $mon){
                    $jumlahfootnoteyangada = $mon->jumlahfootnoteyangada;
                }
                for($i = ($_SESSION['edit_id']+1); $i <= $request->nourut; $i++){
                    $x = $i - 1;
                    DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $i)->update([
                        'id' => $x
                    ]);
                }

                if($_SESSION['jenis'] == 1){
                    if($_SESSION['jumlahpenulis'] == 3){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penulis_3' => $request->penulis_3,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'nomor' => $request->nomor,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                        $_SESSION['apakahedit'] = 0;
                        return redirect('/anficititate/repo_core');
                    } elseif ($_SESSION['jumlahpenulis'] == 2){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'nomor' => $request->nomor,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                        $_SESSION['apakahedit'] = 0;
                        return redirect('/anficititate/repo_core');
                    } elseif ($_SESSION['jumlahpenulis'] == 1 || $_SESSION['jumlahpenulis'] == 4){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'nomor' => $request->nomor,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                        $_SESSION['apakahedit'] = 0;
                        return redirect('/anficititate/repo_core');
                    }

                } elseif($_SESSION['jenis'] == 2){
                    DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                        'id' => $request->nourut,
                        'penulis_1' => $request->penulisArtikel,
                        'judul_web' => $request->judul_web,
                    'deskripsi_web' => $request->judulArtikel,
                        'tanggal' => $request->tanggal_website,
                        'link_web' => $request->link_web,
                        'jenis' => $_SESSION['jenis'],
                        'tanggal_diakses_web' => $request->tanggal_diakses_web,
                        'repositori' => $_SESSION['repo'],
                        'username' => $_SESSION['username']
                    ]);
                    $_SESSION['apakahedit'] = 0;
                    return redirect('/anficititate/repo_core');
                }elseif($_SESSION['jenis'] == 3){

                    if($_SESSION['jumlahpenulis'] == 3){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penulis_3' => $request->penulis_3,
                            'penerjemah' => $request->penerjemah,
                            'jenisBuku' => $request->jenisBuku,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'nomor' => $request->nomor,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 2){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penerjemah' => $request->penerjemah,
                            'jenisBuku' => $request->jenisBuku,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'nomor' => $request->nomor,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 1 || $_SESSION['jumlahpenulis'] == 4){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penerjemah' => $request->penerjemah,
                            'jenisBuku' => $request->jenisBuku,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'nomor' => $request->nomor,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
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
                }elseif($_SESSION['jenis'] == 4){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'tahun' => $request->tahun,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                        $_SESSION['apakahedit'] = 0;
                        return redirect('/anficititate/repo_core');
                }elseif($_SESSION['jenis'] == 5){

                    if($_SESSION['jumlahpenulis'] == 3){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penulis_3' => $request->penulis_3,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'cetakan' => $request->cetakan,
                            'jilid' => $request->jilid,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'penerbit' => $request->penerbit,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 2){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'cetakan' => $request->cetakan,
                            'jilid' => $request->jilid,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'penerbit' => $request->penerbit,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 1 || $_SESSION['jumlahpenulis'] == 4){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'cetakan' => $request->cetakan,
                            'jilid' => $request->jilid,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'penerbit' => $request->penerbit,
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
                }elseif($_SESSION['jenis'] == 6){

                    if($_SESSION['jumlahpenulis'] == 1){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'tanggal' => $request->tanggal,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } else {
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'tanggal' => $request->tanggal,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
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
                }elseif($_SESSION['jenis'] == 7){

                    if($_SESSION['jumlahpenulis'] == 3){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penulis_3' => $request->penulis_3,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'kota' => $request->kota,
                            'penerbit' => $request->penerbit,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 2){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'kota' => $request->kota,
                            'penerbit' => $request->penerbit,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 1 || $_SESSION['jumlahpenulis'] == 4){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'kota' => $request->kota,
                            'penerbit' => $request->penerbit,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    }
                    $_SESSION['apakahedit'] = 0;
                    return redirect('/anficititate/repo_core');
                }elseif($_SESSION['jenis'] == 8){

                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'jabatan' => $request->jabatan,
                            'sumber' => $request->sumber,
                            'jenisWawancara' => $request->jenisWawancara,
                            'tanggal' => $request->tanggal,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'kota' => $request->kota,
                            'jenis' => $_SESSION['jenis'],
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    $_SESSION['apakahedit'] = 0;
                    return redirect('/anficititate/repo_core');
                }elseif($_SESSION['jenis'] == 9){

                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'hari' => $request->tanggal,
                            'tanggal' => $request->hari,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'waktu' => $request->waktu,
                            'jenis' => $_SESSION['jenis'],
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    $_SESSION['apakahedit'] = 0;
                    return redirect('/anficititate/repo_core');
                }elseif($_SESSION['jenis'] == 10){

                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'judul' => $request->komentar,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jenis' => $_SESSION['jenis'],
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    $_SESSION['apakahedit'] = 0;
                    return redirect('/anficititate/repo_core');
                }elseif($_SESSION['jenis'] == 11){

                    if($_SESSION['jumlahpenulis'] == 3){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penulis_3' => $request->penulis_3,
                            'penerjemah' => $request->penerjemah,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'kota' => $request->kota,
                            'penerbit' => $request->penerbit,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 2){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penerjemah' => $request->penerjemah,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'kota' => $request->kota,
                            'penerbit' => $request->penerbit,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 1 || $_SESSION['jumlahpenulis'] == 4){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penerjemah' => $request->penerjemah,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'kota' => $request->kota,
                            'penerbit' => $request->penerbit,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    }
                    $_SESSION['apakahedit'] = 0;
                    return redirect('/anficititate/repo_core');
                }elseif($_SESSION['jenis'] == 12){

                    if($_SESSION['jumlahpenulis'] == 3){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penulis_3' => $request->penulis_3,
                            'asing' => $request->asing,
                            'judul' => $request->judul,
                            'acara' => $request->acara,
                            'judulAcara' => $request->judulAcara,
                            'penyelenggaraAcara' => $request->penyelenggaraAcara,
                            'tanggal' => $request->tanggal,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 2){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'asing' => $request->asing,
                            'judul' => $request->judul,
                            'acara' => $request->acara,
                            'judulAcara' => $request->judulAcara,
                            'penyelenggaraAcara' => $request->penyelenggaraAcara,
                            'tanggal' => $request->tanggal,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 1 || $_SESSION['jumlahpenulis'] == 4){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'asing' => $request->asing,
                            'judul' => $request->judul,
                            'acara' => $request->acara,
                            'judulAcara' => $request->judulAcara,
                            'penyelenggaraAcara' => $request->penyelenggaraAcara,
                            'tanggal' => $request->tanggal,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    }
                    $_SESSION['apakahedit'] = 0;
                    return redirect('/anficititate/repo_core');
                }

            } elseif($request->nourut < $_SESSION['edit_id']){
                $_SESSION['lagiNgedit'] = 0;
                $nom = DB::table('footnote')->where('username', $_SESSION['username'])->where('id', $_SESSION['edit_id'])->where('repositori', $_SESSION['repo'])->get();
                foreach($nom as $mon){
                    $jumlahfootnoteyangada = $mon->jumlahfootnoteyangada;
                }
                for($i = ($_SESSION['edit_id']-1); $i >= $request->nourut; $i--){
                    $x = $i + 1;
                    DB::table('footnote')->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $i)->update([
                        'id' => $x
                    ]);
                }

                if($_SESSION['jenis'] == 1){
                    if($_SESSION['jumlahpenulis'] == 3){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penulis_3' => $request->penulis_3,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'nomor' => $request->nomor,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                        $_SESSION['apakahedit'] = 0;
                        return redirect('/anficititate/repo_core');
                    } elseif ($_SESSION['jumlahpenulis'] == 2){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'nomor' => $request->nomor,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                        $_SESSION['apakahedit'] = 0;
                        return redirect('/anficititate/repo_core');
                    } elseif ($_SESSION['jumlahpenulis'] == 1 || $_SESSION['jumlahpenulis'] == 4){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'nomor' => $request->nomor,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                        $_SESSION['apakahedit'] = 0;
                        return redirect('/anficititate/repo_core');
                    }

                } elseif($_SESSION['jenis'] == 2){
                    DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                        'id' => $request->nourut,
                        'penulis_1' => $request->penulisArtikel,
                        'judul_web' => $request->judul_web,
                    'deskripsi_web' => $request->judulArtikel,
                        'tanggal' => $request->tanggal_website,
                        'link_web' => $request->link_web,
                        'jenis' => $_SESSION['jenis'],
                        'tanggal_diakses_web' => $request->tanggal_diakses_web,
                        'repositori' => $_SESSION['repo'],
                        'username' => $_SESSION['username']
                    ]);
                    $_SESSION['apakahedit'] = 0;
                    return redirect('/anficititate/repo_core');
                }elseif($_SESSION['jenis'] == 3){

                    if($_SESSION['jumlahpenulis'] == 3){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penulis_3' => $request->penulis_3,
                            'penerjemah' => $request->penerjemah,
                            'jenisBuku' => $request->jenisBuku,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'nomor' => $request->nomor,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 2){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penerjemah' => $request->penerjemah,
                            'jenisBuku' => $request->jenisBuku,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'nomor' => $request->nomor,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 1 || $_SESSION['jumlahpenulis'] == 4){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penerjemah' => $request->penerjemah,
                            'jenisBuku' => $request->jenisBuku,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'nomor' => $request->nomor,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
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
                }elseif($_SESSION['jenis'] == 4){
                    DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                        'id' => $request->nourut,
                        'penulis_1' => $request->penulis_1,
                        'judul' => $request->judul,
                        'kota' => $request->kota,
                        'sumber' => $request->sumber,
                        'tahun' => $request->tahun,
                        'jenis' => $_SESSION['jenis'],
                        'halaman_awal' => $request->halaman_awal,
                        'halaman_akhir' => $request->halaman_akhir,
                        'jumlah_penulis' => $request->jumlah_penulis,
                        'repositori' => $_SESSION['repo'],
                        'username' => $_SESSION['username']
                    ]);
                    $_SESSION['apakahedit'] = 0;
                    return redirect('/anficititate/repo_core');
                }elseif($_SESSION['jenis'] == 5){

                    if($_SESSION['jumlahpenulis'] == 3){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penulis_3' => $request->penulis_3,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'cetakan' => $request->cetakan,
                            'jilid' => $request->jilid,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'penerbit' => $request->penerbit,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 2){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'cetakan' => $request->cetakan,
                            'jilid' => $request->jilid,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'penerbit' => $request->penerbit,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 1 || $_SESSION['jumlahpenulis'] == 4){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'cetakan' => $request->cetakan,
                            'jilid' => $request->jilid,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'penerbit' => $request->penerbit,
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
                }elseif($_SESSION['jenis'] == 6){

                    if($_SESSION['jumlahpenulis'] == 1){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'tanggal' => $request->tanggal,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } else {
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'tanggal' => $request->tanggal,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
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
                }elseif($_SESSION['jenis'] == 7){

                    if($_SESSION['jumlahpenulis'] == 3){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penulis_3' => $request->penulis_3,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'kota' => $request->kota,
                            'penerbit' => $request->penerbit,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 2){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'kota' => $request->kota,
                            'penerbit' => $request->penerbit,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 1 || $_SESSION['jumlahpenulis'] == 4){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'kota' => $request->kota,
                            'penerbit' => $request->penerbit,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    }
                    $_SESSION['apakahedit'] = 0;
                    return redirect('/anficititate/repo_core');
                }elseif($_SESSION['jenis'] == 8){

                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'jabatan' => $request->jabatan,
                            'sumber' => $request->sumber,
                            'jenisWawancara' => $request->jenisWawancara,
                            'tanggal' => $request->tanggal,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'kota' => $request->kota,
                            'jenis' => $_SESSION['jenis'],
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    $_SESSION['apakahedit'] = 0;
                    return redirect('/anficititate/repo_core');
                }elseif($_SESSION['jenis'] == 9){

                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'hari' => $request->tanggal,
                            'tanggal' => $request->hari,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'waktu' => $request->waktu,
                            'jenis' => $_SESSION['jenis'],
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    $_SESSION['apakahedit'] = 0;
                    return redirect('/anficititate/repo_core');
                }elseif($_SESSION['jenis'] == 10){

                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'judul' => $request->komentar,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jenis' => $_SESSION['jenis'],
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    $_SESSION['apakahedit'] = 0;
                    return redirect('/anficititate/repo_core');
                }elseif($_SESSION['jenis'] == 11){

                    if($_SESSION['jumlahpenulis'] == 3){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penulis_3' => $request->penulis_3,
                            'penerjemah' => $request->penerjemah,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'kota' => $request->kota,
                            'penerbit' => $request->penerbit,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 2){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penerjemah' => $request->penerjemah,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'kota' => $request->kota,
                            'penerbit' => $request->penerbit,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 1 || $_SESSION['jumlahpenulis'] == 4){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penerjemah' => $request->penerjemah,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'kota' => $request->kota,
                            'penerbit' => $request->penerbit,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    }
                    $_SESSION['apakahedit'] = 0;
                    return redirect('/anficititate/repo_core');
                }elseif($_SESSION['jenis'] == 12){

                    if($_SESSION['jumlahpenulis'] == 3){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penulis_3' => $request->penulis_3,
                            'asing' => $request->asing,
                            'judul' => $request->judul,
                            'acara' => $request->acara,
                            'judulAcara' => $request->judulAcara,
                            'penyelenggaraAcara' => $request->penyelenggaraAcara,
                            'tanggal' => $request->tanggal,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 2){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'asing' => $request->asing,
                            'judul' => $request->judul,
                            'acara' => $request->acara,
                            'judulAcara' => $request->judulAcara,
                            'penyelenggaraAcara' => $request->penyelenggaraAcara,
                            'tanggal' => $request->tanggal,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 1 || $_SESSION['jumlahpenulis'] == 4){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'asing' => $request->asing,
                            'judul' => $request->judul,
                            'acara' => $request->acara,
                            'judulAcara' => $request->judulAcara,
                            'penyelenggaraAcara' => $request->penyelenggaraAcara,
                            'tanggal' => $request->tanggal,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    }
                    $_SESSION['apakahedit'] = 0;
                    return redirect('/anficititate/repo_core');
                }

            }else{
                $_SESSION['lagiNgedit'] = 0;
                $nom = DB::table('footnote')->where('username', $_SESSION['username'])->where('id', $_SESSION['edit_id'])->where('repositori', $_SESSION['repo'])->get();
                foreach($nom as $mon){
                    $jumlahfootnoteyangada = $mon->jumlahfootnoteyangada;
                }
                if($_SESSION['jenis'] == 1){
                    if($_SESSION['jumlahpenulis'] == 3){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penulis_3' => $request->penulis_3,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'nomor' => $request->nomor,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                        $_SESSION['apakahedit'] = 0;
                        return redirect('/anficititate/repo_core');
                    } elseif ($_SESSION['jumlahpenulis'] == 2){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'nomor' => $request->nomor,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                        $_SESSION['apakahedit'] = 0;
                        return redirect('/anficititate/repo_core');
                    } elseif ($_SESSION['jumlahpenulis'] == 1 || $_SESSION['jumlahpenulis'] == 4){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'nomor' => $request->nomor,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                        $_SESSION['apakahedit'] = 0;
                        return redirect('/anficititate/repo_core');
                    }

                } elseif($_SESSION['jenis'] == 2){
                    DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                        'id' => $request->nourut,
                        'penulis_1' => $request->penulisArtikel,
                        'judul_web' => $request->judul_web,
                    'deskripsi_web' => $request->judulArtikel,
                        'tanggal' => $request->tanggal_website,
                        'link_web' => $request->link_web,
                        'jenis' => $_SESSION['jenis'],
                        'tanggal_diakses_web' => $request->tanggal_diakses_web,
                        'repositori' => $_SESSION['repo'],
                        'username' => $_SESSION['username']
                    ]);
                    $_SESSION['apakahedit'] = 0;
                    return redirect('/anficititate/repo_core');
                }elseif($_SESSION['jenis'] == 3){

                    if($_SESSION['jumlahpenulis'] == 3){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penulis_3' => $request->penulis_3,
                            'penerjemah' => $request->penerjemah,
                            'jenisBuku' => $request->jenisBuku,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'nomor' => $request->nomor,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 2){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penerjemah' => $request->penerjemah,
                            'jenisBuku' => $request->jenisBuku,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'nomor' => $request->nomor,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 1 || $_SESSION['jumlahpenulis'] == 4){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penerjemah' => $request->penerjemah,
                            'jenisBuku' => $request->jenisBuku,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'nomor' => $request->nomor,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
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
                }elseif($_SESSION['jenis'] == 4){
                    DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                        'id' => $request->nourut,
                        'penulis_1' => $request->penulis_1,
                        'judul' => $request->judul,
                        'kota' => $request->kota,
                        'sumber' => $request->sumber,
                        'tahun' => $request->tahun,
                        'jenis' => $_SESSION['jenis'],
                        'halaman_awal' => $request->halaman_awal,
                        'halaman_akhir' => $request->halaman_akhir,
                        'jumlah_penulis' => $request->jumlah_penulis,
                        'repositori' => $_SESSION['repo'],
                        'username' => $_SESSION['username']
                    ]);
                    $_SESSION['apakahedit'] = 0;
                    return redirect('/anficititate/repo_core');
                }elseif($_SESSION['jenis'] == 5){

                    if($_SESSION['jumlahpenulis'] == 3){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penulis_3' => $request->penulis_3,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'cetakan' => $request->cetakan,
                            'jilid' => $request->jilid,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'penerbit' => $request->penerbit,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 2){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'cetakan' => $request->cetakan,
                            'jilid' => $request->jilid,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'penerbit' => $request->penerbit,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 1 || $_SESSION['jumlahpenulis'] == 4){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'cetakan' => $request->cetakan,
                            'jilid' => $request->jilid,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'penerbit' => $request->penerbit,
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
                }elseif($_SESSION['jenis'] == 6){

                    if($_SESSION['jumlahpenulis'] == 1){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'tanggal' => $request->tanggal,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } else {
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'judul' => $request->judul,
                            'kota' => $request->kota,
                            'sumber' => $request->sumber,
                            'tanggal' => $request->tanggal,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'asing' => $request->asing,
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
                }elseif($_SESSION['jenis'] == 7){

                    if($_SESSION['jumlahpenulis'] == 3){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penulis_3' => $request->penulis_3,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'kota' => $request->kota,
                            'penerbit' => $request->penerbit,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 2){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'kota' => $request->kota,
                            'penerbit' => $request->penerbit,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 1 || $_SESSION['jumlahpenulis'] == 4){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'kota' => $request->kota,
                            'penerbit' => $request->penerbit,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    }
                    $_SESSION['apakahedit'] = 0;
                    return redirect('/anficititate/repo_core');
                }elseif($_SESSION['jenis'] == 8){

                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'jabatan' => $request->jabatan,
                            'sumber' => $request->sumber,
                            'jenisWawancara' => $request->jenisWawancara,
                            'tanggal' => $request->tanggal,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'kota' => $request->kota,
                            'jenis' => $_SESSION['jenis'],
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    $_SESSION['apakahedit'] = 0;
                    return redirect('/anficititate/repo_core');
                }elseif($_SESSION['jenis'] == 9){

                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'hari' => $request->tanggal,
                            'tanggal' => $request->hari,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'waktu' => $request->waktu,
                            'jenis' => $_SESSION['jenis'],
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    $_SESSION['apakahedit'] = 0;
                    return redirect('/anficititate/repo_core');
                }elseif($_SESSION['jenis'] == 10){

                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'judul' => $request->komentar,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'jenis' => $_SESSION['jenis'],
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    $_SESSION['apakahedit'] = 0;
                    return redirect('/anficititate/repo_core');
                }elseif($_SESSION['jenis'] == 11){

                    if($_SESSION['jumlahpenulis'] == 3){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penulis_3' => $request->penulis_3,
                            'penerjemah' => $request->penerjemah,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'kota' => $request->kota,
                            'penerbit' => $request->penerbit,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 2){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penerjemah' => $request->penerjemah,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'kota' => $request->kota,
                            'penerbit' => $request->penerbit,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 1 || $_SESSION['jumlahpenulis'] == 4){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penerjemah' => $request->penerjemah,
                            'judul' => $request->judul,
                            'sumber' => $request->sumber,
                            'volume' => $request->volume,
                            'tahun' => $request->tahun,
                            'halaman_awal' => $request->halaman_awal,
                            'halaman_akhir' => $request->halaman_akhir,
                            'kota' => $request->kota,
                            'penerbit' => $request->penerbit,
                            'asing' => $request->asing,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    }
                    $_SESSION['apakahedit'] = 0;
                    return redirect('/anficititate/repo_core');
                }elseif($_SESSION['jenis'] == 12){

                    if($_SESSION['jumlahpenulis'] == 3){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'penulis_3' => $request->penulis_3,
                            'asing' => $request->asing,
                            'judul' => $request->judul,
                            'acara' => $request->acara,
                            'judulAcara' => $request->judulAcara,
                            'penyelenggaraAcara' => $request->penyelenggaraAcara,
                            'tanggal' => $request->tanggal,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 2){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'penulis_2' => $request->penulis_2,
                            'asing' => $request->asing,
                            'judul' => $request->judul,
                            'acara' => $request->acara,
                            'judulAcara' => $request->judulAcara,
                            'penyelenggaraAcara' => $request->penyelenggaraAcara,
                            'tanggal' => $request->tanggal,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    } elseif ($_SESSION['jumlahpenulis'] == 1 || $_SESSION['jumlahpenulis'] == 4){
                        DB::table('footnote')->where('jumlahfootnoteyangada', $jumlahfootnoteyangada)->where('username', $_SESSION['username'])->where('repositori', $_SESSION['repo'])->where('id', $_SESSION['edit_id'])->update([
                            'id' => $request->nourut,
                            'penulis_1' => $request->penulis_1,
                            'asing' => $request->asing,
                            'judul' => $request->judul,
                            'acara' => $request->acara,
                            'judulAcara' => $request->judulAcara,
                            'penyelenggaraAcara' => $request->penyelenggaraAcara,
                            'tanggal' => $request->tanggal,
                            'bulan' => $request->bulan,
                            'tahun' => $request->tahun,
                            'jenis' => $_SESSION['jenis'],
                            'jumlah_penulis' => $request->jumlah_penulis,
                            'repositori' => $_SESSION['repo'],
                            'username' => $_SESSION['username']
                        ]);
                    }
                    $_SESSION['apakahedit'] = 0;
                    return redirect('/anficititate/repo_core');
                }

            }
        }

        if(isset($request->keluar)){
            $_SESSION['lagiNgedit'] = 0;
            $_SESSION['jenisTabel'] = "footnote";
            return redirect('/anficititate/back');
        }

        if(isset($request->select)){
            $_SESSION['lagiNgedit'] = 0;
            $_SESSION['jenisTabel'] = "footnote";
            return redirect('/anficititate/slc_repo');
        }

        if(isset($request->rapi)){
            $_SESSION['jenisTabel'] = "footnote";
            $_SESSION['lagiNgedit'] = 0;
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
            $_SESSION['lagiNgedit'] = 0;
            $_SESSION['apakahedit'] = 0;
            $_SESSION['jumlahpenulis'] = 1;
            $_SESSION['jenis'] = 1;
            return redirect('/anficititate/repo_core');
        }

        if(isset($request->dapus)){
            $_SESSION['jenisTabel'] = "daftarPustaka";
            $_SESSION['lagiNgedit'] = 0;
            $_SESSION['jenistabel'] = 1;
            return redirect('/anficititate/repo_core');
        }

    }
}
