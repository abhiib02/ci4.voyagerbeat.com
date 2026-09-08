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
        <div class="package-grid-container">
            <div class="cta-buttons">
                <?= view('pages/packages/component/button-group') ?>
            </div>
            <div class="quick-info"></div>
            <div class="details"></div>
            <div class="photos"></div>
            <div class="customer-reviews"></div>
            <div class="side"></div>
        </div>

    </div>
</div>