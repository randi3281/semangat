<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Perpus - SDN 1 Planjan</title>
    <link rel="shortcut icon" href="/pssp/icon.png">
    @vite('resources/sass/app.scss')
</head>

<body class="bg-primary">
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 100px;">
            <div class="col-lg-5">
                <div class="card" style=" height:450px;">
                    <div class="card-body">
                        @switch($mode)
                            @case(1)
                                @include('pssp.login')
                            @break
                        @endswitch
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
