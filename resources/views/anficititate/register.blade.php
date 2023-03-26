<h1 class="text-center fs-3 mt-4 mb-3" style="font-family: 'Times New Roman', Times, serif">REGISTER</h1>
<div class="row text-center justify-content-center" style="font-size: 9pt; margin-bottom: -10px">
    <p>
        <a class="text-white">-</a><a class="text-danger" style="text-decoration: none">
            @if (isset($pesan))
                @php
                    echo $pesan;
                @endphp
            @endif
        </a><a class="text-white">-</a>
    </p>
</div>
<div class="row justify-content-center">
    <div class="col-sm-8 ">
        <form action="daftarakun" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="username">Username</label>
                <input id="username" class="form-control" type="text" name="username" required>
            </div>
            <div class="form-group mt-1">
                <label for="password">Password</label>
                <input id="password" class="form-control" type="text" name="password" required>
            </div>
            <div class="form-group mt-1">
                <label for="pin">PIN</label>
                <input id="pin" class="form-control" type="text" name="pin" required>
            </div>
            <div class="text-center mt-5">
                <input type="submit" style="height: 38px; font-size: 12px; font-weight: bold"
                    class="btn btn-primary w-50" value="ENTER">
                <p class="mt-2" style="font-size: 7pt">Was Have Account? <a href="login">Login Here</a></p>
            </div>
        </form>
    </div>
</div>