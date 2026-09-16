<link rel="stylesheet" href="/css/package-detail.css">
<?php
// Data Formatting
$TAGS = explode(',', $package->TAGS);
?>
<div>

    <div itemscope itemtype="<?= base_url(); ?>">

        <meta itemprop="name" content="<?= $package->PACKAGE_NAME; ?>" />

        <meta itemprop="url" content="<?= '/package/' . $package->SLUG; ?>" />

        <meta itemprop="description" content="<?= $package->META_DESC; ?>" />

        <meta itemprop="datePublished" content="<?= $package->updated_at; ?>" />

    </div>

</div>

<div class="">
    <section class="package-hero custom-background" style="--bgUrl:url('<?= $package->PACKAGE_IMAGE ?>')">
        <div class="container text-white">
            <div class="row vh-80">
                <div class="col-lg-12 align-content-end">
                    <div class=" pb-5">
                        <h1><?= $package->PACKAGE_NAME ?></h1>
                        <hr>
                        <p><?= $package->META_DESC ?></p>
                        <div class="my-2">
                            <a href="/type/<?= urlencode($package->PACKAGE_TYPE) ?>"><span class=" badge rounded-pill text-bg-light"><?= $package->PACKAGE_TYPE ?></span></a>
                            <a href="/badge/<?= urlencode($package->BADGE) ?>" class="text-decoration-none"><span class="badge rounded-pill text-bg-warning"><?= $package->BADGE ?></span></a>
                            <?php foreach ($TAGS as $tag): ?>
                                <a href="/tag/<?= $tag ?>" class="text-decoration-none"><span class="badge rounded-pill">#<?= $tag ?></span></a>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="package-grid-container mt-2">
            <div class="sidebar">
                <div class="sticky-top" style="top:67px;">
                    <div class="cta-buttons">
                        <?= view('pages/packages/component/button-group', ['package' => $package]) ?>
                    </div>
                    <div class="cost-sidebar">
                        <?= view('pages/packages/component/cost-section-sidebar', ['package' => $package]) ?>
                    </div>
                    <div class="sidebar-form">
                        <?= view('pages/component/packageDetailsQueryForm') ?>
                    </div>
                </div>
            </div>
            <div class="main-content">
                <div class="quick-info">
                    <?= view('pages/packages/component/quick-info') ?>
                </div>
                <div class="trip-includes">
                    <?= view('pages/packages/component/quick-info2') ?>
                </div>
                <!-- Details Section -->
                <div class="details-tabs mb-2">
                    <ul class="nav nav-pills nav-fill p-1 small outline-card style-border rounded-3 mb-2" id="DetailsTabNav" role="tablist" style="">
                        <li class="nav-item col-4 col-lg-2" role="presentation">
                            <button class="nav-link rounded-3" id="home-tab" data-bs-toggle="tab" data-bs-target="#highlight-tab-pane" type="button" role="tab" aria-selected="true">Highlight</button>
                        </li>
                        <li class="nav-item col-4 col-lg-2" role="presentation">
                            <button class="nav-link rounded-3 " id="profile-tab" data-bs-toggle="tab" data-bs-target="#in-ex-tab-pane" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Inclusion / Exclusion</button>
                        </li>
                        <li class="nav-item col-4 col-lg-2" role="presentation">
                            <button class="nav-link rounded-3 active" id="contact-tab" data-bs-toggle="tab" data-bs-target="#itinerary-tab-pane" type="button" role="tab" aria-selected="false">Itinerary</button>
                        </li>
                        <li class="nav-item col-4 col-lg-2" role="presentation">
                            <button class="nav-link rounded-3" id="contact-tab" data-bs-toggle="tab" data-bs-target="#date-cost-tab-pane" type="button" role="tab" aria-selected="false">Date & Cost</button>
                        </li>
                        <li class="nav-item col-4 col-lg-2" role="presentation">
                            <button class="nav-link rounded-3" id="contact-tab" data-bs-toggle="tab" data-bs-target="#misc-tab-pane" type="button" role="tab" aria-selected="false">Misc</button>
                        </li>
                        <li class="nav-item col-4 col-lg-2" role="presentation">
                            <button class="nav-link rounded-3" id="contact-tab" data-bs-toggle="tab" data-bs-target="#tnc-tab-pane" type="button" role="tab" aria-selected="false">Terms & Condition</button>
                        </li>
                    </ul>
                    <div class="tab-content outline-card style-border p-2" id="DetailsTabNavContent">
                        <div class="tab-pane fade" id="highlight-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <h5 class="">Trip Highlight</h5>
                            <hr>
                            <div class="wysiwyg">
                                <?= $package->TRIP_HIGHLIGHT ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="in-ex-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
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

                        </div>
                        <div class="tab-pane fade show active" id="itinerary-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                            <?= view('pages/packages/component/itinerarySection', ['package' => $package]) ?>
                        </div>
                        <div class="tab-pane fade" id="date-cost-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <?= view('pages/packages/component/dates-section', ['package' => $package]) ?>
                                </div>
                                <div class="col-lg-6  col-12">
                                    <?= view('pages/packages/component/cost-section-table', ['package' => $package]) ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="misc-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                            <h5 class="">Miscellaneous</h5>
                            <hr>
                            <div class="wysiwyg">
                                <?= $package->PACKAGE_MISC ?>
                            </div>
                            <div class="additional">
                                <b>Things To Carry</b>

                                <hr />

                                <table class="table" style="--bs-table-bg:#00000000;">
                                    <tbody>
                                        <tr>
                                            <td><b>Gadgets</b></td>

                                            <td>: Camera , Cell phones , Power Bank</td>
                                        </tr>

                                        <tr>
                                            <td><b>Gears</b></td>

                                            <td>: A rucksack bag and a day pack , 3-litre water bladder or water bottle</td>
                                        </tr>

                                        <tr>
                                            <td><b>Clothes</b></td>

                                            <td>
                                                : A sun cap and a woolen cap , UV protected sunglasses , One cotton long sleeves and 2 short sleeve
                                                t-shirt , 1 fleece jacket , 1 heavy Thick jacket/down jacket , 1 pair of gloves At least 2 long pants
                                                (trek pants and cargo pants are favourable) , 4 sets of undergarments , 2 pair of socks , A small towel
                                                , A rain jacket or a poncho
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b>Footwear</b></td>

                                            <td>: Above-the-ankle waterproof and breathable hiking boots with good grip , Flip flops/sandals</td>
                                        </tr>

                                        <tr>
                                            <td><b>Medication</b></td>

                                            <td>
                                                : Glucose powder , Medicines for headaches, diarrhoea, muscular pain, motion and altitude sickness ,
                                                Dettol , Bandages , Cotton
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b>Personal Accessories</b></td>

                                            <td>
                                                : Toothpaste , toothbrush , Paper soap & sanitizer , Sunscreen minimum of spf40 , lip balm , cold creams
                                                , Body spray
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b>Misc</b></td>

                                            <td>LED torch light</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <b>Advisory</b>

                                <ul class="advisory ">
                                    <li>Carry minimum weight.</li>

                                    <li>Please take care of Precautions needed for COVID-19 Pandemic.</li>

                                    <li>Do not litter.</li>

                                    <li>Alcohol and smoking is at their own risk.</li>

                                    <li>The decision of the trek leader will be final and binding.</li>

                                    <li>Delays may occur due to weather conditions & Traffic Conditions.</li>

                                    <li>
                                        Any person with health conditions like Asthma etc. is advised not to go for this expedition. However, if they so
                                        decide, it is at their own risk.
                                    </li>

                                    <li>Do not wander off on your own.</li>

                                    <li>Please take care of your baggage.</li>

                                    <li>
                                        Please keep yourself hydrated throughout the trek and fuel yourself with some energy bars, protein bars, or any
                                        snacks to maintain the energy level.
                                    </li>

                                    <li>
                                        Involve yourself in some physical activities like jumping, running, stretching, as it increases the stamina and
                                        strength of the body.
                                    </li>

                                    <li>People with any physical ailments are advised not to come on the trek.</li>
                                </ul>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="tnc-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                            <h5 class="">Terms & Conditions</h5>
                            <hr>
                            <div class="wysiwyg">
                                <?= $package->PACKAGE_TNC ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Details Section -->
                <div class="why-voyagers">
                    <?= view('pages/packages/component/why-voyager-info') ?>
                </div>
                <div class="similar-packages outline-card style-border p-2 hide-on-mobile">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5>More Trips Like This</h5>
                            <p>Exciting Group Departures Coming Your Way</p>
                        </div>
                        <div>
                            <button id="carousel-prevBtn" class="btn btn-sm btn-dark"><i class='bx bx-left-arrow-alt'></i></button>
                            <button id="carousel-nextBtn" class="btn btn-sm btn-dark"><i class='bx bx-right-arrow-alt'></i></button>
                        </div>
                    </div>
                    <?= view('pages/packages/component/similar-packages', ['similarPackages' => $similarPackages]) ?>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    const PackageDates = '<?= $package->DATES ?>';
</script>
<script src="/js/package-dates.js"></script>
<script src="/js/similar-package.js"></script>