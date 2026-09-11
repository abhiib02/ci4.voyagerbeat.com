<div class=" style-border outline-card p-2 h-100 align-content-center  mb-2">


    <?php if ($isAdmin): ?>
        <div class="btn-group w-100 mb-1" role="group" aria-label="Basic example">
            <a href="/package-edit/<?= $package->PACKAGE_ID ?>" type="button" class="btn btn-sm btn-primary d-flex justify-content-center" title="Edit"><i class='bx bxs-edit fs-4'></i></a>
            &nbsp;
            <form action="/delete_package_process" method="post" id="package_delete_form">
                <input type="hidden" name="id" value="<?= $package->PACKAGE_ID ?>">
                <input type="hidden" name="pdf" value="<?= $package->PACKAGE_PDF ?>">
            </form>
            <button type="submit" class="btn btn-sm btn-danger d-flex justify-content-center" form="package_delete_form" title="Delete"><i class='bx bxs-trash fs-4'></i></button>
            &nbsp;
            <a href="/duplicate_package_process/<?= $package->PACKAGE_ID ?>" type="button" class="btn btn-sm btn-dark d-flex justify-content-center" title="Duplicate"><i class='bx bxs-duplicate fs-4'></i></a>
        </div>
    <?php endif; ?>
    <div class="d-flex mb-1">
        <a href="/book/<?= $package->PACKAGE_ID ?>" type="button" class="btn btn-lg btn-theme btn-success w-100" style="width:250px;">Book Now <i class='bx bx-right-arrow-alt'></i></a>
    </div>
    <?php if (!empty($package->PACKAGE_PDF)): ?>
        <div class="d-flex mb-1">
            <button data-href="/upload/package_pdf/<?= $package->PACKAGE_PDF; ?>" onclick="downloadURI('/upload/package_pdf/<?= $package->PACKAGE_PDF; ?>','')" type="button" class="btn btn-lg btn-theme  btn-warning w-100"> Download PDF <i class='bx bxs-download'></i></button>
        </div>
    <?php endif; ?>
    <div class="d-flex gap-2  mb-1">
        <?php if (!empty($package->WHATSAPP_LINK)) : ?>
            <a href="<?= $package->WHATSAPP_LINK; ?> | https://voyagersbeat.com/package/<?= $package->SLUG; ?>" type="button" class="w-100 btn btn-theme btn-outline-voyagers d-flex justify-content-center"><i class='bx bxl-whatsapp fs-4'></i> Chat with Expert</a>
            <?php
            preg_match('/wa\.me\/(\d+)/', $package->WHATSAPP_LINK, $matches);
            $ExtractedphoneNumber = $matches[1] ?? null;
            ?>
            <a href="tel:+<?= $ExtractedphoneNumber ?>" type="button" class="w-100 btn btn-theme btn-warning d-flex justify-content-center"><i class='bx bxs-phone-call fs-4'></i>Call Travel Consultant</a>
        <?php else: ?>
            <a href="https://wa.me/91<?= $defaultContact ?>?text=Hey! Voyagers Beat I am interested in your trip id <?= $package->PACKAGE_ID; ?> | https://voyagersbeat.com/package/<?= $package->SLUG; ?>" type="button" class="w-100 btn btn-outline-voyagers d-flex justify-content-center"><i class='bx bxl-whatsapp fs-4'></i> Chat with Expert</a>
            <a href="tel:+<?= $defaultContact ?>" type="button" class="w-100 btn btn-outline-voyagers  d-flex justify-content-center"><i class='bx bxs-phone-call fs-4'></i>Call Travel Consultant</a>
        <?php endif; ?>
    </div>

    <div class="d-flex justify-content-between">
        <?php if (!empty($package->HOTEL_IMG_LINK)): ?>
            <a type="button" class="btn btn-sm btn-outline-dark mb-1">Hotel Images</a>
        <?php endif; ?>
        <a href="/book/<?= $package->PACKAGE_ID ?>" type="button" class="text-secondary mb-1"><sub>Check Offer</sub></a>
    </div>

</div>