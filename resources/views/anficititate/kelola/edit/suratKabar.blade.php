{{-- Form Jurnal --}}
<br>
<label for="jumlah">Jenis Koran : </label>
<select class="form-select-sm mb-1" name="jumlah_penulis" onchange="javascript:handleselect(this)">
    {{-- Percabangan --}}
    @if (isset($jumlahpenulis))
        @if ($jumlahpenulis == 1)
            <option value="1" selected>Koran Artikel</option>
            <option value="0">Koran Bukan Artikel</option>
        @else
            <option value="1">Koran Artikel</option>
            <option value="0" selected>Koran Bukan Artikel</option>
        @endif
    @endif
    {{-- End Percabangan --}}
</select>
</div>

<div class="mt-1 form-group">
    @if (isset($jumlahpenulis))
        @if ($jumlahpenulis == 1)
            <input type="text" class=" form-control" placeholder="Penulis" name="penulis_1"
                value="{{ $edita->penulis_1 }}">
        @endif
    @endif
</div>

<div class="form-group  mt-2">
    <label for="judul">Judul</label> <br>
    <textarea name="judul" class="form-control"style="font-size : 11px;" id="" cols="30" rows="3"
        placeholder="Tuliskan Judul">{{ $edita->judul }}</textarea>
</div>

<div class="mt-1 form-group">
    <textarea name="sumber" class="form-control"style="font-size : 11px;" id="" cols="30" rows="2"
        placeholder="Nama Koran">{{ $edita->sumber }}</textarea>
</div>

<div class="mt-2 form-group">
    <input type="text" class="text-center form-control-sm" name="tanggal" style="width:70px;" placeholder="Tanggal"
        value="{{ $edita->tanggal }}">
    <input type="text" class="text-center form-control-sm" name="bulan" style="width:70px;" placeholder="Bulan"
        value="{{ $edita->bulan }}">
    <input type="text" class="text-center form-control-sm" name="tahun" style="width:70px;" placeholder="Tahun"
        value="{{ $edita->tahun }}">
    <label for="halaman">Hal: </label>
    <input type="text" class="text-center form-control-sm float-left" style="width:60px;" name="halaman_awal"
        placeholder="Awal" value="{{ $edita->halaman_awal }}">
    -
    <input type="text" class="text-center form-control-sm float-left" style="width:60px;" name="halaman_akhir"
        placeholder="Akhir" value="{{ $edita->halaman_akhir }}">
</div>

{{-- End Form Jurnal --}}
