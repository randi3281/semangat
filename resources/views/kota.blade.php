<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tujuan Kota</title>
</head>

<body>
    <h1>Urutan Kota yang Akan Dikunjungi Berdasarkan Jarak</h1>
    @foreach ($kota as $daftarKota)
        {{ $daftarKota->nama_kota }}, jarak : {{ $daftarKota->jarak }} km<br>
    @endforeach
</body>

</html>
