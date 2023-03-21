<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Pegawai</title>
    @vite('resources/sass/app.scss')
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center mb-5">
                <h1>Daftar Pegawai</h1>

                <table class="table table-striped">
                    <tr>
                        <th>Nama</th>
                        <th>Alamat</th>
                    </tr>
                    @foreach ($data as $da)
                        <tr>
                            <td>{{$da->Nama}}</td>
                            <td>{{$da->Alamat}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</body>

</html>
