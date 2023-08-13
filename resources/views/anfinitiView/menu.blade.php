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
            <div class="col-md-4 d-flex justify-content-center align-items-center" style="height: 650px">
                <div class="card">
                    <div class="card-body text-dark" style="height: 562px">
                        @switch($mode)
                            @case(1)
                                @include('anfinitiView.input')
                            @break

                            @case(2)
                                @include('anfinitiView.edit')
                            @break

                            @case(3)
                                @include('anfinitiView.trash')
                            @break

                            @default
                        @endswitch
                    </div>
                </div>
            </div>
            <div class="col-md-8 d-flex justify-content-center align-items-center" style="height: 650px">
                <img src="/anfinitiPublic/logo.png" style="width: 384px; height: 109px;" alt="">
            </div>
        </div>
    </div>
</body>

</html>
