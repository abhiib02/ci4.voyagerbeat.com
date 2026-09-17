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
            <h5 class="mt-2"><?= $package->PACKAGE_NAME; ?></h5>
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
        <section class="container mb-3" id="costing">
            <?= view('pages/packages/component/cost-section-sidebar', ['package' => $package]) ?>
        </section>
        <section class="container mb-3" id="dates">
            <h3 class="text-theme-secondary">Dates</h3>
            <?= view('pages/packages/component/dates-section', ['package' => $package]) ?>
        </section>
        <section class="container mb-3" id="itinerary">
            <h3 class="text-theme-secondary">Day to Day Itinerary</h3>
            <?= view('pages/packages/component/itinerarySection', ['package' => $package]) ?>
        </section>
        <br>
        <section class="container mb-3" id="Inclusion">
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
        <section class="container mb-3" id="Exclusion">
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
        <section class="container mb-3" id="Highlight">
            <h3 class="text-theme-secondary">Highlight</h3>
            <div class="wysiwyg">
                <?= $package->TRIP_HIGHLIGHT ?>
            </div>
        </section>
        <?php if (!empty($package->PACKAGE_MISC)): ?>
            <section class="container mb-3" id="Miscellaneous">
                <h3 class="text-theme-secondary">Miscellaneous</h3>
                <div class="wysiwyg">
                    <?= $package->PACKAGE_MISC ?>
                </div>
            </section>
        <?php endif; ?>
        <section class="container mb-3" id="thingstocarry">

            <h3 class="text-theme-secondary">Things To Carry</h3>

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
        <section class="container mb-3" id="advisory">
            <h3 class="text-theme-secondary">Advisory</h3>
            <div class="accordion accordion-flush" id="advisoryAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingAdvisory">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdvisory" aria-expanded="false" aria-controls="collapseAdvisory">
                            Advisory
                        </button>
                    </h2>
                    <div id="collapseAdvisory" class="accordion-collapse collapse" aria-labelledby="headingAdvisory" data-bs-parent="#advisoryAccordion">
                        <div class="accordion-body">
                            <ul>
                                <li>Carry minimum weight.</li>
                                <li>Please take care of Precautions needed for COVID-19 Pandemic.</li>
                                <li>Do not litter.</li>
                                <li>Alcohol and smoking is at their own risk.</li>
                                <li>The decision of the trek leader will be final and binding.</li>
                                <li>Delays may occur due to weather conditions & Traffic Conditions.</li>
                                <li>Any person with health conditions like Asthma etc. is advised not to go for this expedition. However, if they so decide, it is at their own risk.</li>
                                <li>Do not wander off on your own.</li>
                                <li>Please take care of your baggage.</li>
                                <li>Please keep yourself hydrated throughout the trek and fuel yourself with some energy bars, protein bars, or any snacks to maintain the energy level.</li>
                                <li>Involve yourself in some physical activities like jumping, running, stretching, as it increases the stamina and strength of the body.</li>
                                <li>People with any physical ailments are advised not to come on the trek.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <section class="container mb-3" id="tnc">
            <h3 class="text-theme-secondary">Terms & Condition</h3>
            <?php if (!empty($package->PACKAGE_TNC)): ?>

                <div class="accordion accordion-flush" id="tncAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTnc">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTnc" aria-expanded="false" aria-controls="collapseTnc">
                                Terms & Conditions
                            </button>
                        </h2>
                        <div id="collapseTnc" class="accordion-collapse collapse" aria-labelledby="headingTnc" data-bs-parent="#tncAccordion">
                            <div class="accordion-body">
                                <div class="wysiwyg">
                                    <?= $package->PACKAGE_TNC ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
        </section>
    </div>
</div>
<div class="sticky-bottom" style="bottom:70px;">
    <div class="container">
        <div class=" d-flex justify-content-between">
            <div></div>
            <div>
                <a href="/book/<?= $package->PACKAGE_ID ?>" type="button" class="btn btn-sm btn-theme btn-success w-100" style="width:250px;">Book Now <i class='bx bx-right-arrow-alt'></i></a>
            </div>
        </div>
    </div>

</div>
<div id="trigger-nav-menu-animation"></div>

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
<script>
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                whatsappBtn.classList.add('wobble-hor-bottom');
                callBtn.classList.add('wobble-hor-bottom');
                whatsappBtn.classList.add('active');
                callBtn.classList.add('active');
                // Add your active class or action here
            } else {
                whatsappBtn.classList.remove('wobble-hor-bottom');
                callBtn.classList.remove('wobble-hor-bottom');
                whatsappBtn.classList.remove('active');
                callBtn.classList.remove('active');
            }
        });
    }, {
        threshold: 0.1 // Triggers when 10% of the element is visible
    });

    // Target your element
    const whatsappBtn = document.querySelector('#whatsapp-nav-mobile-btn');
    const callBtn = document.querySelector('#call-nav-mobile-btn');
    const triggerDiv = document.querySelector('#trigger-nav-menu-animation');
    observer.observe(triggerDiv);
</script>