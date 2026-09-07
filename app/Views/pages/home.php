<section class="hero-background ">
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
                            <button class="btn btn-theme rounded-pill" type="submit" role="button" id="search-explore">Explore</button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-6 grid-center">
                <?= view('pages/component/reviewCardCarousel') ?>
            </div>
        </div>
    </div>


</section>