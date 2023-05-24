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
        array_push($_SESSION['cekjudul'], $ft->judul);
        if ($ft->jumlah_penulis == 1) {
            $kali = explode(' ', $ft->penulis_1);
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

            $kalimat .= '. (' . $ft->tahun . ', ' . $ft->bulan . ' ' . $ft->tanggal . '). '.$ft->sumber.'. ';
            $kalimat2 .= ', h.';

            if (isset($ft->halaman_akhir)) {
                $kalimat2 .= $ft->halaman_awal;
                $kalimat2 .= '-';
                $kalimat2 .= $ft->halaman_akhir;
            } else {
                $kalimat2 .= $ft->halaman_awal;
            }
            $kalimat2 .= '.';
        } else {
            $kalimat .= $ft->sumber. '. (' . $ft->tahun . ', ' . $ft->bulan . ' ' . $ft->tanggal . '). ';
            $kalimat2 .= ', h.';

            if (isset($ft->halaman_akhir)) {
                $kalimat2 .= $ft->halaman_awal;
                $kalimat2 .= '-';
                $kalimat2 .= $ft->halaman_akhir;
            } else {
                $kalimat2 .= $ft->halaman_awal;
            }
            $kalimat2 .= '.';
        }
    }
@endphp
<p style="text-align: justify">
    @if ($izin == 1)
        {{ $kalimat }}<i>{{ $ft->judul }}</i>{{ $kalimat2 }}
    @endif
</p>
