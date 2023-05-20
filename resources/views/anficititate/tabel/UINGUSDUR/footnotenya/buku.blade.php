@if ($ft->jenisBuku == 'normal')
    @php
        if ($ft->jumlah_penulis == 3) {
            $kalimat = $ft->penulis_1 . ', ' . $ft->penulis_2 . ', dan ' . $ft->penulis_3 . ', ';
        } elseif ($ft->jumlah_penulis == 2) {
            $kalimat = $ft->penulis_1 . ' dan ' . $ft->penulis_2 . ', ';
        } elseif ($ft->jumlah_penulis == 1) {
            $kalimat = $ft->penulis_1 . ', ';
        } else {
            if ($ft->asing == 1) {
                $kalimat = $ft->penulis_1 . ' et al., ';
            } else {
                $kalimat = $ft->penulis_1 . ' dkk., ';
            }
        }

        $kalimat2 = '';

        if (isset($ft->volume)) {
            $kalimat2 .= ', Cet. Ke-' . $ft->volume;
        }

        if (isset($ft->nomor)) {
            $kalimat2 .= ', Jilid ' . $ft->nomor;
        }

        $kalimat2 .= ' (' . $ft->kota . ': ' . $ft->sumber . ', ' . $ft->tahun . '), hlm. ';

        if (isset($ft->halaman_akhir)) {
            $kalimat2 .= $ft->halaman_awal;
            $kalimat2 .= '-';
            $kalimat2 .= $ft->halaman_akhir;
        } else {
            $kalimat2 .= $ft->halaman_awal;
        }
        $kalimat2 .= '.';

    @endphp
    {{ $kalimat }}<i>{{ $ft->judul }}</i>{{ $kalimat2 }}
@elseif ($ft->jenisBuku == 'karangan')
    @php
        if ($ft->jumlah_penulis == 3) {
            $kalimat = $ft->penulis_1 . ', ' . $ft->penulis_2 . ', dan ' . $ft->penulis_3 . ' (Ed.), ';
        } elseif ($ft->jumlah_penulis == 2) {
            $kalimat = $ft->penulis_1 . ' dan ' . $ft->penulis_2 . ' (Ed.), ';
        } elseif ($ft->jumlah_penulis == 1) {
            $kalimat = $ft->penulis_1 . ' (Ed.), ';
        } else {
            if ($ft->asing == 1) {
                $kalimat = $ft->penulis_1 . ' et al. (Ed.), ';
            } else {
                $kalimat = $ft->penulis_1 . ' dkk. (Ed.), ';
            }
        }

        $kalimat2 = '';

        if (isset($ft->volume)) {
            $kalimat2 .= ', Cet. Ke-' . $ft->volume;
        }

        if (isset($ft->nomor)) {
            $kalimat2 .= ', Jilid ' . $ft->nomor;
        }

        $kalimat2 .= ' (' . $ft->kota . ': ' . $ft->sumber . ', ' . $ft->tahun . '), hlm. ';

        if (isset($ft->halaman_akhir)) {
            $kalimat2 .= $ft->halaman_awal;
            $kalimat2 .= '-';
            $kalimat2 .= $ft->halaman_akhir;
        } else {
            $kalimat2 .= $ft->halaman_awal;
        }
        $kalimat2 .= '.';

    @endphp
    {{ $kalimat }}<i>{{ $ft->judul }}</i>{{ $kalimat2 }}
@elseif($ft->jenisBuku == 'terjemahan')
    @php
        if ($ft->jumlah_penulis == 3) {
            $kalimat = $ft->penulis_1 . ', ' . $ft->penulis_2 . ', dan ' . $ft->penulis_3 . ', ';
        } elseif ($ft->jumlah_penulis == 2) {
            $kalimat = $ft->penulis_1 . ' dan ' . $ft->penulis_2 . ', ';
        } elseif ($ft->jumlah_penulis == 1) {
            $kalimat = $ft->penulis_1 . ', ';
        } else {
            if ($ft->asing == 1) {
                $kalimat = $ft->penulis_1 . ' et al., ';
            } else {
                $kalimat = $ft->penulis_1 . ' dkk., ';
            }
        }

        $kalimat2 = ', terjemahan ' . $ft->penerjemah . ' (' . $ft->kota . ': ' . $ft->sumber . ', ' . $ft->tahun . '), hlm. ';

        if (isset($ft->halaman_akhir)) {
            $kalimat2 .= $ft->halaman_awal;
            $kalimat2 .= '-';
            $kalimat2 .= $ft->halaman_akhir;
        } else {
            $kalimat2 .= $ft->halaman_awal;
        }
        $kalimat2 .= '.';

    @endphp
    {{ $kalimat }}<i>{{ $ft->judul }}</i>{{ $kalimat2 }}
@endif
