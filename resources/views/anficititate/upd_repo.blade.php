<h1 class="text-center fs-3 mt-5 mb-3" style="font-family: 'Times New Roman', Times, serif">GANTI NAMA REPOSITORI</h1>
<div class="row text-center justify-content-center" style="font-size: 9pt; margin-top: -15px; margin-bottom: -20px">
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
        <form action="/anficititate/upd_repo" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="row text-center justify-content-center" style="font-size: 9pt; margin-bottom: -20px">
                    <p>
                        <a class="text-white">-</a><a class="text-danger" style="text-decoration: none"></a><a
                            class="text-white">-</a>
                    </p>
                </div>
                <label for="repository">Repositori</label>

                <select class="form-select" name="repository">
                    @foreach ($datarepo as $repodata)
                        <option value="{{ $repodata->repositori }}">{{ $repodata->repositori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-2">
                <input id="namabaru" class="form-control" type="text" name="namabaru"
                    placeholder="Masukkan nama repositori yang baru">
            </div>
            <div class="form-group mt-3">
                <label for="pin">PIN</label>
                <input id="pin" class="form-control" maxlength="6" minlength="6" type="password" name="pin"
                    autofocus placeholder="Masukin PIN kamu disini ya">
            </div>
            <div class="text-center mt-4">
                <input type="submit" name="enter" style="height: 38px; font-size: 10px; font-weight: bold"
                    class="btn btn-danger w-25" value="GANTI">
                <input type="submit" style="height: 38px; font-size: 10px; font-weight: bold"
                    class="btn btn-outline-primary w-50" name="kembali" value="KEMBALI">
                </p>
            </div>
        </form>
    </div>
</div>
