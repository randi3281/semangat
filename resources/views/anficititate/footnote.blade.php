<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Anficititate</title>
    <link rel="shortcut icon" href="/icon/anficititate/anficititate.png">
    @vite('resources/sass/app.scss')
    <style>
        tr * {
            font-size: 10pt;
            font-family: 'Times New Roman';
        }
    </style>
</head>

<body class="bg-primary">
    <div class="container-fluid" style="padding-top: 3px;">
        <div class="row mt-2">

            {{-- Kelola Footnote --}}
            @include('anficititate.kelola.index')
            {{-- End Kelola Footnote --}}

            {{-- Tabel Footnote --}}
            @include('anficititate.tabel.UINGUSDUR.index')
            {{-- End Tabel Footnote --}}
        </div>
</body>

</html>
