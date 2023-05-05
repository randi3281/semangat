{{-- Form Jurnal --}}
<label for="jumlah">Jumlah Penulis : </label>
<select class="form-select-sm" name="jumlah_penulis" style=" width: 50px;" onchange="javascript:handleselect(this)">

    {{-- Percabangan --}}
    @if (isset($jumlahpenulis))
        @if ($jumlahpenulis == 4)
            <option value="4" selected>Lebih dari 3</option>
            @for ($x = 1; $x <= 3; $x++)
                <option value="{{ $x }}">
                    {{ $x }}
                </option>
            @endfor
        @else
            @for ($x = 1; $x <= 3; $x++)
                @if ($x == $jumlahpenulis)
                    <option value="{{ $x }}" selected>{{ $x }}
                    </option>
                @else
                    <option class="mb-2" value="{{ $x }}">
                        {{ $x }}
                    </option>
                @endif
            @endfor
            <option value="4">Lebih dari 3</option>
        @endif
    @else
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">Lebih dari 3</option>
    @endif
    {{-- End Percabangan --}}

</select>
</div>

<div class="mt-1 form-group">
    @if (isset($jumlahpenulis))
        @if ($jumlahpenulis == 4)
            <input type="text" class=" form-control" placeholder="Penulis 1" name="penulis_1"
                value="{{ $edita->penulis_1 }}">
        @elseif ($jumlahpenulis == 3)
            <input type="text" class="form-control" placeholder="Penulis 1" name="penulis_1"
                value="{{ $edita->penulis_1 }}">
            <input type="text" class="form-control" placeholder="Penulis 2" name="penulis_2"
                value="{{ $edita->penulis_2 }}">
            <input type="text" class="form-control" placeholder="Penulis 3" name="penulis_3"
                value="{{ $edita->penulis_3 }}">
        @elseif ($jumlahpenulis == 2)
            <input type="text" class="form-control" placeholder="Penulis 1" name="penulis_1"
                value="{{ $edita->penulis_1 }}">
            <input type="text" class="form-control" placeholder="Penulis 2" name="penulis_2"
                value="{{ $edita->penulis_2 }}">
        @elseif ($jumlahpenulis == 1)
            <input type="text" class="form-control" placeholder="Penulis 1" name="penulis_1"
                value="{{ $edita->penulis_1 }}">
        @endif
    @else
        <input type="text" class="form-control" placeholder="Penulis 1" name="penulis_1">
    @endif
</div>

<div class="form-group mt-2">
    <label for="judul">Judul</label> <br>
    <textarea name="judul" class="form-control"style="font-size : 11px;" id="" cols="30" rows="3"
        placeholder="Tuliskan Judul">{{ $edita->judul }}</textarea>
</div>

<div class="mt-1 form-group">
    <textarea name="sumber" class="form-control"style="font-size : 11px;" id="" cols="30" rows="2"
        placeholder="Sumber">{{ $edita->sumber }}</textarea>
</div>

<div class="mt-2 form-group">
    <label for="volume">Volume : </label>
    <input type="text" class="form-control-sm" name="volume" style="width:70px;" placeholder="Volume"
        value="{{ $edita->volume }}">
    <label for="nomor">Nomor : </label>
    <input type="text" class="form-control-sm" name="nomor" style="width:70px;" placeholder="Nomor"
        value="{{ $edita->nomor }}">
    <label for="tahun">Tahun : </label>
    <input type="text" class="form-control-sm" style="width:60px;" name="tahun"
        placeholder="Tahun"value="{{ $edita->tahun }}">
</div>

<div class="mt-2 form-group">
    <label for="halaman">Halaman : </label>
    <input type="text" class="form-control-sm float-left" style="width:60px;" name="halaman_awal"
        placeholder="Awal" value="{{ $edita->halaman_awal }}">
    -
    <input type="text" class="form-control-sm float-left" style="width:60px;" name="halaman_akhir"
        placeholder="Akhir" value="{{ $edita->halaman_akhir }}">
</div>
<div class="mt-2 form-group">
    <label for="halaman">Asal Kota : </label>
    <input type="text" class="form-control-sm" name="kota" placeholder="Asal Kota"
        value="{{ $edita->kota }}">
</div>
{{-- End Form Jurnal --}}
