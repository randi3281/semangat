{{-- Form Website --}}
</div>
<div class="mt-2 form-group">
    <input type="text" class="form-control" name="penulisArtikel" placeholder="Penulis artikel"
        value="{{ $edita->penulis_1 }}">
</div>
<div class="form-group  mt-3">
    <label for="judul_web">Judul Web</label> <br>
    <textarea name="judul_web" class="form-control" style="font-size : 11px;" cols="30" rows="3"
        placeholder="Nama Web">{{ $edita->judul_web }}</textarea>
</div>
<div class="form-group  mt-3">
    <textarea name="judulArtikel" class="form-control" style="font-size : 11px;" cols="30" rows="3"
        placeholder="Judul Artikel">{{ $edita->deskripsi_web }}</textarea>
</div>

<div class="mt-2 form-group">
    <input type="text" class="form-control" name="tanggal_website" placeholder="Tanggal Website"
        value="{{ $edita->tanggal }}">
</div>

<div class="mt-2 form-group">
    <input type="text" class="form-control" name="link_web" placeholder="Link" value="{{ $edita->link_web }}">
</div>

<div class="mt-2 form-group">
    <input type="text" class="form-control" name="tanggal_diakses_web" placeholder="Tanggal Diakses"
        value="{{ $edita->tanggal_diakses_web }}">
</div>
{{-- End Form Website --}}
