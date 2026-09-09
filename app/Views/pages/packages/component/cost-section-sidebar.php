<?php if (!$package->REQUEST_PRICE): ?>
    <div class="outline-card style-border mb-2 p-2">

        <h5 class="">Trip Costing</h5>
        <ul class="nav nav-pills nav-fill gap-2 p-1 small  rounded-3" id="CostsTabNav" role="tablist">
            <?php if (!empty($package->INFO_P1)): ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link active rounded-3 border" id="info_p1_tab" data-bs-toggle="tab" data-bs-target="#info_p1" type="button" role="tab" aria-selected="true">
                        <?= explode(' ', $package->INFO_P1)[0] ?>
                    </button>
                </li>
            <?php endif; ?>
            <?php if (!empty($package->INFO_P2)): ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-3 border" id="info_p2_tab" data-bs-toggle="tab" data-bs-target="#info_p2" type="button" role="tab" aria-selected="false">
                        <?= explode(' ', $package->INFO_P2)[0] ?>
                    </button>
                </li>
            <?php endif; ?>
            <?php if (!empty($package->INFO_P3)): ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-3 border" id="info_p3_tab" data-bs-toggle="tab" data-bs-target="#info_p3" type="button" role="tab" aria-selected="false">
                        <?= explode(' ', $package->INFO_P3)[0] ?>
                    </button>
                </li>
            <?php endif; ?>
            <?php if (!empty($package->INFO_P4)): ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-3 border" id="info_p4_tab" data-bs-toggle="tab" data-bs-target="#info_p4" type="button" role="tab" aria-selected="false">
                        <?= explode(' ', $package->INFO_P4)[0] ?>
                    </button>
                </li>
            <?php endif; ?>
            <?php if (!empty($package->INFO_P5)): ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-3 border" id="info_p5_tab" data-bs-toggle="tab" data-bs-target="#info_p5" type="button" role="tab" aria-selected="false">
                        <?= explode(' ', $package->INFO_P5)[0] ?>
                    </button>
                </li>
            <?php endif; ?>
        </ul>
        <hr>
        <div class="tab-content px-3" id="CostsTabNavContent">
            <div class="tab-pane fade active show" id="info_p1" role="tabpanel" aria-labelledby="info_p1-tab" tabindex="0">
                <?php if (!empty($package->HEAD_PRICE)): ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class=""><?= strip_tags($package->HEAD_PRICE) ?></p>
                        <p class="fw-bold fs-3 ">₹<?= $package->PRICE_1 ?? '' ?></p>
                    </div>
                <?php endif; ?>
                <?php if (!empty($package->HEAD_WTPRICE)): ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class=""><?= strip_tags($package->HEAD_WTPRICE) ?></p>
                        <p class="fw-bold fs-3">₹<?= $package->WT_PRICE_1 ?? '' ?></p>
                    </div>
                <?php endif; ?>
                <?php if (!empty($package->HEAD_WT2PRICE)): ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class=""><?= strip_tags($package->HEAD_WT2PRICE) ?></p>
                        <p class="fw-bold fs-3">₹<?= $package->WT2_PRICE_1 ?? '' ?></p>
                    </div>
                <?php endif; ?>

            </div>
            <div class="tab-pane fade" id="info_p2" role="tabpanel" aria-labelledby="info_p2-tab" tabindex="0">
                <?php if (!empty($package->HEAD_PRICE)): ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class=""><?= strip_tags($package->HEAD_PRICE) ?></p>
                        <p class="fw-bold fs-3">₹<?= $package->PRICE_2 ?? '' ?></p>
                    </div>
                <?php endif; ?>
                <?php if (!empty($package->HEAD_WTPRICE)): ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class=""><?= strip_tags($package->HEAD_WTPRICE) ?></p>
                        <p class="fw-bold fs-3">₹<?= $package->WT_PRICE_2 ?? '' ?></p>
                    </div>
                <?php endif; ?>
                <?php if (!empty($package->HEAD_WT2PRICE)): ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class=""><?= strip_tags($package->HEAD_WT2PRICE) ?></p>
                        <p class="fw-bold fs-3">₹<?= $package->WT2_PRICE_2 ?? '' ?></p>
                    </div>
                <?php endif; ?>

            </div>
            <div class="tab-pane fade" id="info_p3" role="tabpanel" aria-labelledby="info_p3-tab" tabindex="0">
                <?php if (!empty($package->HEAD_PRICE)): ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class=""><?= strip_tags($package->HEAD_PRICE) ?></p>
                        <p class="fw-bold fs-3">₹<?= $package->PRICE_3 ?? '' ?></p>
                    </div>
                <?php endif; ?>
                <?php if (!empty($package->HEAD_WTPRICE)): ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class=""><?= strip_tags($package->HEAD_WTPRICE) ?></p>
                        <p class="fw-bold fs-3">₹<?= $package->WT_PRICE_3 ?? '' ?></p>
                    </div>
                <?php endif; ?>
                <?php if (!empty($package->HEAD_WT2PRICE)): ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class=""><?= strip_tags($package->HEAD_WT2PRICE) ?></p>
                        <p class="fw-bold fs-3">₹<?= $package->WT2_PRICE_3 ?? '' ?></p>
                    </div>
                <?php endif; ?>

            </div>
            <div class="tab-pane fade" id="info_p4" role="tabpanel" aria-labelledby="info_p4-tab" tabindex="0">
                <?php if (!empty($package->HEAD_PRICE)): ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class=""><?= strip_tags($package->HEAD_PRICE) ?></p>
                        <p class="fw-bold fs-3">₹<?= $package->PRICE_4 ?? '' ?></p>
                    </div>
                <?php endif; ?>
                <?php if (!empty($package->HEAD_WTPRICE)): ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class=""><?= strip_tags($package->HEAD_WTPRICE) ?></p>
                        <p class="fw-bold fs-3">₹<?= $package->WT_PRICE_4 ?? '' ?></p>
                    </div>
                <?php endif; ?>
                <?php if (!empty($package->HEAD_WT2PRICE)): ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class=""><?= strip_tags($package->HEAD_WT2PRICE) ?></p>
                        <p class="fw-bold fs-3">₹<?= $package->WT2_PRICE_4 ?? '' ?></p>
                    </div>
                <?php endif; ?>

            </div>
            <div class="tab-pane fade" id="info_p5" role="tabpanel" aria-labelledby="info_p5-tab" tabindex="0">
                <?php if (!empty($package->HEAD_PRICE)): ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class=""><?= $package->HEAD_PRICE ?></p>
                        <p class="fw-bold fs-3">₹<?= $package->PRICE_5 ?? '' ?></p>
                    </div>
                <?php endif; ?>
                <?php if (!empty($package->HEAD_WTPRICE)): ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class=""><?= strip_tags($package->HEAD_WTPRICE) ?></p>
                        <p class="fw-bold fs-3">₹<?= $package->WT_PRICE_5 ?? '' ?></p>
                    </div>
                <?php endif; ?>
                <?php if (!empty($package->HEAD_WT2PRICE)): ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class=""><?= strip_tags($package->HEAD_WT2PRICE) ?></p>
                        <p class="fw-bold fs-3">₹<?= $package->WT2_PRICE_5 ?? '' ?></p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between align-items-center px-3">
            <p></p>
            <p class="fw-bold text-secondary">+ 5% GST</p>
        </div>
    </div>
<?php endif; ?>