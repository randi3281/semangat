@foreach ($editan as $edita)
    @switch($edita->jenis)
        @case(1)
            @include('anficititate.kelola.UINGUSDUR.edit.jurnal')
        @break

        @case(2)
            @include('anficititate.kelola.UINGUSDUR.edit.website')
        @break

        @case(3)
            @include('anficititate.kelola.UINGUSDUR.edit.buku')
        @break

        @case(4)
            @include('anficititate.kelola.UINGUSDUR.edit.terjemahan')
        @break

        @case(5)
            @include('anficititate.kelola.UINGUSDUR.edit.majalah')
        @break

        @case(6)
            @include('anficititate.kelola.UINGUSDUR.edit.suratKabar')
        @break

        @case(7)
            @include('anficititate.kelola.UINGUSDUR.edit.karanganTidakDiterbitkan')
        @break

        @case(8)
            @include('anficititate.kelola.UINGUSDUR.edit.wawancara')
        @break

        @case(9)
            @include('anficititate.kelola.UINGUSDUR.edit.pidato')
        @break

        @case(10)
            @include('anficititate.kelola.UINGUSDUR.edit.komentar')
        @break

        @case(11)
            @include('anficititate.kelola.UINGUSDUR.edit.ensiklopedia')
        @break

        @case(12)
            @include('anficititate.kelola.UINGUSDUR.edit.makalah')
        @break
    @endswitch
@endforeach
