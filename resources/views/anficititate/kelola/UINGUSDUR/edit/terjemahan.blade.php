<br>

</div>

<div class="form-group  mt-2">
    <label for="judul">Judul</label> <br>
    <textarea name="judul" class="form-control"style="font-size : 11px;" id="" cols="30" rows="3"
        placeholder="Tuliskan Judul">{{ $edita->judul }}</textarea>
</div>

<div class="mt-1 form-group">
    <textarea name="penulis_1" class="form-control"style="font-size : 11px;" id="" cols="30" rows="2"
        placeholder="Sub Instansi/Perusahaan/Lembaga">{{ $edita->penulis_1 }}</textarea>
</div>

<div class="mt-1 form-group">
    <textarea name="sumber" class="form-control"style="font-size : 11px;" id="" cols="30" rows="2"
        placeholder="Instansi/Perusahaan/Lembaga">{{ $edita->sumber }}</textarea>
</div>

<div class="mt-2 form-group">
    <input type="text" class="text-center form-control-sm" name="tahun" style="width:70px;" placeholder="Tahun" value="{{ $edita->tahun }}">
    <label for="halaman">Hal: </label>
    <input type="text" class="text-center form-control-sm float-left" style="width:60px;" name="halaman_awal"
        placeholder="Awal" value="{{ $edita->halaman_awal }}">
    -
    <input type="text" class="text-center form-control-sm float-left" style="width:60px;" name="halaman_akhir"
        placeholder="Akhir" value="{{ $edita->halaman_akhir }}">
</div>
<div class="mt-2 form-group">
    <input type="text" class="form-control" name="kota" placeholder="Asal Kota" value="{{ $edita->kota }}">
</div>
