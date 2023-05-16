<div class="col-lg-8 mb-3">
    <div class="card mb-3">
        <div class="card-body">
            <div class="row pb-0 justify-content-left">
                <div class="pb-0 col-lg-7 mb-2 text-center">
                    <div>
                        <form action="/anficititate/kelola" method="POST">
                            <input type="hidden" name="urut" value="{{ $nomor }}">
                            {{ csrf_field() }}
                            <input type="submit" name="keluar" value="Logout" class="btn btn-danger">
                            <input type="submit" name="select" value="Pilih Repositori" class="btn btn-success">
                            <input type="submit" name="rapi" value="Daftar Footnote" class="btn btn-primary">
                            <input type="submit" name="dapus" value="Daftar Pustaka" class="btn btn-primary">
                        </form>
                    </div>
                </div>
                <div class="pb-0 text-center col-lg-5">
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
                    @include('anficititate.tabel.UINGUSDUR.footnote')
                @break

                @case(1)
                    @include('anficititate.tabel.UINGUSDUR.dapus')
                @break
            @endswitch
        </div>
    </div>
</div>
</div>
