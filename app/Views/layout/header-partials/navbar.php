<?php

/**
 * @var array $navDataLadakh
 * @var array $navDataSpiti
 * @var array $navDataHoneymoon
 */
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary shadow" id="desktop-nav" style="z-index:9999;">
  <div class="container-fluid">
    <a class="navbar-brand" href="/" aria-label="Home">
      <img src="<?= env('app.LogoPath') ?>" alt="Bootstrap" width="50px" height="32.5px">
    </a>
    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link" href="/recognition" aria-label="Awards & Recognition">Awards & Recognition</a>
      </li>
      <?= seasonNav() ?>
      <li class="nav-item dropdown ">
        <button class="nav-link dropdown-toggle menu-trigger" popovertarget="family-trips-dropdown">Family Trips</button>
      </li>
      <li class="nav-item dropdown">
        <button class="nav-link dropdown-toggle menu-trigger" popovertarget="ladakh-trips-dropdown">Ladakh</button>
      </li>
      <li class="nav-item dropdown">
        <button class="nav-link dropdown-toggle menu-trigger" popovertarget="spiti-trips-dropdown">Spiti</button>
      </li>
      <li class="nav-item dropdown">
        <button class="nav-link dropdown-toggle menu-trigger" popovertarget="weekend-trips-dropdown">Weekend Trips</button>
      </li>
      <li class="nav-item dropdown">
        <button class="nav-link dropdown-toggle menu-trigger" popovertarget="international-trips-dropdown">International Trips</button>
      </li>
      <li class="nav-item dropdown">
        <button class="nav-link dropdown-toggle menu-trigger" popovertarget="trip-type-dropdown">Trip Type</button>
      </li>
      <li class="nav-item dropdown">
        <button class="nav-link dropdown-toggle menu-trigger" popovertarget="honeymoon-dropdown">Honeymoon</button>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/upcoming" aria-label="Upcoming">Upcoming</a>
      </li>
      <li class="nav-item dropdown">
        <button class="nav-link dropdown-toggle menu-trigger" popovertarget="more-dropdown">More</button>
      </li>
    </ul>
    <ul class="navbar-nav mb-2 mb-lg-0">
      <li class="nav-item ">
        <button class="nav-link" data-bs-toggle="modal" aria-label="open searchbox" data-bs-target="#SearchBox">
          <i class='fs-4 bx bx-search'></i>
        </button>
      </li>
    </ul>
</nav>
<div id="family-trips-dropdown" class="mega-panel" popover>
  <div class="menu-panel p-3">
    <div class="row g-3">
      <div class="col-6">
        <a href="/state/kerala" class="icon-menu" aria-label="Kerala, Backwaters, tea gardens &amp; Munnar">
          <div class="icon">
            <i class='bx bx-map-pin'></i>
          </div>
          <div>
            <p class="">Kerala</p>
            <sub>Backwaters, tea gardens & Munnar</sub>
          </div>
        </a>
        <a href="/state/Andaman+and+Nicobar+Islands" class="icon-menu" aria-label="Andaman, Islands, scuba &amp; beach resorts">
          <div class="icon">
            <i class='bx bx-map-pin'></i>
          </div>
          <div>
            <p class="">Andaman</p>
            <sub>Islands, scuba & beach resorts</sub>
          </div>
        </a>
        <a href="/tag/dham-yatra" class="icon-menu" aria-label="Char Dham Yatra, Pilgrimage circuit, Himalayas">
          <div class="icon">
            <i class='bx bx-map-pin'></i>
          </div>
          <div>
            <p class="">Char Dham Yatra </p>
            <sub>Pilgrimage circuit, Himalayas</sub>
          </div>
        </a>
        <a href="/packages/ooty" class="icon-menu" aria-label="Ooty, Hill station, toy train, gardens">
          <div class="icon">
            <i class='bx bx-map-pin'></i>
          </div>
          <div>
            <p class="">Ooty</p>
            <sub>Hill station, toy train, gardens</sub>
          </div>
        </a>
        <a href="/packages/coorg" class="icon-menu" aria-label="Coorg, Coffee estates &amp; misty hills">
          <div class="icon">
            <i class='bx bx-map-pin'></i>
          </div>
          <div>
            <p class="">Coorg</p>
            <sub>Coffee estates & misty hills</sub>
          </div>
        </a>


      </div>
      <div class="col-6">
        <div class="h-100">
          <a href="/type/family-trip" class="hover-panel  text-decoration-none  grid-center" aria-label="Family Trips" style="--hover-panel-bg:url('/assets/img/family.jpg')">
            Family Trips
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="ladakh-trips-dropdown" class="mega-panel " popover>
  <div class="menu-panel p-3">
    <div class="row g-3">
      <div class="col-6">
        <?php foreach (($navDataLadakh ?? []) as $item): ?>
          <a href="/package/<?= urlencode($item->SLUG) ?>" class="icon-menu" aria-label="<?= esc($item->PACKAGE_NAME . ' ' . $item->PACKAGE_DAYS . ' ' . $item->BADGE) ?>">
            <div class="icon">
              <i class='bx bx-map-pin'></i>
            </div>
            <div>
              <p class=""><?= $item->PACKAGE_NAME ?></p>
              <sub><?= $item->PACKAGE_DAYS ?></sub>
            </div>

            <span class="badge rounded-pill text-bg-warning"><?= $item->BADGE ?></span>
          </a>
        <?php endforeach; ?>
      </div>
      <div class="col-6">
        <div class="h-100">
          <a href="/packages/leh" class="hover-panel text-decoration-none grid-center" aria-label="Leh Ladakh Trips" style="--hover-panel-bg:url('/assets/img/ladakh.webp')">
            Leh Ladakh Trips
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="spiti-trips-dropdown" class="mega-panel " popover>
  <div class="menu-panel p-3">
    <div class="row g-3">
      <div class="col-6">
        <?php foreach (($navDataSpiti ?? []) as $item): ?>
          <a href="/package/<?= urlencode($item->SLUG) ?>" class="icon-menu" aria-label="<?= esc($item->PACKAGE_NAME . ' ' . $item->PACKAGE_DAYS . ' ' . $item->BADGE) ?>">
            <div class="icon">
              <i class='bx bx-map-pin'></i>
            </div>
            <div>
              <p class=""><?= $item->PACKAGE_NAME ?></p>
              <sub><?= $item->PACKAGE_DAYS ?></sub>
            </div>
            <span class="badge rounded-pill text-bg-warning"><?= $item->BADGE ?></span>

          </a>
        <?php endforeach; ?>
      </div>
      <div class="col-6">
        <div class="h-100">
          <a href="/packages/spiti" class="hover-panel  text-decoration-none  grid-center" aria-label="Spiti Trips" style="--hover-panel-bg:url('/assets/img/spiti.jpg')">
            Spiti Trips
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="weekend-trips-dropdown" class="mega-panel " popover>
  <div class="menu-panel p-3">
    <div class="row g-3">
      <div class="col-4">

        <a href="/nights/1" class="icon-menu" aria-label="1 Night / 2 Days Quick Routine Breaker Trips">
          <div>
            <p class="">1 Night / 2 Days</p>
            <sub>Quick Routine Breaker Trips</sub>
          </div>
        </a>
        <ul class="list-group">
          <a class="list-group-item list-group-item-action" href="/nights/1/manali" aria-label="Manali Solang Sissu">
            Manali Solang Sissu
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/1/kasol" aria-label="Kasol Tosh Manikaran">
            Kasol Tosh Manikaran
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/1/kasol" aria-label="Kheerganga">
            Kheerganga
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/1/mcleodganj" aria-label="mcleodganj">
            mcleodganj
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/1/triund" aria-label="Triund">
            Triund
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/1/bir-billing" aria-label="Bir Billing">
            Bir Billing
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/1/tirthan" aria-label="Jibhi Jalori Pass">
            Jibhi Jalori Pass
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/1/rishikesh" aria-label="Rishikesh">
            Rishikesh
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/1/kanatal" aria-label="Kanatal">
            Kanatal
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/1/chakrata" aria-label="Chakrata">
            Chakrata
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/1/jaipur" aria-label="Jaipur">
            Jaipur
          </a>
        </ul>

      </div>
      <div class="col-4">

        <a href="/nights/2" class="icon-menu" aria-label="2 Night / 3 Days Life Refreshing Trips">
          <div>
            <p class="">2 Night / 3 Days</p>
            <sub>Life Refreshing Trips</sub>
          </div>
        </a>
        <ul class="list-group">
          <a class="list-group-item list-group-item-action" href="/nights/2/manali" aria-label="Manali solang sissu">
            Manali solang sissu
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/kasol" aria-label="Kasol tosh manikaran">
            Kasol tosh manikaran
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/kasol" aria-label="Kasol kheerganga">
            Kasol kheerganga
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/mcleodganj" aria-label="Mcleodganj triund">
            Mcleodganj triund
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/bir-billing" aria-label="Mcleodganj bir-billing">
            Mcleodganj bir-billing
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/Tirthan" aria-label="Tirthan valley jibhi">
            Tirthan valley jibhi
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/Chopta" aria-label="Chopta Chandrashila">
            Chopta Chandrashila
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/Harshil" aria-label="Harshil valley">
            Harshil valley
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/Udaipur" aria-label="Udaipur Kumbhalgarh">
            Udaipur Kumbhalgarh
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/auli" aria-label="Auli joshimath">
            Auli joshimath
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/jaisalmer" aria-label="Jaisalmer longewala">
            Jaisalmer longewala
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/Manali" aria-label="Manali jispa">
            Manali jispa
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/Sainj" aria-label="Shangarh &amp; sainj">
            Shangarh &amp; sainj
          </a>
        </ul>
      </div>
      <div class="col-4">

        <a href="/nights/3" class="icon-menu" aria-label="3 Night / 4 Days Memory Creation Trips">
          <div>
            <p class="">3 Night / 4 Days</p>
            <sub>Memory Creation Trips</sub>
          </div>
        </a>
        <ul class="list-group">
          <a class="list-group-item list-group-item-action" href="/nights/3/mcleodganj" aria-label="Mcleodganj Triund Birbilling">
            Mcleodganj Triund Birbilling
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/3/kasol" aria-label="Kasol tosh kheerganga">
            Kasol tosh kheerganga
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/3/Tirthan" aria-label="Jibhi tirthan kasol">
            Jibhi tirthan kasol
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/3/manali" aria-label="Manali Sissu Kasol">
            Manali Sissu Kasol
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/3/chitkul" aria-label="Chitkul Kalpa">
            Chitkul Kalpa
          </a>
        </ul>
      </div>
    </div>
  </div>
</div>
<div id="international-trips-dropdown" class="mega-panel " popover>
  <div class="menu-panel p-3">
    <div class="row g-3">
      <div class="col-6">
        <?php foreach (($navDataInternational ?? []) as $item): ?>
          <?php if ($item != 'India'): ?>
            <a href="/country/<?= urlencode($item) ?>" class="icon-menu" aria-label="<?= esc($item) ?>">
              <div class="icon" style="--iconbg:url('/assets/flags/<?= getCountryCode($item) ?>.svg')">

              </div>
              <div>
                <p class=""><?= $item ?></p>
                <sub>International</sub>
              </div>

            </a>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
      <div class="col-6">
        <div class="h-100">
          <a href="/state/International" class="hover-panel text-decoration-none grid-center" aria-label="International Trips" style="--hover-panel-bg:url('/assets/img/almaty.jpg')">
            International Trips
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="trip-type-dropdown" class="mega-panel " popover>
  <div class="menu-panel p-3">
    <div class="row g-3">
      <div class="col-12 d-flex flex-wrap gap-2">
        <?php foreach (($navDataPackageType ?? []) as $item): ?>
          <a href="/type/<?= urlencode($item) ?>" class="icon-menu" aria-label="<?= esc($item) ?>" style="width: max-content;">
            <div class="icon">
              <i class='bx bx-map-pin'></i>
            </div>
            <div>
              <p class=""><?= $item ?></p>
              <sub></sub>
            </div>

          </a>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</div>
<div id="honeymoon-dropdown" class="mega-panel " popover>
  <div class="menu-panel p-3">
    <div class="row g-3">
      <div class="col-6">

        <?php foreach (($navDataHoneymoon ?? []) as $item): ?>
          <a href="/package/<?= urlencode($item->SLUG) ?>" class="icon-menu" aria-label="<?= esc($item->PACKAGE_NAME . ' ' . $item->PACKAGE_DAYS) ?>">
            <div class="icon">
              <i class='bx bx-map-pin'></i>
            </div>
            <div>
              <p class=""><?= $item->PACKAGE_NAME ?></p>
              <sub><?= $item->PACKAGE_DAYS ?></sub>
            </div>

          </a>
        <?php endforeach; ?>
      </div>
      <div class="col-6">
        <div class="h-100">
          <a href="/state/International" class="hover-panel text-decoration-none grid-center" aria-label="Honeymoon Trips" style="--hover-panel-bg:url('/assets/img/honeymoon.jpg')">
            Honeymoon Trips
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="more-dropdown" class="mega-panel " popover>
  <div class="menu-panel p-3">
    <div class="row g-3">
      <div class="col-6">
        <ul class="list-group">
          <a class="list-group-item list-group-item-action" href="/blogs" aria-label="Blogs">
            Blogs
          </a>
          <a class="list-group-item list-group-item-action" href="/packages" aria-label="Packages">
            Packages
          </a>

          <a class="list-group-item list-group-item-action" href="/travelerFavorites" aria-label="Traveler Favorites">
            Traveler Favorites
          </a>
          <?= view('layout/header-partials/role-based-navigation') ?>
        </ul>
      </div>
      <div class="col-6">
        <ul class="list-group">

          <a class="list-group-item list-group-item-action" href="/about" aria-label="introduction">
            Introduction
          </a>
          <a class="list-group-item list-group-item-action" href="/about" aria-label="Who We Are?">
            Who We Are?
          </a>
          <a class="list-group-item list-group-item-action" href="/blogs/write-for-us" aria-label="Write for Us">
            Write for Us
          </a>
          <a class="list-group-item list-group-item-action" href="/career" aria-label="Join Our Team">
            Join Our Team
          </a>
        </ul>
      </div>
    </div>
  </div>
</div>

<nav class="navbar navbar-expand-lg bg-body-tertiary shadow" id="ipad-safari-nav" style="z-index:1000;">
  <div class="container-fluid">
    <ul class="navbar-nav mb-2 mb-lg-0">
      <li class="nav-item ">
        <button class="nav-link" data-bs-toggle="modal" aria-label="Open Searchbox" data-bs-target="#SearchBox">
          <i class='fs-4 bx bx-search'></i>
        </button>
      </li>
    </ul>
    <a class="navbar-brand" href="/" aria-label="Home">
      <img src="<?= env('app.LogoPath') ?>" alt="Bootstrap" width="50px" height="auto">
    </a>
    <ul class="navbar-nav mb-2 mb-lg-0">
      <li class="nav-item ">
        <button class="nav-link" data-bs-toggle="offcanvas" data-bs-target="#navmobilemenu">
          <i class='bx bx-menu-alt-right fs-4'></i>
        </button>
      </li>
    </ul>
  </div>
</nav>
<?= view('layout/header-partials/offcanvasnav-mobile') ?>