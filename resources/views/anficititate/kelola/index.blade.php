<div class="col-lg-4 mb-2">
    <div class="card mb-3" style="height: 548px;">
        <div class="card-body">
            <h4 class="text-center">Kelola Footnote</h4>

            {{-- Form Kelola --}}
            <form action="/anficititate/kelola" method="POST">
                {{ csrf_field() }}
                <div class="mt-4 form-group">
                    {{-- <input type="hidden" name="urut" value="{{ $nomor }}"> --}}
                    <select name="jenis_footnote" class="form-select-sm mb-1">
                        @switch($jenis)
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
                    </select>
                    <input type="submit" class="btn btn-success"
                        style="margin-right: 4px;height: 28px; font-size:8pt; margin-top: -2px" value="ENTER"
                        name="tomboljenis">
                    <label for="nourut">Urutan : </label>
                    @if ($apakahedit == 1)
                        <input type="text" class="form-control-sm" name="nourut"
                            style="margin-right: 11px;width: 50px;" placeholder="No"
                            value="{{ $_SESSION['edit_id'] }}">
                    @else
                        <input type="text" class="form-control-sm" name="nourut"
                            style="margin-right: 11px;width: 50px;" placeholder="No" value="{{ $nomor }}">
                    @endif
                    @switch($apakahedit)
                        @case(0)
                            {{-- Switch --}}
                            @switch($jenis)
                                @case(1)
                                    @include('anficititate.kelola.normal.jurnal')
                                @break

                                @case(2)
                                    @include('anficititate.kelola.normal.website')
                                @break

                                @case(3)
                                    @include('anficititate.kelola.normal.buku')
                                @break

                                @case(4)
                                    @include('anficititate.kelola.normal.terjemahan')
                                @break

                                @case(5)
                                    @include('anficititate.kelola.normal.majalah')
                                @break

                                @case(6)
                                    @include('anficititate.kelola.normal.suratKabar')
                                @break

                                @case(7)
                                    @include('anficititate.kelola.normal.karanganTidakDiterbitkan')
                                @break

                                @case(8)
                                    @include('anficititate.kelola.normal.wawancara')
                                @break

                                @case(9)
                                    @include('anficititate.kelola.normal.pidato')
                                @break

                                @case(10)
                                    @include('anficititate.kelola.normal.komentar')
                                @break

                                @case(11)
                                    @include('anficititate.kelola.normal.ensiklopedia')
                                @break

                                @case(12)
                                    @include('anficititate.kelola.normal.makalah')
                                @break
                            @endswitch
                            {{-- End Switch --}}
                        @break

                        @case(1)
                            @foreach ($editan as $edita)
                                {{-- Switch --}}
                                @switch($edita->jenis)
                                    @case(1)
                                        @include('anficititate.kelola.edit.jurnal')
                                    @break

                                    @case(2)
                                        @include('anficititate.kelola.edit.website')
                                    @break

                                    @case(3)
                                        @include('anficititate.kelola.edit.buku')
                                    @break

                                    @case(4)
                                        @include('anficititate.kelola.edit.terjemahan')
                                    @break

                                    @case(5)
                                        @include('anficititate.kelola.edit.majalah')
                                    @break

                                    @case(6)
                                        @include('anficititate.kelola.edit.suratKabar')
                                    @break

                                    @case(7)
                                        @include('anficititate.kelola.edit.karanganTidakDiterbitkan')
                                    @break

                                    @case(8)
                                        @include('anficititate.kelola.edit.wawancara')
                                    @break

                                    @case(9)
                                        @include('anficititate.kelola.edit.pidato')
                                    @break

                                    @case(10)
                                        @include('anficititate.kelola.edit.komentar')
                                    @break

                                    @case(11)
                                        @include('anficititate.kelola.edit.ensiklopedia')
                                    @break

                                    @case(12)
                                        @include('anficititate.kelola.edit.makalah')
                                    @break
                                @endswitch
                            @endforeach
                            {{-- End Switch --}}
                        @break

                    @endswitch
                </div>
        </div>
        <script type="text/javascript">
            function handleselect(elm) {
                window.location = "/anficititate/repo_core/" + elm.value;
            }
        </script>

        {{-- Tombol Kelola --}}
        <div class="card" style="height:75px; margin-top:-10px;">
            <div class="card-body">
                <div class="text-center">
                    <input type="submit" name="input" value="Input" class="w-25 btn btn-primary"
                        style="margin-left:20px">
                    <input type="submit" name="edit" value="Edit" class="w-25 btn btn-danger"
                        style="margin-left:20px">
                    <input type="submit" name="reset" value="Reset" class="w-25 btn btn-secondary"
                        style="margin-left:20px">
                    </form>
                </div>
            </div>
        </div>
        {{-- End Tombol Kelola --}}

        {{-- End Form Kelola --}}

        <footer>
            <p class="text-center text-white mt-2" style="font-family: arial; margin-bottom:-20px;">&copy; 2023
                Anficititate | Created with &hearts; by Anfi</p>
        </footer>

    </div>
