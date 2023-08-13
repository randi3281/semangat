<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/anfinitiPublic/aa.png" type="image/x-icon">
    <title>nfiniti - / An . fi . ni . ti /</title>
    @vite('resources/sass/app.scss')
</head>

<body class="bg-dark">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8 d-flex justify-content-center align-items-center" style="height: 650px">
                <img src="/anfinitiPublic/logo.png" style="width: 384px; height: 109px;" alt="">
            </div>
            <div class="col-md-4 d-flex justify-content-center align-items-center" style="height: 650px">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mt-5">- Daftar -</h2>
                        <form class="" style="width: 350px; height: 400px;">
                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control mb-1" id="username"
                                            placeholder="Masukin username baru kamu disini" style="width: 300px">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" style="width: 300px"
                                            id="password" placeholder="Masukin password baru kamu disini">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" style="width: 300px"
                                            id="password" placeholder="Masukin passwordnya lagi disini">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label style="margin-right: 12px">Captcha</label>
                                        <img src="/captcha/captcha.php" alt="gambar">
                                    </div>
                                    <div class="form-group mt-4">
                                        <input id="captcha" class="form-control" type="text" name="captcha"
                                            placeholder="Masukin captcha di atas kesini" maxlength="6"
                                            value="" minlength="6">
                                    </div>
                                    <div class="tombol text-center mt-4">
                                        <button type="submit" class="btn btn-dark btn-block w-75">Daftar</button>
                                        <button type="submit" class="btn btn-outline-dark btn-block">Masuk</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
