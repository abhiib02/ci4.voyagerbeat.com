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
                            <span class="badge rounded-pill text-bg-light"><?= $package->PACKAGE_TYPE ?></span>
                            <span class="badge rounded-pill text-bg-warning"><?= $package->BADGE ?></span>
                            <?php foreach ($TAGS as $tag): ?>
                                <span class="badge rounded-pill">#<?= $tag ?></span>
                            <?php endforeach; ?>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <?php if ($package->PACKAGE_PDF): ?>
                                    <button data-href="/upload/package_pdf/<?= $package->PACKAGE_PDF; ?>" onclick="downloadURI('/upload/package_pdf/<?= $package->PACKAGE_PDF; ?>','')" type="button" class="btn btn-warning"><i class='bx bxs-download'></i> Download PDF</button>
                                <?php endif; ?>
                                <a href="/book/<?= $package->PACKAGE_ID ?>" type="button" class="btn btn-success" style="width:250px;">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="package-grid-container mt-2">
            <div class="cta-buttons">
                <?= view('pages/packages/component/button-group', ['package' => $package]) ?>
            </div>
            <div class="quick-info">
                <?= view('pages/packages/component/quick-info', ['package' => $package]) ?>
            </div>
            <div class="details">
                <div class="facilities">
                    <?= view('pages/packages/component/quick-info2') ?>
                </div>

                <ul class="nav nav-pills nav-fill gap-2 p-1 small outline-card style-border rounded-3 mb-2" id="pillNav" role="tablist" style="">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-3" id="home-tab" data-bs-toggle="tab" data-bs-target="#highlight-tab-pane" type="button" role="tab" aria-selected="true">Highlight</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-3 " id="profile-tab" data-bs-toggle="tab" data-bs-target="#in-ex-tab-pane" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Inclusion / Exclusion</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-3 active" id="contact-tab" data-bs-toggle="tab" data-bs-target="#itinerary-tab-pane" type="button" role="tab" aria-selected="false">Itinerary</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-3" id="contact-tab" data-bs-toggle="tab" data-bs-target="#date-cost-tab-pane" type="button" role="tab" aria-selected="false">Date & Cost</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-3" id="contact-tab" data-bs-toggle="tab" data-bs-target="#misc-tab-pane" type="button" role="tab" aria-selected="false">Misc</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-3" id="contact-tab" data-bs-toggle="tab" data-bs-target="#tnc-tab-pane" type="button" role="tab" aria-selected="false">Terms & Condition</button>
                    </li>
                </ul>
                <div class="tab-content outline-card style-border p-2" id="pillNavContent">
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
                                <h5 class="">Trip Inclusion</h5>
                                <hr>
                                <div class="wysiwyg">
                                    <?= $package->INCLUSION ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h5 class="">Trip Exclusion</h5>
                                <hr>
                                <div class="wysiwyg">
                                    <?= $package->EXCLUSION ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade show active" id="itinerary-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                        <?php $itiArr = json_decode($package->PACK_IT) ?>
                        <div class="accordion" id="ItineraryAccordion">
                            <?php foreach ($itiArr as $index => $day): ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#day-<?= $index ?>" aria-expanded="false" aria-controls="collapseOne">
                                            <?= $day->dayTitle ?>
                                        </button>
                                    </h2>
                                    <div id="day-<?= $index ?>" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                            <div class="wysiwyg">
                                                <?= $day->dayDesc ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="date-cost-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">

                        <?= view('pages/packages/component/dates-section', ['package' => $package]) ?>
                    </div>
                    <div class="tab-pane fade" id="misc-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">..5.</div>
                    <div class="tab-pane fade" id="tnc-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">..6.</div>
                </div>
            </div>
            <div class="photos"></div>
            <div class="customer-reviews"></div>
            <div class="side">
                <?= view('pages/component/packageDetailsQueryForm') ?>
            </div>
        </div>

    </div>
</div>
<script>
    const PackageDates = '<?= $package->DATES ?>';
</script>
<script src="/js/package-dates.js"></script>