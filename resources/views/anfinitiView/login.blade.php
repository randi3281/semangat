<div class="row ">
    <div class="col-auto d-flex justify-content-center align-items-center" style="height:500px">
        <form style="width: 350px;">
            <h2 class="text-center">- Login -</h2>
            <div class="row justify-content-center mt-4">
                <div class="col-auto">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control mb-2" id="username"
                            placeholder="Masukin username kamu disini" style="width: 300px">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" style="width: 300px" id="password"
                            placeholder="Hayo passwordnya ingat enggak?">
                    </div>
                    <p class=" mb-4" style="font-size: 7pt">Kalau lupa passwordnya, <a
                            href="/anficititate/lupa_sandi">Klik
                            disini ya</a></p>
                    <div class="form-group mt-3">
                        <label style="margin-right: 12px">Captcha</label>
                        <img src="/captcha/captcha.php" alt="gambar">
                    </div>
                    <div class="form-group mt-3">
                        <input id="captcha" class="form-control" type="text" name="captcha"
                            placeholder="Masukin captcha di atas kesini">
                    </div>
                    <div class="tombol text-center mt-5">
                        <button type="submit" class="btn btn-dark btn-block w-75">Masuk</button>
                        <button type="submit" class="btn btn-outline-dark btn-block">Daftar</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
