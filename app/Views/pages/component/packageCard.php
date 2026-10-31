<?php

/**
 * @var object $package
 */
?>
<?php helper('custom'); ?>
<div class="travel_card_new" data-filter="<?= strtolower($package->PACKAGE_TYPE); ?>|<?= strtolower($package->TAGS); ?>|<?= strtolower($package->LOCATION); ?>|<?= strtolower($package->STATE); ?>|<?= strtolower($package->WEEKEND); ?>|<?= ($package->UPCOMING) ? "upcoming" : "" ?>" title="<?= $package->PACKAGE_ID; ?>">
    <section class="travelCard-image">
        <a disabledtarget="__blank" class="" href="/package/<?php echo $package->SLUG; ?>" aria-label="<?= strtoupper($package->PACKAGE_NAME); ?>">
            <img
                src="<?= gdriveImage($package->PACKAGE_IMAGE, 400) ?>"
                title="<?= strtoupper($package->PACKAGE_NAME); ?>"
                alt="<?= $package->PACKAGE_ID; ?>|<?= strtoupper($package->PACKAGE_NAME); ?>"
                loading="lazy">
        </a>

        <?php
        $All_Dates = explode(",", $package->DATES);
        $Month_Array = explode(",", $package->DATES);
        $Month_Array = array_values(array_filter($Month_Array));
        $unique_arr = array();

        for ($i = 0; $i < (count($Month_Array) - 1); $i++) {
            array_push($unique_arr, get_Month(extract_month($Month_Array[$i])));
        }
        $unique_arr = array_values(array_unique($unique_arr));
        $months_to_show =  array_filter($unique_arr);
        ?>



        <ul class="months">
            <?php if (!empty($months_to_show)): ?>
                <?php foreach ($months_to_show as $index => $month): ?>
                    <?php if ($index < 4): ?>
                        <li class="mon-pill"><?= $month ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
        <?php if (auth('Admin', 'Employee', 'Manager')): ?>
            <ul class="months" style="justify-content:flex-end;">
                <li class="mon-pill text-bg-dark fw-bold"><?= $package->PACKAGE_ID ?></li>
            </ul>
        <?php endif; ?>
    </section>
    <section class="detail">
        <div>
            <div class="title "><a disabledtarget="__blank" href="/package/<?= $package->SLUG; ?>"><?= strtoupper($package->PACKAGE_NAME); ?></a></div>
            <div class="desc"><a disabledtarget="__blank" href="/package/<?= $package->SLUG; ?>">
                    <div class="loc-dur">
                        <span style="white-space: nowrap;text-overflow: ellipsis;overflow: clip;display: inline-block;max-width: 90px;"><?= $package->LOCATION ?></span>
                        <span>•</span>
                        <span><?= convertDuration($package->PACKAGE_DAYS) ?></span>
                    </div>
                </a></div>
        </div>
        <div class="desc">
            <div class="price">
                <a disabledtarget="__blank" href="/package/<?= $package->SLUG; ?>">
                    <?php if ($package->REQUEST_PRICE) : ?>
                        Price on Request
                    <?php else: ?>
                        <del class="text-secondary">₹<?= $package->S_PRICE_1; ?></del> <b>₹<?= $package->PRICE_1; ?> / Adult</b>
                    <?php endif; ?>

                </a>
            </div>
        </div>
        <?php if ($package->BADGE): ?>
            <div class="badge"><?= $package->BADGE ?></div>
        <?php endif; ?>

        <?php // if($package->PACKAGE_PDF){ echo '<div class="btn pdf_btn"><a class="" aria-label="Download pdf of '.$package->PACKAGE_NAME.'" rel=”nofollow” href="../../pdf/'.$package->PACKAGE_PDF.'" download><i class="icon-file-pdf"></i></a></div>';}
        ?>

        <?php if (auth('Admin', 'Manager')): ?>
            <a href="/voyagersbeat/download_json_package/<?= $package->PACKAGE_ID ?>" class="btn export_btn"><i class='bx bx-export'></i></a>
        <?php endif; ?>

        <div class="btn dates_btn"><i class="bx bx-calendar"></i></div>

        <?php if ($package->FAVORITE_COUNT == 0): ?>
            <div class="chip-btn like"
                data-count="<?= (int)$package->FAVORITE_COUNT; ?>"
                data-id="<?= $package->PACKAGE_ID; ?>"
                style="display:flex;justify-content: center;" onclick="toggleFav(<?= $package->PACKAGE_ID; ?>, this)">
                <i class="bx bx-heart"></i>
                <span class="like_count" id="lc<?= $package->PACKAGE_ID; ?>">
                    <?= (int)$package->FAVORITE_COUNT; ?>
                </span>
            </div>
        <?php else: ?>
            <div class="chip-btn like like2"
                data-count="<?= (int)$package->FAVORITE_COUNT; ?>"
                data-id="<?= $package->PACKAGE_ID; ?>"
                style="display:flex;justify-content: center;" onclick="toggleFav(<?= $package->PACKAGE_ID; ?>, this)">
                <i class="bx bx-heart"></i>
                <span class="like_count" id="lc<?= $package->PACKAGE_ID; ?>">
                    <?= (int)$package->FAVORITE_COUNT; ?>
                </span>
            </div>
        <?php endif; ?>

        <div class="dates">
            <ul style="display: grid;place-items: center;">

                <?php
                if (count($All_Dates) > 0) {
                    for ($i = 0; $i < (count($All_Dates)); $i++) {
                        if ($i < 10) {
                ?>
                            <li class="chip bg-main"><?= $All_Dates[$i]; ?></li>
                    <?php }
                    }
                } else { ?>
                    <li class="chip bg-main"><?= $package->DATES; ?></li>
                <?php } ?>

            </ul>

        </div>
    </section>
    <?php
    $price = (int)$package->PRICE_1;
    $s_price = (int)$package->S_PRICE_1;
    $diffrence = $s_price - $price;
    if ($s_price - $price == 2500) {
        $percent = ($price / (($s_price)) - 1) * 100;
    } else {
        $percent = ($price / (($price + 2500)) - 1) * 100;
    }

    ?>
    <?php

    if (!$package->REQUEST_PRICE) : ?>
        <section class="travel-card-bottom-bar">
            <?php
            // Deterministic variation based on package ID so it stays consistent per package
            $variant = ($package->PACKAGE_ID % 3) + 1;
            switch ($variant):
                case 1:
            ?>
                    <span>You Save <?= number_format(abs($percent)) ?>%</span>
                <?php
                    break;
                case 2:
                ?>
                    <span>Save ₹<?= number_format($diffrence) ?> Today</span>
                <?php
                    break;
                case 3:
                ?>
                    <span>Special Deal: Save ₹<?= number_format($diffrence) ?></span>
            <?php
                default:
                    break;
            endswitch;
            ?>
        </section>
    <?php endif; ?>
</div>