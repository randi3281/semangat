<h4 class="text-center">Daftar Footnote</h4>
<table class="table table-striped">
    <tr>
        <th style="width: 35px;">No</th>
        <th>Footnote</th>
        <th style="width: 120px; text-align: center;">Keterangan</th>
    </tr>
    @foreach ($data as $ft)
        <?php
        if ($ft->jenis == 1) {
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
        } elseif ($ft->jenis) {
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
        }
        ?>
        <tr>
            <td>{{ $ft->id }}</td>
            <td>
                @php
                    if (isset($kalimat)) {
                        echo $kalimat;
                    }
                @endphp
            </td>
            <td style=" text-align: center;">
                <a href="/edit/{{ $ft->jenis }}/{{ $ft->jumlah_penulis }}/{{ $ft->id }}"
                    style="text-decoration: none; font-weight: bold; color:blue;">EDIT </a>
                |
                <a href="/hapus/{{ $ft->id }}" style="text-decoration: none; font-weight: bold; color:red;">
                    HAPUS</a>
            </td>
        </tr>
    @endforeach
</table>
