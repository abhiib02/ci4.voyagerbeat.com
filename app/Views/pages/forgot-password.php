<div class="container-fluid">
    <div class="row full-vh custom-background" style="--bgUrl:url(/assets/backgrounds/1.jpg);">

        <div class="col-lg-12 grid-center">

            <div class="card theme-card p-4 w-25 mx-auto">
                <div class="text-center">
                    <img src="<?= env('app.LogoPath') ?>" width="100px" alt="voyagersBeatlogo">
                    <hr>
                    <h4 class="fw-bold">Reset Password</h4>

                </div>
                <form action="/forgotpassword" id="forgot-password-form" method="post">
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com"
                            required>
                        <label for="email">Email address</label>
                    </div>
                    <br>
                    <button type="submit" id="forgot-pass-request" class="btn btn-sm btn-success">Submit</button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    document.querySelector('#forgot-password-form').addEventListener('submit', () => {
        runToast('Sending Reset Link To Mail...', 'info', '10s');
    })
</script>