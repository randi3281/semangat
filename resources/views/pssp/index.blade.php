<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Perpus | SDN 1 Planjan</title>
    <link rel="shortcut icon" href="/pssp/icon.png">
    @vite('resources/sass/app.scss')
</head>

<body class="bg-primary">
    <div class="container-fluid">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <div class="col-lg-4">
                <div class="card" style=" height:550px;">
                    <div class="card-body">
                        <h1 class="text-center fs-3 mt-5 pt-4 mb-2" style="font-family: 'Times New Roman', Times, serif">
                            - LOGIN -
                        </h1>
                        <div class="row text-center justify-content-center"
                            style="font-size: 9pt; margin-top:-10px; margin-bottom: 10px">
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
                                <form action="/pssp/masuk" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input id="username" class="form-control" type="text" name="username"
                                            autofocus required placeholder="Masukkan username Anda disini">
                                    </div>
                                    <div class="form-group mt-1">
                                        <label for="password">Kata Sandi</label>
                                        <input id="password" class="form-control" type="password" name="password"
                                            required placeholder="Masukkan kata sandi Anda disini" minlength="8">
                                    </div>
                                    <p style="font-size: 7pt">Kalau kamu mau ubah kata sandinya, <a
                                            href="/anficititate/lupa_sandi">Klik Disini</a></p>
                                    <div class="form-group mt-3">
                                        <label style="margin-right: 12px">Captcha</label>
                                        <img src="/captcha/captcha.php" alt="gambar">
                                    </div>
                                    <div class="form-group mt-3">
                                        <input id="captcha" class="form-control" type="text" name="captcha"
                                            placeholder="Masukin captcha di atas disini" maxlength="6"
                                            value="" minlength="6" required>
                                    </div>
                                    <div class="text-center mt-4">
                                        <input type="submit" style="height: 38px; font-size: 12px; font-weight: bold"
                                            class="btn btn-primary w-50" value="MASUK">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="row justify-content-center">
                    <div class="card" style="height:550px;">
                        <div class="card-body justify-content-center d-flex">
                            <img src="/pssp/eperpus.png" class="img-fluid" style="margin-top: 15px; height:500px; width:500px"  alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
