<div class="container-fluid">
    <div class="row full-vh custom-background" style="--bgUrl:url(/assets/backgrounds/1.jpg);--bg-attachment:fixed;">


        <div class="col-lg-12 grid-center">
            <?= view('pages/component/login-form') ?>
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