<main class="col-md-11 ms-sm-auto col-lg-10 px-md-4 pb-5 full-vh">
    <?php
    // Extract the list of valid links to check against
    $validLinks = !empty($pagenames) ? array_column($pagenames, 'link') : [];

    if (!empty($pagename) && in_array($pagename, $validLinks, true)): ?>
        <?= view('dashboard/admin/pages/' . $pagename) ?>
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
                    <div class="col-lg-2">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div class="fw-bold">Total Booking of <?= get_Month_Full($month ?? '') ?> <?= $year ?? '' ?><span title="Showing Booking With Pending,Completed and Completed with No Points Status"><i class='bx bx-info-circle'></i></span></div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <h1 class="card-title"><?= $BookingsCount_Month ?? '' ?></h1>
                                    <p class="fs-6  fst-italic m-0"><?= get_Month_Full($month ?? '') ?> <?= $year ?? '' ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="card mb-2">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div class="fw-bold">Total Persons Sent to Trip in <?= get_Month_Full($month ?? '') ?> <?= $year ?? '' ?></div>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <h1><?= $TotalPersons_Month ?? '' ?> Pax </h1>
                                    <p class="fs-6  fst-italic m-0"><?= get_Month_Full($month ?? '') ?> <?= $year ?? '' ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card mb-2">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div class="fw-bold">Total Revenue of <?= get_Month_Full($month ?? '') ?> <?= $year ?? '' ?><span title="Counted Only With Pending,Completed and Completed with No Points Status"><i class='bx bx-info-circle'></i></span></div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <h1>₹ <?= $TotalRevenue_Month ?? '' ?> </h1>
                                    <p class="fs-6  fst-italic m-0"><?= get_Month_Full($month ?? '') ?> <?= $year ?? '' ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card mb-2">
                            <div class="card-header">
                                <div class="fw-bold">Bookings By Status | <?= get_Month_Full($month ?? '') ?> <?= $year ?? '' ?></div>
                            </div>
                            <div class="card-body">
                                <canvas id="booking-status"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card mb-2">
                            <div class="card-header">
                                <div class="fw-bold">Employees Bookings | <?= get_Month_Full($month ?? '') ?> <?= $year ?? '' ?> <span title="Showing Booking With Pending,Completed and Completed with No Points Status"><i class='bx bx-info-circle'></i></span></div>
                            </div>
                            <div class="card-body">
                                <canvas id="Employees-Bookings"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card mb-2">
                            <div class="card-header">
                                <div class="fw-bold">Annual Data | <?= $year ?? '' ?></div>
                            </div>
                            <div class="card-body">
                                <canvas id="annual-sales"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
                <?= view('dashboard/shared-dashboard-script', [
                    'EmployeeBooking_Month' => $EmployeeBooking_Month ?? [],
                    'Annual_Revenue' => $Annual_Revenue ?? [],
                    'Annual_Pax' => $Annual_Pax ?? [],
                    'BookingCountByStatus' => $BookingCountByStatus ?? []
                ]) ?>
            <?php endif; ?>

</main>