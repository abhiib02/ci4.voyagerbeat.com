<style>
    .swiper-slide>img {
        height: 100vh;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 hide-on-mobile p-0">
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
        <div class="col-lg-4 full-vh grid-center ">
            <div class=" w-100">
                <?= view('pages/component/login-form') ?>
            </div>
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