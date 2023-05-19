@php
    $kalimat = $ft->judul_web;
    $kalimat .= ', "';
    $kalimat .= $ft->deskripsi_web;
    $kalimat .= '", ';
    $kalimat .= $ft->tahun_web;
    $kalimat .= ', ';
    $kalimat .= $ft->link_web;
    $kalimat .= '. Diakses pada ';
    $kalimat .= $ft->tanggal_diakses_web;
    $kalimat .= '.';
    $_SESSION['kalimat'] = $kalimat;
@endphp
