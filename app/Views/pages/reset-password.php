<div class="container-fluid">
    <div class="row full-vh custom-background" style="--bgUrl:url(/assets/backgrounds/1.jpg);">

        <div class="col-lg-12 grid-center">

            <div class="card theme-card p-4 dw-50-mw-100  ">
                <div class="text-center">
                    <img src="<?= env('app.LogoPath') ?>" width="100px" alt="ltt">
                    <h4 class="fw-bold">Set A New Password</h4>

                </div>
                <form action="/reset" method="post">
                    <input type="hidden" name="token" value="<?= esc($token ?? '') ?>" />
                    <div class="mb-3">
                        <label class="password">Password</label>
                        <input type="password" name="password" class="form-control" minlength="8" id="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" name="cpassword" id="confirm_password" minlength="8" class="form-control" required>
                    </div>
                    <div class="">
                        <label for="" class="text-danger" id="error-msg"></label>
                    </div>
                    <button type="submit" name="btn_login" class="btn btn-success">Reset
                        Password</button>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    var password = document.getElementById("password"),
        confirm_password = document.getElementById("confirm_password"),
        errormsg = document.getElementById("error-msg");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
            errormsg.innerHTML = "Passwords Don't Match";
        } else {
            confirm_password.setCustomValidity('');
            errormsg.innerHTML = "";
        }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>