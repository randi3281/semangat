<h1 class="text-center fs-4 mb-4"> Kelola Siswa</h1>
<form action="/siswa/input" method="POST">
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
        <input type="submit" value="Enter" class="mt-4 btn btn-primary w-50 mb-5">
    </div>
</form>
