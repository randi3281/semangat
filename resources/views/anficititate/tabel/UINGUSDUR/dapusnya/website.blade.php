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
            // break;
        }
    }

    if ($izin == 1) {
        $kal = $ft->deskripsi_web;
        $kali = explode(' ', $kal);
        $lika = end($kali);
        $kalimat = $lika;
        $kalimat .= ', ';
        foreach ($kali as $kila) {
            if ($kila == $lika) {
            } else {
                $kalimat .= ' ';
                $kalimat .= $kila;
            }
        }
        $kalimat .= '. ';
        $kalimat .= $ft->link_web;
        $kalimat .= ', diakses pada ';
        $kalimat .= $ft->tanggal_diakses_web;
        $kalimat .= '. ';
        // echo $kalimat . '<br/> <br/>';
    }
@endphp
<a style="text-align: justify">
    @if ($izin == 1)
        {{ $kalimat }}<br/>
    @endif
</a>
