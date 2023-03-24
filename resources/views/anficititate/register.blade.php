<h1 class="text-center fs-3 mt-4 mb-4" style="font-family: 'Times New Roman', Times, serif">REGISTER</h1>
<div class="row justify-content-center">
    <div class="col-sm-8 ">
        <form action="login" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="my-input">Username</label>
                <input id="my-input" class="form-control" type="text" name="">
            </div>
            <div class="form-group mt-1">
                <label for="my-input">Password</label>
                <input id="my-input" class="form-control" type="text" name="">
            </div>
            <div class="form-group mt-1">
                <label for="my-input">PIN</label>
                <input id="my-input" class="form-control" type="text" name="">
            </div>
            <div class="text-center mt-5">
                <input type="submit" style="height: 38px; font-size: 12px; font-weight: bold"
                    class="btn btn-primary w-50" value="ENTER">
                <p class="mt-2" style="font-size: 7pt">Was Have Account? <a href="login">Login Here</a></p>
            </div>
        </form>
    </div>
</div>
