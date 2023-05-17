{{-- Form Website --}}
</div>
<input type="hidden" name="idedita" value="{{ $edita->id }}">
<div class="form-group  mt-3">
    <label for="judul_web">Judul Web</label> <br>
    <textarea name="judul_web" class="form-control" style="font-size : 11px;" cols="30" rows="3"
        placeholder="Tuliskan Judul">{{ $edita->judul_web }}</textarea>
</div>

<div class="mt-3 form-group">
    <label for="deskripsi_web">Deskripsi Web</label>
    <textarea type="text" class="form-control" style="font-size : 11px;" cols="30" rows="3"
        name="deskripsi_web" placeholder="Deskripsi">{{ $edita->deskripsi_web }}</textarea>
</div>

<div class="mt-2 form-group">
    <input type="text" class="form-control" name="tahun_web" placeholder="Tahun" value="{{ $edita->tahun_web }}">
</div>

<div class="mt-2 form-group">
    <input type="text" class="form-control" name="link_web" placeholder="Link" value="{{ $edita->link_web }}">
</div>

<div class="mt-2 form-group">
    <input type="text" class="form-control" name="tanggal_diakses_web" placeholder="Tanggal Diakses"
        value="{{ $edita->tanggal_diakses_web }}">
</div>
{{-- End Form Website --}}
