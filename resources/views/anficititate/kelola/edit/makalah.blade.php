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
@if ($edita->asing == 1)
    <input type="checkbox" name="asing" id="asing" value="1" checked>
@else
    <input type="checkbox" name="asing" id="asing" value="1">
@endif
<label for="asing">Asing</label>

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
        placeholder="Tuliskan Judul">{{ $edita->judul }}</textarea>
</div>

<div class="mt-1 form-group">
    <textarea name="acara" class="form-control"style="font-size : 11px;" id="" cols="30" rows="2"
        placeholder="Acara">{{ $edita->acara }}</textarea>
</div>

<div class="mt-1 form-group">
    <textarea name="judulAcara" class="form-control"style="font-size : 11px;" id="" cols="30" rows="2"
        placeholder="Judul Acara">{{ $edita->judulAcara }}</textarea>
</div>

<div class="mt-1 form-group">
    <textarea name="penyelenggaraAcara" class="form-control"style="font-size : 11px;" id="" cols="30"
        rows="2" placeholder="Penyelenggara Acara">{{ $edita->penyelenggaraAcara }}</textarea>
</div>

<div class="mt-2 form-group">
    <input type="text" class="text-center form-control-sm" name="tanggal" style="width:70px;" placeholder="Tanggal" value="{{ $edita->tanggal }}">
    <input type="text" class="text-center form-control-sm" name="bulan" style="width:70px;" placeholder="Bulan" value="{{ $edita->bulan }}">
    <input type="text" class="text-center form-control-sm" name="tahun" style="width:70px;" placeholder="Tahun" value="{{ $edita->tahun }}">
</div>
{{-- End Form Jurnal --}}
