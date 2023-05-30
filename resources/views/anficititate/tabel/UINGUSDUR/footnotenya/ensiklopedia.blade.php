@php
    if ($ft->jumlah_penulis == 3) {
        if (isset($ft->penerjemah)) {
            $kalimat = $ft->penulis_1 . ', ' . $ft->penulis_2 . ', ' . $ft->penulis_3 . ', dan ' . $ft->penerjemah . ' (Ed.), ';
        } else {
            $kalimat = $ft->penulis_1 . ', ' . $ft->penulis_2 . ', dan ' . $ft->penulis_3 . ', ';
        }
    } elseif ($ft->jumlah_penulis == 2) {
        if (isset($ft->penerjemah)) {
            $kalimat = $ft->penulis_1 . ', ' . $ft->penulis_2 . ', dan ' . $ft->penerjemah . ' (Ed.), ';
        } else {
            $kalimat = $ft->penulis_1 . ' dan ' . $ft->penulis_2 . ', ';
        }
    } elseif ($ft->jumlah_penulis == 1) {
        if (isset($ft->penerjemah)) {
            $kalimat = $ft->penulis_1 . ' dan ' . $ft->penerjemah . ' (Ed.), ';
        } else {
            $kalimat = $ft->penulis_1 . ', ';
        }
    } else {
        if (isset($ft->penerjemah)) {
            if ($ft->asing == 1) {
                $kalimat = $ft->penulis_1 . ' et al. dan ' . $ft->penerjemah . ' (Ed.), ';
            } else {
                $kalimat = $ft->penulis_1 . ' dkk. dan ' . $ft->penerjemah . ' (Ed.), ';
            }
        } else {
            if ($ft->asing == 1) {
                $kalimat = $ft->penulis_1 . ' et al., ';
            } else {
                $kalimat = $ft->penulis_1 . ' dkk., ';
            }
        }
    }
    $kalimat .= '"' . $ft->judul . '", ';

    $kalimat2 = ', Jilid ' . $ft->volume . ' (' . $ft->kota . ': ' . $ft->penerbit . ', ' . $ft->tahun . '), hlm.';

    if (isset($ft->halaman_akhir)) {
        $kalimat2 .= $ft->halaman_awal;
        $kalimat2 .= '-';
        $kalimat2 .= $ft->halaman_akhir;
    } else {
        $kalimat2 .= $ft->halaman_awal;
    }
    $kalimat2 .= '.';

@endphp
{{ $kalimat }}<i>{{ $ft->sumber }}</i>{{ $kalimat2 }}
