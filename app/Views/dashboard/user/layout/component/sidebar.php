<div class="sidebar d-flex flex-column flex-shrink-0 bg-body-tertiary position-sticky shadow-sm hide-on-mobile" style="top:0; width: 4.5rem;height:100vh;z-index:1;">
    <a href="/" class="d-block p-3 link-body-emphasis text-decoration-none text-center" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Home">
        <img src="<?= env('appLogoPath') ?>" class="w-100" alt="Voyagersbeat">
    </a>
    <a href="/userdashboard" class="d-block p-3 link-body-emphasis text-decoration-none text-center" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Dashboard">
        <i class='bx bxs-dashboard fs-5'></i>
    </a>

    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
        <?php if (!empty($pagenames)): ?>

            <?php foreach ($pagenames as $index => $page): ?>
                <li class="nav-item"> <a href="/account/<?= esc($page['link']) ?>" class="nav-link p-1 border-bottom rounded-0"
                        data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?= esc($page['title']) ?>">
                        <i class="<?= esc($page['icon']) ?> fs-5"></i>
                    </a> </li>


            <?php endforeach; ?>
        <?php endif; ?>


    </ul>
    <div class="dropdown border-top"> <a href="#" class="d-flex align-items-center justify-content-center p-3 link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="rounded-circle bg-warning text-dark grid-center fw-bold fs-5 me-2 flex-shrink-0 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <?= esc(substr($name ?? 'A', 0, 1)) ?>
            </div>

        </a>
        <ul class="dropdown-menu text-small shadow">
            <li>
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
                                <small class="text-muted text-truncate d-block" title="<?= esc($id ?? '') ?>">
                                    <?= esc($id ?? '') ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item text-bg-danger" href="/logout">Sign out</a></li>
        </ul>
    </div>
</div>
<!-- Mobile Bottom Bar Dashboard -->
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
                    <a href="/account/<?= esc($page['link']) ?>" class="nav-link rounded-3 lh-1" id="home-tab2" aria-selected="true">
                        <i class='<?= esc($page['icon']) ?> fs-1'></i>
                        <br>
                        <sub class="text-capitalize"><?= esc($page['title']) ?></sub>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</nav>