<h1 class="text-center fs-3 mt-4 mb-3" style="font-family: 'Times New Roman', Times, serif">LUPA PIN</h1>
<div class="row text-center justify-content-center" style="font-size: 9pt; margin-top:-10px; margin-bottom: -20px">
    <p>
        <a class="text-white">-</a>
        <a class="text-danger" style="text-decoration: none">
            @if (isset($pesan))
                @php
                    echo $pesan;
                @endphp
            @endif
        </a>
        <a class="text-white">-</a>
    </p>
</div>
<div class="row justify-content-center">
    <div class="col-sm-8 ">
        <form action="/anficititate/lupa_pin_nya" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="username">Username</label>
                <input id="username" class="form-control" type="text" name="username" autofocus
                    placeholder="Masukin username kamu disini">
            </div>
            <div class="form-group mt-1">
                <label for="password">Kode Konfirmasi</label>
                <div class="row">
                    <div class="col">
                        <input id="password" class="form-control-sm text-center" style="width:120px; margin-right:5px"
                            type="password" name="kodekonfir" placeholder="Kode Konfirmasi">
                        <input type="submit" class="w-50 btn btn-primary fs-6" name="minkode" value="Minta Kode">
                    </div>
                </div>
            </div>
            <div class="form-group mt-1">
                <label for="password">Kata PIN Baru</label>
                <input id="password" class="form-control" type="password" name="new_pin"
                    placeholder="Masukin kata sandi barumu disini" minlength="6">
            </div>
            <div class="form-group mt-1">
                <label for="password">Konfirmasi PIN Baru</label>
                <input id="password" class="form-control" type="password" name="confirm_new_pin"
                    placeholder="Masukin ulang kata sandi barumu" minlength="6">
            </div>
            <div class="text-center mt-3">
                <input type="submit" style="height: 38px; font-size: 12px; font-weight: bold"
                    class="btn btn-primary w-50" value="MASUK" name="enter">
                <p class="mt-2" style="font-size: 7pt">Mau Login? <a href="/anficititate">Klik Disini</a></p>
            </div>
        </form>
    </div>
</div>
