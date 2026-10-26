<style>
    .swiper-slide>img {
        height: 100vh;
    }
</style>
<div class="container-fluid ">
    <div class="row">
        <div class="col-lg-6 hide-on-mobile p-0">
            <div class="swiper login-page-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img width="100%" height="100vh" src="/assets/backgrounds/1.jpg" style="object-fit:cover; object-position:bottom;" />
                    </div>
                    <div class="swiper-slide">
                        <img width="100%" height="100vh" src="/assets/backgrounds/2.jpg" style="object-fit:cover; object-position:bottom;" />
                    </div>
                    <div class="swiper-slide">
                        <img width="100%" height="100vh" src="/assets/backgrounds/3.jpg" style="object-fit:cover; object-position:bottom;" />
                    </div>

                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <div class="col-lg-6 full-vh grid-center">
            <div class="card ">
                <div class="card-body">
                    <div class="text-center">
                        <img src="<?= env('app.LogoPath') ?>" width="100px" alt="voyagersbeat.logo">
                        <hr>
                        <h4 class="fw-bold">Create your Account</h4>

                    </div>
                    <!--    <div class="grid-center">-->
                    <!--<div id="g_id_onload" data-client_id="1010170602006-kb84cpoucj3kqkeanl4v38bf31gp80f1.apps.googleusercontent.com" data-context="signin" data-ux_mode="popup" data-login_uri="<?= env('app.baseURL') ?>/signup" data-auto_prompt="false">-->
                    <!--</div>-->
                    <!--<div class="g_id_signin" data-type="standard" data-shape="rectangular" data-theme="outline" data-text="signup_with" data-size="large" data-logo_alignment="left">-->
                    <!--</div>-->
                    <!--</div>-->
                    <div class="divider-text"><span>Use Email</span></div>
                    <form action="/signupvalidation" class="" method="post"
                        data-loader
                        data-loader-title="Signing Up Your Account"
                        data-loader-steps="Validating your details...|Saving to the database...|Almost done...">
                        <div class="row">
                            <div class="col-6">
                                <div class=" mb-3">
                                    <label for="floatingInput">Name</label>
                                    <input type="text" class="form-control " id="floatingInput" name="name" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class=" mb-3">
                                    <label for="floatingInput">Email address</label>
                                    <input type="email" class="form-control " id="floatingInput" name="email" placeholder="name@example.com" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class=" mb-3">
                                    <label for="floatingInput">Gender</label>
                                    <div class="form-group">
                                        <select name="gender" id="" class="form-select" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class=" mb-3">
                                    <label for="floatingInput">Mobile No.</label>
                                    <input type="text" class="form-control" inputmode="numeric"
                                        pattern="\d{1,10}"
                                        maxlength="10" name="mobile" placeholder="Mobile No." required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class=" mb-3 ">
                                    <label for="floatingInput">Password</label>
                                    <input type="password" class="form-control" minlength="8" id="password" name="password" required>
                                    <small class="">( Password Length must be more than 8 Characters )</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class=" mb-3 ">
                                    <label for="floatingInput">Confirm Password</label>
                                    <input type="password" class="form-control" minlength="8" id="cpassword" name="cpassword" required oninput="handlePasswordEvents()">
                                </div>
                            </div>
                        </div>
                        <div id="match" class="hide alert alert-danger" role="alert">
                        </div>
                </div>
                <div class="card-footer d-flex justify-content-between">

                    <a href="/login" class="btn  btn-sm btn-outline-dark">Already Have Account ?</a>
                    <button type="submit" id="submit" class="btn btn-success btn-sm">Sign up</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://accounts.google.com/gsi/client" async defer></script>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@14.0.1/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper('.login-page-swiper', {
        effect: 'fade',
        autoplay: true,
        pagination: {
            el: '.swiper-pagination',
            dynamicBullets: true,
        },
    });
</script>

<script src="https://accounts.google.com/gsi/client" async defer></script>
<script>
    function togglePass() {
        let password = document.querySelector('#password');
        return password.type == "password" ? password.type = "text" : password.type = "password";
    }

    function handlePasswordEvents() {
        checkcpass();
    }

    function checkcpass() {
        let password = document.querySelector('#password');
        let cpassword = document.querySelector('#cpassword');
        let feedback = document.querySelector('#match');
        let submit = document.querySelector('#submit');
        if (password.value != cpassword.value && cpassword.value.length > 0) {
            feedback.classList.remove('hide');
            feedback.textContent = 'Password is not matching';
            feedback.classList.add('text-danger');
            submit.setAttribute('disabled', '');
        } else {
            feedback.classList.add('hide');
            feedback.textContent = '';
            feedback.classList.add('text-danger');
            submit.removeAttribute('disabled', '');
        }
    }
</script>