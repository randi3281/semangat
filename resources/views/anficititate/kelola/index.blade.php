<div class="col-lg-4 mb-2">
    <div class="card mb-3" style="height: 548px;">
        <div class="card-body">
            <h4 class="text-center">Kelola Footnote</h4>

            {{-- Form Kelola --}}
            <form action="/anficititate/kelola" method="POST">
                {{ csrf_field() }}
                <div class="mt-4 form-group">
                    {{-- <input type="hidden" name="jp" value="{{ $jumlahpenulis }}">
                    <input type="hidden" name="jenisf" value="{{ $jenis }}">
                    <input type="hidden" name="urut" value="{{ $nomor }}"> --}}
                    <select name="jenis_footnote" class="form-select-sm">
                        @switch($jenis)
                            @case(1)
                                <option value="1" selected>Jurnal</option>
                                <option value="2">Website</option>
                            @break

                            @case(2)
                                <option value="1">Jurnal</option>
                                <option value="2" selected>Website</option>
                            @break
                        @endswitch
                    </select>

                    <input type="submit" class="btn btn-success"
                        style="margin-right: 4px;height: 28px; font-size:8pt; margin-top: -2px" value="ENTER"
                        name="tomboljenis">

                    <input type="text" class="form-control-sm" name="nourut" style="margin-right: 11px;width: 50px;"
                        placeholder="No" value="{{ $nomor }}">
                    @switch($apakahedit)
                        @case(0)
                            {{-- Switch --}}
                            @switch($jenis)
                                @case(1)
                                    @include('anficititate.kelola.jurnal')
                                @break

                                @case(2)
                                    @include('anficititate.kelola.website')
                                @break
                            @endswitch
                            {{-- End Switch --}}
                        @break

                        @case(1)
                            @foreach ($editan as $edita)
                                {{-- Switch --}}
                                @switch($edita->jenis)
                                    @case(1)
                                        @include('anficititate.kelola.editjurnal')
                                    @break

                                    @case(2)
                                        @include('anficititate.kelola.editwebsite')
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
                    <input type="submit" name="input" value="Input" class="w-25 btn btn-primary" style="margin-left:20px">
                    <input type="submit" name="edit" value="Edit" class="w-25 btn btn-danger"
                        style="margin-left:20px">
                </form>
            </div>
        </div>
    </div>
    {{-- End Tombol Kelola --}}

    {{-- End Form Kelola --}}

    <footer><p class="text-center text-white mt-2" style="font-family: arial; margin-bottom:-20px;">&copy; 2023 Anficititate | Created with &hearts; by Anfi</p></footer>

</div>
