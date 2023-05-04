<h4 class="text-center mb-4">Daftar Pustaka</h4>
<div style="font-size: 12pt; font-family: 'Times New Roman';">
    <?php
    $a = ['hy'];
    ?>
    @foreach ($datapus as $ft)
        <?php
        $izin = 0;
        $ket = 0;
        if ($ft->jenis == 1) {
            for ($w = 1; $w <= $ft->id; $w++) {
                if (isset($a[$w])) {
                    if ($ft->judul == $a[$w]) {
                        $izin = 0;
                    } else {
                        // $izin = 1;
                        // $ket = 1;
                    }
                } else {
                    for ($o = 1; $o <= $ft->id; $o++) {
                        if (isset($a[$o])) {
                            if ($ft->judul == $a[$o]) {
                                $ket = 1;
                            }
                        }
                    }
                    if ($ket == 1) {
                        $izin = 0;
                        array_push($a, 'hy');
                    } else {
                        $izin = 1;
                        array_push($a, $ft->judul);
                    }
                }
            }

            if ($izin == 1) {
                $kal = $ft->penulis_1;
                $kali = explode(' ', $kal);
                $lika = end($kali);
                $kalimat = $lika;
                $kalimat .= ', ';
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
                    $kalimat .= '. ';
                } elseif ($ft->jumlah_penulis == 2) {
                    $kalimat .= ', ';
                    $kalimat .= $ft->penulis_2;
                    $kalimat .= '. ';
                } elseif ($ft->jumlah_penulis == 1) {
                    $kalimat .= '. ';
                } else {
                    $kalimat .= ' dkk. ';
                }
                $kalimat .= $ft->tahun;
                $kalimat .= '. ';
                $kalimat .= $ft->judul;
                $kalimat .= '. ';
                $kalimat .= $ft->kota;
                $kalimat .= ': ';
                $kalimat .= $ft->sumber;
                $kalimat .= '.';
                echo $kalimat . '<br/> <br/>';
            }
        } elseif ($ft->jenis == 2) {
            for ($y = 1; $y <= $ft->id; $y++) {
                if (isset($a[$y])) {
                    if ($ft->deskripsi_web == $a[$y]) {
                        $izin = 0;
                    } else {
                        // $izin = 1;
                        // $ket = 1;
                    }
                } else {
                    for ($t = 1; $t <= $ft->id; $t++) {
                        if (isset($a[$t])) {
                            if ($ft->deskripsi_web == $a[$t]) {
                                $ket = 1;
                            }
                        }
                    }
                    if ($ket == 1) {
                        $izin = 0;
                        array_push($a, 'hy');
                    } else {
                        $izin = 1;
                        array_push($a, $ft->deskripsi_web);
                    }
                }
            }

            if ($izin == 1) {
                $kal = $ft->judul_web;
                $kali = explode(' ', $kal);
                $lika = end($kali);
                $kalimata = $lika;
                $kalimata .= ', ';
                foreach ($kali as $kila) {
                    if ($kila == $lika) {
                    } else {
                        $kalimata .= ' ';
                        $kalimata .= $kila;
                    }
                }
                $kalimata .= '. ';
                $kalimata .= $ft->link_web;
                $kalimata .= ', diakses pada ';
                $kalimata .= $ft->tanggal_diakses_web;
                $kalimata .= '. ';
                echo $kalimata . '<br/> <br/>';
            }
        }
        ?>
    @endforeach
</div>
