<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FootnoteController extends Controller
{
    public function index(){
        return redirect('/1/1');
    }

    public function indexpenulis($jenis, $jumlahpenulis){
        $data = DB::table('footnote')->orderBy('id', 'DESC')->paginate(10);
        $nom = DB::table('footnote')->orderBy('id', 'DESC')->first();
        $nomo = $nom->id + 1;
        $apakahedit = 0;
        $dapus = 0;
        return view('anficititate.footnote', ['jenis' => $jenis, 'jumlahpenulis' => $jumlahpenulis, 'data' => $data, 'nomor' => $nomo, 'apakahedit' => $apakahedit, 'dapus' => $dapus]);
    }
    public function dapus($jenis, $jumlahpenulis){
        $data = DB::table('footnote')->get();
        $nom = DB::table('footnote')->orderBy('id', 'DESC')->first();
        $nomo = $nom->id + 1;
        $apakahedit = 0;
        $dapus = 1;
        return view('anficititate.footnote', ['jenis' => $jenis, 'jumlahpenulis' => $jumlahpenulis, 'dataa' => $data, 'nomor' => $nomo, 'apakahedit' => $apakahedit, 'dapus' => $dapus]);
    }
    public function hapus($ft){
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
    public function tampiledit($jenis, $jumlahpenulis, $ft){
        $data = DB::table('footnote')->orderBy('id', 'DESC')->paginate(10);
        $nom = DB::table('footnote')->orderBy('id', 'DESC')->first();
        $editan = DB::table('footnote')->where('id', $ft)->get();
        $nomo = 0;
        $dapus = 0;
        foreach($editan as $ediit){
            $nomo = $ediit->id;
        }
        $apakahedit = 1;
        return view('anficititate.footnote', ['jenis' => $jenis, 'jumlahpenulis' => $jumlahpenulis, 'data' => $data, 'nomor' => $nomo, 'editan' => $editan, 'apakahedit' => $apakahedit, 'dapus' => $dapus]);
    }
    public function kelola(Request $request){
        if(isset($request->tomboljenis)){
            switch($request->jenis_footnote){
                case(1):
                    return redirect('/1/'.$request->jp);
                    break;
                case(2):
                    return redirect('/2/'.$request->jp);
                    break;
            }

        }

        if(isset($request->input)){
            if($request->jenisf == 1){
                $urutan = $request->urut + 1;
                if($request->nourut !== $request->$urutan){
                    for($i = $request->urut; $i >= $request->nourut; $i--){
                        $x = $i + 1;
                        DB::table('footnote')->where('id', $i)->update([
                            'id' => $x
                        ]);
                    }
                }
                if(isset($request->penulis_1)&&isset($request->penulis_2)&&isset($request->penulis_3)){
                    DB::table('footnote')->insert([
                        'id' => $request->nourut,
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
                    DB::table('footnote')->insert([
                        'id' => $request->nourut,
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
                    DB::table('footnote')->insert([
                        'id' => $request->nourut,
                        'penulis_1' => $request->penulis_1,
                        'judul' => $request->judul,
                        'kota' => $request->kota,
                        'sumber' => $request->sumber,
                        'volume' => $request->volume,
                        'nomor' => $request->nomor,
                        'tahun' => $request->tahun,
                        'jenis' => $request->jenisf,
                        'halaman_awal' => $request->halaman_awal,
                        'halaman_akhir' => $request->halaman_akhir,
                        'jumlah_penulis' => $request->jumlah_penulis
                    ]);
                }
                return redirect('/');
            } elseif($request->jenisf == 2){
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
                    'jenis' => $request->jenisf,
                    'jumlah_penulis' => 1,
                    'tanggal_diakses_web' => $request->tanggal_diakses_web
                ]);
                return redirect('/2/'.$request->jenisf);
            }

        } elseif(isset($request->edit)){
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
        } elseif(isset($request->rapi)){
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
                return redirect('/1/1');
            }
        } elseif(isset($request->dapus)){

            return redirect('/dapus/1/1');
        }

    }
}