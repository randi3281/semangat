@php
    $kalimat = '';
    $kalimat2 = '';
    $izin = 0;
    for ($i = 0; $i <= count($_SESSION['cekjudul']) - 1; $i++) {
        if ($ft->judul == $_SESSION['cekjudul'][$i]) {
            $izin = 0;
            break;
        } else {
            $izin = 1;
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
        $kalimat .= '. (' . $ft->tahun . ', ' . $ft->bulan . ' ' . $ft->tanggal . '). ' . $ft->judul .'. '.$ft->sumber.'.';
    }
@endphp
<p style="text-align: justify">
    @if ($izin == 1)
        {{ $kalimat }}
    @endif
</p>
