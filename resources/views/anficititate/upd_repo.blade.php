<h1 class="text-center fs-3 mt-5 mb-2" style="font-family: 'Times New Roman', Times, serif">UPDATE REPOSITORY</h1>
<div class="row justify-content-center">
    <div class="col-sm-8 ">
        <form action="pin" method="POST">
            <div class="form-group">
                <div class="row text-center justify-content-center" style="font-size: 9pt; margin-bottom: -20px">
                    <p>
                        <a class="text-white">-</a><a class="text-danger" style="text-decoration: none">s</a><a
                            class="text-white">-</a>
                    </p>
                </div>
                <label for="repository">Repository</label>

                <select class="form-select" name="repository" id="">
                    <option value="hy" selected>hy</option>
                </select>
            </div>
            <p style="font-size: 7pt; margin-bottom:-5px;">Or want to <a href="/anficititate/del_repo" class="text-danger">Delete
                    Repository</a> or <a href="/anficititate/slc_repo">Select Repository</a></p>
            <div class="form-group mt-2">
                <input id="namabaru" class="form-control" type="text" name="namabaru"
                    placeholder="Input new name here ...">
            </div>
            <div class="form-group mt-3">
                <label for="pin">PIN</label>
                <input id="pin" class="form-control" type="password" name="pin">
            </div>
            <div class="text-center mt-4">
                <input type="submit" name="enter" style="height: 38px; font-size: 12px; font-weight: bold"
                    class="btn btn-primary w-50" value="ENTER">
                <p class="mt-2" style="font-size: 7pt">Want to change account? <a href="/anficititate">Login again
                        Here</a>
                </p>
            </div>
        </form>
    </div>
</div>
