<h1 class="text-center fs-3 mt-5 mb-4" style="font-family: 'Times New Roman', Times, serif">PILIH REPOSITORI</h1>
<div class="row justify-content-center">
    <div class="col-sm-8 ">
        <form action="home" method="POST">
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
            <p style="font-size: 7pt">Atau ingin untuk <a href="/anficititate/del_repo" class="text-danger">Hapus
                    Repositori</a> atau <a href="/anficititate/upd_repo">Perbarui
                    Repositori</a></p>
            <div class="form-group" style="margin-top: -15px">
                <label for="pin">Format Kampus</label>
                <select name="kampus" id="" class="form-select">
                    <option value="uingusdur" selected>UIN K.H. Abdurrahman Wahid</option>
                    <option value="itsnupkl">ITSNU Pekalongan</option>
                </select>
            </div>
            <div class="form-group mt-1">
                <label for="pin">PIN</label>
                <input id="pin" class="form-control" type="password" maxlength="6" name="pin" minlength="6" autofocus placeholder="Masukin PIN kamu disini ya">
            </div>
            <div class="text-center mt-4">
                <input type="submit" style="height: 38px; font-size: 12px; font-weight: bold"
                    class="btn btn-primary w-25" name="enter" value="MASUK">
                <input type="submit" style="height: 38px; font-size: 12px; font-weight: bold"
                    class="btn btn-secondary w-50" name="new" value="BUAT BARU">
                <p class="mt-2" style="font-size: 7pt">Ingin Mengganti Akun? <a href="/anficititate/back">Login
                        Kembali Disini</a>
                </p>
            </div>
        </form>
    </div>
</div>
