<h1 class="text-center fs-3 mt-5 mb-5" style="font-family: 'Times New Roman', Times, serif">BUAT REPOSITORI</h1>
<div class="row justify-content-center">
    <div class="col-sm-8 ">
        <form action="new_repo" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="pin">Nama Repositori</label>
                <input type="text" class="form-control" name="nama_repo" autofocus placeholder="Contoh: Skripsiku">
            </div>
            <div class="form-group mt-3 pb-3">
                <label for="pin">PIN</label>
                <input id="pin" class="form-control" type="password" maxlength="6" name="pin" placeholder="Masukin PIN kamu disini ya">
            </div>
            <div class="text-center mt-5">
                <input type="submit" style="height: 38px; font-size: 12px; font-weight: bold"
                    class="btn btn-primary w-50" name="new" value="BUAT BARU">
                <input type="submit" style="height: 38px; font-size: 12px; font-weight: bold"
                    class="btn btn-secondary w-25" name="enter" value="MASUK">
                <p class="mt-2" style="font-size: 7pt">Ingin Mengganti Akun? <a href="/anficititate/back">Login
                        Kembali Disini</a>
                </p>
            </div>
        </form>
    </div>
</div>
