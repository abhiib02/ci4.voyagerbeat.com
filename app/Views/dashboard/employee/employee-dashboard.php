<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 h-100">
    <?php
    // Extract the list of valid links to check against
    $validLinks = !empty($pagenames) ? array_column($pagenames, 'link') : [];

    if (!empty($pagename) && in_array($pagename, $validLinks, true)): ?>
        <?= view('dashboard/employee/pages/' . $pagename) ?>
    <?php else: ?>
        <div class="card my-2">
            <div class="card-header">
                <div class="fw-bold">Dashboard</div>
            </div>
            <div class="card-body">
                <p class="display-3">Welcome, <?= esc($name ?? 'Employee') ?></p>
                <div class="row">
                    <div class="col-lg-4">
                        Sidebar Navigation Details
                        <ul>
                            <li>Nothing For Now</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

</main>