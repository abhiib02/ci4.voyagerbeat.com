<!-- <section class="hero-background ">
    <div class="container">
        <div class="row full-vh">
            <div class="col-lg-6 grid-center">
                <div class="text-white">
                    <p class="display-1 fw-bold">Pack Your Bags</p>
                    <p class="display-1">Let Us do the Rest</p>
                    <p class="big-text">
                        <span> PACK </span> |
                        <span> EXPLORE </span>|
                        <span> ESCAPE </span>|
                        <span> REPEAT </span>
                    </p>
                    <div class="w-50">
                        <div class="input-group mb-3 bg-white rounded-pill p-2" data-bs-toggle="modal" data-bs-target="#SearchBox">
                            <input type="text" class="form-control rounded-pill border-0" placeholder="Where do you want to go?" aria-label="Where do you want to go?" aria-describedby="button-addon2" readonly>
                            <button class="btn btn-theme btn-voyager rounded-pill" type="submit" role="button" id="search-explore">Explore</button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-6 grid-center">
                view('pages/component/reviewCardCarousel')  
            </div>
        </div>
    </div>


</section> -->
<!-- <section class="">
    <div class="layers">

        <div class="layer custom-bg" style="--url:url('/assets/parallax/L1.webp'); --mul:-0.01;"></div>
        <div class="layer ">
            <div class="container">
                <div class="row full-vh">
                    <div class="col-lg-6 grid-center">
                        <div class="text-white text-shadow">
                            <p class="display-1 fw-bold ">Pack Your Bags</p>
                            <p class="display-1">Let Us do the Rest</p>
                            <p class="big-text">
                                <span> PACK </span> |
                                <span> EXPLORE </span>|
                                <span> ESCAPE </span>|
                                <span> REPEAT </span>
                            </p>
                            <div class="w-50">
                                <div class="input-group mb-3 bg-white rounded-pill p-2" data-bs-toggle="modal" data-bs-target="#SearchBox">
                                    <input type="text" class="form-control rounded-pill border-0" placeholder="Where do you want to go?" aria-label="Where do you want to go?" aria-describedby="button-addon2" readonly>
                                    <button class="btn btn-theme btn-voyager rounded-pill" type="submit" role="button" id="search-explore">Explore</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6 grid-center">
                        <?= //view('pages/component/reviewCardCarousel') ?>
                    </div>
                </div>
            </div>
            <div class="layer custom-bg" style="--url:url('/assets/parallax/L0.webp'); --mul:-0.02;"></div>
        </div>
</section> -->

<section style="background: linear-gradient(-90deg,rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 1) 100%),url('/assets/backgrounds/bg.jpg');background-size:cover;">
    <div class="full-vh grid-center text-white">
        <div class="text-center">
            <p>EXPLORE • EXPERIENCE • ESCAPE</p>
            <h1 class="display-2">Pack your <span class="style-font display-1 text-warning">Bags</span><br> Let us do the <span class="style-font display-1text-warning">Rest</span></h1>
            <p>From weekend getaways to unforgettable adventures, <br>discover handpicked trips designed to make your next journey effortless.</p>
            <div class="">
                <div class="input-group mb-3 bg-white rounded-pill p-2" data-bs-toggle="modal" data-bs-target="#SearchBox">
                    <input type="text" class="form-control rounded-pill border-0" placeholder="Where do you want to go?" aria-label="Where do you want to go?" aria-describedby="button-addon2" readonly>
                    <button class="btn btn-theme btn-voyager rounded-pill" type="submit" role="button" id="search-explore">Explore</button>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    let layers = document.querySelector('.layers');
    layers.addEventListener('mousemove', (e) => {
        let x = e.clientX - (window.innerWidth / 2);
        let y = e.clientY - (window.innerHeight / 2);
        layers.style.setProperty('--x', x);
        layers.style.setProperty('--y', y);
    })
</script>
<?= view('pages/component/popupQueryForm') ?>