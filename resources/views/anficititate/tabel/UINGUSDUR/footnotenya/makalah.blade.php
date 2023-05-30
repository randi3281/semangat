@php
    if ($ft->jumlah_penulis == 3) {
        $kalimat = $ft->penulis_1 . ', ' . $ft->penulis_2 . ', dan ' . $ft->penulis_3 . ', "' . $ft->judul . '", Makalah';
    } elseif ($ft->jumlah_penulis == 2) {
        $kalimat = $ft->penulis_1 . ' dan ' . $ft->penulis_2 . ', "' . $ft->judul . '", Makalah';
    } elseif ($ft->jumlah_penulis == 1) {
        $kalimat = $ft->penulis_1 . ', "' . $ft->judul . '", Makalah';
    } else {
        if ($ft->asing == 1) {
            $kalimat = $ft->penulis_1 . ' et al., "' . $ft->judul . '", Makalah';
        } else {
            $kalimat = $ft->penulis_1 . ' dkk., "' . $ft->judul . '", Makalah';
        }
    }

    if (isset($ft->acara) && isset($ft->judulAcara) && isset($ft->penyelenggaraAcara)) {
        $kalimat .= ' Disampaikan dalam ' . $ft->acara . ', ';
        $kalimat2 = ', yang diselenggarakan oleh ' . $ft->penyelenggaraAcara . ', ' . $ft->tanggal . ' ' . $ft->bulan . ' ' . $ft->tahun . '.';
    } elseif (isset($ft->penyelenggaraAcara)) {
        $kalimat .= ', ' . $ft->penyelenggaraAcara . ', ' . $ft->tanggal . ' ' . $ft->bulan . ' ' . $ft->tahun . '.';
    }

@endphp
@if (isset($ft->judulAcara))
    {{ $kalimat }}<i>{{ $ft->judulAcara }}</i>{{ $kalimat2 }}
@else
    {{ $kalimat }}
@endif
