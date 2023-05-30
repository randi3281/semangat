@php
    if ($ft->jumlah_penulis == 3) {
        $kalimat = $ft->penulis_1 . ', ' . $ft->penulis_2 . ', dan ' . $ft->penulis_3 . ', "';
    } elseif ($ft->jumlah_penulis == 2) {
        $kalimat = $ft->penulis_1 . ' dan ' . $ft->penulis_2 . ', "';
    } elseif ($ft->jumlah_penulis == 1) {
        $kalimat = $ft->penulis_1 . ', "';
    } else {
        if ($ft->asing == 1) {
            $kalimat = $ft->penulis_1 . ' et al., "';
        } else {
            $kalimat = $ft->penulis_1 . ' dkk., "';
        }
    }
    $kalimat .= $ft->judul . '" (' . $ft->kota . ': ';

    $kalimat2 = "";
    if (isset($ft->nomor)) {
        $kalimat2 .= ', No. ' . $ft->nomor;
    }

    if (isset($ft->bulan)) {
        $kalimat2 .= ', ' . $ft->bulan;
    }

    if (isset($ft->volume)) {
        $kalimat2 .= ', ' . $ft->volume;
    }

    if (isset($ft->tahun)) {
        $kalimat2 .= ', ' . $ft->tahun;
    }

    $kalimat2 .= '), hlm. ';

    if (isset($ft->halaman_akhir)) {
        $kalimat2 .= $ft->halaman_awal;
        $kalimat2 .= '-';
        $kalimat2 .= $ft->halaman_akhir;
    } else {
        $kalimat2 .= $ft->halaman_awal;
    }
    $kalimat2 .= '.';
@endphp
{{ $kalimat }}<i>{{ $ft->sumber }}</i>{{$kalimat2}}
