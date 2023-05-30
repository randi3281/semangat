@switch($jenis)
    @case(1)
        @include('anficititate.kelola.UINGUSDUR.normal.jurnal')
    @break

    @case(2)
        @include('anficititate.kelola.UINGUSDUR.normal.website')
    @break

    @case(3)
        @include('anficititate.kelola.UINGUSDUR.normal.buku')
    @break

    @case(4)
        @include('anficititate.kelola.UINGUSDUR.normal.terjemahan')
    @break

    @case(5)
        @include('anficititate.kelola.UINGUSDUR.normal.majalah')
    @break

    @case(6)
        @include('anficititate.kelola.UINGUSDUR.normal.suratKabar')
    @break

    @case(7)
        @include('anficititate.kelola.UINGUSDUR.normal.karanganTidakDiterbitkan')
    @break

    @case(8)
        @include('anficititate.kelola.UINGUSDUR.normal.wawancara')
    @break

    @case(9)
        @include('anficititate.kelola.UINGUSDUR.normal.pidato')
    @break

    @case(10)
        @include('anficititate.kelola.UINGUSDUR.normal.komentar')
    @break

    @case(11)
        @include('anficititate.kelola.UINGUSDUR.normal.ensiklopedia')
    @break

    @case(12)
        @include('anficititate.kelola.UINGUSDUR.normal.makalah')
    @break
@endswitch
