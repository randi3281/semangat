<h1 class="text-center fs-3 mt-5 mb-4" style="font-family: 'Times New Roman', Times, serif">UPDATE REPOSITORY</h1>
<div class="row justify-content-center">
    <div class="col-sm-8 ">
        <form action="pin" method="POST">
            <div class="form-group">
                <label for="my-input">Repository</label>
                {{-- <input id="my-input" class="form-control" type="text" name=""> --}}
                <select class="form-select" name="repository" id="">
                    <option value="hy" selected>hy</option>
                </select>
            </div>
            <p  style="font-size: 7pt; margin-bottom:-5px;">Or want to <a href="del_repo" class="text-danger">Delete Repository</a> or <a href="slc_repo">Select Repository</a></p>
            <div class="form-group mt-2">
                <input id="my-input" class="form-control" type="text" name="" placeholder="Input new name here ...">
            </div>
            <div class="form-group mt-3">
                <label for="my-input">PIN</label>
                <input id="my-input" class="form-control" type="password" name="">
            </div>
            <div class="text-center mt-4">
                <input type="submit" style="height: 38px; font-size: 12px; font-weight: bold"
                    class="btn btn-primary w-50" value="ENTER">
                <p class="mt-2" style="font-size: 7pt">Want to change account? <a href="login">Login again Here</a></p>
            </div>
        </form>
    </div>
</div>
