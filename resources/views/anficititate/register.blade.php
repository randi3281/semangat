<h1 class="text-center fs-3 mt-4 mb-1" style="font-family: 'Times New Roman', Times, serif">PENDAFTARAN</h1>
<div class="row text-center justify-content-center" style="font-size: 9pt; margin-bottom: -20px">
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
        <form action="/anficititate/daftarakun" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="username">Username</label>
                <input id="username" class="form-control" type="text" name="username" required autofocus
                    placeholder="Contoh : anfi123">
            </div>
            <div class="form-group mt-1">
                <label for="pin">Kampus</label>
                <select name="kampus" id="" class="form-select">
                    @foreach ($kampus as $ackampus)
                        <option value="{{ $ackampus->alias }}">{{ $ackampus->nama_kampus }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-1">
                <label for="password">Kata Sandi</label>
                <input id="password" class="form-control" type="text" name="password" required
                    placeholder="Minimal 8 digit ya" minlength="8">
            </div>
            <div class="form-group mt-1">
                <label for="pin">PIN</label>
                <input id="pin" class="form-control" type="text" name="pin"
                    placeholder="Masukkan 6 digit angka" maxlength="6" minlength="6" required>
            </div>
            <div class="text-center mt-3">
                <input type="submit" style="height: 38px; font-size: 12px; font-weight: bold"
                    class="btn btn-primary w-50" value="DAFTAR">
                <p class="mt-2" style="font-size: 7pt">Sudah Mempunyai Akun? <a href="login">Masuk Disini</a></p>
            </div>
        </form>
    </div>
</div>
