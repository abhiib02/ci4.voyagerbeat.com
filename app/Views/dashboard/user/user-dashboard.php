<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <?php
    // This Condition Checks if page name is not exist in directory then show default not error 404
    if (isset($pagename) && in_array($pagename, $pagenames ?? [], true)): ?>
        <?= view('dashboard/user/pages/' . $pagename) ?>
    <?php else: ?>


        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-3 mt-4 mb-4 border-bottom">
            <div>
                <h1 class="h2 fw-bold mb-1">Hello, <?= esc($name ?? 'Traveller') ?>! 👋</h1>
                <p class="text-muted small mb-0">Here is a quick overview of your account activity.</p>
            </div>
            <a href="/logout" class="btn btn-warning text-dark fw-bold px-4">
                <i class="bx bx-log-out me-1"></i> Logout
            </a>
        </div>

        <!-- Stat Cards Grid -->
        <div class="row g-3 mb-4">
            <!-- Customer Since Card -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="rounded-3 bg-primary bg-opacity-10 text-primary p-3 me-3">
                            <i class="bx bx-calendar fs-3"></i>
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
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="rounded-3 bg-success bg-opacity-10 text-success p-3 me-3">
                            <i class="bx bx-map-pin fs-3"></i>
                        </div>
                        <div>
                            <span class="text-muted small fw-semibold text-uppercase">Booked Trips</span>
                            <h3 class="mb-0 fw-bold fs-4 text-dark"><?= esc($CustomerBookingsCount ?? 'Not Loaded') ?></h3>
                        </div>
                    </div>
                    <a href="/account/bookings" class="btn btn-sm">See Detail</a>

                </div>
            </div>

            <!-- Travel Buddy Trips Card -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="rounded-3 bg-info bg-opacity-10 text-info p-3 me-3">
                            <i class="bx bx-user-plus fs-3"></i>
                        </div>
                        <div>
                            <span class="text-muted small fw-semibold text-uppercase">Travel Buddy In</span>
                            <h3 class="mb-0 fw-bold fs-4 text-dark"><?= esc($CustomerAsTravelBuddyCount ?? 'Not Loaded') ?> Trips</h3>
                        </div>
                    </div>
                    <a href="/account/travelbuddy" class="btn btn-sm">See Detail</a>
                </div>
            </div>

            <!-- Registered Customer ID/Number -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="rounded-3 bg-warning bg-opacity-10 text-warning p-3 me-3">
                            <i class="bx bx-id-card fs-3"></i>
                        </div>
                        <div>
                            <span class="text-muted small fw-semibold text-uppercase">Customer ID</span>
                            <h3 class="mb-0 fw-bold fs-4 text-dark">#194</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>

</main>