<div class="card  p-4">
    <div class="text-center">
        <img src="<?= env('app.LogoPath') ?>" width="100px" alt="voyagersbeatlogo">
        <hr>
        <h4 class="fw-bold">Sign in to your Account</h4>
    </div>

    <div class="divider-text"><span>Use Email</span></div>
    <form action="/login-validation" method="post" id="login-form"
        data-loader
        data-loader-title="Logging into Account"
        data-loader-steps="Validating your details...|Checking Your Password...|Checking your Status... |Almost done...">

        <input type="hidden" name="redirect_url" value="<?= current_url() ?>">
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
    </form>
    <!-- <hr>

                <div class="grid-center">
                    <div id="g_id_onload"
                        data-client_id="1010170602006-kb84cpoucj3kqkeanl4v38bf31gp80f1.apps.googleusercontent.com"
                        data-context="signin" data-ux_mode="popup" data-login_uri="<?= env('app.baseURL') ?>/login"
                        data-auto_prompt="false">
                    </div>
                    <div class="g_id_signin" data-type="standard" data-shape="rectangular" data-theme="outline"
                        data-text="signin_with" data-size="large" data-logo_alignment="left">
                    </div>
                </div> -->
    <hr>

    <div class="d-flex justify-content-between">
        <div>
            <button type="submit" class="btn btn-success" form="login-form">Sign In</button>
            <a href="/forgot_password_form" class="btn btn-outline-dark">Forgot Password ?</a>
        </div>
        <div>
            <a href="/signup" class="btn btn-dark ">Sign Up</a>
        </div>
    </div>


</div>