@php
    $kalimat = '';
    $kalimat2 = '';
    $izin = 0;
    for ($i = 0; $i <= count($_SESSION['cekjudul']) - 1; $i++) {
        if ($ft->deskripsi_web == $_SESSION['cekjudul'][$i]) {
            $izin = 0;
            break;
        } else {
            $izin = 1;
            // break;
        }
    }

    if ($izin == 1) {
        array_push($_SESSION['cekjudul'], $ft->deskripsi_web);
        $kal = $ft->tanggal;
        $kali = explode(' ', $kal);
        $lika = end($kali);
        $kalimat = $ft->judul_web . '. (';
        $kalimat .= $lika;
        $kalimat .= ', ';
        foreach ($kali as $kila) {
            if ($kila == $lika) {
            } else {
                $kalimat .= ' ';
                $kalimat .= $kila;
            }
        }
        $kalimat .= '). ' . $ft->deskripsi_web . '. Diakses pada ' . $ft->tanggal_diakses_web . ' dari ' . $ft->link_web . '.';
        // echo $kalimat . '<br/> <br/>';
    }
@endphp
<p style="text-align: justify">
    @if ($izin == 1)
        {{ $kalimat }}
    @endif
</p>
