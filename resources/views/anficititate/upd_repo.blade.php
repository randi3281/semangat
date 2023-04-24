<h1 class="text-center fs-3 mt-5 mb-3" style="font-family: 'Times New Roman', Times, serif">PERBARUI REPOSITORI</h1>
<div class="row justify-content-center">
    <div class="col-sm-8 ">
        <form action="pin" method="POST">
            <div class="form-group">
                <div class="row text-center justify-content-center" style="font-size: 9pt; margin-bottom: -20px">
                    <p>
                        <a class="text-white">-</a><a class="text-danger" style="text-decoration: none"></a><a
                            class="text-white">-</a>
                    </p>
                </div>
                <label for="repository">Repositori</label>

                <select class="form-select" name="repository" id="">
                    <option value="hy" selected>hy</option>
                </select>
            </div>
            <p style="font-size: 7pt; margin-bottom:-5px;">Atau ingin untuk <a href="/anficititate/slc_repo">Pilih
                    Repositori</a> atau <a href="/anficititate/del_repo" class="text-danger">Hapus
                    Repositori</a></p>
            <div class="form-group mt-2">
                <input id="namabaru" class="form-control" type="text" name="namabaru"
                    placeholder="Masukkan nama repositori yang baru">
            </div>
            <div class="form-group mt-3">
                <label for="pin">PIN</label>
                <input id="pin" class="form-control" maxlength="6" type="password" name="pin" autofocus required placeholder="Masukin PIN kamu disini ya">
            </div>
            <div class="text-center mt-4">
                <input type="submit" name="enter" style="height: 38px; font-size: 12px; font-weight: bold"
                    class="btn btn-primary w-50" value="ENTER">
                <p class="mt-2" style="font-size: 7pt">Ingin Mengganti Akun? <a href="login">Login Kembali
                        Disini</a>
                </p>
            </div>
        </form>
    </div>
</div>
