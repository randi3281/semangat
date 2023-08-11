<h1 class="text-center fs-3 mt-3 mb-2" style="font-family: 'Times New Roman', Times, serif">LOGIN</h1>
<div class="row text-center justify-content-center" style="font-size: 9pt; margin-top:-10px; margin-bottom: 10px">
    <p>
        <a class="text-white">-</a>
        <a class="text-danger" style="text-decoration: none">
            @if (isset($pesan))
                @php
                    echo $pesan;
                @endphp
            @endif
        </a>
        <a class="text-white">-</a>
    </p>
</div>

<div class="row justify-content-center" style="margin-top: -32px">
    <div class="col-sm-8 ">
        <form action="/anficititate/slc_repo" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="username">Username</label>
                <input id="username" class="form-control" type="text" name="username" autofocus required
                    placeholder="Masukin username kamu disini">
            </div>
            <div class="form-group mt-1">
                <label for="password">Kata Sandi</label>
                <input id="password" class="form-control" type="password" name="password" required
                    placeholder="Inget kan kata sandinya?" minlength="8">
            </div>
            <p style="font-size: 7pt">Kalau kamu mau ubah kata sandinya, <a href="/anficititate/lupa_sandi">Klik
                    Disini</a></p>
            <div class="form-group mt-3">
                <label style="margin-right: 12px">Captcha</label>
                <img src="/captcha/captcha.php" alt="gambar">
            </div>
            <div class="form-group mt-3">
                <input id="captcha" class="form-control" type="text" name="captcha"
                    placeholder="Masukin captcha di atas kesini ...." maxlength="6" value="" minlength="6"
                    required>
            </div>
            <div class="text-center mt-3">
                <input type="submit" style="height: 38px; font-size: 12px; font-weight: bold"
                    class="btn btn-primary w-50" value="MASUK">
                <p class="mt-2" style="font-size: 7pt">Belum punya akun? <a href="/anficititate/daftar">Ayo Daftar
                        Disini</a></p>
            </div>
        </form>
    </div>
</div>
