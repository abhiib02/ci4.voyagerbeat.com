    <?php

    /**
     * @var object $package
     * @var string $defaultContact
     */
    ?>
    <div class=" style-border outline-card p-2 h-100 align-content-center  mb-2">


        <?= view('pages/packages/component/admin-actions', ['package' => $package]) ?>

        <div class="d-flex mb-1">
            <?php if (auth('Admin', 'Employee', 'User')): ?>
                <?php if (!$package->REQUEST_PRICE): ?>
                    <a href="/book/<?= $package->PACKAGE_ID ?>" type="button" class="btn btn-lg btn-theme btn-success w-100" style="width:250px;">Book Now <i class='bx bx-right-arrow-alt'></i></a>
                <?php else: ?>
                    <a href="https://wa.me/91<?= $defaultContact ?>?text=Hey! Voyagers Beat I am interested in your trip id <?= $package->PACKAGE_ID; ?> | https://voyagersbeat.com/package/<?= $package->SLUG; ?>" type=" button" class="btn btn-lg btn-theme btn-success w-100" style="width:250px;">Book Now on WhatsApp<i class='bx bx-right-arrow-alt'></i></a>
                <?php endif; ?>
            <?php else: ?>
                <button class="btn btn-lg btn-theme btn-success w-100" data-bs-toggle="modal" data-bs-target="#LoginPopup">
                    Book Now <i class='bx bx-right-arrow-alt'></i>
                </button>
            <?php endif; ?>
        </div>
        <?php if (!empty($package->PACKAGE_PDF)): ?>
            <div class="d-flex mb-1">
                <button data-href="/upload/package_pdf/<?= $package->PACKAGE_PDF; ?>" onclick="downloadURI('/upload/package_pdf/<?= $package->PACKAGE_PDF; ?>','')" type="button" class="btn btn-lg btn-theme  btn-warning w-100"> Download PDF <i class='bx bxs-download'></i></button>
            </div>
        <?php endif; ?>
        <div class="d-flex gap-2  mb-1">
            <?php if (!empty($package->WHATSAPP_LINK)) : ?>
                <a href="<?= $package->WHATSAPP_LINK; ?> | https://voyagersbeat.com/package/<?= $package->SLUG; ?>" type="button" class="w-100 btn btn-outline-whatsapp d-flex justify-content-center gap-2"><i class='bx bxl-whatsapp fs-4'></i> Chat with Expert</a>
                <?php
                preg_match('/wa\.me\/(\d+)/', $package->WHATSAPP_LINK, $matches);
                $ExtractedphoneNumber = $matches[1] ?? null;
                ?>
                <a href="tel:+<?= $ExtractedphoneNumber ?>" type="button" class="w-100 btn btn-theme btn-warning d-flex justify-content-center gap-2"><i class='bx bxs-phone-call fs-4'></i>Call Expert</a>
            <?php else: ?>
                <a href="https://wa.me/91<?= $defaultContact ?>?text=Hey! Voyagers Beat I am interested in your trip id <?= $package->PACKAGE_ID; ?> | https://voyagersbeat.com/package/<?= $package->SLUG; ?>" type="button" class="w-100 btn btn-outline-whatsapp d-flex justify-content-center gap-2"><i class='bx bxl-whatsapp fs-4'></i> Chat with Expert</a>
                <a href="tel:+<?= $defaultContact ?>" type="button" class="w-100 btn btn-outline-dark  d-flex justify-content-center gap-2"><i class='bx bxs-phone-call fs-4'></i>Call Expert</a>
            <?php endif; ?>
        </div>

        <div class="d-flex justify-content-between">
            <?php if (!empty($package->HOTEL_IMG_LINK)): ?>
                <a type="button" class="btn btn-sm btn-outline-dark mb-1">Hotel Images</a>
            <?php endif; ?>
            <a href="/book/<?= $package->PACKAGE_ID ?>" type="button" class="text-secondary mb-1"><sub>Check Offer</sub></a>
        </div>

    </div>