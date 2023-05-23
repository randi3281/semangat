@php
    $izin = 0;
    // $ket = 0;
    // for ($w = 0; $w <= $ft->id; $w++) {
    //     if ($izin = 0) {
    //     } else {
    //         if (isset($_SESSION['cekjudul'][$w])) {
    //             if ($ft->judul == $_SESSION['cekjudul'][$w]) {
    //                 $izin = 0;
    //             } else {
    //                 $izin = 1;
    //                 $ket = 0;
    //             }
    //         } else {
    //             for ($o = 1; $o <= $ft->id; $o++) {
    //                 if (isset($_SESSION['cekjudul'][$o])) {
    //                     if ($ft->judul == $_SESSION['cekjudul'][$o]) {
    //                         $ket = 1;
    //                     }
    //                 }
    //             }
    //             if ($ket == 1) {
    //                 $izin = 0;
    //                 array_push($_SESSION['cekjudul'], '');
    //             } else {
    //                 $izin = 1;
    //                 array_push($_SESSION['cekjudul'], $ft->judul);
    //             }
    //         }
    //     }
    // }

    for ($i = 0; $i <= count($_SESSION['cekjudul']) - 1; $i++) {
        if ($ft->judul == $_SESSION['cekjudul'][$i]) {
            $izin = 0;
            break;
        } else {
            $izin = 1;
            // break;
        }
    }

    if ($izin == 1) {
        array_push($_SESSION['cekjudul'], $ft->judul);
        $kal = $ft->penulis_1;
        $kali = explode(' ', $kal);
        $lika = end($kali);
        $kalimat = $lika;
        if ($lika == $ft->penulis_1) {
        } else {
            $kalimat .= ', ';
        }
        foreach ($kali as $kila) {
            if ($kila == $lika) {
            } else {
                $kalimat .= ' ';
                $kalimat .= $kila;
            }
        }
        if ($ft->jumlah_penulis == 3) {
            $kalimat .= ', ';
            $kalimat .= $ft->penulis_2;
            $kalimat .= ', dan ';
            $kalimat .= $ft->penulis_3;
            $kalimat .= '. (';
        } elseif ($ft->jumlah_penulis == 2) {
            $kalimat .= ', ';
            $kalimat .= $ft->penulis_2;
            $kalimat .= '. (';
        } elseif ($ft->jumlah_penulis == 1) {
            $kalimat .= '. (';
        } else {
            $kalimat .= ' dkk. (';
        }
        $kalimat .= $ft->tahun;
        $kalimat .= '). ';
        $kalimat .= $ft->judul;
        $kalimat .= '. ';
        $kalimat .= $ft->kota;
        $kalimat .= ': ';
        $kalimat .= $ft->sumber;
        $kalimat .= '.';
        echo $kalimat . '<br/> <br/>';
    }
@endphp
