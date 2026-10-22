<link rel="stylesheet" href="/css/bg3dwall.css">
<link rel="stylesheet" href="/css/home.css">
<link rel="stylesheet" href="/css/destination_3d_card.css">
<section id="hero">

    <div class="perspective">
        <div class="img-cylinder" id="img-cylinder-home">
            <?php foreach ($AllPackagesNameAndID ?? [] as $index => $Package): ?>
                <?php if ($index < 90): ?>
                    <img class="image" style="--i:<?= $index ?>" src="<?= gdriveImage($Package->PACKAGE_IMAGE) ?>" alt="" width="256" height="256" decoding="async" fetchpriority="low" loading="lazy">
                <?php endif; ?>
            <?php endforeach; ?>

        </div>
        <div class="overlayLayer"></div>
        <div class="content">
            <div class="grid-center text-white">
                <div class="text-center">
                    <p in-view="animate__bounce">EXPLORE • EXPERIENCE • ESCAPE</p>
                    <h1 class="display-2">Pack your <span class="style-font display-1 text-warning">Bags</span><br> Let us do the <span class="style-font display-1text-warning">Rest</span></h1>
                    <p>From weekend getaways to unforgettable adventures, <br>discover handpicked trips designed to make your next journey effortless.</p>
                    <div class="d-flex">
                        <div class="input-group mb-3 bg-white rounded-pill p-2" data-bs-toggle="modal" data-bs-target="#SearchBox">
                            <input type="text" class="form-control rounded-pill border-0" placeholder="Where do you want to go?" aria-label="Where do you want to go?" aria-describedby="button-addon2" readonly>
                            <button class="btn btn-theme btn-voyager rounded-pill" type="submit" role="button" id="search-explore">Explore</button>
                        </div>
                    </div>
                </div>
                <em>Since 2016 · 70,000+ travellers · 4.6★ Google · 45K Happy Travelers · 300+ itineraries.</em>
            </div>

        </div>

    </div>


</section>
<section id="explore" class="pt-5">
    <div class="container">
        <div class="">
            <h1 class="display-3"><span>Explore</span><span class="style-font text-bg-gif"> Voyagers Beat</span> </h1>
            <p>
                Many ways to travel with us, from weekend escapes to long expeditions in Spiti Mountains.
            </p>
        </div>
        <div class="explore-container">
            <a href="/weekend" class="Weekend text-decoration-none">
                <h3 class="style-font ">Weekend Trips</h3>
                <p class="m-0">These Trips are Quick Routine Breaker • Life Refreshing • Memory Creation</p>
            </a>
            <a href="/type/Bike" class="Bike text-decoration-none">
                <h3 class="style-font ">Bike Trips</h3>
            </a>
            <a href="/type/Treks" class="Treks text-decoration-none">
                <h3 class="style-font ">Treks</h3>
            </a>
            <a href="/type/Party" class="Party text-decoration-none">
                <h3 class="style-font ">Party Trips</h3>
            </a>
            <a href="/type/Backpack" class="Backpacking text-decoration-none">
                <h3 class="style-font ">Backpacking Trips</h3>
            </a>
            <a href="/type/family-trip" class="Family text-decoration-none">
                <h3 class="style-font ">Family Trips</h3>
                <p class="m-0">Start the journey with your family .#voyagersbeat</p>
            </a>
            <a href="/type/honeymoon" class="Honeymoon text-decoration-none">
                <h3 class="style-font ">Honeymoon Trips</h3>
            </a>
            <a href="/type/Corporate" class="Corporate text-decoration-none">
                <h3 class="style-font ">Corporate Trips</h3>
            </a>
        </div>
    </div>

</section>
<section id="weekend-getaway" class="pt-5">
    <div class="container pt-5">
        <div class="">
            <h1 class="display-3"><span class="style-font text-bg-gif">Weekend </span><span>Getaways</span> </h1>
            <p>
                Weekend Getaways, Budget Weekend Trips and Treks planned from major cities New Delhi , Travel with the community #voyagersbeat
            </p>
        </div>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="weekend-1n" data-bs-toggle="pill" data-bs-target="#weekend-1n-pane" type="button" role="tab">1 Night / 2 Days</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="weekend-2n" data-bs-toggle="pill" data-bs-target="#weekend-2n-pane" type="button" role="tab">2 Night / 3 Days</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="weekend-3n" data-bs-toggle="pill" data-bs-target="#weekend-3n-pane" type="button" role="tab">3 Night / 4 Days</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="weekend-1n-pane" role="tabpanel" tabindex="0">
                <h3>Quick Routine Breaker Trips</h3>
                <div class="flex_wrap_section">
                    <?php foreach ($packages_1n ?? [] as $index => $Package): ?>
                        <?= view('pages/component/packageCard', ['package' => $Package]) ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="tab-pane fade" id="weekend-2n-pane" role="tabpanel" tabindex="0">
                <h3>Life Refreshing Trips</h3>
                <div class="flex_wrap_section">
                    <?php foreach ($packages_2n ?? [] as $index => $Package): ?>
                        <?= view('pages/component/packageCard', ['package' => $Package]) ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="tab-pane fade" id="weekend-3n-pane" role="tabpanel" tabindex="0">
                <h3>Memory Creation Trips</h3>
                <div class="flex_wrap_section">
                    <?php foreach ($packages_3n ?? [] as $index => $Package): ?>
                        <?= view('pages/component/packageCard', ['package' => $Package]) ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</section>
<section id="signature-exp" class="pt-5">
    <div class="container pt-5">
        <div class="">
            <h1 class="display-3"><span>Signature </span><span class="style-font text-bg-gif">Expedition</span> </h1>
            <p>
                Uncover breathtaking landscapes and uncharted passes on the Signature Expedition.
            </p>
        </div>
        <div>
            <div class="flex-wrapper">
                <a href="/packages/leh" class="flex-item relative" style="--url:url('/assets/img/ladakh.webp');">
                    <p class="fw-bolder style-font">Ladakh</p>
                </a>
                <a href="/packages/spiti" class="flex-item relative" style="--url:url('/assets/img/spiti.jpg');">
                    <p class="fw-bolder style-font">Spiti</p>
                </a>
            </div>
        </div>
    </div>
</section>
<section id="international-dest" class="pt-5">
    <div class="container pt-5">
        <div class="">
            <h1 class="display-3"><span>International</span><span class="style-font text-bg-gif"> Destination</span> </h1>
            <p>
                Global Journeys, Unforgettable Memories.
            </p>
        </div>
        <?php $destionation_3d = [
            [
                'name' => 'Almaty',
                'image_l1' => '../../assets/dest_int/almaty.webp?v=2',
                'image_l2' => '../../assets/dest_int/almaty-3d.webp?v=2',
                'link' => '/packages/Almaty',
            ],
            [
                'name' => 'Baku',
                'image_l1' => '../../assets/dest_int/baku.webp?v=2',
                'image_l2' => '../../assets/dest_int/baku-3d.webp?v=2',
                'link' => '/packages/Baku',
            ],
            [
                'name' => 'Bali',
                'image_l1' => '../../assets/dest_int/bali.webp?v=2',
                'image_l2' => '../../assets/dest_int/bali-3d.webp?v=2',
                'link' => '/packages/Bali',
            ],
            [
                'name' => 'Dubai',
                'image_l1' => '../../assets/dest_int/dubai.webp?v=2',
                'image_l2' => '../../assets/dest_int/dubai-3d.webp?v=2',
                'link' => '/packages/Dubai',
            ],
            [
                'name' => 'Singapore',
                'image_l1' => '../../assets/dest_int/singapore.webp?v=2',
                'image_l2' => '../../assets/dest_int/singapore-3d.webp?v=2',
                'link' => '/packages/Singapore',
            ],
            [
                'name' => 'Tashkent',
                'image_l1' => '../../assets/dest_int/tashkent.webp?v=2',
                'image_l2' => '../../assets/dest_int/tashkent-3d.webp?v=2',
                'link' => '/packages/Tashkent',
            ],
            [
                'name' => 'Thailand',
                'image_l1' => '../../assets/dest_int/thailand.webp?v=2',
                'image_l2' => '../../assets/dest_int/thailand-3d.webp?v=2',
                'link' => '/packages/Thailand',
            ],
            [
                'name' => 'Vietnam',
                'image_l1' => '../../assets/dest_int/vietnam.webp?v=2',
                'image_l2' => '../../assets/dest_int/vietnam-3d.webp?v=2',
                'link' => '/packages/Vietnam',
            ],
        ]; ?>
        <div>
            <div class="swiper home-slider2" style="padding-top:18px;">
                <div class="swiper-wrapper">
                    <?php foreach ($destionation_3d as $destionation): ?>
                        <div class="swiper-slide">
                            <?= view('pages/component/destination-3d-card', ['destination' => $destionation]) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="Domestic-dest" class="pt-5">
    <div class="container pt-5">
        <div class="text-center">
            <h1 class="display-3"><span>Domestic</span><span class="style-font text-bg-gif"> Destination</span> </h1>
            <p>Your Everyday Escape, Just Around the Corner.</p>
        </div>
    </div>
    <div>

        <div class="slider-curves">
            <div class="slider-wrapper">

                <?php foreach ($domesticDests ?? [] as $index => $row): ?>
                    <a class="slider-image text-decoration-none text-white style-font" href="/packages/<?= $row->LOCATION; ?>" style="--url:url('<?= str_replace("\n", "", gdriveImage($row->PACKAGE_IMAGE)) ?>');">
                        <p class="text-center fs-2"><?= $row->LOCATION; ?></p>
                    </a>
                <?php endforeach; ?>

            </div>
        </div>
    </div>

</section>
<section id="honeymoon" class="pt-5">
    <div class="container pt-5">
        <div class="text-center">
            <h1 class="display-3"><span class="style-font text-bg-gif">Honeymoon </span>Destinations</h1>
            <p>Escape into Romance.</p>
        </div>
        <div>
            <div class="flex-wrapper">
                <a href="/packages/Bali" class="flex-item relative" style="--url:url('/assets/img/couple-bali.png');">
                    <p class="fw-bolder style-font">Bali</p>
                </a>
                <a href="/country/Thailand" class="flex-item relative" style="--url:url('/assets/img/couple-thailand.webp');">
                    <p class="fw-bolder style-font">Thailand</p>
                </a>
                <a href="/country/Vietnam" class="flex-item relative" style="--url:url('/assets/img/couple-vietnam.webp');">
                    <p class="fw-bolder style-font">Vietnam</p>
                </a>
                <a href="/state/kerala" class="flex-item relative" style="--url:url('/assets/img/couple-kerala.png');">
                    <p class="fw-bolder style-font">Kerala</p>
                </a>
            </div>
        </div>
    </div>
</section>
<section id="why-us" class="pt-5">
    <div class="container pt-5">
        <div class="text-center">
            <h1 class="display-3">Why Plan Your <span class="style-font text-bg-gif">Holiday </span> with Voyagers Beat ?</h1>
            <p>Committed to helping its clients reach their goals, to personalizing their event experiences & to providing an innovative environment & comfortable Trip.</p>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <div class="card grid-center square radial-bg border-0" style="--radial-bg-color:#ff595e;">
                    <div class="text-center">
                        <p class="fs-5 style-font m-0">
                            <i class='bx bxs-map'></i>
                        </p>
                        <p class="fs-5">Location</p>
                        <hr>
                        <p class="style-font fs-2">700+</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card grid-center square radial-bg border-0" style="--radial-bg-color:#ffca3a;">
                    <div class="text-center">
                        <p class="fs-5 style-font m-0">
                            <i class='bx bxs-user-check'></i>
                        </p>
                        <p class="fs-5">Happy Clients</p>
                        <hr>
                        <p class="style-font fs-2">21000+</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card grid-center square radial-bg border-0" style="--radial-bg-color:#8ac926;">
                    <div class="text-center">
                        <p class="fs-5 style-font m-0">
                            <i class='bx bxs-briefcase-alt'></i>
                        </p>
                        <p class="fs-5">Trips Done</p>
                        <hr>
                        <p class="style-font fs-2">1500+</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card grid-center square radial-bg border-0" style="--radial-bg-color:#1982c4;">
                    <div class="text-center">
                        <p class="fs-5 style-font m-0">
                            <i class='bx bx-user-circle'></i>
                        </p>
                        <p class="fs-5">Experienced</p>
                        <hr>
                        <p class="style-font fs-2">Tour Guide</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card grid-center square radial-bg border-0" style="--radial-bg-color:#6a4c93;">
                    <div class="text-center">
                        <p class="fs-5 style-font m-0">
                            <i class='bx bxs-check-shield'></i>
                        </p>
                        <p class="fs-5">Quality</p>
                        <hr>
                        <p class="style-font fs-2">Assurance</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card grid-center square radial-bg border-0" style="--radial-bg-color:#ffca3a;">
                    <div class="text-center">
                        <p class="fs-5 style-font m-0">
                            <i class='bx bxs-phone-call'></i>
                        </p>
                        <p class="fs-5">Support</p>
                        <hr>
                        <p class="style-font fs-2">24 * 7</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if ($PopupSwitch): ?>
    <?= view('pages/component/popupQueryForm') ?>
<?php endif; ?>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@14.0.1/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper('.home-slider2', {
        slidesPerView: 5,
        spaceBetween: 30,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
</script>