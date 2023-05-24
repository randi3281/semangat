<h4 class="text-center mb-4">Daftar Pustaka</h4>
<div style="font-size: 12pt; font-family: 'Times New Roman';">
    <?php
    $_SESSION['cekjudul'] = ['halo'];
    ?>
    @foreach ($datapus as $ft)
        @if ($ft->jenis == 1)
            @include('anficititate.tabel.UINGUSDUR.dapusnya.jurnal')
        @elseif ($ft->jenis == 2)
            @include('anficititate.tabel.UINGUSDUR.dapusnya.website')
        @elseif ($ft->jenis == 3)
            @include('anficititate.tabel.UINGUSDUR.dapusnya.buku')
        @elseif ($ft->jenis == 4)
            @include('anficititate.tabel.UINGUSDUR.dapusnya.terjemahan')
        @elseif ($ft->jenis == 5)
            @include('anficititate.tabel.UINGUSDUR.dapusnya.majalah')
        @elseif ($ft->jenis == 6)
            @include('anficititate.tabel.UINGUSDUR.dapusnya.suratKabar')
        @elseif ($ft->jenis == 7)
            @include('anficititate.tabel.UINGUSDUR.dapusnya.karanganTidakDiterbitkan')
        @elseif ($ft->jenis == 8)
            @include('anficititate.tabel.UINGUSDUR.dapusnya.wawancara')
        @elseif ($ft->jenis == 9)
            @include('anficititate.tabel.UINGUSDUR.dapusnya.pidato')
        @elseif ($ft->jenis == 10)
            @include('anficititate.tabel.UINGUSDUR.dapusnya.komentar')
        @elseif ($ft->jenis == 11)
            @include('anficititate.tabel.UINGUSDUR.dapusnya.ensiklopedia')
        @elseif ($ft->jenis == 12)
            @include('anficititate.tabel.UINGUSDUR.dapusnya.makalah')
        @endif
    @endforeach
</div>
