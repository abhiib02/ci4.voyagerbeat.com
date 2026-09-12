<?php
if (! function_exists('seasonNav')) {
  function seasonNav()
  {
    $monthNumber = date("m");
    $monthNavArr = array(
      '01' => '
      <li class="nav-item">
        <a class="nav-link" href="/packages/Kedarkantha">Kedarkantha</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/tags/holi">Holi Trips</a>
      </li>
    ',
      '02' => '
      <li class="nav-item">
        <a class="nav-link" href="/packages/Kedarkantha">Kedarkantha</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/tags/holi">Holi Trips</a>
      </li>
    ',
      '03' => '
      <li class="nav-item">
        <a class="nav-link" href="/tags/holi">Holi Trips</a>
      </li>
    ',
      '04' => '',
      '05' => '',
      '06' => '',
      '07' => '',
      '08' => '',
      '09' => '',
      '10' => '',
      '11' => '
      <li class="nav-item">
        <a class="nav-link" href="/type/xmas-new-year">Xmas & New Year</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/packages/kedarkantha">Kedarkantha</a>
      </li>
    ',
      '12' => '
      <li class="nav-item">
        <a class="nav-link" href="/type/xmas-new-year">Xmas & New Year</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/packages/kedarkantha">Kedarkantha</a>
      </li>
    '
    );
    return $monthNavArr[$monthNumber];
  }
}
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
      <img src="<?= env('app.LogoPath') ?>" alt="Bootstrap" width="50px" height="auto">
    </a>
    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link" href="/recognition">Awards & Recognition</a>
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
        <a class="nav-link" href="/upcoming">Upcoming</a>
      </li>
      <li class="nav-item dropdown">
        <button class="nav-link dropdown-toggle menu-trigger" popovertarget="more-dropdown">More</button>
      </li>
    </ul>
    <ul class="navbar-nav mb-2 mb-lg-0">
      <li class="nav-item ">
        <button class="nav-link" data-bs-toggle="modal" data-bs-target="#SearchBox">
          <i class='fs-4 bx bx-search'></i>
        </button>
      </li>
    </ul>
</nav>
<div id="family-trips-dropdown" class="mega-panel" popover>
  <div class="menu-panel p-3">
    <div class="row g-3">
      <div class="col-6">
        <a href="/state/kerala" class="icon-menu">
          <div class="icon">
            <i class='bx bx-map-pin'></i>
          </div>
          <div>
            <p class="">Kerala</p>
            <sub>Backwaters, tea gardens & Munnar</sub>
          </div>
        </a>
        <a href="/state/Andaman+and+Nicobar+Islands" class="icon-menu">
          <div class="icon">
            <i class='bx bx-map-pin'></i>
          </div>
          <div>
            <p class="">Andaman</p>
            <sub>Islands, scuba & beach resorts</sub>
          </div>
        </a>
        <a href="/tag/dham-yatra" class="icon-menu">
          <div class="icon">
            <i class='bx bx-map-pin'></i>
          </div>
          <div>
            <p class="">Char Dham Yatra </p>
            <sub>Pilgrimage circuit, Himalayas</sub>
          </div>
        </a>
        <a href="/packages/ooty" class="icon-menu">
          <div class="icon">
            <i class='bx bx-map-pin'></i>
          </div>
          <div>
            <p class="">Ooty</p>
            <sub>Hill station, toy train, gardens</sub>
          </div>
        </a>
        <a href="/packages/coorg" class="icon-menu">
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
          <a href="/type/family-trip" class="hover-panel  text-decoration-none  grid-center" style="--hover-panel-bg:url('/assets/img/family.jpg')">
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
        <?php foreach ($navDataLadakh as $item): ?>
          <a href="/package/<?= urlencode($item->SLUG) ?>" class="icon-menu">
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
          <a href="/packages/leh" class="hover-panel text-decoration-none grid-center" style="--hover-panel-bg:url('/assets/img/ladakh.webp')">
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
        <?php foreach ($navDataSpiti as $item): ?>
          <a href="/package/<?= urlencode($item->SLUG) ?>" class="icon-menu">
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
          <a href="/packages/spiti" class="hover-panel  text-decoration-none  grid-center" style="--hover-panel-bg:url('/assets/img/spiti.jpg')">
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

        <a href="/nights/1" class="icon-menu">
          <div>
            <p class="">1 Night / 2 Days</p>
            <sub>Quick Routine Breaker Trips</sub>
          </div>
        </a>
        <ul class="list-group">
          <a class="list-group-item list-group-item-action" href="/nights/1/manali">
            Manali Solang Sissu
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/1/kasol">
            Kasol Tosh Manikaran
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/1/kasol">
            Kheerganga
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/1/mcleodganj">
            mcleodganj
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/1/triund">
            Triund
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/1/bir-billing">
            Bir Billing
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/1/tirthan">
            Jibhi Jalori Pass
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/1/rishikesh">
            Rishikesh
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/1/kanatal">
            Kanatal
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/1/chakrata">
            Chakrata
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/1/jaipur">
            Jaipur
          </a>
        </ul>

      </div>
      <div class="col-4">

        <a href="/nights/2" class="icon-menu">
          <div>
            <p class="">2 Night / 3 Days</p>
            <sub>Life Refreshing Trips</sub>
          </div>
        </a>
        <ul class="list-group">
          <a class="list-group-item list-group-item-action" href="/nights/2/manali">
            Manali solang sissu
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/Kasol">
            Kasol tosh manikaran
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/Kasol">
            Kasol kheerganga
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/mcleodganj">
            Mcleodganj triund
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/bir-billing">
            Mcleodganj bir-billing
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/Tirthan">
            Tirthan valley jibhi
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/Chopta">
            Chopta Chandrashila
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/Harshil">
            Harshil valley
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/Udaipur">
            Udaipur Kumbhalgarh
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/auli">
            Auli joshimath
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/jaisalmer">
            Jaisalmer longewala
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/Manali">
            Manali jispa
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/2/Sainj">
            Shangarh &amp; sainj
          </a>
        </ul>
      </div>
      <div class="col-4">

        <a href="/nights/3" class="icon-menu">
          <div>
            <p class="">3 Night / 4 Days</p>
            <sub>Memory Creation Trips</sub>
          </div>
        </a>
        <ul class="list-group">
          <a class="list-group-item list-group-item-action" href="/nights/3/mcleodganj">
            Mcleodganj Triund Birbilling
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/3/kasol">
            Kasol tosh kheerganga
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/3/Tirthan">
            Jibhi tirthan kasol
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/3/manali">
            Manali Sissu Kasol
          </a>
          <a class="list-group-item list-group-item-action" href="/nights/3/chitkul">
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
        <?php foreach ($navDataInternational as $item): ?>
          <?php if ($item != 'India'): ?>
            <a href="/country/<?= urlencode($item) ?>" class="icon-menu">
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
          <a href="/state/International" class="hover-panel text-decoration-none grid-center" style="--hover-panel-bg:url('/assets/img/almaty.jpg')">
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
        <?php foreach ($navDataPackageType as $item): ?>
          <a href="/type/<?= urlencode($item) ?>" class="icon-menu" style="width: max-content;">
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

        <?php foreach ($navDataHoneymoon as $item): ?>
          <a href="/package/<?= urlencode($item->SLUG) ?>" class="icon-menu">
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
          <a href="/state/International" class="hover-panel text-decoration-none grid-center" style="--hover-panel-bg:url('/assets/img/honeymoon.jpg')">
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
          <a class="list-group-item list-group-item-action" href="/blogs">
            Blogs
          </a>
          <a class="list-group-item list-group-item-action" href="/packages">
            Packages
          </a>

          <a class="list-group-item list-group-item-action" href="/travelerFavorites">
            Traveler Favorites
          </a>
          <?php if ($isAdmin): ?>
            <a class="list-group-item list-group-item-action" href="/dashboard">
              Admin Dashboard
            </a>
            <a class="list-group-item list-group-item-action text-bg-danger" href="/logout">
              Logout
            </a>
          <?php elseif ($isUser): ?>
            <a class="list-group-item list-group-item-action" href="/account">
              Your Profile
            </a>
            <a class="list-group-item list-group-item-action text-bg-danger" href="/logout">
              Logout
            </a>
          <?php else: ?>
            <a class="list-group-item list-group-item-action" href="/login">
              Login
            </a>
            <a class="list-group-item list-group-item-action" href="/Signup">
              Signup
            </a>
          <?php endif; ?>
        </ul>
      </div>
      <div class="col-6">
        <ul class="list-group">
          <a class="list-group-item list-group-item-action" href="/contact">
            Contact Us
          </a>
          <a class="list-group-item list-group-item-action" href="/about">
            introduction
          </a>
          <a class="list-group-item list-group-item-action" href="/about">
            Who We Are?
          </a>
          <a class="list-group-item list-group-item-action" href="/write-for-us">
            Write for Us
          </a>
          <a class="list-group-item list-group-item-action" href="/career">
            Join Our Team
          </a>
        </ul>
      </div>
    </div>
  </div>
</div>
</div>
<script src="/js/navigation-data.json"></script>