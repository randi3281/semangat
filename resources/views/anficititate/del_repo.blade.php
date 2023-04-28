<h1 class="text-center fs-3 mt-5 mb-5" style="font-family: 'Times New Roman', Times, serif">HAPUS REPOSITORY</h1>
<div class="row text-center justify-content-center" style="font-size: 9pt; margin-top:-40px; margin-bottom: 10px">
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
        <form action="/anficititate/delete_repo" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="repository">Repositori</label>
                {{-- <input id="my-input" class="form-control" type="text" name=""> --}}
                <select class="form-select" name="repository">
                    @foreach ($datarepo as $repodata)
                        <option value="{{$repodata->repositori}}">{{$repodata->repositori}}</option>
                    @endforeach
                </select>
            </div>
            <p style="font-size: 7pt">Atau ingin untuk <a href="/anficititate/slc_repo">Pilih Repository</a> atau <a class="text-danger" href="/anficititate/upd_repo">Perbarui
                    Repositori</a></p>
            <div class="form-group mt-3" style="margin-bottom: -0px">
                <label for="pin">PIN</label>
                <input id="pin" class="form-control" type="password" maxlength="6" minlength="6" name="pin" autofocus required placeholder="Masukin PIN kamu disini ya">
            </div>
            <div class="text-center mt-5">
                <input type="submit" style="height: 38px; font-size: 12px; font-weight: bold"
                    class="btn btn-danger w-50" name="delete" value="HAPUS">
                <p class="mt-2" style="font-size: 7pt">Ingin Mengganti Akun? <a href="login">Login Kembali Disini</a>
                </p>
            </div>
        </form>
    </div>
</div>
