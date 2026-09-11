<div class="container text-center mb-2">
    <div class="row style-border outline-card">
        <div class="col-lg-4 col-12">
            <div class="border rounded-3 my-2">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="rounded-3 bg-warning bg-opacity-10 text-warning p-3 me-3">
                        <i class='bx bx-time-five fs-3'></i>
                    </div>
                    <div class="text-start">
                        <span class="text-muted small fw-semibold text-uppercase">Duration</span>
                        <h6 class="mb-0 fw-bold text-dark"><?= $package->DURATION ?> Days</h6>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-4 col-12">
            <div class="border rounded-3 my-2">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="rounded-3 bg-warning bg-opacity-10 text-warning p-3 me-3">
                        <i class='bx bx-bed fs-3'></i>
                    </div>
                    <div class="text-start">
                        <span class="text-muted small fw-semibold text-uppercase">Stay</span>
                        <h6 class="mb-0 fw-bold text-dark"><?= $package->PACKAGE_DAYS ?></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="border rounded-3 my-2">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="rounded-3 bg-warning bg-opacity-10 text-warning p-3 me-3">
                        <i class='bx bx-rupee fs-3'></i>
                    </div>
                    <div class="text-start">
                        <span class="text-muted small fw-semibold text-uppercase">Starting Price</span>
                        <h6 class="mb-0 fw-bold text-dark">
                            <?php if ($package->REQUEST_PRICE) : ?>
                                Price on Request
                            <?php else: ?>
                                ₹ <?= $package->PRICE_1; ?>
                            <?php endif; ?>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="border rounded-3 my-2">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="rounded-3 bg-warning bg-opacity-10 text-warning p-3 me-3">
                        <i class='bx bx-buildings fs-3'></i>
                    </div>
                    <div class="text-start">
                        <span class="text-muted small fw-semibold text-uppercase">Location</span>
                        <h6 class="mb-0 fw-bold text-dark">
                            <?= $package->LOCATION ?>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="border rounded-3 my-2">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="rounded-3 bg-warning bg-opacity-10 text-warning p-3 me-3">
                        <i class='bx bx-map-pin fs-3'></i>
                    </div>
                    <div class="text-start">
                        <span class="text-muted small fw-semibold text-uppercase">Pick n Drop</span>
                        <h6 class="mb-0 fw-bold text-dark">
                            <?= ($package->PICKNDROP) ?? 'Delhi to Delhi' ?>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="border rounded-3 my-2">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="rounded-3 bg-warning bg-opacity-10 text-warning p-3 me-3">
                        <i class='bx bx-map-pin fs-3'></i>
                    </div>
                    <div class="text-start">
                        <span class="text-muted small fw-semibold text-uppercase">State</span>
                        <h6 class="mb-0 fw-bold text-dark">
                            <?= $package->STATE ?>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>