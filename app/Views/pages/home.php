<?php

/**
 * @var array $AllPackagesNameAndID
 * @var array $domesticDests
 * @var string $cssversion
 */
?>
<?php
$winterMonthArr = [11, 12, 1, 2, 3];
$summerMonthArr = [4, 5, 6, 7, 8, 9, 10];
$nightTimeArr = [17, 18, 19, 20, 21, 22, 23, 0, 1, 2, 3, 4, 5, 6];
$dayTimeArr = [7, 8, 9, 10, 11, 12, 13, 14, 15, 16];
$dt = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
$isthour = $dt->format('G');
?>
<link rel="stylesheet" href="/css/bg3dwall.css?v=<?= $cssversion ?>">
<link rel="stylesheet" href="/css/home.css?v=<?= $cssversion ?>">
<link rel="stylesheet" href="/css/destination_3d_card.css?v=<?= $cssversion ?>">
<?php if (in_array(date('m'), $winterMonthArr)): ?>
    <section id="screenEffect">
        <style>
            #screenEffect {
                pointer-events: none;
            }

            #snowfall {
                position: fixed;
                top: 0%;
                left: 0%;
                width: 100vw;
                height: 100vh;
                z-index: 100;
                mix-blend-mode: lighten;
                pointer-events: none;
            }
        </style>
        <canvas id="snowfall"></canvas>
        <script>
            // gets the canvas element
            const canvas = document.querySelector('#snowfall');

            // gets the width and height of browser viewport
            const width = window.innerWidth;
            const height = window.innerHeight;

            //   set the width and height of canvas equal to browser viewport
            canvas.width = width;
            canvas.height = height;

            //   call the getContext method to draw 2d shape
            const ctx = canvas.getContext('2d');

            // create Ball class
            class Ball {
                constructor(x, y, velx, vely, size, color) {
                    this.x = x; // horizontal position of the ball
                    this.y = y; // vertical position of the ball
                    this.velx = velx; // velocity x added to coordinate x when we animate our ball
                    this.vely = vely; // velocity y added to coordinate y
                    this.size = size; // size is a radius of the ball
                    this.color = color; // fill ball shape with given color
                }

                // create draw func
                drawBall() {
                    ctx.beginPath(); // start drawing
                    ctx.fillStyle = this.color; // fill ball shape with given color

                    // x and y is center of the ball
                    // size is radius of the ball
                    // 0 is a start point of degree around radius of the ball
                    // 2 * Math.PI is an end point which is equivalent to 360 degree
                    ctx.arc(this.x, this.y, this.size, 0, 2 * Math.PI);
                    ctx.fill(); // finish drawing
                }

                // create update func
                updateBall() {
                    // if x and y position is greater than or less than
                    // browser viewport than balls turn another direction

                    if (this.x + this.size >= width) {
                        this.x = 0;
                    }

                    if (this.y + this.size >= height) {
                        this.y = 0;
                    }


                    /*if (this.x + this.size >= width || this.x - this.size <= 0) {
                      this.velx = -this.velx;
                    }

                    if (this.y + this.size >= height || this.y - this.size <= 0) {
                      this.vely = -this.vely;
                    }*/

                    // x and y velocity added to x and y coordinate
                    // everytime updateBall func is called
                    this.x += this.velx;
                    this.y += this.vely;
                }
            }

            //   create random number generator func
            function random(min, max) {
                const num = Math.floor(Math.random() * (max - min + 1)) + min;
                return num;
            }

            function randomFloat(min, max) {
                const num = (Math.random() * (max - min + 1)) + min;
                return num;
            }

            //   create some balls and store in an array
            const balls = [];

            while (balls.length < 300) {
                let size = randomFloat(0.01, 0.9);

                // create a new instance of Ball class
                // now replace static number with random number
                const ball = new Ball(
                    random(size, width - size),
                    random(size, height - size),
                    random(1, 5),
                    randomFloat(0.5, 0.9),
                    size,
                    `rgb(${random(253,255)}, ${random(253,255)}, ${random(253,255)})`
                );

                balls.push(ball);
            }

            //   create loop func
            function loop() {
                // cover the previous frame's drawing before the next one is drawn
                ctx.fillStyle = 'rgb(0,0,0)';
                ctx.fillRect(0, 0, width, height);
                // run necessary func
                for (let i = 0; i < balls.length; i++) {
                    balls[i].drawBall();
                    balls[i].updateBall();
                }

                // lets calls loop func itself over and over again
                //  and make animation smooth
                requestAnimationFrame(loop);
            }

            // finaly call the loop func once ot start
            loop();
        </script>
    </section>
<?php endif; ?>
<section id="hero">
    <div class="perspective">
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
                <em>Since 2017 · 4.6★ Google · 70k Happy Travelers · 300+ itineraries.</em>
            </div>
        </div>
        <div class="layers">

            <div class="layer custom-bg timing-opacity" style="--delay:0;--url:url('/assets/backgrounds/blue-sky.webp'); --mul:0;"></div>
            <div class="layer custom-bg timing-opacity" style="--delay:100;--url:url('/assets/backgrounds/clouds.webp');--mul:0.005;background-size:600px;background-repeat:repeat;"></div>


            <?php if (in_array(date('m'), $winterMonthArr)): ?>
                <?php if (in_array($isthour, $nightTimeArr)): ?>
                    <div class="layer custom-bg timing-opacity" style="--delay:0;--url:url('/assets/backgrounds/winter-spiti-night-layer.webp'); --mul:0;"></div>
                <?php else: ?>
                    <div class="layer custom-bg timing-opacity" style="--delay:0;--url:url('/assets/backgrounds/winter-spiti-layer.webp'); --mul:0;"></div>
                <?php endif; ?>
            <?php else: ?>
                <?php if (in_array($isthour, $nightTimeArr)): ?>
                    <div class="layer custom-bg timing-opacity" style="--delay:0;--url:url('/assets/backgrounds/spiti-night-layer.webp'); --mul:0;"></div>
                <?php else: ?>
                    <div class="layer custom-bg timing-opacity" style="--delay:0;--url:url('/assets/backgrounds/spiti-layer.webp'); --mul:0;"></div>
                <?php endif; ?>
            <?php endif; ?>

        </div>
        <div class="overlayLayer"></div>


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
            <a href="/weekend" class="Weekend text-decoration-none" style="--url:url('/assets/img/weekend-mascot.webp');">
                <p class="style-font fs-3 m-0">Weekend Trips</p>
                <p class="m-0">These Trips are Quick Routine Breaker • Life Refreshing • Memory Creation</p>
            </a>
            <a href="/type/Bike" class="Bike text-decoration-none" style="--url:url('/assets/img/bike-mascot.webp');">
                <p class="style-font fs-3 m-0">Bike Trips</p>
            </a>
            <a href="/type/Treks" class="Treks text-decoration-none" style="--url:url('/assets/img/trek-mascot.webp');">
                <p class="style-font fs-3 m-0">Treks</p>
            </a>
            <a href="/type/Party" class="Party text-decoration-none" style="--url:url('/assets/img/party-mascot.webp');">
                <p class="style-font fs-3 m-0">Party Trips</p>
            </a>
            <a href="/type/Backpack" class="Backpacking text-decoration-none" style="--url:url('/assets/img/backpack-mascot.webp');">
                <p class="style-font fs-3 m-0">Backpacking Trips</p>
            </a>
            <a href="/type/family-trip" class="Family text-decoration-none" style="--url:url('/assets/img/family-mascot.webp');">
                <p class="style-font fs-3 m-0">Family Trips</p>
                <p class="m-0">Start the journey with your family .#voyagersbeat</p>
            </a>
            <a href="/type/honeymoon" class="Honeymoon text-decoration-none" style="--url:url('/assets/img/honeymoon-mascot.webp');">
                <p class="style-font fs-3 m-0">Honeymoon Trips</p>
            </a>
            <a href="/type/Corporate" class="Corporate text-decoration-none" style="--url:url('/assets/img/corporate-mascot.webp');">
                <p class="style-font fs-3 m-0">Corporate Trips</p>
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
                <p class="fs-4 style-font m-0">Quick Routine Breaker Trips</p>
                <div class="flex_wrap_section">
                    <?php foreach ($packages_1n ?? [] as $index => $Package): ?>
                        <?= view('pages/component/packageCard', ['package' => $Package]) ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="tab-pane fade" id="weekend-2n-pane" role="tabpanel" tabindex="0">
                <p class="fs-4 style-font m-0">Life Refreshing Trips</p>
                <div class="flex_wrap_section">
                    <?php foreach ($packages_2n ?? [] as $index => $Package): ?>
                        <?= view('pages/component/packageCard', ['package' => $Package]) ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="tab-pane fade" id="weekend-3n-pane" role="tabpanel" tabindex="0">
                <p class="fs-4 style-font m-0">Memory Creation Trips</p>
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
                <a href="/packages/spiti" class="flex-item relative" style="--url:url('/assets/img/spiti.webp');">
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
        <?= view('pages/component/infinite-marquee', ['Destinations' => $domesticDests]) ?>
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
                <a href="/packages/Bali" class="flex-item relative" style="--url:url('/assets/img/couple-bali.webp');">
                    <p class="fw-bolder style-font">Bali</p>
                </a>
                <a href="/country/Thailand" class="flex-item relative" style="--url:url('/assets/img/couple-thailand.webp');">
                    <p class="fw-bolder style-font">Thailand</p>
                </a>
                <a href="/country/Vietnam" class="flex-item relative" style="--url:url('/assets/img/couple-vietnam.webp');">
                    <p class="fw-bolder style-font">Vietnam</p>
                </a>
                <a href="/state/kerala" class="flex-item relative" style="--url:url('/assets/img/couple-kerala.webp');">
                    <p class="fw-bolder style-font">Kerala</p>
                </a>
            </div>
        </div>
    </div>
</section>
<section id="instagram-section" class="pt-5">
    <div class="container pt-5">
        <div class="row">
            <div class="col-lg-3 col-6">
                <p class="text-uppercase">Only a Backpack Away</p>
                <p class="fs-1 fw-bold style-font">Follow Along<br> on <span class="text-bg-insta insta-bg">Instagram</span></p>
                <div class="d-flex gap-2">
                    <div class="square grid-center rounded-circle insta-story">
                        <img src="<?= env('app.LogoPath') ?>" width="64px" alt="">
                    </div>
                    <div class="align-content-center">
                        <p class="fw-bold  m-0">@voyagersbeat <svg aria-label="Verified" class="x1lliihq x1n2onr6" fill="rgb(0, 149, 246)" height="18" role="img" viewBox="0 0 40 40" width="18">
                                <title>Verified</title>
                                <path d="M19.998 3.094 14.638 0l-2.972 5.15H5.432v6.354L0 14.64 3.094 20 0 25.359l5.432 3.137v5.905h5.975L14.638 40l5.36-3.094L25.358 40l3.232-5.6h6.162v-6.01L40 25.359 36.905 20 40 14.641l-5.248-3.03v-6.46h-6.419L25.358 0l-5.36 3.094Zm7.415 11.225 2.254 2.287-11.43 11.5-6.835-6.93 2.244-2.258 4.587 4.581 9.18-9.18Z" fill-rule="evenodd"></path>
                            </svg></p>
                        <p class="text-muted m-0">Voyagers Beat ( Live to Travel )</p>
                    </div>
                </div>
                <div class="pt-3">
                    <ul class="list-unstyled">
                        <li>✨Est. 2017 | 15K+ Trips & Counting</li>
                        <li>🤝Group Trips | Corporate |Custom Trips</li>
                        <li>🦺Trusted Travel Community</li>
                        <li>🏔️Travel.Explore.Create Stories.</li>
                    </ul>
                    <hr>
                    <div class="d-flex gap-5">
                        <div>
                            <p class="m-0 fs-5 fw-bold">2,955+</p>
                            <p class="m-0 text-muted">POSTS</p>
                        </div>
                        <div>
                            <p class="m-0 fs-5 fw-bold">65k+</p>
                            <p class="m-0 text-muted">FOLLOWERS</p>
                        </div>
                    </div>
                    <hr>
                    <a href="https://www.instagram.com/voyagersbeat/" aria-label="open instagram" class="btn btn-lg insta-bg rounded-pill text-white" style="background-size: 130%;background-repeat: no-repeat;background-position: center;">Follow @voyagersbeat</a>
                </div>
            </div>
            <div class="col-lg-9 col-6">
                <?php $instaSecVideos = [
                    '/assets/videos/1.mp4',
                    '/assets/videos/2.mp4',
                    '/assets/videos/3.mp4',
                    '/assets/videos/4.mp4',
                    '/assets/videos/5.mp4',
                    '/assets/videos/6.mp4',
                ]; ?>
                <div class="swiper insta-sec-slide" style="padding-top:18px;">
                    <div class="swiper-wrapper">
                        <?php foreach ($instaSecVideos as $video): ?>
                            <div class="swiper-slide">
                                <a class="square" aria-label="open Instagram" href="https://www.instagram.com/voyagersbeat/">
                                    <video width="100%" height="auto" style="object-fit: contain;" class="rounded-3" loading="lazy" autoplay loop muted>
                                        <source src="<?= $video ?>" type="video/mp4">
                                    </video>
                                </a>

                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
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
            <div class="col-lg-2 col-4">
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
            <div class="col-lg-2 col-4">
                <div class="card grid-center square radial-bg border-0" style="--radial-bg-color:#ffca3a;">
                    <div class="text-center">
                        <p class="fs-5 style-font m-0">
                            <i class='bx bxs-user-check'></i>
                        </p>
                        <p class="fs-5">Happy Clients</p>
                        <hr>
                        <p class="style-font fs-2">70,000+</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-4">
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
            <div class="col-lg-2 col-4">
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
            <div class="col-lg-2 col-4">
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
            <div class="col-lg-2 col-4">
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
<?php if ($PopupSwitch ?? false): ?>
    <?= view('pages/component/popupQueryForm') ?>
<?php endif; ?>