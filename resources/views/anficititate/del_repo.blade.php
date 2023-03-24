<h1 class="text-center fs-3 mt-5 mb-5" style="font-family: 'Times New Roman', Times, serif">DELETE REPOSITORY</h1>
<div class="row justify-content-center">
    <div class="col-sm-8 ">
        <form action="pin" method="POST">
            <div class="form-group">
                <label for="repository">Repository</label>
                {{-- <input id="my-input" class="form-control" type="text" name=""> --}}
                <select class="form-select" name="repository" id="">
                    <option value="hy" selected>hy</option>
                </select>
            </div>
            <p style="font-size: 7pt">Or want to <a href="slc_repo">Select Repository</a> or <a href="upd_repo">Update
                    Repository</a></p>
            <div class="form-group mt-3">
                <label for="pin">PIN</label>
                <input id="pin" class="form-control" type="password" name="pin">
            </div>
            <div class="text-center mt-5">
                <input type="submit" style="height: 38px; font-size: 12px; font-weight: bold"
                    class="btn btn-danger w-50" name="delete" value="DELETE">
                <p class="mt-2" style="font-size: 7pt">Want to change account? <a href="login">Login again Here</a>
                </p>
            </div>
        </form>
    </div>
</div>
