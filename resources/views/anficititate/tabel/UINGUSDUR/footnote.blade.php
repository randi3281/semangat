<h4 class="text-center">Daftar Footnote</h4>
<table class="table table-striped">
    <tr>
        <th style="width: 35px;">No</th>
        <th>Footnote</th>
        <th style="text-align: center;">Jenis Footnote</th>
        <th style="width: 120px; text-align: center;">Keterangan</th>
    </tr>
    @foreach ($data as $ft)

    <tr>
        <td>{{ $ft->id }}</td>

        <td>
                @if ($ft->jenis == 1)
                    @include('anficititate.tabel.UINGUSDUR.footnotenya.jurnal')
                @elseif ($ft->jenis == 2)
                    @include('anficititate.tabel.UINGUSDUR.footnotenya.website')
                @elseif ($ft->jenis == 3)
                    @include('anficititate.tabel.UINGUSDUR.footnotenya.buku')
                @elseif ($ft->jenis == 4)
                    @include('anficititate.tabel.UINGUSDUR.footnotenya.terjemahan')
                @elseif ($ft->jenis == 5)
                    @include('anficititate.tabel.UINGUSDUR.footnotenya.majalah')
                @elseif ($ft->jenis == 6)
                    @include('anficititate.tabel.UINGUSDUR.footnotenya.suratKabar')
                @elseif ($ft->jenis == 7)
                    @include('anficititate.tabel.UINGUSDUR.footnotenya.karanganTidakDiterbitkan')
                @elseif ($ft->jenis == 8)
                    @include('anficititate.tabel.UINGUSDUR.footnotenya.wawancara')
                @elseif ($ft->jenis == 9)
                    @include('anficititate.tabel.UINGUSDUR.footnotenya.pidato')
                @elseif ($ft->jenis == 10)
                    @include('anficititate.tabel.UINGUSDUR.footnotenya.komentar')
                @elseif ($ft->jenis == 11)
                    @include('anficititate.tabel.UINGUSDUR.footnotenya.ensiklopedia')
                @elseif ($ft->jenis == 12)
                    @include('anficititate.tabel.UINGUSDUR.footnotenya.makalah')
                @endif
            </td>
            <td style=" text-align: center;">
                @switch($ft->jenis)
                    @case(1)
                        <option value="1" selected>Jurnal</option>
                    @break

                    @case(2)
                        <option value="2" selected>Website</option>
                    @break

                    @case(3)
                        <option value="3" selected>Buku</option>
                    @break

                    @case(4)
                        <option value="4" selected>Buku Tanpa Penulis</option>
                    @break

                    @case(5)
                        <option value="5" selected>Majalah</option>
                    @break

                    @case(6)
                        <option value="6" selected>Surat Kabar</option>
                    @break

                    @case(7)
                        <option value="7" selected>Karangan Tidak Diterbitkan</option>
                    @break

                    @case(8)
                        <option value="8" selected>Wawancara</option>
                    @break

                    @case(9)
                        <option value="9" selected>Pidato</option>
                    @break

                    @case(10)
                        <option value="10" selected>Komentar</option>
                    @break

                    @case(11)
                        <option value="11" selected>Ensiklopedia</option>
                    @break

                    @case(12)
                        <option value="12" selected>Makalah</option>
                    @break
                @endswitch
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

        </tr>
    @endforeach
</table>
