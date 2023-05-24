<div class="col-lg-8 mb-3">
    <div class="card mb-3">
        <div class="card-body">
            <div class="row pb-0 justify-content-center">
                <div class="pb-0 col-lg-4 text-center mb-3">
                    <div>
                        <form action="/anficititate/kelola" method="POST">
                            <input type="hidden" name="urut" value="{{ $nomor }}">
                            {{ csrf_field() }}
                            <input type="submit" name="keluar" value="Logout" class="btn btn-danger  mb-1">
                            <input type="submit" name="select" value="Pilih Repositori" class="btn btn-success mb-1">
                    </div>
                </div>
                <div class="col-lg-4">
                    @if (isset($data))
                        {{ $data->links() }}
                    @endif
                </div>
                <div class="col-lg-4 text-center">
                    @if (isset($_SESSION['jenisTabel']))

                        @if ($_SESSION['jenisTabel'] == 'daftarPustaka')
                            <input type="submit" name="rapi" value="Footnote" class="btn btn-outline-primary mb-1">
                            <input type="submit" name="dapus" value="Daftar Pustaka" class="btn btn-primary mb-1">
                        @else
                            <input type="submit" name="rapi" value="Footnote" class="btn btn-primary mb-1">
                            <input type="submit" name="dapus" value="Daftar Pustaka"
                                class="btn btn-outline-primary mb-1">
                        @endif
                    @else
                        <input type="submit" name="rapi" value="Footnote" class="btn btn-primary mb-1">
                        <input type="submit" name="dapus" value="Daftar Pustaka"
                            class="btn btn-outline-primary mb-1">
                    @endif
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @if ($_SESSION['jenisKampus'] == 'uingusdur')
                @switch($dapus)
                    @case(0)
                        @include('anficititate.tabel.UINGUSDUR.footnote')
                    @break

                    @case(1)
                        @include('anficititate.tabel.UINGUSDUR.dapus')
                    @break
                @endswitch
            @elseif($_SESSION['jenisKampus'] == 'itsnupkl')
                @switch($dapus)
                    @case(0)
                        @include('anficititate.tabel.ITSNUPKL.footnote')
                    @break

                    @case(1)
                        @include('anficititate.tabel.ITSNUPKL.dapus')
                    @break
                @endswitch
            @endif

        </div>
    </div>
</div>
</div>
