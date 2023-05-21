{{-- @php
    $a = ['hy'];
    $izin = 0;
    $ket = 0;
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
@endphp --}}
