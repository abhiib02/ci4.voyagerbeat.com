<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 h-100">

    <?php
    // Extract the list of valid links to check against
    $validLinks = !empty($pagenames) ? array_column($pagenames, 'link') : [];

    if (!empty($pagename) && in_array($pagename, $validLinks, true)): ?>
        <?= view('dashboard/employee/pages/' . $pagename) ?>
    <?php else: ?>
        <div class="card my-2">
            <div class="card-header d-flex justify-content-between">
                <div class="fw-bold">Dashboard</div>
                <div>
                    <?= view('dashboard/shared-components/month-year-selector') ?>
                </div>
            </div>
            <div class="card-body">
                <p class="display-3">Welcome, <?= esc($name ?? 'Employee') ?></p>
                <div class="row">

                    <div class="col-lg-4">

                        <div class="card mb-2">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div class="fw-bold">Total Persons Sent to Trip </div>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h1><?= $TotalPersons_Month ?> Pax </h1>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div class="fw-bold">Total Revenue</div>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h1>₹ <?= $TotalRevenue_Month ?> </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div class="fw-bold">Total Booking of</div>
                                    <div>

                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title"><?= $BookingsCount_Month ?></h5>
                                    <h5>Bookings</h5>
                                </div>

                                <hr>
                                <div class="alert alert-success p-2 d-flex justify-content-between" role="alert">
                                    <div>Complete Booking</div>
                                    <div><?= $BookingsCount_Complete_Month ?></div>
                                </div>
                                <div class="alert alert-success p-2 d-flex justify-content-between" role="alert">
                                    <div>Complete With no points Booking</div>
                                    <div><?= $BookingsCount_Complete_no_points_Month ?></div>
                                </div>
                                <div class="alert alert-warning p-2 d-flex justify-content-between" role="alert">
                                    <div>Pending Booking</div>
                                    <div><?= $BookingsCount_Pending_Month ?></div>
                                </div>
                                <div class="alert alert-secondary p-2 d-flex justify-content-between" role="alert">
                                    <div>Cancelled Booking</div>
                                    <div><?= $BookingsCount_Cancelled_Month ?></div>
                                </div>
                                <div class="alert alert-danger p-2 d-flex justify-content-between" role="alert">
                                    <div>Failed Booking</div>
                                    <div><?= $BookingsCount_Failed_Month ?></div>
                                </div>
                                <div class="alert alert-info p-2 d-flex justify-content-between" role="alert">
                                    <div>Postponed Booking</div>
                                    <div><?= $BookingsCount_Postponed_Month ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

</main>