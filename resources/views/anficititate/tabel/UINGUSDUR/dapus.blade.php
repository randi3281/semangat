<h4 class="text-center mb-4">Daftar Pustaka</h4>
<div style="font-size: 12pt; font-family: 'Times New Roman';">
    <?php
    $_SESSION['cekjudul'] = [];
    ?>
    @foreach ($datapus as $ft)
        @if ($ft->jenis == 1)
            @include('anficititate.tabel.UINGUSDUR.dapusnya.jurnal')
        @elseif ($ft->jenis == 2)
            @include('anficititate.tabel.UINGUSDUR.dapusnya.website')
        @endif
    @endforeach
</div>
