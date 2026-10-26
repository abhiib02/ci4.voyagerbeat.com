<div style="z-index: 1021;">
    <div class="topbar text-center py-2 bgColorTheme px-2 d-flex justify-content-between">
        <button onclick="history.back()" class="btn btn-sm btn-outline-dark"><i class='bx bx-chevron-left'></i></button>
        <a href="/">
            <img src="<?= env('app.LogoPath') ?>" alt="<?= env('app.name') ?>" width="50px" height="auto">
        </a>
        <button data-bs-toggle="modal" data-bs-target="#SearchBox" class="btn btn-sm  btn-outline-dark"><i class='bx bx-search'></i></button>
    </div>
</div>
<nav class="fixed-bottom" style="z-index: 1100;" id="mobile-nav">
    <ul class="nav nav-pills gap-2 nav-fill  bg-white rounded-3 shadow-sm flex-nowrap border border-top">
        <li class="nav-item text-center" role="presentation">
            <a href="/" class="nav-link rounded-3 lh-1" id="home-tab2" aria-selected="true">
                <i class='bx bx-home fs-1'></i>
                <br>
                <sub>Home</sub>

            </a>
        </li>
        <?php $current_url = $_SERVER['REQUEST_URI']; ?>
        <li class="nav-item text-center" role="presentation" id="">
            <a href="<?= 'https://wa.me/918448591315?text=Hey! Voyagers Beat,I want to hear more about voyagers beat up coming trip | https://voyagersbeat.com' . $current_url; ?>" class="nav-link rounded-3  lh-1" id="whatsapp-nav-mobile-btn" style="--bs-nav-pills-link-active-bg:#37c572;" aria-selected="false">
                <i class='bx bxl-whatsapp fs-1'></i>
                <br>
                <sub>Whatsapp</sub>
            </a>
        </li>
        <?php if ((str_contains($current_url, '/package/') || str_contains($current_url, '/packageid/')) && isset($package) && isset($package->PACKAGE_ID)): ?>
            <li class="nav-item text-center" role="presentation" id="">
                <a href="/book/<?= $package->PACKAGE_ID ?>" class="nav-link btn btn-theme btn-success text-white active lh-1 " id="Book-now-btn" aria-selected="false">
                    <i class='bx bx-calendar-check fs-1'></i>
                    <br>
                    <sub>Book Now</sub>
                </a>
            </li>
        <?php endif; ?>
        <li class="nav-item text-center" role="presentation">
            <a href="tel:+919667711662" class="nav-link rounded-3  lh-1" id="call-nav-mobile-btn" style="--bs-nav-pills-link-active-bg:#ff7722;" aria-selected="false">
                <i class='bx bx-phone-call fs-1'></i>
                <br>
                <sub>Call Now</sub>
            </a>
        </li>
        <li class="nav-item text-center" role="presentation">
            <button type="button" data-bs-toggle="offcanvas" data-bs-target="#navmobilemenu" class="nav-link rounded-3 lh-1" id="contact-tab2" aria-selected="false">
                <i class='bx bx-menu-alt-right fs-1'></i>
                <br>
                <sub>Menu</sub>
            </button>
        </li>
    </ul>
</nav>

<!-- -->
<?= view('layout/header-partials/offcanvasnav-mobile') ?>