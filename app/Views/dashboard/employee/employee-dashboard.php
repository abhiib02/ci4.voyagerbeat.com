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
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div class="fw-bold">Total Booking of</div>
                                    <div>

                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <h1 class="card-title"><?= $BookingsCount_Month ?></h1>
                                    <p class="fs-6  fst-italic m-0"><?= get_Month_Full($month) ?> <?= $year ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card mb-2">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div class="fw-bold">Total Persons Sent to Trip </div>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <h1><?= $TotalPersons_Month ?> Pax </h1>
                                    <p class="fs-6  fst-italic m-0"><?= get_Month_Full($month) ?> <?= $year ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card mb-2">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div class="fw-bold">Total Revenue</div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <h1>₹ <?= $TotalRevenue_Month ?> </h1>
                                    <p class="fs-6  fst-italic m-0"><?= get_Month_Full($month) ?> <?= $year ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card mb-2">
                            <div class="card-header">
                                <div class="fw-bold">Annual Data | <?= $year ?></div>
                            </div>
                            <div class="card-body">
                                <canvas id="annual-sales"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card mb-2">
                            <div class="card-header">
                                <div class="fw-bold">Bookings By Status | <?= get_Month_Full($month) ?> <?= $year ?></div>
                            </div>
                            <div class="card-body">
                                <canvas id="booking-status"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <?= view('dashboard/shared-dashboard-script', [
                    'Annual_Revenue' => $Annual_Revenue,
                    'Annual_Pax' => $Annual_Pax,
                    'BookingCountByStatus' => $BookingCountByStatus
                ]) ?>
            <?php endif; ?>

</main>