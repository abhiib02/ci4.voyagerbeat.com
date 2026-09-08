<div class=" style-border outline-card p-2">
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
    <div class="btn-group-vertical w-100" role="group" aria-label="Vertical button group">
        <?php if ($package->WHATSAPP_LINK) : ?>
            <a href="<?= $package->WHATSAPP_LINK; ?> | https://voyagersbeat.com/package/<?= $package->SLUG; ?>" type="button" class="btn btn-success mb-1 d-flex justify-content-center"><i class='bx bxl-whatsapp fs-4'></i> Whatsapp to Connect With Executive</a>
            <?php
            preg_match('/wa\.me\/(\d+)/', $package->WHATSAPP_LINK, $matches);
            $ExtractedphoneNumber = $matches[1] ?? null;
            ?>
            <a href="tel:+<?= $ExtractedphoneNumber ?>" type="button" class="btn btn-warning mb-1 d-flex justify-content-center"><i class='bx bxs-phone-call fs-4'></i>Call Us Now</a>
        <?php else: ?>
            <a href="https://wa.me/91<?= $defaultContact ?>?text=Hey! Voyagers Beat I am interested in your trip id <?= $package->PACKAGE_ID; ?> | https://voyagersbeat.com/package/<?= $package->SLUG; ?>" type="button" class="btn btn-success mb-1 d-flex justify-content-center"><i class='bx bxl-whatsapp fs-4'></i> Whatsapp to Connect With Executive</a>
            <a href="tel:+<?= $defaultContact ?>" type="button" class="btn btn-warning mb-1 d-flex justify-content-center"><i class='bx bxs-phone-call fs-4'></i>Call Us Now</a>
        <?php endif; ?>


        <a href="/book/<?= $package->PACKAGE_ID ?>" type="button" class="btn btn-info mb-1">Check Offer</a>
        <button type="button" class="btn btn-primary mb-1" disabled>View Hotel Images</button>
    </div>
</div>