@php
    if ($ft->jumlah_penulis == 3) {
        $kalimat = $ft->penulis_1;
        $kalimat .= ', ';
        $kalimat .= $ft->penulis_2;
        $kalimat .= ', dan ';
        $kalimat .= $ft->penulis_3;
        $kalimat .= ', "';
    } elseif ($ft->jumlah_penulis == 2) {
        $kalimat = $ft->penulis_1;
        $kalimat .= ' dan ';
        $kalimat .= $ft->penulis_2;
        $kalimat .= ', "';
    } elseif ($ft->jumlah_penulis == 1) {
        $kalimat = $ft->penulis_1;
        $kalimat .= ', "';
    } else {
        $kalimat = $ft->penulis_1;
        $kalimat .= ' dkk, "';
    }
    $kalimat .= $ft->judul;
    $kalimat .= '", ';
    $kalimat .= $ft->sumber;
    if (isset($ft->volume)) {
        $kalimat .= ', Vol. ';
        $kalimat .= $ft->volume;
        $kalimat .= ', ';
    } else {
        $kalimat .= ', ';
    }
    if (isset($ft->nomor)) {
        $kalimat .= 'No. ';
        $kalimat .= $ft->nomor;
        $kalimat .= ' (';
        $kalimat .= $ft->tahun;
        $kalimat .= '), hal. ';
    } else {
        $kalimat .= $ft->tahun;
        $kalimat .= ', hal. ';
    }
    if (isset($ft->halaman_akhir)) {
        $kalimat .= $ft->halaman_awal;
        $kalimat .= '-';
        $kalimat .= $ft->halaman_akhir;
    } else {
        $kalimat .= $ft->halaman_awal;
    }
    $kalimat .= '.';
    $_SESSION['kalimat'] = $kalimat;
@endphp
