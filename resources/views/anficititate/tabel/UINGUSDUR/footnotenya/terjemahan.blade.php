@php
    $kalimat = $ft->penulis_1 . ', ' . $ft->judul . ', ';

    $kalimat2 = ' (' . $ft->kota . ', ' . $ft->tahun . '), hlm. ';

    if (isset($ft->halaman_akhir)) {
        $kalimat2 .= $ft->halaman_awal;
        $kalimat2 .= '-';
        $kalimat2 .= $ft->halaman_akhir;
    } else {
        $kalimat2 .= $ft->halaman_awal;
    }
    $kalimat2 .= '.';

@endphp
{{ $kalimat }}<i>{{ $ft->sumber}}</i>{{ $kalimat2 }}
