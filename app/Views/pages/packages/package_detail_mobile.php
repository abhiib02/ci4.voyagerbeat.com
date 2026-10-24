<?php helper('packageImage'); ?>
<?php
// Data Formatting
$TAGS = explode(',', $package->TAGS);
?>
<link rel="stylesheet" href="/css/package-detail-mobile.css">
<div>

    <div itemscope itemtype="<?= base_url(); ?>">

        <meta itemprop="name" content="<?= $package->PACKAGE_NAME; ?>" />

        <meta itemprop="url" content="<?= '/package/' . $package->SLUG; ?>" />

        <meta itemprop="description" content="<?= $package->META_DESC; ?>" />

        <meta itemprop="datePublished" content="<?= $package->updated_at; ?>" />

    </div>

</div>
<div class="scroll-margin">
    <div class="package_detail_content_mobile">

        <section class="pdf-download" id="pdf">
            <button class="btn btn-theme btn-warning share-button"><i class='bx bxs-share-alt'></i></button>
            <?php if (!empty($package->PACKAGE_PDF)): ?>
                <button data-href="/upload/package_pdf/<?= $package->PACKAGE_PDF; ?>" onclick="downloadURI('/upload/package_pdf/<?= $package->PACKAGE_PDF; ?>','')" type="button" class="btn btn-theme btn-warning "> PDF <i class='bx bxs-download'></i></button>
            <?php endif; ?>
        </section>

        <section class="images" id="package_images">
            <!-- Swiper -->
            <div class="swiper package_images">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <?= imageLinkType($package->PACKAGE_IMAGE); ?>
                    </div>
                    <?php if (!empty($package->IMAGE_1)): ?>
                        <div class="swiper-slide">
                            <?= imageLinkType($package->IMAGE_1); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($package->IMAGE_2)): ?>
                        <div class="swiper-slide">
                            <?= imageLinkType($package->IMAGE_2); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($package->IMAGE_3)): ?>
                        <div class="swiper-slide">
                            <?= imageLinkType($package->IMAGE_3); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($package->IMAGE_4)): ?>
                        <div class="swiper-slide">
                            <?= imageLinkType($package->IMAGE_4); ?>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>

        <section class="container" id="package_name">
            <h5 class="mt-2 fw-bold "><?= $package->PACKAGE_NAME; ?></h5>

            <p><?= $package->META_DESC ?></p>
            <div class="my-2" hidden>
                <a href="/type/<?= urlencode($package->PACKAGE_TYPE) ?>"><span class=" badge rounded-pill text-bg-dark"><?= $package->PACKAGE_TYPE ?></span></a>
                <a href="/badge/<?= urlencode($package->BADGE) ?>" class="text-decoration-none"><span class="badge rounded-pill text-bg-warning"><?= $package->BADGE ?></span></a>
                <?php foreach ($TAGS as $tag): ?>
                    <a href="/tag/<?= $tag ?>" class="text-decoration-none text-theme-secondary"><span class="badge rounded-pill text-theme-secondary">#<?= $tag ?></span></a>
                <?php endforeach; ?>
            </div>
            <span class="text-theme-secondary mx-2"><i class='bx bxs-location-plus'></i></span><span class="mx-1"><?= $package->LOCATION; ?></span>•<span class="mx-1"><?= $package->COUNTRY; ?></span>•<span class="mx-1 fw-bold">Package ID : <?= $package->PACKAGE_ID ?> </span>
        </section>

        <section class="container" id="quick-info">
            <div class="d-flex justify-content-between flex-wrap gap-1">
                <div class="border rounded-3 my-2 flex-fill card">
                    <div class="card-body p-2 grid-center">
                        <div class="text-center">
                            <p class="text-muted small fw-semibold text-uppercase m-0">Duration</p>
                            <i class="bx bx-time-five fs-3"></i>
                            <h6 class="mb-0 fw-bold text-dark"><?= ($package->STAY) ?? '' ?></h6>
                        </div>
                    </div>
                </div>
                <div class="border rounded-3 my-2 flex-fill card">
                    <div class="card-body p-2 grid-center">
                        <div class="text-center">
                            <p class="text-muted small fw-semibold text-uppercase m-0">Pick n Drop</p>
                            <i class='bx bx-map-pin fs-3'></i>
                            <h6 class="mb-0 fw-bold text-dark"><?= ($package->PICKNDROP) ?? 'Delhi to Delhi' ?></h6>
                        </div>
                    </div>
                </div>
                <div class="border rounded-3 my-2 flex-fill card">
                    <div class="card-body p-2 grid-center">
                        <div class="text-center">
                            <p class="text-muted small fw-semibold text-uppercase m-0">Starting Price</p>
                            <i class='bx bx-rupee fs-3'></i>
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
            <div class="row">
                <div class="col-lg-6">

                    <div class="accordion accordion-flush" id="Inclusion-Accordion">
                        <!-- Gadgets -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingGadgets">
                                <button class="accordion-button collapsed text-bg-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInclusion-Accordion" aria-expanded="false" aria-controls="collapseGadgets">
                                    Trip Inclusion
                                </button>
                            </h2>
                            <div id="collapseInclusion-Accordion" class="accordion-collapse collapse" aria-labelledby="headingGadgets" data-bs-parent="#Inclusion-Accordion">
                                <div class="accordion-body">
                                    <div class="alert alert-success">
                                        <div class="wysiwyg">
                                            <?= $package->INCLUSION ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section class="container mb-3" id="Exclusion">
            <div class="row">
                <div class="col-lg-6">
                    <div class="accordion accordion-flush" id="Exclusion-Accordion">
                        <!-- Gadgets -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingGadgets">
                                <button class="accordion-button collapsed text-bg-danger" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExclusion-Accordion" aria-expanded="false" aria-controls="collapseGadgets">
                                    Trip Exclusion
                                </button>
                            </h2>
                            <div id="collapseExclusion-Accordion" class="accordion-collapse collapse" aria-labelledby="headingGadgets" data-bs-parent="#Exclusion-Accordion">
                                <div class="accordion-body">
                                    <div class="alert alert-danger">
                                        <div class="wysiwyg">
                                            <?= $package->EXCLUSION ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section class="container mb-3" id="Highlight">
            <h3 class="text-theme-secondary">Highlight</h3>

            <div class="accordion accordion-flush" id="HighlightAccordion">

                <!-- Gadgets -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="Highlight">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-Highlight" aria-expanded="false" aria-controls="collapseGadgets">
                            Highlight
                        </button>
                    </h2>
                    <div id="collapse-Highlight" class="accordion-collapse collapse" aria-labelledby="Highlight">
                        <div class="accordion-body">
                            <div class="wysiwyg">
                                <?= $package->TRIP_HIGHLIGHT ?>
                            </div>
                        </div>
                    </div>
                </div>
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
        <?php if (!empty($package->PACKAGE_TNC)): ?>
            <section class="container mb-3" id="tnc">
                <h3 class="text-theme-secondary">Terms & Condition</h3>
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
            </section>
        <?php endif; ?>
        <?php $faqs = !empty($package->PACKAGE_FAQ) ? json_decode($package->PACKAGE_FAQ, true) : []; ?>
        <?php if (!empty($faqs)): ?>
            <section class="container mb-5 pb-5" id="tnc">
                <h3 class="text-theme-secondary">Frequently Asked Questions</h3>
                <?= view('pages/packages/component/faq-section', ['FAQS' => $package->PACKAGE_FAQ]) ?>
            </section>

        <?php endif; ?>
    </div>
</div>

<div id="trigger-nav-menu-animation" class="mb-5"></div>

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
<script src="/js/button_trigger_package.js"></script>
<script>
    const shareButton = document.querySelector('.share-button');
    const shareDialog = document.querySelector('.share-dialog');
    const closeButton = document.querySelector('.close-button');
    shareButton.addEventListener('click', event => {
        if (navigator.share) {
            const shareMessage = `✨ <?= addslashes($package->PACKAGE_NAME) ?> ✨\n\n` +
                `📍 <?= addslashes($package->LOCATION) ?>\n` +
                `⏱️ <?= $package->DURATION ?> Days\n` +
                `🏷️ <?= $package->PACKAGE_TYPE ?>\n\n` +
                `💰 Pricing (per person):\n` +
                `  <?= $package->INFO_P1 ?? '' ?>: ₹<?= number_format($package->PRICE_1) ?? '' ?>\n` +
                `  <?= $package->INFO_P2 ?? '' ?>: ₹<?= number_format($package->PRICE_2) ?? '' ?>\n` +
                `  <?= $package->INFO_P3 ?? '' ?>: ₹<?= number_format($package->PRICE_3) ?? '' ?>\n\n` +
                `✅ Inclusions:\n` +
                `<?= addslashes(strip_tags($package->INCLUSION) ?? '') ?>` +
                `<?= addslashes($package->DESCRIPTION ?? '') ?>\n\n` +
                `🚀 Book now on Voyagers Beat app!\n` +
                `🔗 https://voyagersbeat.com/package/<?= $package->SLUG ?>\n` +
                `📲 Open in app: voyagersbeat://package/<?= $package->SLUG ?>\n\n` +
                `📞 Contact: +91 9667711662`;

            navigator.share({
                    title: '✨ <?= addslashes($package->PACKAGE_NAME) ?> ✨',
                    text: shareMessage
                })
                .then(() => {
                    console.log('Thanks for sharing!');
                })
                .catch(console.error);
        } else {
            shareDialog.classList.add('is-open');
        }
    });
</script>
<script>
    const PackageDates = '<?= $package->DATES ?>';
</script>
<script src="/js/package-dates.js"></script>