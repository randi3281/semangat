<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inputan</title>
</head>

<body>
    <h1>Belajar Inputan</h1>
    <form action="/inputan/hasil" method="POST">
        {{ csrf_field() }}
        Nama : <input type="text" name="nama"><br><br>
        NIM : <input type="text" name="nim"><br><br>
        <input type="submit" name="masuk" value="Enter">
    </form>
</body>

</html>
