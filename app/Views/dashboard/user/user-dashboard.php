<main class="w-100">
    <?= view('dashboard/user/layout/component/top-nav') ?>
    <?php
    // Extract the list of valid links to check against
    $validLinks = !empty($pagenames) ? array_column($pagenames, 'link') : [];

    if (!empty($pagename) && in_array($pagename, $validLinks, true)): ?>
        <?= view('dashboard/user/pages/' . $pagename) ?>
    <?php else: ?>

        <div class="px-3 pb-3">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-3 mt-4 mb-4 border-bottom ">
                <div>
                    <h1 class="h2 fw-bold mb-1">Hello, <?= esc($name ?? 'Traveller') ?>! 👋</h1>
                    <p class="text-muted small mb-0">Here is a quick overview of your account activity.</p>
                </div>
                <a href="/logout" class="btn btn-warning text-dark fw-bold px-4 hide-on-mobile">
                    <i class="bx bx-log-out me-1"></i> Logout
                </a>
            </div>

            <!-- Stat Cards Grid -->
            <div class="row g-3 mb-4">
                <!-- Customer Since Card -->
                <div class="col-6 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-1 d-flex align-items-center">
                            <div class="rounded-3 bg-primary bg-opacity-10 text-primary p-3 me-3 hue-rotate">
                                <i class='bx bx-star fs-6'></i>
                            </div>
                            <div>
                                <span class="text-muted small fw-semibold text-uppercase">Loyalty Points</span>
                                <h4 class="mb-0 fw-bold text-dark fs-5"><?= esc($Points ?? '') ?></h4>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Customer Since Card -->
                <div class="col-6 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-1 d-flex align-items-center">
                            <div class="rounded-3 bg-primary bg-opacity-10 text-primary p-3 me-3">
                                <i class="bx bx-calendar fs-6"></i>
                            </div>
                            <div>
                                <span class="text-muted small fw-semibold text-uppercase">Customer Since</span>
                                <h4 class="mb-0 fw-bold text-dark fs-5">05/09/2026</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Booked Trips Card -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-1 d-flex align-items-center">
                            <div class="rounded-3 bg-success bg-opacity-10 text-success p-3 me-3">
                                <i class="bx bx-map-pin fs-6"></i>
                            </div>
                            <div>
                                <span class="text-muted small fw-semibold text-uppercase">Booked Trips</span>
                                <h3 class="mb-0 fw-bold fs-4 text-dark"><?= esc($CustomerBookingsCount ?? 'Not Loaded') ?></h3>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Travel Buddy Trips Card -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-1 d-flex align-items-center">
                            <div class="rounded-3 bg-info bg-opacity-10 text-info p-3 me-3">
                                <i class="bx bx-user-plus fs-6"></i>
                            </div>
                            <div>
                                <span class="text-muted small fw-semibold text-uppercase">Travel Buddy In</span>
                                <h3 class="mb-0 fw-bold fs-4 text-dark"><?= esc($CustomerAsTravelBuddyCount ?? 'Not Loaded') ?> Trips</h3>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>

    <?php endif; ?>

</main>