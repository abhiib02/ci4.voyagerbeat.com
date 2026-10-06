<div class="sidebar col-md-3 col-lg-2 p-0 bg-white border-end  shadow-sm">
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

    <!-- Navigation Menu -->
    <div class="p-2 hide-on-mobile">
        <div class="text-uppercase text-muted fw-bold px-3 py-2" style="font-size: 0.75rem; letter-spacing: 0.05em;">
            Menu
        </div>
        <div class="nav flex-column nav-pills gap-1">
            <!-- Account Root Link -->
            <a href="/account" class="nav-link d-flex align-items-center px-3 py-2 rounded-2 text-dark">
                <i class="bx bx-chevron-right me-2 fs-5"></i>
                <span class="fw-medium text-capitalize">Account</span>
            </a>

            <!-- Dynamic Page Links Loop -->
            <?php if (!empty($pagenames)): ?>
                <?php foreach ($pagenames as $page): ?>
                    <a href="/account/<?= esc($page) ?>" class="nav-link d-flex align-items-center px-3 py-2 rounded-2 text-dark ">
                        <i class="bx bx-chevron-right me-2 fs-5"></i>
                        <span class="fw-medium text-capitalize"><?= esc(str_replace(['-', '_'], ' ', $page)) ?></span>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

</div>
<nav class="fixed-bottom p-0 show-on-mobile" style="z-index: 1100;" id="mobile-nav">
    <ul class="nav nav-pills gap-2 nav-fill  bg-white rounded-3 shadow-sm flex-nowrap border border-top">

        <li class="nav-item text-center" role="presentation">
            <a href="/" class="nav-link rounded-3 lh-1" id="home-tab2" aria-selected="true">
                <i class='bx bx-home fs-1'></i>
                <br>
                <sub>Home</sub>
            </a>
        </li>
        <li class="nav-item text-center" role="presentation">
            <a href="/account" class="nav-link rounded-3 lh-1" id="home-tab2" aria-selected="true">
                <i class='bx bx-user-circle fs-1'></i>
                <br>
                <sub class="text-capitalize">Profile</sub>
            </a>
        </li>
        <?php if (!empty($pagenames)): ?>
            <?php foreach ($pagenames as $page): ?>
                <li class="nav-item text-center" role="presentation">
                    <a href="/account/<?= esc($page) ?>" class="nav-link rounded-3 lh-1" id="home-tab2" aria-selected="true">
                        <i class='bx bx-link-alt fs-1'></i>
                        <br>
                        <sub class="text-capitalize"><?= esc(str_replace(['-', '_'], ' ', $page)) ?></sub>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</nav>