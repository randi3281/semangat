@php
    $_SESSION['kalimat'] = "";
@endphp
<h4 class="text-center">Daftar Footnote</h4>
<table class="table table-striped">
    <tr>
        <th style="width: 35px;">No</th>
        <th>Footnote</th>
        <th style="width: 120px; text-align: center;">Keterangan</th>
        <th style="width: 120px; text-align: center;">Jenis Footnote</th>
    </tr>
    @foreach ($data as $ft)
        @if ($ft->jenis == 1)
            @include('anficititate.tabel.UINGUSDUR.footnotenya.jurnal')
        @elseif ($ft->jenis == 2)
            @include('anficititate.tabel.UINGUSDUR.footnotenya.website')
        @endif

        <tr>
            <td>{{ $ft->id }}</td>
            <td>
                @php
                        echo $_SESSION['kalimat'];
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
                    @break

                    @case(2)
                        <option value="2" selected>Website</option>
                    @break

                    @case(3)
                        <option value="3" selected>Buku</option>
                    @break

                    @case(4)
                        <option value="4" selected>Terjemahan</option>
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
        </tr>
    @endforeach
</table>
