<?php

/**
 * @var array $packages
 * @var string $banners
 */
?>
<?php helper('custom'); ?>
<div class="container scroll-margin pt-2">

    <section id="mobile-hero" class="mb-3">
        <p class="display-5 text-center mt-2">Pack your <span class="style-font display-4 text-warning">Bags</span><br> Let us do the <span class="style-font display-4 text-warning">Rest</span></p>

        <!-- Swiper -->
        <div class="swiper package_images rounded-3 mt-2 mb-3">
            <div class="swiper-wrapper ">
                <?php if (!empty($banners) && json_validate($banners)) : ?>
                    <?php foreach (json_decode($banners) as $index => $banner) : ?>
                        <div class="swiper-slide">
                            <a href="<?= $banner->BannerLink ?>" target="_blank">
                                <img src="<?= gdriveImage($banner->BannerImageLink) ?>" alt="<?= $banner->BannerLink ?>" style="aspect-ratio: 3/2; width:100%; object-fit:cover;">
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="d-flex flex-wrap gap-1">
            <div class="border-sq-button flex-fill p-2 text-center" style="--circle-color:var(--maincolor);">
                70,000+<br>
                Followers
            </div>
            <div class="border-sq-button flex-fill p-2 text-center" style="--circle-color:var(--maincolor);">
                4.6 ⭐<br>
                700+ Google
                Reviews
            </div>
            <div class="border-sq-button flex-fill p-2 text-center" style="--circle-color:var(--maincolor);">
                300+<br>
                Itineraries
            </div>
            <div class="border-sq-button flex-fill p-2 text-center" style="--circle-color:var(--maincolor);">
                45k+<br>
                Happy Travelers
            </div>
        </div>
    </section>
    <section id="search-buttons">
        <div class="">
            <div class="input-group mb-3 bg-white rounded-pill p-2 border border-warning" data-bs-toggle="modal" data-bs-target="#SearchBox">
                <input type="text" class="form-control rounded-pill border-0" placeholder="Where do you want to go?" aria-label="Where do you want to go?" aria-describedby="button-addon2" readonly>
                <button class="btn btn-theme btn-voyager rounded-pill" type="submit" role="button" id="search-explore">Explore</button>
            </div>
        </div>
        <div class="d-flex gap-2 justify-content-between">
            <a href="/tag/hot-selling" class="btn btn-theme flex-fill fw-bold text-white" style="--btn-bg-color:#FF5A00;">Hot Trips</a>
            <a href="/upcoming" class="btn btn-theme flex-fill fw-bold text-white" style="--btn-bg-color:#4cc3a8;">Upcoming Trips</a>
        </div>
        <?= view('pages/component/AnnouncementBar-mobile') ?>
    </section>
    <section id="trip-type-scroller">
        <h5 class="my-2">Trips</h5>
        <div class="categories-wrapper invisible-scrollbar">
            <div class="categories">
                <a class="border-sq-button filter-btn" data-filter="all" style="--circle-color:#FFD60044;">
                    <div class="circle-with-text">ALL</div>
                    All
                </a>
                <a class="border-sq-button filter-btn activeFilter" data-filter="yes" style="--circle-color:#9e0142;">
                    <div class="circle-with-text">WE</div>
                    Weekend
                </a>
                <a class="border-sq-button filter-btn" data-filter="treks" style="--circle-color:#abdda4;">
                    <div class="circle-with-text">TR</div>
                    Trekking
                </a>
                <a class="border-sq-button filter-btn" data-filter="backpack" style="--circle-color:#d53e4f;">
                    <div class="circle-with-text">BP</div>
                    Backpacking
                </a>
                <a class="border-sq-button filter-btn" data-filter="family-trip" style="--circle-color:#f46d43;">
                    <div class="circle-with-text">FA</div>
                    Family
                </a>
                <a class="border-sq-button filter-btn" data-filter="spiritual" style="--circle-color:#fdae61;">
                    <div class="circle-with-text">SP</div>
                    Spiritual
                </a>
                <a class="border-sq-button filter-btn" data-filter="leh" style="--circle-color:#5e4fa2;">
                    <div class="circle-with-text">LH</div>
                    Leh
                </a>
                <a class="border-sq-button filter-btn" data-filter="spiti" style="--circle-color:#3288bd;">
                    <div class="circle-with-text">ST</div>
                    Spiti
                </a>

            </div>
        </div>
    </section>
</div>
<section class="container">
    <?php if (count($packages) > 0) : ?>
        <?php foreach ($packages as $package) : ?>
            <?= view('pages/component/packageCard', ['package' => $package]) ?>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="vh100 center overflow-clip relative">

            <?php if (isset($pageBannerText)) : ?>
                <h1 class="big-heading style-text-theme">Currently No Packages Found</h1>
            <?php else : ?>
                <h1 class="big-heading style-text-theme">No Packages Found</h1>
            <?php endif; ?>
            <br>
            <a href="/" class="btn btn-lg btn-dark">Back to Home</a>

        </div>
    <?php endif; ?>
</section>
<!-- Pagination Links -->
<?php if (isset($pager)): ?>
    <div class="pagination">
        <?= $pager->links() ?>
    </div>
<?php endif; ?>
<script src="/js/TripTypepackageFilter.js"></script>