<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
      <img src="<?= env('app.LogoPath') ?>" alt="Bootstrap" width="50px" height="auto">
    </a>
    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link" href="#">Awards & Recognition</a>
      </li>
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
        <a href="#" class="icon-menu">
          <div class="icon">
            <i class='bx bx-map-pin'></i>
          </div>
          <div>
          <p class="">Kerala</p>
          <sub>Backwaters, tea gardens & Munnar</sub>
          </div>
        </a>
        <a href="#" class="icon-menu">
          <div class="icon">
            <i class='bx bx-map-pin'></i>
          </div>
          <div>
          <p class="">Andaman</p>
          <sub>Islands, scuba & beach resorts</sub>
          </div>
        </a>
        <a href="#" class="icon-menu">
          <div class="icon">
            <i class='bx bx-map-pin'></i>
          </div>
          <div>
          <p class="">Char Dham Yatra </p>
          <sub>Pilgrimage circuit, Himalayas</sub>
          </div>
        </a>
        <a href="#" class="icon-menu">
          <div class="icon">
            <i class='bx bx-map-pin'></i>
          </div>
          <div>
          <p class="">Ooty</p>
          <sub>Hill station, toy train, gardens</sub>
          </div>
        </a>
        <a href="#" class="icon-menu">
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
        <div class="card h-100"></div>
      </div>
    </div>
  </div>
</div>
<div id="ladakh-trips-dropdown" class="mega-panel container" popover>
  <div class="d-flex justify-content-around">
    <div class="square-card">Image Card</div>
    <div class="square-card">Image Card</div>
    <div class="square-card">Image Card</div>
    <div class="square-card">Image Card</div>
  </div>
</div>
<div id="spiti-trips-dropdown" class="mega-panel container" popover>
  <div class="d-flex justify-content-around">
    <div class="square-card">Card 1</div>
    <div class="square-card">Card 1</div>
    <div class="square-card">Card 1</div>
    <div class="square-card">Card 1</div>
  </div>
</div>
<div id="weekend-trips-dropdown" class="mega-panel container" popover>
  <div class="d-flex justify-content-around">
    <div class="square-card">Card 1</div>
    <div class="square-card">Card 1</div>
    <div class="square-card">Card 1</div>
    <div class="square-card">Card 1</div>
  </div>
</div>
<div id="international-trips-dropdown" class="mega-panel container" popover>
  <div class="d-flex justify-content-around">
    <div class="square-card">Card 1</div>
    <div class="square-card">Card 1</div>
    <div class="square-card">Card 1</div>
    <div class="square-card">Card 1</div>
  </div>
</div>
<div id="trip-type-dropdown" class="mega-panel container" popover>
  <div class="d-flex justify-content-around">
    <div class="square-card">Card 1</div>
    <div class="square-card">Card 1</div>
    <div class="square-card">Card 1</div>
    <div class="square-card">Card 1</div>
  </div>
</div>
<div id="honeymoon-dropdown" class="mega-panel container" popover>
  <div class="d-flex justify-content-around">
    <div class="square-card">Card 1</div>
    <div class="square-card">Card 1</div>
    <div class="square-card">Card 1</div>
    <div class="square-card">Card 1</div>
  </div>
</div>

<div id="more-dropdown" class="mega-panel container" popover>
  <?php if ($isAdmin): ?>
    <a href="/dashboard">Dashboard</a> |
    <a href="/logout">Logout</a>
  <?php elseif ($isUser): ?>
    <a href="/account">Account</a> |
    <a href="/logout">Logout</a>
  <?php else: ?>
    <a href="/login">Login</a>
  <?php endif; ?>
</div>
</div>