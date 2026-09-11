<a href="/package/<?= $package->SLUG ?>" class="package_image_card " style="--url:url('<?= str_replace("\n", "", $package->PACKAGE_IMAGE); ?>');">
    <div class="corner-box">
        <span class="badge rounded-pill text-bg-dark"><?= $package->PACKAGE_DAYS ?></span>
    </div>
    <p><?= $package->PACKAGE_NAME ?></p>
    <br>
    <p>
        <?php if ($package->REQUEST_PRICE) : ?>
            Cost as Per Requirement
        <?php else: ?>
            Starting Price @ <b>₹<?php echo $package->PRICE_1 ?></b>
        <?php endif; ?>
    </p>
</a>