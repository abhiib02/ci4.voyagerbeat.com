<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 h-100">
    <?php
    // This Condition Checks if page name is not exist in directory then show default not error 404
    if (isset($pagename) && in_array($pagename, $pagenames ?? [], true)): ?>
        <?= view('dashboard/admin/pages/' . $pagename) ?>
    <?php else: ?>
        <div class="card my-2">
            <div class="card-header">
                <div class="fw-bold">Dashboard</div>
            </div>
            <div class="card-body">
                <p class="display-3">Welcome, <?= esc($name ?? 'Admin') ?></p>
                <div class="row">
                    <div class="col-lg-4">
                        Sidebar Navigation Details
                        <ul>
                            <li>all-booking : Show All the Details of Booking and Payment.</li>
                            <li>Coupon : Show All the Coupons Details.</li>
                            <li>Option List : Show All the Details Which is Subject to Change on Purpose.</li>
                            <li>Package List : Show Essential the Details of package .</li>
                            <li>User List : Show All the Details of User .</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

</main>