<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Siswa</title>
</head>

<body>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
        </tr>
        @foreach ($siswa as $murid)
            <tr>
                <td>{{ $murid->id }}</td>
                <td>{{ $murid->nama }}</td>
                <td>{{ $murid->alamat }}</td>
            </tr>
        @endforeach
    </table>
    {{ $siswa->links() }}
</body>

</html>
