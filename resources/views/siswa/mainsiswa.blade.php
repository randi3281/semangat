<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Siswa</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    @vite('resources/sass/app.scss')

</head>

<body class="bg-dark text-white">
    <div class="container mt-5">
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-3">
                @include('siswa.kelolasiswa')
            </div>
            <div class="col-lg-9 pl-3">
                @include('siswa.daftarsiswa')
                {{$data->links()}}
            </div>
        </div>
    </div>
</body>

</html>
