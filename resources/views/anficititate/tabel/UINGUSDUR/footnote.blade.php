<h4 class="text-center">Daftar Footnote</h4>
<table class="table table-striped">
    <tr>
        <th style="width: 35px;">No</th>
        <th>Footnote</th>
        <th style="width: 120px; text-align: center;">Keterangan</th>
        <th style="width: 120px; text-align: center;">Jenis Footnote</th>
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
                <input type="hidden" value="">
                <a href="/anficititate/core_repo_edit/{{ $ft->id }}"
                    style="text-decoration: none; font-weight: bold; color:blue;">EDIT </a>
                |
                <a href="/anficititate/core_repo_hapus/{{ $ft->id }}"
                    style="text-decoration: none; font-weight: bold; color:red;">
                    HAPUS</a>
            </td>
            <td style=" text-align: center;">
                @switch($ft->jenis)
                    @case(1)
                        <option value="1" selected>Jurnal</option>
                        <option value="2">Website</option>
                        <option value="3">Buku</option>
                        <option value="4">Terjemahan</option>
                        <option value="5">Majalah</option>
                        <option value="6">Surat Kabar</option>
                        <option value="7">Karangan Tidak Diterbitkan</option>
                        <option value="8">Wawancara</option>
                        <option value="9">Pidato</option>
                        <option value="10">Komentar</option>
                        <option value="11">Ensiklopedia</option>
                        <option value="12">Makalah</option>
                    @break

                    @case(2)
                        <option value="1">Jurnal</option>
                        <option value="2" selected>Website</option>
                        <option value="3">Buku</option>
                        <option value="4">Terjemahan</option>
                        <option value="5">Majalah</option>
                        <option value="6">Surat Kabar</option>
                        <option value="7">Karangan Tidak Diterbitkan</option>
                        <option value="8">Wawancara</option>
                        <option value="9">Pidato</option>
                        <option value="10">Komentar</option>
                        <option value="11">Ensiklopedia</option>
                        <option value="12">Makalah</option>
                    @break

                    @case(3)
                        <option value="1">Jurnal</option>
                        <option value="2">Website</option>
                        <option value="3" selected>Buku</option>
                        <option value="4">Terjemahan</option>
                        <option value="5">Majalah</option>
                        <option value="6">Surat Kabar</option>
                        <option value="7">Karangan Tidak Diterbitkan</option>
                        <option value="8">Wawancara</option>
                        <option value="9">Pidato</option>
                        <option value="10">Komentar</option>
                        <option value="11">Ensiklopedia</option>
                        <option value="12">Makalah</option>
                    @break

                    @case(4)
                        <option value="1">Jurnal</option>
                        <option value="2">Website</option>
                        <option value="3">Buku</option>
                        <option value="4" selected>Terjemahan</option>
                        <option value="5">Majalah</option>
                        <option value="6">Surat Kabar</option>
                        <option value="7">Karangan Tidak Diterbitkan</option>
                        <option value="8">Wawancara</option>
                        <option value="9">Pidato</option>
                        <option value="10">Komentar</option>
                        <option value="11">Ensiklopedia</option>
                        <option value="12">Makalah</option>
                    @break

                    @case(5)
                        <option value="1">Jurnal</option>
                        <option value="2">Website</option>
                        <option value="3">Buku</option>
                        <option value="4">Terjemahan</option>
                        <option value="5" selected>Majalah</option>
                        <option value="6">Surat Kabar</option>
                        <option value="7">Karangan Tidak Diterbitkan</option>
                        <option value="8">Wawancara</option>
                        <option value="9">Pidato</option>
                        <option value="10">Komentar</option>
                        <option value="11">Ensiklopedia</option>
                        <option value="12">Makalah</option>
                    @break

                    @case(6)
                        <option value="1">Jurnal</option>
                        <option value="2">Website</option>
                        <option value="3">Buku</option>
                        <option value="4">Terjemahan</option>
                        <option value="5">Majalah</option>
                        <option value="6" selected>Surat Kabar</option>
                        <option value="7">Karangan Tidak Diterbitkan</option>
                        <option value="8">Wawancara</option>
                        <option value="9">Pidato</option>
                        <option value="10">Komentar</option>
                        <option value="11">Ensiklopedia</option>
                        <option value="12">Makalah</option>
                    @break

                    @case(7)
                        <option value="1">Jurnal</option>
                        <option value="2">Website</option>
                        <option value="3">Buku</option>
                        <option value="4">Terjemahan</option>
                        <option value="5">Majalah</option>
                        <option value="6">Surat Kabar</option>
                        <option value="7" selected>Karangan Tidak Diterbitkan</option>
                        <option value="8">Wawancara</option>
                        <option value="9">Pidato</option>
                        <option value="10">Komentar</option>
                        <option value="11">Ensiklopedia</option>
                        <option value="12">Makalah</option>
                    @break

                    @case(8)
                        <option value="1">Jurnal</option>
                        <option value="2">Website</option>
                        <option value="3">Buku</option>
                        <option value="4">Terjemahan</option>
                        <option value="5">Majalah</option>
                        <option value="6">Surat Kabar</option>
                        <option value="7">Karangan Tidak Diterbitkan</option>
                        <option value="8" selected>Wawancara</option>
                        <option value="9">Pidato</option>
                        <option value="10">Komentar</option>
                        <option value="11">Ensiklopedia</option>
                        <option value="12">Makalah</option>
                    @break

                    @case(9)
                        <option value="1">Jurnal</option>
                        <option value="2">Website</option>
                        <option value="3">Buku</option>
                        <option value="4">Terjemahan</option>
                        <option value="5">Majalah</option>
                        <option value="6">Surat Kabar</option>
                        <option value="7">Karangan Tidak Diterbitkan</option>
                        <option value="8">Wawancara</option>
                        <option value="9" selected>Pidato</option>
                        <option value="10">Komentar</option>
                        <option value="11">Ensiklopedia</option>
                        <option value="12">Makalah</option>
                    @break

                    @case(10)
                        <option value="1">Jurnal</option>
                        <option value="2">Website</option>
                        <option value="3">Buku</option>
                        <option value="4">Terjemahan</option>
                        <option value="5">Majalah</option>
                        <option value="6">Surat Kabar</option>
                        <option value="7">Karangan Tidak Diterbitkan</option>
                        <option value="8">Wawancara</option>
                        <option value="9">Pidato</option>
                        <option value="10" selected>Komentar</option>
                        <option value="11">Ensiklopedia</option>
                        <option value="12">Makalah</option>
                    @break

                    @case(11)
                        <option value="1">Jurnal</option>
                        <option value="2">Website</option>
                        <option value="3">Buku</option>
                        <option value="4">Terjemahan</option>
                        <option value="5">Majalah</option>
                        <option value="6">Surat Kabar</option>
                        <option value="7">Karangan Tidak Diterbitkan</option>
                        <option value="8">Wawancara</option>
                        <option value="9">Pidato</option>
                        <option value="10">Komentar</option>
                        <option value="11" selected>Ensiklopedia</option>
                        <option value="12">Makalah</option>
                    @break

                    @case(12)
                        <option value="1">Jurnal</option>
                        <option value="2">Website</option>
                        <option value="3">Buku</option>
                        <option value="4">Terjemahan</option>
                        <option value="5">Majalah</option>
                        <option value="6">Surat Kabar</option>
                        <option value="7">Karangan Tidak Diterbitkan</option>
                        <option value="8">Wawancara</option>
                        <option value="9">Pidato</option>
                        <option value="10">Komentar</option>
                        <option value="11">Ensiklopedia</option>
                        <option value="12" selected>Makalah</option>
                    @break
                @endswitch
            </td>
        </tr>
    @endforeach
</table>
