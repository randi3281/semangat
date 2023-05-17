{{-- Form Jurnal --}}
<br>
<label for="jumlah">Jumlah Penulis : </label>
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
<input type="checkbox" name="asing" id="asing" value="asing">
<label for="asing">Asing</label>

</div>

<div class="mt-1 form-group">
    @if (isset($jumlahpenulis))
        @if ($jumlahpenulis == 1)
            <input type="text" class=" form-control" placeholder="Penulis 1" name="penulis_1">
        @endif
    @endif
</div>

<div class="form-group  mt-2">
    <label for="judul">Judul</label> <br>
    <textarea name="judul" class="form-control"style="font-size : 11px;" id="" cols="30" rows="3"
        placeholder="Tuliskan Judul"></textarea>
</div>

<div class="mt-1 form-group">
    <textarea name="sumber" class="form-control"style="font-size : 11px;" id="" cols="30" rows="2"
        placeholder="Nama Koran"></textarea>
</div>

<div class="mt-2 form-group">
    <input type="text" class="text-center form-control-sm" name="tanggal" style="width:70px;" placeholder="Tanggal">
    <input type="text" class="text-center form-control-sm" name="bulan" style="width:70px;" placeholder="Bulan">
    <input type="text" class="text-center form-control-sm" name="tahun" style="width:70px;" placeholder="Tahun">
    <label for="halaman">Hal: </label>
    <input type="text" class="text-center form-control-sm float-left" style="width:60px;" name="halaman_awal"
        placeholder="Awal">
    -
    <input type="text" class="text-center form-control-sm float-left" style="width:60px;" name="halaman_akhir"
        placeholder="Akhir">
</div>

{{-- End Form Jurnal --}}
