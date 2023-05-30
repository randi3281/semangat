@php
    $kalimat = $ft->judul . '. (disadur dari ' . $ft->penulis_1 . ', ' . $ft->tahun . ': ';
    if (isset($ft->halaman_akhir)) {
        $kalimat .= $ft->halaman_awal;
        $kalimat .= '-';
        $kalimat .= $ft->halaman_akhir;
    } else {
        $kalimat .= $ft->halaman_awal;
    }
    $kalimat .= ')';
@endphp
{{ $kalimat }}
