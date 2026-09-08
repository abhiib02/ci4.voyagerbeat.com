<div class="container text-center ">
    <div class="row style-border outline-card p-3">
        <div class="col-lg-4">
            <i class='bx bx-time-five fs-2'></i>
            <p>Duration</p>
            <p class="fw-bold m-0">
                <?= $package->DURATION ?> Days
            </p>
        </div>
        <div class="col-lg-4">
            <i class='bx bx-bed fs-2'></i>
            <p>Duration</p>
            <p class="fw-bold m-0">
                <?= $package->PACKAGE_DAYS ?>
            </p>
        </div>
        <div class="col-lg-4">
            <i class='bx bx-rupee fs-2'></i>
            <p>Starting Price</p>
            <p class="fw-bold m-0">
                <?php if ($package->REQUEST_PRICE) : ?>
                    Price on Request
                <?php else: ?>
                    ₹ <?= $package->PRICE_1; ?>
                <?php endif; ?>
            </p>
        </div>
        <div class="col-lg-4">
            <i class='bx bx-buildings fs-2'></i>
            <p>Location</p>
            <p class="fw-bold m-0">
                <?= $package->LOCATION ?>
            </p>
        </div>
        <div class="col-lg-4">
            <i class='bx bx-map-pin fs-2'></i>
            <p>Pick n Drop</p>
            <p class="fw-bold m-0">
                <?= ($package->PICKNDROP) ?? 'Delhi to Delhi' ?>
            </p>
        </div>
        <div class="col-lg-4">
            <i class='bx bx-map-pin fs-2'></i>
            <p>State</p>
            <p class="fw-bold m-0">
                <?= $package->STATE ?>
            </p>
        </div>
    </div>
</div>