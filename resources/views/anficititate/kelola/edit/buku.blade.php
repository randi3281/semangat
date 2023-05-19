{{-- Form Jurnal --}}
<br>
<label for="jumlah">Jumlah Penulis : </label>
<select class="form-select-sm mb-1" name="jumlah_penulis" onchange="javascript:handleselect(this)">
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
<input type="checkbox" name="asing" id="asing" value="1">
<label for="asing">Asing</label>
<br>
<input type="radio" name="jenisBuku" id="normal" value="normal" checked>
<label for="karangan">Normal</label>
<input type="radio" name="jenisBuku" id="karangan" value="karangan">
<label for="karangan">Karangan</label>
<input type="radio" name="jenisBuku" id="tanpaPenulis" value="tanpaPenulis">
<label for="tanpaPenulis">Tanpa Penulis</label>
<input type="radio" name="jenisBuku" id="terjemahan" value="terjemahan">
<label for="terjemahan">Terjemahan</label>

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

<div class="form-group  mt-2">
    <label for="judul">Judul</label> <br>
    <textarea name="judul" class="form-control"style="font-size : 11px;" id="" cols="30" rows="3"
        placeholder="Tuliskan Judul"></textarea>
</div>

<div class="mt-1 form-group">
    <textarea name="sumber" class="form-control"style="font-size : 11px;" id="" cols="30" rows="2"
        placeholder="Sumber"></textarea>
</div>

<div class="mt-2 form-group">
    <input type="text" class="text-center form-control-sm" name="volume" style="width:70px;" placeholder="Volume">
    <input type="text" class="text-center form-control-sm" name="nomor" style="width:70px;" placeholder="Nomor">
    <input type="text" class="text-center form-control-sm" name="tahun" style="width:70px;" placeholder="Tahun">
    <label for="halaman">Hal: </label>
    <input type="text" class="text-center form-control-sm float-left" style="width:60px;" name="halaman_awal"
        placeholder="Awal">
    -
    <input type="text" class="text-center form-control-sm float-left" style="width:60px;" name="halaman_akhir"
        placeholder="Akhir">
</div>
<div class="mt-2 form-group">
    <input type="text" class="form-control" name="kota" placeholder="Asal Kota">
</div>

{{-- End Form Jurnal --}}
