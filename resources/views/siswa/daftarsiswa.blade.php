<h1 class="text-center fs-4 mb-4">Daftar Siswa</h1>
<table class="table table-bordered table-striped text-center" style="font-size: 10pt">
    <tr>
        <th class="text-white" style="width: 20px">No</th>
        <th class="text-white">Nama</th>
        <th class="text-white">NIM</th>
        <th class="text-white">Kelas</th>
        <th class="text-white" style="width: 100px;">Ket.</th>
    </tr>
    @foreach ($data as $siswa)
        <tr>
            <td class="text-white">{{ $siswa->id }}</td>
            <td class="text-white">{{ $siswa->nama }}</td>
            <td class="text-white">{{ $siswa->nim }}</td>
            <td class="text-white">{{ $siswa->kelas }}</td>
            <td class="text-white">
                <a href="/siswa/hapus/{{ $siswa->nim }}" style="font-size: 8pt;">Hapus</a>
                <a> | </a>
                <a href="/siswa/update/{{ $siswa->nim }}" style="font-size: 8pt;">Update</a>
            </td>
        </tr>
    @endforeach
</table>
