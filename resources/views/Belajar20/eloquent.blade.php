<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Belajar Eloquent Dasar</title>
</head>

<body>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
        </tr>
        @foreach ($pegawai as $karyawan)
            <tr>
                <td>{{ $karyawan->id }}</td>
                <td>{{ $karyawan->nama }}</td>
                <td>{{ $karyawan->alamat }}</td>
            </tr>
        @endforeach
    </table><br>
    Karyawan pertama adalah {{ $pegawaiPertama->nama }} <br>
    Karyawan kedua adalah {{ $pegawaiKedua->nama }} <br>
    @foreach ($pegawaiKetiga as $pegawaiFirst)
        Alamat Dadap Wibowo adalah {{ $pegawaiFirst->alamat }} <br>
    @endforeach
    @foreach ($pegawaiKeempat as $pegawaiFirst)
        Alamat Dadap Wibowo adalah {{ $pegawaiFirst->alamat }} <br>
    @endforeach
    @foreach ($pegawaiKelima as $pegawaiFirst)
        Alamatnya adalah {{ $pegawaiFirst->alamat }} <br>
    @endforeach
    @foreach ($pegawaiKeenam as $pegawaiFirst)
        Namanya adalah {{ $pegawaiFirst->nama }} <br>
    @endforeach
    @foreach ($pegawaiKetujuh as $pegawaiFirst)
        Nama adalah {{ $pegawaiFirst->nama }} <br>
    @endforeach
    {{$pegawaiKetujuh->links()}}
</body>

</html>
