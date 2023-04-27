<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Randi Footnote</title>
    @vite('resources/sass/app.scss')
    <style>
        tr * {
            font-size: 10pt;
            font-family: 'Times New Roman';
        }
    </style>
</head>

<body class="bg-primary">
    <div class="container-fluid" style="padding-top: 3px;">
        <div class="row mt-2">

            {{-- Kelola Footnote --}}
            <div class="col-lg-4 mb-2">
                <div class="card mb-3" style="height: 548px;">
                    <div class="card-body">
                        <h4 class="text-center">Kelola Footnote</h4>

                        {{-- Form Kelola --}}
                        <form action="anficititate/kelola" method="POST">
                            {{ csrf_field() }}
                            <div class="mt-4 form-group">
                                <input type="hidden" name="jp" value="{{ $jumlahpenulis }}">
                                <input type="hidden" name="jenisf" value="{{ $jenis }}">
                                <input type="hidden" name="urut" value="{{ $nomor }}">
                                <select name="jenis_footnote" class="form-select-sm">
                                    @switch($jenis)
                                        @case(1)
                                            <option value="1" selected>Jurnal</option>
                                            <option value="2">Website</option>
                                        @break

                                        @case(2)
                                            <option value="1">Jurnal</option>
                                            <option value="2" selected>Website</option>
                                        @break
                                    @endswitch
                                </select>
                                <input type="submit" class="btn btn-success"
                                    style="margin-right: 4px;height: 28px; font-size:8pt; margin-top: -2px"
                                    value="ENTER" name="tomboljenis">
                                <input type="text" class="form-control-sm" name="nourut"
                                    style="margin-right: 11px;width: 50px;" placeholder="No"
                                    value="{{ $nomor }}">
                                @switch($apakahedit)
                                    @case(0)
                                        {{-- Switch --}}
                                        @switch($jenis)
                                            @case(1)
                                                {{-- Form Jurnal --}}
                                                <label for="jumlah">Jumlah Penulis : </label>
                                                <select class="form-select-sm" name="jumlah_penulis" style=" width: 50px;"
                                                    onchange="javascript:handleselect(this)">
                                                    {{-- Percabangan --}}
                                                    @if (isset($jumlahpenulis))
                                                        @if ($jumlahpenulis == 4)
                                                            <option value="4" selected>Lebih dari 3</option>
                                                            @for ($x = 1; $x <= 3; $x++)
                                                                <option value="{{ $x }}">
                                                                    {{ $x }}
                                                                </option>
                                                            @endfor
                                                        @else
                                                            @for ($x = 1; $x <= 3; $x++)
                                                                @if ($x == $jumlahpenulis)
                                                                    <option value="{{ $x }}" selected>{{ $x }}
                                                                    </option>
                                                                @else
                                                                    <option class="mb-2" value="{{ $x }}">
                                                                        {{ $x }}
                                                                    </option>
                                                                @endif
                                                            @endfor
                                                            <option value="4">Lebih dari 3</option>
                                                        @endif
                                                    @else
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">Lebih dari 3</option>
                                                    @endif
                                                    {{-- End Percabangan --}}
                                                </select>
                                            </div>

                                            <div class="mt-1 form-group">
                                                @if (isset($jumlahpenulis))
                                                    @if ($jumlahpenulis == 4)
                                                        <input type="text" class=" form-control" placeholder="Penulis 1"
                                                            name="penulis_1">
                                                    @else
                                                        @for ($i = 1; $i <= $jumlahpenulis; $i++)
                                                            <input type="text" class="form-control"
                                                                placeholder="Penulis {{ $i }}"
                                                                name="penulis_{{ $i }}">
                                                        @endfor
                                                    @endif
                                                @else
                                                    <input type="text" class="form-control" placeholder="Penulis 1" name="penulis_1">
                                                @endif
                                            </div>

                                            <div class="form-group  mt-2">
                                                <label for="judul">Judul</label> <br>
                                                <textarea name="judul" class="form-control"style="font-size : 11px;" id="" cols="30" rows="3"
                                                    placeholder="Tuliskan Judul"></textarea>
                                            </div>

                                            <div class="mt-1 form-group">
                                                <textarea name="sumber" class="form-control"style="font-size : 11px;" id="" cols="30" rows="2"
                                                    placeholder="Sumber"></textarea>
                                            </div>

                                            <div class="mt-2 form-group">
                                                <input type="text" class="text-center form-control-sm" name="volume"
                                                    style="width:70px;" placeholder="Volume">
                                                <input type="text" class="text-center form-control-sm" name="nomor"
                                                    style="width:70px;" placeholder="Nomor">
                                                <input type="text" class="text-center form-control-sm" name="tahun"
                                                    style="width:70px;" placeholder="Tahun">
                                                <label for="halaman">Hal: </label>
                                                <input type="text" class="text-center form-control-sm float-left"
                                                    style="width:60px;" name="halaman_awal" placeholder="Awal">
                                                -
                                                <input type="text" class="text-center form-control-sm float-left"
                                                    style="width:60px;" name="halaman_akhir" placeholder="Akhir">
                                            </div>
                                            <div class="mt-2 form-group">
                                                <input type="text" class="form-control" name="kota" placeholder="Asal Kota">
                                            </div>

                                            {{-- End Form Jurnal --}}
                                        @break

                                        @case(2)
                                    </div>
                                    {{-- Form Website --}}
                                    <div class="form-group  mt-3">
                                        <label for="judul_web">Judul Web</label> <br>
                                        <textarea name="judul_web" class="form-control" style="font-size : 11px;" cols="30" rows="3"
                                            placeholder="Tuliskan Judul"></textarea>
                                    </div>

                                    <div class="mt-3 form-group">
                                        <label for="deskripsi_web">Deskripsi Web</label>
                                        <textarea type="text" class="form-control" style="font-size : 11px;" cols="30" rows="3"
                                            name="deskripsi_web" placeholder="Deskripsi"></textarea>
                                    </div>

                                    <div class="mt-2 form-group">
                                        <input type="text" class="form-control" name="tahun_web" placeholder="Tahun">
                                    </div>

                                    <div class="mt-2 form-group">
                                        <input type="text" class="form-control" name="link_web" placeholder="Link">
                                    </div>

                                    <div class="mt-2 form-group">
                                        <input type="text" class="form-control" name="tanggal_diakses_web"
                                            placeholder="Tanggal Diakses">
                                    </div>
                                    {{-- End Form Website --}}
                                @break

                            @endswitch
                            {{-- End Switch --}}
                        @break

                        @case(1)
                            @foreach ($editan as $edita)
                                {{-- Switch --}}
                                @switch($edita->jenis)
                                    @case(1)
                                        {{-- Form Jurnal --}}
                                        <input type="hidden" name="idedita" value="{{ $edita->id }}">
                                        <label for="jumlah">Jumlah Penulis : </label>
                                        <select class="form-select-sm" name="jumlah_penulis" style=" width: 50px;"
                                            onchange="javascript:handleselect(this)">

                                            {{-- Percabangan --}}
                                            @if (isset($jumlahpenulis))
                                                @if ($jumlahpenulis == 4)
                                                    <option value="4" selected>Lebih dari 3</option>
                                                    @for ($x = 1; $x <= 3; $x++)
                                                        <option value="{{ $x }}">
                                                            {{ $x }}
                                                        </option>
                                                    @endfor
                                                @else
                                                    @for ($x = 1; $x <= 3; $x++)
                                                        @if ($x == $jumlahpenulis)
                                                            <option value="{{ $x }}" selected>{{ $x }}
                                                            </option>
                                                        @else
                                                            <option class="mb-2" value="{{ $x }}">
                                                                {{ $x }}
                                                            </option>
                                                        @endif
                                                    @endfor
                                                    <option value="4">Lebih dari 3</option>
                                                @endif
                                            @else
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">Lebih dari 3</option>
                                            @endif
                                            {{-- End Percabangan --}}

                                        </select>
                                </div>

                                <div class="mt-1 form-group">
                                    @if (isset($jumlahpenulis))
                                        @if ($jumlahpenulis == 4)
                                            <input type="text" class=" form-control" placeholder="Penulis 1" name="penulis_1"
                                                value="{{ $edita->penulis_1 }}">
                                        @elseif ($jumlahpenulis == 3)
                                            <input type="text" class="form-control" placeholder="Penulis 1" name="penulis_1"
                                                value="{{ $edita->penulis_1 }}">
                                            <input type="text" class="form-control" placeholder="Penulis 2" name="penulis_2"
                                                value="{{ $edita->penulis_2 }}">
                                            <input type="text" class="form-control" placeholder="Penulis 3" name="penulis_3"
                                                value="{{ $edita->penulis_3 }}">
                                        @elseif ($jumlahpenulis == 2)
                                            <input type="text" class="form-control" placeholder="Penulis 1" name="penulis_1"
                                                value="{{ $edita->penulis_1 }}">
                                            <input type="text" class="form-control" placeholder="Penulis 2" name="penulis_2"
                                                value="{{ $edita->penulis_2 }}">
                                        @elseif ($jumlahpenulis == 1)
                                            <input type="text" class="form-control" placeholder="Penulis 1" name="penulis_1"
                                                value="{{ $edita->penulis_1 }}">
                                        @endif
                                    @else
                                        <input type="text" class="form-control" placeholder="Penulis 1" name="penulis_1">
                                    @endif
                                </div>

                                <div class="form-group  mt-2">
                                    <label for="judul">Judul</label> <br>
                                    <textarea name="judul" class="form-control"style="font-size : 11px;" id="" cols="30"
                                        rows="3" placeholder="Tuliskan Judul">{{ $edita->judul }}</textarea>
                                </div>

                                <div class="mt-1 form-group">
                                    <textarea name="sumber" class="form-control"style="font-size : 11px;" id="" cols="30"
                                        rows="2" placeholder="Sumber">{{ $edita->sumber }}</textarea>
                                </div>

                                <div class="mt-2 form-group">
                                    <label for="volume">Volume : </label>
                                    <input type="text" class="form-control-sm" name="volume" style="width:70px;"
                                        placeholder="Volume" value="{{ $edita->volume }}">
                                    <label for="nomor">Nomor : </label>
                                    <input type="text" class="form-control-sm" name="nomor" style="width:70px;"
                                        placeholder="Nomor" value="{{ $edita->nomor }}">
                                    <label for="tahun">Tahun : </label>
                                    <input type="text" class="form-control-sm" style="width:60px;" name="tahun"
                                        placeholder="Tahun"value="{{ $edita->tahun }}">
                                </div>

                                <div class="mt-2 form-group">
                                    <label for="halaman">Halaman : </label>
                                    <input type="text" class="form-control-sm float-left" style="width:60px;" name="halaman_awal"
                                        placeholder="Awal" value="{{ $edita->halaman_awal }}">
                                    -
                                    <input type="text" class="form-control-sm float-left" style="width:60px;"
                                        name="halaman_akhir" placeholder="Akhir" value="{{ $edita->halaman_akhir }}">
                                </div>
                                <div class="mt-2 form-group">
                                    <label for="halaman">Asal Kota : </label>
                                    <input type="text" class="form-control-sm" name="kota" placeholder="Asal Kota"
                                        value="{{ $edita->kota }}">
                                </div>
                                {{-- End Form Jurnal --}}
                            @break

                            @case(2)
                                {{-- Form Website --}}
                            </div>
                            <input type="hidden" name="idedita" value="{{ $edita->id }}">
                            <div class="form-group  mt-3">
                                <label for="judul_web">Judul Web</label> <br>
                                <textarea name="judul_web" class="form-control" style="font-size : 11px;" cols="30" rows="3"
                                    placeholder="Tuliskan Judul">{{ $edita->judul_web }}</textarea>
                            </div>

                            <div class="mt-3 form-group">
                                <label for="deskripsi_web">Deskripsi Web</label>
                                <textarea type="text" class="form-control" style="font-size : 11px;" cols="30" rows="3"
                                    name="deskripsi_web" placeholder="Deskripsi">{{ $edita->deskripsi_web }}</textarea>
                            </div>

                            <div class="mt-2 form-group">
                                <input type="text" class="form-control" name="tahun_web" placeholder="Tahun"
                                    value="{{ $edita->tahun_web }}">
                            </div>

                            <div class="mt-2 form-group">
                                <input type="text" class="form-control" name="link_web" placeholder="Link"
                                    value="{{ $edita->link_web }}">
                            </div>

                            <div class="mt-2 form-group">
                                <input type="text" class="form-control" name="tanggal_diakses_web" placeholder="Tanggal Diakses"
                                    value="{{ $edita->tanggal_diakses_web }}">
                            </div>
                            {{-- End Form Website --}}
                        @break
                    @endswitch
                    @endforeach
                    {{-- End Switch --}}
                @break

                </form>
            @endswitch
        </div>
    </div>
    <script type="text/javascript">
        function handleselect(elm) {
            window.location = "/" + {{ $jenis }} + "/" + elm.value;
        }
    </script>

    {{-- Tombol Kelola --}}
    <div class="card" style="height:75px;">
        <div class="card-body">
            <div class="text-center">
                <form action="/kelola" method="POST">
                    <input type="submit" name="input" value="Input" class="w-25 btn btn-primary">
                    <input type="submit" name="edit" value="Edit" class="w-25 btn btn-danger"
                        style="margin-left:20px">
                </form>
            </div>
        </div>
    </div>
    {{-- End Tombol Kelola --}}


    {{-- End Form Kelola --}}

    </div>
    {{-- End Kelola Footnote --}}

    {{-- Tabel Footnote --}}
    <div class="col-lg-8 mb-3">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row pb-0 justify-content-left">
                    <div class="pb-0 col-lg-5 mb-2 text-center">
                        <div>
                            <form action="/kelola" method="POST">
                                <input type="hidden" name="urut" value="{{ $nomor }}">
                                {{ csrf_field() }}
                                <input type="submit" name="rapi" value="Daftar Footnote"
                                    class="btn btn-success">
                                <input type="submit" name="dapus" value="Daftar Pustaka" class="btn btn-danger">
                            </form>
                        </div>
                    </div>
                    <div class="pb-0 text-center col-lg-7">
                        @if (isset($data))
                            {{ $data->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @switch($dapus)
                    @case(0)
                        <h4 class="text-center">Daftar Footnote</h4>
                        <table class="table table-striped">
                            <tr>
                                <th style="width: 35px;">No</th>
                                <th>Footnote</th>
                                <th style="width: 120px; text-align: center;">Keterangan</th>
                            </tr>
                            @foreach ($data as $ft)
                                <?php
                                if ($ft->jenis == 1) {
                                    if ($ft->jumlah_penulis == 3) {
                                        $kalimat = $ft->penulis_1;
                                        $kalimat .= ', ';
                                        $kalimat .= $ft->penulis_2;
                                        $kalimat .= ', dan ';
                                        $kalimat .= $ft->penulis_3;
                                        $kalimat .= ', "';
                                    } elseif ($ft->jumlah_penulis == 2) {
                                        $kalimat = $ft->penulis_1;
                                        $kalimat .= ' dan ';
                                        $kalimat .= $ft->penulis_2;
                                        $kalimat .= ', "';
                                    } elseif ($ft->jumlah_penulis == 1) {
                                        $kalimat = $ft->penulis_1;
                                        $kalimat .= ', "';
                                    } else {
                                        $kalimat = $ft->penulis_1;
                                        $kalimat .= ' dkk, "';
                                    }
                                    $kalimat .= $ft->judul;
                                    $kalimat .= '", ';
                                    $kalimat .= $ft->sumber;
                                    if (isset($ft->volume)) {
                                        $kalimat .= ', Vol. ';
                                        $kalimat .= $ft->volume;
                                        $kalimat .= ', ';
                                    } else {
                                        $kalimat .= ', ';
                                    }
                                    if (isset($ft->nomor)) {
                                        $kalimat .= 'No. ';
                                        $kalimat .= $ft->nomor;
                                        $kalimat .= ' (';
                                        $kalimat .= $ft->tahun;
                                        $kalimat .= '), hal. ';
                                    } else {
                                        $kalimat .= $ft->tahun;
                                        $kalimat .= ', hal. ';
                                    }
                                    if (isset($ft->halaman_akhir)) {
                                        $kalimat .= $ft->halaman_awal;
                                        $kalimat .= '-';
                                        $kalimat .= $ft->halaman_akhir;
                                    } else {
                                        $kalimat .= $ft->halaman_awal;
                                    }
                                    $kalimat .= '.';
                                } elseif ($ft->jenis) {
                                    $kalimat = $ft->judul_web;
                                    $kalimat .= ', "';
                                    $kalimat .= $ft->deskripsi_web;
                                    $kalimat .= '", ';
                                    $kalimat .= $ft->tahun_web;
                                    $kalimat .= ', ';
                                    $kalimat .= $ft->link_web;
                                    $kalimat .= '. Diakses pada ';
                                    $kalimat .= $ft->tanggal_diakses_web;
                                    $kalimat .= '.';
                                }
                                ?>
                                <tr>
                                    <td>{{ $ft->id }}</td>
                                    <td>{{ $kalimat }}</td>
                                    <td style=" text-align: center;">
                                        <a href="/edit/{{ $ft->jenis }}/{{ $ft->jumlah_penulis }}/{{ $ft->id }}"
                                            style="text-decoration: none; font-weight: bold; color:blue;">EDIT </a>
                                        |
                                        <a href="/hapus/{{ $ft->id }}"
                                            style="text-decoration: none; font-weight: bold; color:red;">
                                            HAPUS</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @break

                    @case(1)
                        <h4 class="text-center mb-4">Daftar Pustaka</h4>
                        <div style="font-size: 12pt; font-family: 'Times New Roman';">
                            <?php
                            $a = ['hy'];
                            ?>
                            @foreach ($dataa as $ft)
                                <?php
                                $izin = 0;
                                $ket = 0;
                                if ($ft->jenis == 1) {
                                    for ($w = 1; $w <= $ft->id; $w++) {
                                        if (isset($a[$w])) {
                                            if ($ft->judul == $a[$w]) {
                                                $izin = 0;
                                            } else {
                                                // $izin = 1;
                                                // $ket = 1;
                                            }
                                        } else {
                                            for ($o = 1; $o <= $ft->id; $o++) {
                                                if (isset($a[$o])) {
                                                    if ($ft->judul == $a[$o]) {
                                                        $ket = 1;
                                                    }
                                                }
                                            }
                                            if ($ket == 1) {
                                                $izin = 0;
                                                array_push($a, 'hy');
                                            } else {
                                                $izin = 1;
                                                array_push($a, $ft->judul);
                                            }
                                        }
                                    }

                                    if ($izin == 1) {
                                        $kal = $ft->penulis_1;
                                        $kali = explode(' ', $kal);
                                        $lika = end($kali);
                                        $kalimat = $lika;
                                        $kalimat .= ', ';
                                        foreach ($kali as $kila) {
                                            if ($kila == $lika) {
                                            } else {
                                                $kalimat .= ' ';
                                                $kalimat .= $kila;
                                            }
                                        }
                                        if ($ft->jumlah_penulis == 3) {
                                            $kalimat .= ', ';
                                            $kalimat .= $ft->penulis_2;
                                            $kalimat .= ', dan ';
                                            $kalimat .= $ft->penulis_3;
                                            $kalimat .= '. ';
                                        } elseif ($ft->jumlah_penulis == 2) {
                                            $kalimat .= ', ';
                                            $kalimat .= $ft->penulis_2;
                                            $kalimat .= '. ';
                                        } elseif ($ft->jumlah_penulis == 1) {
                                            $kalimat .= '. ';
                                        } else {
                                            $kalimat .= ' dkk. ';
                                        }
                                        $kalimat .= $ft->tahun;
                                        $kalimat .= '. ';
                                        $kalimat .= $ft->judul;
                                        $kalimat .= '. ';
                                        $kalimat .= $ft->kota;
                                        $kalimat .= ': ';
                                        $kalimat .= $ft->sumber;
                                        $kalimat .= '.';
                                        echo $kalimat . '<br/> <br/>';
                                    }
                                } elseif ($ft->jenis == 2) {
                                    for ($y = 1; $y <= $ft->id; $y++) {
                                        if (isset($a[$y])) {
                                            if ($ft->deskripsi_web == $a[$y]) {
                                                $izin = 0;
                                            } else {
                                                // $izin = 1;
                                                // $ket = 1;
                                            }
                                        } else {
                                            for ($t = 1; $t <= $ft->id; $t++) {
                                                if (isset($a[$t])) {
                                                    if ($ft->deskripsi_web == $a[$t]) {
                                                        $ket = 1;
                                                    }
                                                }
                                            }
                                            if ($ket == 1) {
                                                $izin = 0;
                                                array_push($a, 'hy');
                                            } else {
                                                $izin = 1;
                                                array_push($a, $ft->deskripsi_web);
                                            }
                                        }
                                    }

                                    if ($izin == 1) {
                                        $kal = $ft->judul_web;
                                        $kali = explode(' ', $kal);
                                        $lika = end($kali);
                                        $kalimata = $lika;
                                        $kalimata .= ', ';
                                        foreach ($kali as $kila) {
                                            if ($kila == $lika) {
                                            } else {
                                                $kalimata .= ' ';
                                                $kalimata .= $kila;
                                            }
                                        }
                                        $kalimata .= '. ';
                                        $kalimata .= $ft->link_web;
                                        $kalimata .= ', diakses pada ';
                                        $kalimata .= $ft->tanggal_diakses_web;
                                        $kalimata .= '. ';
                                        echo $kalimata . '<br/> <br/>';
                                    }
                                }
                                ?>
                            @endforeach
                        </div>
                    @break

                @endswitch
            </div>
        </div>
    </div>
    </div>
    {{-- End Tabel Footnote --}}
    </div>
</body>

</html>
