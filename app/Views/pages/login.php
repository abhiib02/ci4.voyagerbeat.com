<div class="container-fluid">
    <div class="row full-vh custom-background" style="--bgUrl:url(/assets/backgrounds/1.jpg);">

        <div class="col-lg-12 grid-center">

            <div class="card theme-card p-4 mx-auto">
                <div class="text-center">
                    <img src="<?= env('app.LogoPath') ?>" width="100px" alt="voyagersbeatlogo">
                    <hr>
                    <h4 class="fw-bold">Sign in to your Account</h4>
                </div>
                <!--<div class="grid-center">-->
                <!--    <div id="g_id_onload"-->
                <!--        data-client_id="1010170602006-kb84cpoucj3kqkeanl4v38bf31gp80f1.apps.googleusercontent.com"-->
                <!--        data-context="signin" data-ux_mode="popup" data-login_uri="<?= env('app.baseURL') ?>/login"-->
                <!--        data-auto_prompt="false">-->
                <!--    </div>-->
                <!--    <div class="g_id_signin" data-type="standard" data-shape="rectangular" data-theme="outline"-->
                <!--        data-text="signin_with" data-size="large" data-logo_alignment="left">-->
                <!--    </div>-->
                <!--</div>-->
                <div class="divider-text"><span>Use Email</span></div>
                <form action="/login-validation" method="post">

                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com"
                            required>
                        <label for="email">Email address</label>
                    </div>
                    <div class="d-flex">
                        <div class="form-floating flex-fill">
                            <input type="password" class="form-control" id="password" placeholder="Password"
                                name="password" required>
                            <label for="password">Password</label>
                        </div>
                        <a class="btn btn-light grid-center" onclick="togglePass()">&#128065;</a>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="submit" class="btn btn-sm btn-success">Sign In</button><br>
                            <a href="/forgot_password_form" class="btn btn-sm btn-light">Forgot Password ?</a>
                        </div>
                        <div>
                            <a href="/signup" class="btn btn-sm btn-dark ">Sign Up</a>
                        </div>
                    </div>

            </div>
            </form>
        </div>

    </div>
</div>
</div>
<script src="https://accounts.google.com/gsi/client" async defer></script>
<script>
    function togglePass() {
        let password = document.querySelector('#password');
        return password.type = password.type === "password" ? "text" : "password";
    }
</script>