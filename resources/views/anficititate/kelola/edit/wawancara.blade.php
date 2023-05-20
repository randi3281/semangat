{{-- Form Jurnal --}}

</select>

</div>

<input type="text" class=" form-control" placeholder="Narasumber" name="penulis_1" value="{{ $edita->penulis_1 }}">

<div class="mt-1 form-group">
    <textarea name="jabatan" class="form-control"style="font-size : 11px;" id="" cols="30" rows="2"
        placeholder="Jabatan">{{ $edita->jabatan }}</textarea>
</div>

<div class="mt-1 form-group">
    <textarea name="sumber" class="form-control"style="font-size : 11px;" id="" cols="30" rows="2"
        placeholder="Sumber (Instansi/Perusahaan/yang lain)">{{ $edita->sumber }}</textarea>
</div>

<div class="mt-1 form-group">
    <textarea name="jenisWawancara" class="form-control"style="font-size : 11px;" id="" cols="30"
        rows="2" placeholder="Jenis Wawancara (Contoh: Wawancara Pribadi)">{{ $edita->jenisWawancara }}</textarea>
</div>

<div class="mt-2 form-group">
    <input type="text" class="text-center form-control-sm" name="tanggal" style="width:70px;" placeholder="Tanggal" value="{{ $edita->tanggal }}">
    <input type="text" class="text-center form-control-sm" name="bulan" style="width:70px;" placeholder="Bulan" value="{{ $edita->bulan }}">
    <input type="text" class="text-center form-control-sm" name="tahun" style="width:70px;" placeholder="Tahun" value="{{ $edita->tahun }}">
</div>
<div class="mt-2 form-group">
    <input type="text" class="form-control" name="kota" placeholder="Kota Tempat Wawancara"  value="{{ $edita->kota }}">
</div>

{{-- End Form Jurnal --}}
