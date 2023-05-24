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
        $kalimat = $ft->penulis_1 . '. (' . $ft->tahun . '). ';
        $kalimat2 = '. ' . $ft->sumber . '.';
    }
@endphp
<a style="text-align: justify">
    @if ($izin == 1)
        {{ $kalimat }}<i>{{ $ft->judul }}</i>{{ $kalimat2 }}<br />
    @endif
</a>
