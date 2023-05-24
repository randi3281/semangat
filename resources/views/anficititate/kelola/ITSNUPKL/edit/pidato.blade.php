{{-- Form Jurnal --}}
<br>

{{-- End Percabangan --}}
</select>

</div>

<input type="text" class=" form-control" placeholder="Narasumber" name="penulis_1" value="{{ $edita->penulis_1 }}">

<div class="form-group  mt-2">
    <label for="judul">Nama Acara Pidato</label> <br>
    <textarea name="judul" class="form-control"style="font-size : 11px;" id="" cols="30" rows="3"
        placeholder="Tuliskan Judul">{{ $edita->judul }}</textarea>
</div>

<div class="mt-1 form-group">
    <textarea name="sumber" class="form-control"style="font-size : 11px;" id="" cols="30" rows="2"
        placeholder="Sumber Tempat Pidato (Misal : TVRI)">{{ $edita->sumber }}</textarea>
</div>

<div class="mt-2 form-group">
    <input type="text" class="text-center form-control-sm" name="hari" style="width:70px;" placeholder="Hari" value="{{ $edita->hari }}">
    <input type="text" class="text-center form-control-sm" name="tanggal" style="width:70px;" placeholder="Tanggal" value="{{ $edita->tanggal }}">
    <input type="text" class="text-center form-control-sm" name="bulan" style="width:70px;" placeholder="Bulan" value="{{ $edita->bulan }}">
    <input type="text" class="text-center form-control-sm" name="tahun" style="width:70px;" placeholder="Tahun" value="{{ $edita->tahun }}">
    <input type="text" class="text-center form-control-sm" name="waktu" style="width:70px;" placeholder="Pukul" value="{{ $edita->waktu }}">
</div>
{{-- End Form Jurnal --}}
