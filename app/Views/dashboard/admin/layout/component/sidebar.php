<div class="sidebar col-md-3 col-lg-2 p-0 bg-white border-end min-vh-100 shadow-sm">

    <!-- User Profile Header -->
    <div class="p-3 border-bottom bg-light">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center me-2 overflow-hidden">
                <div class="rounded-circle bg-warning text-dark grid-center fw-bold fs-5 me-2 flex-shrink-0 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <?= esc(substr($name ?? 'A', 0, 1)) ?>
                </div>
                <div class="lh-sm overflow-hidden">
                    <h6 class="mb-0 fw-bold text-truncate" title="<?= esc($name ?? '') ?>">
                        <?= esc($name ?? 'User') ?>
                    </h6>
                    <small class="text-muted text-truncate d-block" title="<?= esc($email ?? '') ?>">
                        <?= esc($email ?? '') ?>
                    </small>
                </div>
            </div>
            <a href="/logout" class="btn btn-outline-danger btn-sm rounded-circle p-0 flex-shrink-0 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Logout">
                <i class="bx bx-log-out fs-5"></i>
            </a>
        </div>
    </div>
    <div class="sticky-top">
        <br>
        <!-- Navigation Menu -->
        <div class="p-2">
            <div class="text-uppercase text-muted fw-bold px-3 py-2" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                Menu
            </div>
            <div class="nav flex-column nav-pills gap-1">
                <!-- Account Root Link -->
                <a href="/dashboard" class="nav-link d-flex align-items-center px-3 py-2 rounded-2 text-dark">
                    <i class="bx bx-chevron-right me-2 fs-5"></i>
                    <span class="fw-medium text-capitalize">Dashboard</span>
                </a>

                <!-- Dynamic Page Links Loop -->
                <?php if (!empty($pagenames)): ?>
                    <?php foreach ($pagenames as $page): ?>
                        <a href="/dashboard/<?= esc($page) ?>" class="nav-link d-flex align-items-center px-3 py-2 rounded-2 text-dark ">
                            <i class="bx bx-chevron-right me-2 fs-5"></i>
                            <span class="fw-medium text-capitalize"><?= esc($page) ?></span>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>