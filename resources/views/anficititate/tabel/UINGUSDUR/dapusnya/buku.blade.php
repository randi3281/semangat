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
        if ($ft->jumlah_penulis == 3) {
            $kalimat .= ', ';
            $kalimat .= $ft->penulis_2;
            if ($ft->jenisBuku == 'karangan') {
                $kalimat .= ', ';
                $kalimat .= $ft->penulis_3;
                $kalimat .= ', dan ';
                $kalimat .= $ft->penerjemah;
                $kalimat .= ' (Ed.). (';
            } else {
                $kalimat .= ', dan ';
                $kalimat .= $ft->penulis_3;
                $kalimat .= '. (';
            }
        } elseif ($ft->jumlah_penulis == 2) {
            if ($ft->jenisBuku == 'karangan') {
                $kalimat .= ', ';
                $kalimat .= $ft->penulis_2;
                $kalimat .= ', dan ';
                $kalimat .= $ft->penerjemah;
                $kalimat .= ' (Ed.). (';
            } else {
                $kalimat .= ' dan ';
                $kalimat .= $ft->penulis_2;
                $kalimat .= '. (';
            }
        } elseif ($ft->jumlah_penulis == 1) {
            if ($ft->jenisBuku == 'karangan') {
                $kalimat .= ' dan ';
                $kalimat .= $ft->penerjemah;
                $kalimat .= ' (Ed.). (';
            } else {
                $kalimat .= '. (';
            }
        } else {
            if ($ft->jenisBuku == 'karangan') {
                if ($ft->asing == 1) {
                    $kalimat .= ' et al."';
                } else {
                    $kalimat .= ' dkk.';
                    $kalimat .= ' dan ';
                    $kalimat .= $ft->penerjemah;
                    $kalimat .= '(Ed.). (';
                }
            } else {
                if ($ft->asing == 1) {
                    $kalimat .= ' et al.. ("';
                } else {
                    $kalimat .= ' dkk.. (';
                }
            }
        }
        $kalimat .= $ft->tahun;
        $kalimat .= '). ';
    
        $kalimat2 .= ' (';
        $kalimat2 .= $ft->nomor;
        $kalimat2 .= '), ';
    
        if (isset($ft->halaman_akhir)) {
            $kalimat2 .= $ft->halaman_awal;
            $kalimat2 .= '-';
            $kalimat2 .= $ft->halaman_akhir;
        } else {
            $kalimat2 .= $ft->halaman_awal;
        }
        $kalimat2 .= '.';
    }
@endphp
<a style="text-align: justify">
    @if ($izin == 1)
        {{ $kalimat }}<i>{{ $ft->judul }}</i>{{ $kalimat2 }}<br />
    @endif
</a>
