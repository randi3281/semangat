<h1 class="text-center fs-3 mt-5 mb-5" style="font-family: 'Times New Roman', Times, serif">PILIH REPOSITORI</h1>
<div class="row justify-content-center">
    <div class="col-sm-8 ">
        <form action="home" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="repository">Repositori</label>
                {{-- <input id="my-input" class="form-control" type="text" name=""> --}}
                <select class="form-select" name="repository" id="" onchange="javascript:handleselect(this)">
                    <option value="hy" selected>hy</option>
                    <option value="hy">Buat Repositori baru</option>
                </select>
            </div>
            <p style="font-size: 7pt">Atau ingin untuk <a href="/anficititate/del_repo" class="text-danger">Hapus Repositori</a> atau <a
                    href="/anficititate/upd_repo">Perbarui
                    Repositori</a></p>
            <div class="form-group mt-3">
                <label for="pin">PIN</label>
                <input id="pin" class="form-control" type="password" maxlength="6" name="pin">
            </div>
            <div class="text-center mt-5">
                <input type="submit" style="height: 38px; font-size: 12px; font-weight: bold"
                    class="btn btn-primary w-50" name="enter"  value="MASUK">
                <p class="mt-2" style="font-size: 7pt">Ingin Mengganti Akun? <a href="/anficititate/back">Login Kembali Disini</a>
                </p>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    function handleselect(elm) {
        window.location = elm.value;
    }
</script>
