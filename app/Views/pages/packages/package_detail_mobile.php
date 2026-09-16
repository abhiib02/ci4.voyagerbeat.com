<?php helper('packageImage'); ?>
<link rel="stylesheet" href="/css/package-detail-mobile.css">
<div class="scroll-margin">
    <div class="package_detail_content_mobile">

        <section class="pdf-download" id="pdf">
            <?php if (!empty($package->PACKAGE_PDF)): ?>
                <button data-href="/upload/package_pdf/<?= $package->PACKAGE_PDF; ?>" onclick="downloadURI('/upload/package_pdf/<?= $package->PACKAGE_PDF; ?>','')" type="button" class="btn btn-sm btn-theme btn-warning "> Download PDF <i class='bx bxs-download'></i></button>
            <?php endif; ?>
        </section>

        <section class="images" id="package_images">
            <!-- Swiper -->
            <div class="swiper package_images">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <?= imageLinkType($package->PACKAGE_IMAGE); ?>
                    </div>
                    <div class="swiper-slide">
                        <?= imageLinkType($package->IMAGE_1); ?>
                    </div>
                    <div class="swiper-slide">
                        <?= imageLinkType($package->IMAGE_2); ?>
                    </div>
                    <div class="swiper-slide">
                        <?= imageLinkType($package->IMAGE_3); ?>
                    </div>
                    <div class="swiper-slide">
                        <?= imageLinkType($package->IMAGE_4); ?>
                    </div>

                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>

        <section class="container" id="package_name">
            <h5><?= $package->PACKAGE_NAME; ?></h5>
            <span class="main-color-text"><i class='bx bxs-location-plus'></i></span>&nbsp;<span><?= $package->LOCATION; ?></span>•<span><?= $package->COUNTRY; ?></span>
        </section>

        <section class="container" id="quick-info">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="border rounded-3 my-2 flex-fill">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="rounded-3 bg-warning bg-opacity-10 text-warning p-3 me-3">
                            <i class="bx bx-time-five fs-3"></i>
                        </div>
                        <div class="text-start">
                            <span class="text-muted small fw-semibold text-uppercase">Duration</span>
                            <h6 class="mb-0 fw-bold text-dark">5 Days</h6>
                        </div>
                    </div>
                </div>
                <div class="border rounded-3 my-2 flex-fill">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="rounded-3 bg-warning bg-opacity-10 text-warning p-3 me-3">
                            <i class='bx bx-map-pin fs-3'></i>
                        </div>
                        <div class="text-start">
                            <span class="text-muted small fw-semibold text-uppercase">Pick n Drop</span>
                            <h6 class="mb-0 fw-bold text-dark">
                                <?= ($package->PICKNDROP) ?? 'Delhi to Delhi' ?>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="border rounded-3 my-2 flex-fill">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="rounded-3 bg-warning bg-opacity-10 text-warning p-3 me-3">
                            <i class='bx bx-rupee fs-3'></i>
                        </div>
                        <div class="text-start">
                            <span class="text-muted small fw-semibold text-uppercase">Starting Price</span>
                            <h6 class="mb-0 fw-bold text-dark">
                                <?php if ($package->REQUEST_PRICE) : ?>
                                    Price on Request
                                <?php else: ?>
                                    ₹ <?= $package->PRICE_1; ?>
                                <?php endif; ?>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="container" id="costing">

            <?= view('pages/packages/component/cost-section-sidebar', ['package' => $package]) ?>
        </section>
        <section class="container" id="dates">
            <h3 class="text-theme-secondary">Dates</h3>
            <?= view('pages/packages/component/dates-section', ['package' => $package]) ?>
        </section>
        <section class="container" id="itinerary">
            <h3 class="text-theme-secondary">Day to Day Itinerary</h3>
            <?= view('pages/packages/component/itinerarySection', ['package' => $package]) ?>
        </section>
        <br>
        <section class="container" id="Inclusion">
            <h3 class="text-success">Inclusion</h3>
            <div class="row">
                <div class="col-lg-6">
                    <div class="alert alert-success">
                        <h5 class="">Trip Inclusion</h5>
                        <hr>
                        <div class="wysiwyg">
                            <?= $package->INCLUSION ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="container" id="Exclusion">
            <h3 class="text-danger">Exclusion</h3>
            <div class="row">
                <div class="col-lg-6">
                    <div class="alert alert-danger">
                        <h5 class="">Trip Exclusion</h5>
                        <hr>
                        <div class="wysiwyg">
                            <?= $package->EXCLUSION ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="container" id="Highlight">
            <h3 class="">Highlight</h3>
            <div class="wysiwyg">
                <?= $package->TRIP_HIGHLIGHT ?>
            </div>
        </section>
        <section class="container" id="thingstocarry">

            <p class="mid-text main-color-text">Things To Carry</p>

            <div class="accordion accordion-flush" id="thingsToCarryAccordion">

                <!-- Gadgets -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingGadgets">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGadgets" aria-expanded="false" aria-controls="collapseGadgets">
                            Gadgets
                        </button>
                    </h2>
                    <div id="collapseGadgets" class="accordion-collapse collapse" aria-labelledby="headingGadgets" data-bs-parent="#thingsToCarryAccordion">
                        <div class="accordion-body">
                            <ul>
                                <li>Camera</li>
                                <li>Power Bank</li>
                                <li>LED torch light</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Gears -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingGears">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGears" aria-expanded="false" aria-controls="collapseGears">
                            Gears
                        </button>
                    </h2>
                    <div id="collapseGears" class="accordion-collapse collapse" aria-labelledby="headingGears" data-bs-parent="#thingsToCarryAccordion">
                        <div class="accordion-body">
                            <ul>
                                <li>A rucksack bag and a day pack</li>
                                <li>3-litre water bladder or water bottle</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Clothes -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingClothes">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseClothes" aria-expanded="false" aria-controls="collapseClothes">
                            Clothes
                        </button>
                    </h2>
                    <div id="collapseClothes" class="accordion-collapse collapse" aria-labelledby="headingClothes" data-bs-parent="#thingsToCarryAccordion">
                        <div class="accordion-body">
                            <ul>
                                <li>A sun cap and a woolen cap</li>
                                <li>UV protected sunglasses</li>
                                <li>One cotton long sleeves and 2 short sleeve t-shirt</li>
                                <li>1 fleece jacket</li>
                                <li>1 heavy Thick jacket/down jacket</li>
                                <li>1 pair of gloves At least 2 long pants (trek pants and cargo pants are favourable)</li>
                                <li>4 sets of undergarments</li>
                                <li>2 pair of socks</li>
                                <li>A small towel</li>
                                <li>A rain jacket or a poncho</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Footwear -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFootwear">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFootwear" aria-expanded="false" aria-controls="collapseFootwear">
                            Footwear
                        </button>
                    </h2>
                    <div id="collapseFootwear" class="accordion-collapse collapse" aria-labelledby="headingFootwear" data-bs-parent="#thingsToCarryAccordion">
                        <div class="accordion-body">
                            <ul>
                                <li>Above-the-ankle waterproof and breathable hiking boots with good grip</li>
                                <li>Flip flops/sandals</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Medication -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingMedication">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMedication" aria-expanded="false" aria-controls="collapseMedication">
                            Medication
                        </button>
                    </h2>
                    <div id="collapseMedication" class="accordion-collapse collapse" aria-labelledby="headingMedication" data-bs-parent="#thingsToCarryAccordion">
                        <div class="accordion-body">
                            <ul>
                                <li>Glucose powder</li>
                                <li>Medicines for headaches</li>
                                <li>Medicines for diarrhoea</li>
                                <li>Medicines for muscular pain</li>
                                <li>Medicines for motion and altitude sickness</li>
                                <li>Dettol</li>
                                <li>Bandages</li>
                                <li>Cotton</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Personal Accessories -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingAccessories">
                        <button class="accordion-button collapsed" type="button" data-bs-type="button" data-bs-toggle="collapse" data-bs-target="#collapseAccessories" aria-expanded="false" aria-controls="collapseAccessories">
                            Personal Accessories
                        </button>
                    </h2>
                    <div id="collapseAccessories" class="accordion-collapse collapse" aria-labelledby="headingAccessories" data-bs-parent="#thingsToCarryAccordion">
                        <div class="accordion-body">
                            <ul>
                                <li>Toothpaste</li>
                                <li>Toothbrush</li>
                                <li>Paper soap &amp; sanitizer</li>
                                <li>Sunscreen minimum of spf40</li>
                                <li>Lip balm</li>
                                <li>cold creams</li>
                                <li>Body spray</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
</div>
<div class="package_detail_content">

    <div class="images">

        <!-- Swiper -->

        <div class="package_gallery_wrapper">


            <?php if ($package->PACKAGE_PDF) : ?>

                <button class="btn themebtn pdf-link" style="height:min-content; --btn-color:#ff7722; font-weight:bold;" onclick="downloadURI('../../pdf/<?php echo $package->PACKAGE_PDF; ?>','')" data-href="../../pdf/<?php echo $package->PACKAGE_PDF; ?>"><i class='bx bx-download' style="font-size:1rem;"></i> PDF</button>

            <?php endif; ?>

        </div>

        <!-- Swiper -->

    </div>

    <div class="details">

        <br>

        <div class="container">

            <h5><?= $package->PACKAGE_NAME; ?></h5>

            <p class="second-color-text"><span class="main-color-text"><i class='bx bxs-location-plus'></i></span>&nbsp;&nbsp;<?= $package->LOCATION; ?>,<?= $package->COUNTRY; ?></p>

        </div>

        <br>

        <!-- details section -->

        <div class="container ">

            <div class="flex-new" style="gap: 20px;">

                <div class="detail-box">

                    <div>

                        <i class="bx bx-time-five main-color-text big-text"></i><br>

                        Duration <br>

                        <!-- format the string to N/D -->

                        <b> <?= preg_replace('/\s*Nights?\s*\/\s*(\d+)\s*Days?/i', 'N/$1D', $package->PACKAGE_DAYS); ?></b>

                    </div>

                </div>

                <div class="detail-box">

                    <div>

                        <i class="bx bx-car main-color-text big-text"></i><br>

                        Pick and Drop <br>



                        <b> <?= $package->PICKNDROP ?></b>

                    </div>

                </div>

                <div class="detail-box">

                    <div>

                        <span class="" style="font-size:2em;font-weight:bolder;color:var(--maincolor) !important;">₹</span><br>

                        Starting Price <br>

                        <?php if ($package->REQUEST_PRICE) : ?>

                            <b class="">Price on Request </b>

                        <?php else: ?>

                            <b class="">₹ <?= $package->PRICE_1; ?></b>

                        <?php endif; ?>

                    </div>

                </div>

            </div>



        </div>

        <br>

        <!-- price section -->

        <?php if (!$package->REQUEST_PRICE): ?>
            <div class="container">
                <p class="mid-text main-color-text">Prices</p>
            </div>
            <?php if ($package->HEAD_PRICE != "0"): ?>
                <div class="container ">
                    <p class="main-color-text"><?= $package->HEAD_PRICE; ?></p>
                    <br>

                    <div class="flex-new" style="gap: 20px;">

                        <?php if (($package->INFO_P1 != null) && ($package->PRICE_1 > 0)) : ?>

                            <div class="detail-box">

                                <p class="second-color-text">

                                    <?= $package->INFO_P1; ?></p>

                                <b class="main-color-text mid-text"> ₹ <?= $package->PRICE_1; ?> </b>

                                <p>per person</p>

                            </div>

                        <?php endif; ?>

                        <?php if (($package->INFO_P2 != null) && ($package->PRICE_2 > 0)) : ?>

                            <div class="detail-box">

                                <p class="second-color-text">

                                    <?= $package->INFO_P2; ?></p>

                                <b class="main-color-text mid-text"> ₹ <?= $package->PRICE_2; ?> </b>

                                <p>per person</p>

                            </div>

                        <?php endif; ?>

                    </div>

                    <br>

                    <div class="flex-new" style="gap: 20px;">

                        <?php if (($package->INFO_P3 != null) && ($package->PRICE_3 > 0)) : ?>

                            <div class="detail-box">

                                <p class="second-color-text">

                                    <?= $package->INFO_P3; ?></p>

                                <b class="main-color-text mid-text"> ₹ <?= $package->PRICE_3; ?> </b>

                                <p>per person</p>

                            </div>

                        <?php endif; ?>

                        <?php if (($package->INFO_P4 != null) && ($package->PRICE_4 > 0)) : ?>

                            <div class="detail-box">

                                <p class="second-color-text">

                                    <?= $package->INFO_P4; ?></p>

                                <b class="main-color-text mid-text"> ₹ <?= $package->PRICE_4; ?> </b>

                                <p>per person</p>

                            </div>

                        <?php endif; ?>

                        <?php if (($package->INFO_P5 != null) && ($package->PRICE_5 > 0)) : ?>

                            <div class="detail-box">

                                <p class="second-color-text">

                                    <?= $package->INFO_P5; ?></p>

                                <b class="main-color-text mid-text"> ₹ <?= $package->PRICE_5; ?> </b>

                                <p>per person</p>

                            </div>

                        <?php endif; ?>

                    </div>

                    <br>


                </div>
                <br>
            <?php endif; ?>

            <?php if ($package->HEAD_WTPRICE != "0" && $package->HEAD_WTPRICE != ""): ?>
                <div class="container ">


                    <p class="main-color-text"><?= $package->HEAD_WTPRICE; ?></p>
                    <br>

                    <div class="flex-new" style="gap: 20px;">

                        <?php if (($package->INFO_P1 != null) && ($package->WT_PRICE_1 > 0)) : ?>

                            <div class="detail-box">

                                <p class="second-color-text">

                                    <?= $package->INFO_P1; ?></p>

                                <b class="main-color-text mid-text"> ₹ <?= $package->WT_PRICE_1; ?> </b>

                                <p>per person</p>

                            </div>

                        <?php endif; ?>

                        <?php if (($package->INFO_P2 != null) && ($package->WT_PRICE_2 > 0)) : ?>

                            <div class="detail-box">

                                <p class="second-color-text">

                                    <?= $package->INFO_P2; ?></p>

                                <b class="main-color-text mid-text"> ₹ <?= $package->WT_PRICE_2; ?> </b>

                                <p>per person</p>

                            </div>

                        <?php endif; ?>

                    </div>

                    <br>

                    <div class="flex-new" style="gap: 20px;">

                        <?php if (($package->INFO_P3 != null) && ($package->WT_PRICE_3 > 0)) : ?>

                            <div class="detail-box">

                                <p class="second-color-text">

                                    <?= $package->INFO_P3; ?></p>

                                <b class="main-color-text mid-text"> ₹ <?= $package->WT_PRICE_3; ?> </b>

                                <p>per person</p>

                            </div>

                        <?php endif; ?>

                        <?php if (($package->INFO_P4 != null) && ($package->WT_PRICE_4 > 0)) : ?>

                            <div class="detail-box">

                                <p class="second-color-text">

                                    <?= $package->INFO_P4; ?></p>

                                <b class="main-color-text mid-text"> ₹ <?= $package->WT_PRICE_4; ?> </b>

                                <p>per person</p>

                            </div>

                        <?php endif; ?>

                        <?php if (($package->INFO_P5 != null) && ($package->WT_PRICE_5 > 0)) : ?>

                            <div class="detail-box">

                                <p class="second-color-text">

                                    <?= $package->INFO_P5; ?></p>

                                <b class="main-color-text mid-text"> ₹ <?= $package->WT_PRICE_5; ?> </b>

                                <p>per person</p>

                            </div>

                        <?php endif; ?>

                    </div>

                    <br>



                </div>
                <br>
            <?php endif; ?>

            <?php if ($package->HEAD_WT2PRICE != "" && $package->HEAD_WT2PRICE != "0"): ?>
                <div class="container ">


                    <p class="main-color-text"><?= $package->HEAD_WT2PRICE; ?></p>
                    <br>

                    <div class="flex-new" style="gap: 20px;">

                        <?php if (($package->INFO_P1 != null) && ($package->WT2_PRICE_1 > 0)) : ?>

                            <div class="detail-box">

                                <p class="second-color-text">

                                    <?= $package->INFO_P1; ?></p>

                                <b class="main-color-text mid-text"> ₹ <?= $package->WT2_PRICE_1; ?> </b>

                                <p>per person</p>

                            </div>

                        <?php endif; ?>

                        <?php if (($package->INFO_P2 != null) && ($package->WT2_PRICE_2 > 0)) : ?>

                            <div class="detail-box">

                                <p class="second-color-text">

                                    <?= $package->INFO_P2; ?></p>

                                <b class="main-color-text mid-text"> ₹ <?= $package->WT2_PRICE_2; ?> </b>

                                <p>per person</p>

                            </div>

                        <?php endif; ?>

                    </div>

                    <br>

                    <div class="flex-new" style="gap: 20px;">

                        <?php if (($package->INFO_P3 != null) && ($package->WT2_PRICE_3 > 0)) : ?>

                            <div class="detail-box">

                                <p class="second-color-text">

                                    <?= $package->INFO_P3; ?></p>

                                <b class="main-color-text mid-text"> ₹ <?= $package->WT2_PRICE_3; ?> </b>

                                <p>per person</p>

                            </div>

                        <?php endif; ?>

                        <?php if (($package->INFO_P4 != null) && ($package->WT2_PRICE_4 > 0)) : ?>

                            <div class="detail-box">

                                <p class="second-color-text">

                                    <?= $package->INFO_P4; ?></p>

                                <b class="main-color-text mid-text"> ₹ <?= $package->WT2_PRICE_4; ?> </b>

                                <p>per person</p>

                            </div>

                        <?php endif; ?>

                        <?php if (($package->INFO_P5 != null) && ($package->WT2_PRICE_5 > 0)) : ?>

                            <div class="detail-box">

                                <p class="second-color-text">

                                    <?= $package->INFO_P5; ?></p>

                                <b class="main-color-text mid-text"> ₹ <?= $package->WT2_PRICE_5; ?> </b>

                                <p>per person</p>

                            </div>

                        <?php endif; ?>

                    </div>

                    <br>



                </div>
                <br>
            <?php endif; ?>

            <div class="container">
                <a href="#datesandcost" class="themebtn btn">Dates & Cost</a>
            </div>
            <br>
        <?php endif; ?>





        <!-- itinerary  -->

        <div class="container package_itinerary">

            <p class="mid-text main-color-text">Day to Day Itinerary</p>

            <?php if (str_contains($package->PACK_IT, '<h5>')): ?>

                <div class="iti" style="display:none;">

                    <?php echo strtolower($package->PACK_IT); ?>

                </div>



                <ul class="package-coll collapsible" style="margin:0;">



                </ul>

            <?php else: ?>



                <?php $itiArr = json_decode($package->PACK_IT) ?>

                <ul class="package-coll collapsible" style="margin:0;">

                    <?php foreach ($itiArr as $day): ?>

                        <li>

                            <div class="collapsible-header" style="background:var(--bg-color-2);" tabindex="0"><span><?= $day->dayTitle ?></span><span>▼</span></div>

                            <div class="collapsible-body">

                                <?= $day->dayDesc ?>

                            </div>

                        </li>

                    <?php endforeach; ?>

                </ul>

            <?php endif; ?>

        </div>

        <br>

        <!-- Inclusion  -->

        <div class="container inclusion">

            <p class="mid-text main-color-text">Inclusions</p>

            <div id="Inclusion">

                <?= $package->INCLUSION ?>

            </div>

        </div>

        <br>

        <!-- Exclusion  -->

        <div class="container Exclusion">

            <p class="mid-text main-color-text">Exclusions</p>

            <div id="Exclusion">

                <?= $package->EXCLUSION ?>

            </div>

        </div>

        <br>

        <!-- Trip Dates & cost-->

        <?php if (!$package->REQUEST_PRICE): ?>

            <div class="container">

                <p id="datesandcost" class="mid-text main-color-text">Trip Cost</p>

                <table class="">

                    <thead style="background:var(--maincolor-lite);">

                        <tr>

                            <th class="">Sharing</th>

                            <?php if ($package->HEAD_PRICE != '0'): ?>

                                <th><?= $package->HEAD_PRICE; ?></th>

                            <?php endif; ?>



                            <?php if ($package->HEAD_WTPRICE != '0' && $package->HEAD_WTPRICE != 'N/A'): ?>

                                <th><?= $package->HEAD_WTPRICE; ?></th>

                            <?php endif; ?>



                            <?php if ($package->HEAD_WT2PRICE != null || $package->HEAD_WT2PRICE != '0'): ?>

                                <th><?= $package->HEAD_WT2PRICE; ?></th>

                            <?php endif; ?>



                        </tr>

                    </thead>

                    <tbody>

                        <?php if (($package->INFO_P1 != null) && ($package->PRICE_1 > 0)) { ?>

                            <tr>

                                <td><?= $package->INFO_P1; ?></td>

                                <td><?= ($package->S_PRICE_1) ? '<del>₹' . $package->S_PRICE_1 . '</del>' : ''; ?><b><?= ' ₹' . $package->PRICE_1; ?></b></td>

                                <?php if ($package->WT_PRICE_1 != 0): ?><td><?= ($package->WT_PRICE_1 == 0) ? "Not Available" : '<del>₹' . ((int)$package->WT_PRICE_1 + 2500) . '</del> ' . '<b>₹' . $package->WT_PRICE_1; ?></b></td><?php endif; ?>

                                <?php if ($package->WT2_PRICE_1 != 0): ?><td><?= ($package->WT2_PRICE_1 == 0) ? "" : '<del>₹' . ((int)$package->WT2_PRICE_1 + 2500) . '</del> ' . '<b>₹' . $package->WT2_PRICE_1; ?></b></td><?php endif; ?>

                            </tr>

                        <?php } ?>

                        <?php if (($package->INFO_P2 != null) && ($package->PRICE_2 > 0)) { ?>

                            <tr>

                                <td><?= $package->INFO_P2; ?></td>

                                <td><?= ($package->S_PRICE_2) ? '<del>₹' . $package->S_PRICE_2 . '</del>' : ''; ?><b><?= ' ₹' . $package->PRICE_2; ?></b></td>

                                <?php if ($package->WT_PRICE_2 != 0): ?><td><?= ($package->WT_PRICE_2 == 0) ? "Not Available" : '<del>₹' . ((int)$package->WT_PRICE_2 + 2500) . '</del> ' . '<b>₹' . $package->WT_PRICE_2; ?></b></td><?php endif; ?>

                                <?php if ($package->WT2_PRICE_2 != 0): ?><td><?= ($package->WT2_PRICE_2 == 0) ? "" : '<del>₹' . ((int)$package->WT2_PRICE_2 + 2500) . '</del> ' . '<b>₹' . $package->WT2_PRICE_2; ?></b></td><?php endif; ?>

                            </tr>

                        <?php } ?>

                        <?php if (($package->INFO_P3 != null) && ($package->PRICE_3 > 0)) { ?>

                            <tr>

                                <td><?= $package->INFO_P3; ?></td>

                                <td><?= ($package->S_PRICE_3) ? '<del>₹' . $package->S_PRICE_3 . '</del>' : ''; ?><b><?= ' ₹' . $package->PRICE_3; ?></b></td>

                                <?php if ($package->WT_PRICE_3 != 0): ?><td><?= ($package->WT_PRICE_3 == 0) ? "Not Available" : '<del>' . ((int)$package->WT_PRICE_3 + 2500) . '</del> ' . '<b>₹' . $package->WT_PRICE_3; ?></b></td><?php endif; ?>

                                <?php if ($package->WT2_PRICE_3 != 0): ?><td><?= ($package->WT2_PRICE_3 == 0) ? "" : '<del>₹' . ((int)$package->WT2_PRICE_3 + 2500) . '</del> ' . '<b>₹' . $package->WT2_PRICE_3; ?></b></td><?php endif; ?>

                            </tr>

                        <?php } ?>

                        <?php if (($package->INFO_P4 != null) && ($package->PRICE_4 > 0)) { ?>

                            <tr>

                                <td><?= $package->INFO_P4; ?></td>

                                <td><?= ($package->S_PRICE_4) ? '<del>₹' . $package->S_PRICE_4 . '</del>' : ''; ?><b><?= ' ₹' . $package->PRICE_4; ?></b></td>

                                <?php if ($package->WT_PRICE_4 != 0): ?><td><?= ($package->WT_PRICE_4 == 0) ? "Not Available" : '<del>₹' . ((int)$package->WT_PRICE_4 + 2500) . '</del> ' . '<b>₹' . $package->WT_PRICE_4; ?></b></td><?php endif; ?>

                                <?php if ($package->WT2_PRICE_4 != 0): ?><td><?= ($package->WT2_PRICE_4 == 0) ? "" : '<del>₹' . ((int)$package->WT2_PRICE_4 + 2500) . '</del> ' . '<b>₹' . $package->WT2_PRICE_4; ?></b></td><?php endif; ?>

                            </tr>

                        <?php } ?>

                        <?php if (($package->INFO_P5 != null) && ($package->PRICE_5 > 0)) { ?>

                            <tr>

                                <td><?= $package->INFO_P5; ?></td>

                                <td><?= ($package->S_PRICE_5) ? '<del>₹' . $package->S_PRICE_5 . '</del>' : ''; ?><b><?= ' ₹' . $package->PRICE_5; ?></b></td>

                                <?php if ($package->WT_PRICE_5 != 0): ?><td><?= ($package->WT_PRICE_5 == 0) ? "Not Available" : '<del>₹' . ((int)$package->WT_PRICE_5 + 2500) . '</del> ' . '<b>₹' . $package->WT_PRICE_5; ?></b></td><?php endif; ?>

                                <?php if ($package->WT2_PRICE_5 != 0): ?><td><?= ($package->WT2_PRICE_5 == 0) ? "" : '<del>₹' . ((int)$package->WT2_PRICE_5 + 2500) . '</del> ' . '<b>₹' . $package->WT2_PRICE_5; ?></b></td><?php endif; ?>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

                <div id="Datesncost">

                    <p id="datesandcost" class="mid-text main-color-text">Dates</p>

                    <div class="btn-grp">

                        <div class="btndate disable" data-index=0></div>

                        <div class="btndate disable" data-index=1>January</div>

                        <div class="btndate disable" data-index=2>February</div>

                        <div class="btndate disable" data-index=3>March</div>

                        <div class="btndate disable" data-index=4>April</div>

                        <div class="btndate disable" data-index=5>May</div>

                        <div class="btndate disable" data-index=6>June</div>

                        <div class="btndate disable" data-index=7>July</div>

                        <div class="btndate disable" data-index=8>August</div>

                        <div class="btndate disable" data-index=9>September</div>

                        <div class="btndate disable" data-index=10>October</div>

                        <div class="btndate disable" data-index=11>November</div>

                        <div class="btndate disable" data-index=12>December</div>

                    </div>



                    <div class="date-viewer animate__animated">



                    </div>





                    <table class="black-text " style="display:none;">

                        <thead>

                            <tr>

                                <th>Dates</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                            $Dates = explode(",", $package->DATES);

                            for ($i = 0; $i < (count($Dates)); $i++) { ?>

                                <tr>

                                    <td class="date"><?php echo $Dates[$i]; ?></td>

                                </tr>

                            <?php } ?>



                        </tbody>

                    </table>

                </div>

            </div>

            <br>

        <?php else: ?>

            <div class="container">

                <b>Price on Request</b>

                <hr>

                <h6>Pricing will be provided upon request, based on your selected destinations, duration, accommodations, and customization preferences.</h6>

            </div>

        <?php endif; ?>



        <br>

        <!-- About Trip  -->

        <div class="container ">

            <p class="mid-text main-color-text">About This Trip</p>

            <p><?= $package->META_DESC ?></p>

        </div>

        <br>

        <!-- Trip Highlights -->

        <div class="container">

            <p class="mid-text main-color-text">Trip Highlight</p>

            <!--<div class="wysiwyg" style="padding:0px;">-->

            <?php //formattedHTML($package->TRIP_HIGHLIGHT) 
            ?>

            <!--</div>-->

            <ul class="collapsible" style="margin:0;">



                <li>

                    <div class="collapsible-header" style="background:var(--bg-color-2);" tabindex="0"><span><?= $package->PACKAGE_NAME ?> Highlight's</span><span>▼</span></div>

                    <div class="collapsible-body">



                        <div class="flex-new" style="flex-wrap:wrap;gap:20px;">
                            <div class="wysiwyg">
                                <?= $package->TRIP_HIGHLIGHT ?>
                            </div>
                        </div>

                    </div>

                </li>



            </ul>

        </div>









        <!-- Trip Misc -->

        <?php if ($package->PACKAGE_MISC != ""): ?>

            <div class="container">

                <p class="mid-text main-color-text">Miscellaneous</p>



                <ul class="collapsible" style="margin:0;">



                    <li>

                        <div class="collapsible-header" style="background:var(--bg-color-2);" tabindex="0"><span><b>Miscellaneous</b></span><span>▼</span></div>

                        <div class="collapsible-body">

                            <div class="detail-box" style="place-items: flex-start;text-align: unset;padding:10px;">
                                <div class="" style="padding:0px;">
                                    <div class="wysiwyg">
                                        <?= $package->PACKAGE_MISC ?>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </li>

            </div>

        <?php endif; ?>

        <br>

        <!-- ttc -->

        <div class="container">

            <p class="mid-text main-color-text">Things To Carry</p>

            <ul class="collapsible" style="margin:0;">



                <li>

                    <div class="collapsible-header" style="background:var(--bg-color-2);" tabindex="0"><span><b>Gadgets</b></span><span>▼</span></div>

                    <div class="collapsible-body">

                        <div class="detail-box" style="place-items: flex-start;text-align: unset;padding:10px;">

                            <ul>

                                <li>Camera</li>

                                <li>Power Bank</li>

                                <li>LED torch light</li>

                            </ul>

                        </div>

                    </div>

                </li>

                <li>

                    <div class="collapsible-header" style="background:var(--bg-color-2);" tabindex="0"><span><b>Gears</b></span><span>▼</span></div>

                    <div class="collapsible-body">

                        <div class="detail-box" style="place-items: flex-start;text-align: unset;padding:10px;">

                            <ul>

                                <li>A rucksack bag and a day pack</li>

                                <li>3-litre water bladder or water bottle</li>

                            </ul>

                        </div>

                    </div>

                </li>

                <li>

                    <div class="collapsible-header" style="background:var(--bg-color-2);" tabindex="0"><span><b>Clothes</b></span><span>▼</span></div>

                    <div class="collapsible-body">

                        <div class="detail-box" style="place-items: flex-start;text-align: unset;padding:10px;">

                            <ul>

                                <li>A sun cap and a woolen cap</li>

                                <li>UV protected sunglasses</li>

                                <li>One cotton long sleeves and 2 short sleeve t-shirt</li>

                                <li>1 fleece jacket</li>

                                <li>1 heavy Thick jacket/down jacket</li>

                                <li>1 pair of gloves At least 2 long pants (trek pants and cargo pants are favourable)</li>

                                <li>4 sets of undergarments</li>

                                <li>2 pair of socks</li>

                                <li>A small towel</li>

                                <li>A rain jacket or a poncho</li>

                            </ul>

                        </div>

                    </div>

                </li>

                <li>

                    <div class="collapsible-header" style="background:var(--bg-color-2);" tabindex="0"><span><b>Footwear</b></span><span>▼</span></div>

                    <div class="collapsible-body">

                        <div class="detail-box" style="place-items: flex-start;text-align: unset;padding:10px;">

                            <ul>

                                <li>Above-the-ankle waterproof and breathable hiking boots with good grip</li>

                                <li>Flip flops/sandals</li>

                            </ul>

                        </div>

                    </div>

                </li>

                <li>

                    <div class="collapsible-header" style="background:var(--bg-color-2);" tabindex="0"><span><b>Medication</b></span><span>▼</span></div>

                    <div class="collapsible-body">

                        <div class="detail-box" style="place-items: flex-start;text-align: unset;padding:10px;">

                            <ul>

                                <li>Glucose powder</li>

                                <li>Medicines for headaches</li>

                                <li>Medicines for diarrhoea</li>

                                <li>Medicines for muscular pain</li>

                                <li>Medicines for motion and altitude sickness</li>

                                <li>Dettol</li>

                                <li>Bandages</li>

                                <li>Cotton</li>

                            </ul>

                        </div>

                    </div>

                </li>

                <li>

                    <div class="collapsible-header" style="background:var(--bg-color-2);" tabindex="0"><span><b>Personal Accessories</b></span><span>▼</span></div>

                    <div class="collapsible-body">

                        <div class="detail-box" style="place-items: flex-start;text-align: unset;padding:10px;">

                            <ul>

                                <li>Toothpaste</li>

                                <li>Toothbrush</li>

                                <li>Paper soap & sanitizer</li>

                                <li>Sunscreen minimum of spf40</li>

                                <li>Lip balm</li>

                                <li>cold creams</li>

                                <li>Body spray</li>

                            </ul>

                        </div>

                    </div>

                </li>



            </ul>

        </div>

        <br>

        <!-- Advisory -->

        <div class="container">

            <p class="mid-text main-color-text">Advisory</p>

            <ul class="collapsible" style="margin:0;">



                <li>

                    <div class="collapsible-header" style="background:var(--bg-color-2);" tabindex="0"><span><b>Advisory</b></span><span>▼</span></div>

                    <div class="collapsible-body">

                        <div class="detail-box" style="place-items: flex-start;text-align: unset;padding:10px;">

                            <ul class="">

                                <li>Carry minimum weight.</li>

                                <li>Please take care of Precautions needed for COVID-19 Pandemic.</li>

                                <li>Do not litter.</li>

                                <li>Alcohol and smoking is at their own risk.</li>

                                <li>The decision of the trek leader will be final and binding.</li>

                                <li>Delays may occur due to weather conditions & Traffic Conditions.</li>

                                <li>Any person with health conditions like Asthma etc. is advised not to go for this expedition.

                                    However, if they so decide, it is at their own risk.</li>

                                <li>Do not wander off on your own.</li>

                                <li>Please take care of your baggage.</li>

                                <li>Please keep yourself hydrated throughout the trek and fuel yourself with some energy bars,

                                    protein bars, or any snacks to maintain the energy level.</li>

                                <li>Involve yourself in some physical activities like jumping, running, stretching, as it increases

                                    the stamina and strength of the body.</li>

                                <li>People with any physical ailments are advised not to come on the trek.</li>

                            </ul>

                        </div>

                    </div>

                </li>

            </ul>



        </div>

        <br>

        <!-- Tnc -->

        <?php if ($package->PACKAGE_TNC != ""): ?>

            <div class="container">

                <p class="mid-text main-color-text">Terms & Conditions</p>

                <ul class="collapsible" style="margin:0;">



                    <li>

                        <div class="collapsible-header" style="background:var(--bg-color-2);" tabindex="0"><span><b>Terms & Conditions</b></span><span>▼</span></div>

                        <div class="collapsible-body">

                            <div class="detail-box" style="place-items: flex-start;text-align: unset;padding:10px;">

                                <div class="" style="padding:0px;">
                                    <div class="wysiwyg">
                                        <?= $package->PACKAGE_TNC ?>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </li>

                </ul>

            </div>



        <?php endif; ?>

        <br>

        <!-- Book Now  -->

        <div class="bg-second-2 book_section">

            <div class="container">

                <div class="flex-new spaced-between">

                    <div>

                        <?php if (!$package->REQUEST_PRICE): ?>

                            <p class="second-color-text">

                                Starting From</p>

                            <b class="main-color-text big-text"> ₹ <?= $package->PRICE_1; ?> </b>

                            <p>per person</p>

                        <?php else: ?>

                            <p class="main-color-text ">

                                Request Price</p>

                            <p>per person</p>

                        <?php endif; ?>



                    </div>

                    <div>

                        <?php if ($package->REQUEST_PRICE): ?>

                            <a class="btn themebtn-lite " style="--btn-color:var(--maincolor); width:100%; font-weight:bold;" href="https://wa.me/91<?= $defaultContact ?>?text=Hello,I want to book | https://voyagersbeat.com/package/<?php echo $package->SLUG; ?>">Book Now</a>

                        <?php else: ?>

                            <a class="btn themebtn-lite " style="--btn-color:var(--maincolor); width:100%; font-weight:bold;" href="/book/<?php echo $package->PACKAGE_ID; ?>">Book Now</a>

                        <?php endif; ?>

                    </div>

                </div>

            </div>



        </div>

    </div>



</div>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@14.0.1/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper('.package_images', {
        pagination: {
            el: '.swiper-pagination',
            dynamicBullets: true,
        },
    });
</script>