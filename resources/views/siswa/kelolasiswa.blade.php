@switch($kelola)
    @case(1)
        <h1 class="text-center fs-4 mb-4"> Kelola Siswa</h1>
        <form action="siswa/input" method="POST">
            {{ csrf_field() }}
            <div class="form-group mb-2">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" placeholder="masukkan nama ...." name="nama">
            </div>
            <div class="form-group mb-2">
                <label for="nim">NIM</label>
                <input type="text" class="form-control" placeholder="masukkan NIM ...." name="nim">
            </div>
            <div class="form-group mb-2">
                <label for="kelas">Kelas</label>
                <input type="text" class="form-control" placeholder="masukkan kelas ...." name="kelas">
            </div>
            <div class="text-center">
                <input type="submit" value="Enter" name="enter" class="mt-4 btn btn-primary w-50 mb-5">
            </div>
        </form>
    @break

    @case(2)
        <h1 class="text-center fs-4 mb-4"> Kelola Siswa</h1>
        <form action="updatingdata" method="POST">
            {{ csrf_field() }}
            @foreach ($dataupdate as $ud)
                <input type="hidden" value="{{ $ud->nim }}" name="hiddennim">
                <div class="form-group mb-2">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" placeholder="masukkan nama ...." name="nama"
                        value="{{ $ud->nama }}">
                </div>
                <div class="form-group mb-2">
                    <label for="nim">NIM</label>
                    <input type="text" class="form-control" placeholder="masukkan NIM ...." name="nim"
                        value="{{ $ud->nim }}">
                </div>
                <div class="form-group mb-2">
                    <label for="kelas">Kelas</label>
                    <input type="text" class="form-control" placeholder="masukkan kelas ...." name="kelas"
                        value="{{ $ud->kelas }}">
                </div>
            @endforeach
            <div class="text-center">
                <div class="row justify-content-center mt-4">
                    <input type="submit" value="Batal" name="batal" class="btn btn-danger w-25" style="margin-right: 20px">
                    <input type="submit" value="Update" name="update" class="btn btn-primary w-25">
                </div>
            </div>
        </form>
    @break

@endswitch
