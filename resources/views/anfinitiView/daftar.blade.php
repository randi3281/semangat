<div class="row ">
    <div class="col-auto d-flex justify-content-center align-items-center" style="height:500px">
        <form action="/anfiniti/daftarproses" style="width: 350px;" method="POST">
            {{ csrf_field() }}
            <h2 class="text-center">- Daftar -</h2>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row justify-content-center mt-4">
                <div class="col-auto">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control mb-1" id="username"
                            placeholder="Masukin username baru kamu disini" style="width: 300px" name="username">
                    </div>
                    <div class="form-group mb-1">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" style="width: 300px" id="password"
                            placeholder="Masukin password baru kamu disini" name="password">
                    </div>
                    <div class="form-group mb-4">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" style="width: 300px" id="password"
                            placeholder="Masukin passwordnya lagi disini" name="password2">
                    </div>
                    <div class="form-group mt-3">
                        <label style="margin-right: 12px">Captcha</label>
                        <img src="/captcha/captcha.php" alt="gambar">
                    </div>
                    <div class="form-group mt-4">
                        <input id="captcha" class="form-control" type="text" name="captcha"
                            placeholder="Masukin captcha di atas kesini" style="width: 300px" maxlength="6"
                            value="" minlength="6">
                    </div>
                    <div class="tombol text-center mt-4">
                        <input type="submit" class="btn btn-dark text-light btn-block w-75" name="tombolDaftar"
                            value="Daftar">
                        <input type="submit" class="btn btn-outline-dark btn-block" name="tombolMasuk" value="Login">
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
