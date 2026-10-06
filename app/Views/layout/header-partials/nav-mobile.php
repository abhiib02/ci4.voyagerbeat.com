<div class="sticky-top" style="z-index: 1021;">
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

<div class="offcanvas offcanvas-end" tabindex="-1" id="navmobilemenu" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header bgColorTheme">
        <div>

            <h5 class="m-0">Voyagers Beat</h5>
            <sub>Pack Your Bags & Let us Do the Rest</sub>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>




    <div class="offcanvas-body pb-5 mb-3">
        <ul class="list-group list-group-flush" id="listgroupaccordion">

            <li class="list-group-item">

                <?php if (auth('User', 'Admin', 'Employee')): ?>
                    <a class="nav-link icon-link collapsed d-flex justify-content-between w-100" type="button" href="/account">
                        <span class="fs-5"><i class='bx bx-user-circle'></i> Hello, <?= session()->get('name') ?? 'Login' ?></span>
                    </a>
                <?php else: ?>
                    <a class="nav-link icon-link collapsed d-flex justify-content-between w-100" type="button" href="/login">
                        <span class="fs-5"><i class='bx bx-user-circle'></i> Login</span>
                    </a>
                <?php endif; ?>



            </li>

            <li class="list-group-item ">
                <button class="nav-link icon-link collapsed d-flex justify-content-between w-100" type="button" data-bs-toggle="collapse" data-bs-target="#weekend-getaway-mobile" aria-expanded="false" aria-controls="weekend-getaway" data-bs-parent="#listgroupaccordion">
                    <span class="fs-5">📅 Weekend Getaway</span>
                    <span><i class='bx bxs-chevron-down'></i></span>
                </button>
                <div id="weekend-getaway-mobile" class="accordion-collapse collapse  p-2" data-bs-parent="#listgroupaccordion">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active text-dark" id="night-tab" data-bs-toggle="tab" data-bs-target="#night-1" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">1 Night</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-dark" id="night-2-tab" data-bs-toggle="tab" data-bs-target="#night-2" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">2 Nights</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-dark" id="night-3-tab" data-bs-toggle="tab" data-bs-target="#night-3" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">3 Nights</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active card p-2" id="night-1" role="tabpanel" tabindex="0">
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
                        <div class="tab-pane fade card p-2" id="night-2" role="tabpanel" tabindex="0">
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
                        <div class="tab-pane fade card p-2" id="night-3" role="tabpanel" tabindex="0">
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
            </li>
            <li class="list-group-item">
                <button class="nav-link icon-link collapsed d-flex justify-content-between w-100" type="button" data-bs-toggle="collapse" data-bs-target="#family-nav-mobile" aria-expanded="false" aria-controls="weekend-getaway" data-bs-parent="#listgroupaccordion">
                    <span class="fs-5">👨‍👩‍👧‍👧 Family Trips</span>
                    <span><i class='bx bxs-chevron-down'></i></span>
                </button>
                <div id="family-nav-mobile" class="accordion-collapse collapse  p-2" data-bs-parent="#listgroupaccordion">
                    <ul class="list-group">
                        <a class="list-group-item list-group-item-action" href="/state/kerala">
                            Kerala
                        </a>
                        <a class="list-group-item list-group-item-action" href="/state/Andaman+and+Nicobar+Islands">
                            Andaman
                        </a>
                        <a class="list-group-item list-group-item-action" href="/tag/dham-yatra">
                            Char Dham Yatra
                        </a>
                        <a class="list-group-item list-group-item-action" href="/packages/ooty">
                            Ooty
                        </a>
                        <a class="list-group-item list-group-item-action" href="/packages/coorg">
                            Coorg
                        </a>
                        <a class="list-group-item list-group-item-action" href="/tag/Second+Innings">
                            Second Innings
                        </a>

                    </ul>
                </div>
            </li>
            <li class="list-group-item">
                <button class="nav-link icon-link collapsed d-flex justify-content-between w-100" type="button" data-bs-toggle="collapse" data-bs-target="#leh-nav-mobile" aria-expanded="false" aria-controls="weekend-getaway" data-bs-parent="#listgroupaccordion">
                    <span class="fs-5">🏕 Leh Trips</span>
                    <span><i class='bx bxs-chevron-down'></i></span>
                </button>
                <div id="leh-nav-mobile" class="accordion-collapse collapse  p-2" data-bs-parent="#listgroupaccordion">
                    <ul class="list-group">
                        <?php foreach (($navDataLadakh ?? []) as $item): ?>
                            <a class="list-group-item list-group-item-action" href="/package/<?= urlencode($item->SLUG) ?>">
                                <?= $item->PACKAGE_NAME ?>
                            </a>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </li>
            <li class="list-group-item">
                <button class="nav-link icon-link collapsed d-flex justify-content-between w-100" type="button" data-bs-toggle="collapse" data-bs-target="#Spiti-nav-mobile" aria-expanded="false" aria-controls="weekend-getaway" data-bs-parent="#listgroupaccordion">
                    <span class="fs-5">🏔 Spiti Trips</span>
                    <span><i class='bx bxs-chevron-down'></i></span>
                </button>
                <div id="Spiti-nav-mobile" class="accordion-collapse collapse  p-2" data-bs-parent="#listgroupaccordion">
                    <ul class="list-group">
                        <?php foreach (($navDataSpiti ?? []) as $item): ?>
                            <a class="list-group-item list-group-item-action" href="/package/<?= urlencode($item->SLUG) ?>">
                                <?= $item->PACKAGE_NAME ?>
                            </a>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </li>
            <?php if (!empty(seasonNavMobile())): ?>
                <li class="list-group-item">
                    <button class="nav-link icon-link collapsed d-flex justify-content-between w-100" type="button" data-bs-toggle="collapse" data-bs-target="#season-nav-mobile" aria-expanded="false" aria-controls="weekend-getaway" data-bs-parent="#listgroupaccordion">
                        <span class="fs-5">🌦 Season Trips</span>
                        <span><i class='bx bxs-chevron-down'></i></span>
                    </button>
                    <div id="season-nav-mobile" class="accordion-collapse collapse  p-2" data-bs-parent="#listgroupaccordion">
                        <ul class="list-group">
                            <?= seasonNavMobile() ?>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
            <li class="list-group-item">
                <button class="nav-link icon-link collapsed d-flex justify-content-between w-100" type="button" data-bs-toggle="collapse" data-bs-target="#trip-types-nav-mobile" aria-expanded="false" aria-controls="weekend-getaway" data-bs-parent="#listgroupaccordion">
                    <span class="fs-5">📃 Trip Types</span>
                    <span><i class='bx bxs-chevron-down'></i></span>
                </button>
                <div id="trip-types-nav-mobile" class="accordion-collapse collapse  p-2" data-bs-parent="#listgroupaccordion">
                    <?php foreach (($navDataPackageType ?? []) as $item): ?>
                        <a class="list-group-item list-group-item-action" href="/type/<?= urlencode($item) ?>">
                            <?= $item ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </li>
            <li class="list-group-item">
                <button class="nav-link icon-link collapsed d-flex justify-content-between w-100" type="button" data-bs-toggle="collapse" data-bs-target="#International-nav-mobile" aria-expanded="false" aria-controls="weekend-getaway" data-bs-parent="#listgroupaccordion">
                    <span class="fs-5">✈ International Trips</span>
                    <span><i class='bx bxs-chevron-down'></i></span>
                </button>
                <div id="International-nav-mobile" class="accordion-collapse collapse  p-2" data-bs-parent="#listgroupaccordion">
                    <?php foreach (($navDataInternational ?? []) as $item): ?>
                        <?php if ($item != 'India'): ?>
                            <a href="/country/<?= urlencode($item) ?>" class="icon-menu">
                                <div class="icon" style="--iconbg:url('/assets/flags/<?= getCountryCode($item) ?>.svg')">

                                </div>
                                <div>
                                    <p class=""><?= $item ?></p>
                                </div>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </li>

            <li class="list-group-item">
                <button class="nav-link icon-link collapsed d-flex justify-content-between w-100" type="button" data-bs-toggle="collapse" data-bs-target="#more-nav-mobile" aria-expanded="false" aria-controls="weekend-getaway" data-bs-parent="#listgroupaccordion">
                    <span class="fs-5">📱 More</span>
                    <span><i class='bx bxs-chevron-down'></i></span>
                </button>
                <div id="more-nav-mobile" class="accordion-collapse collapse  p-2" data-bs-parent="#listgroupaccordion">
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
                        <a class="list-group-item list-group-item-action" href="/career">
                            Join Our Team
                        </a>

                        <?php if (auth('Admin')): ?>
                            <a class="list-group-item list-group-item-action" href="/dashboard">
                                Admin Dashboard
                            </a>
                            <a class="list-group-item list-group-item-action text-bg-danger" href="/logout">
                                Logout
                            </a>
                        <?php elseif (auth('Employee')): ?>
                            <a class="list-group-item list-group-item-action" href="/employee-dashboard">
                                Employee Dashboard
                            </a>
                            <a class="list-group-item list-group-item-action text-bg-danger" href="/logout">
                                Logout
                            </a>
                        <?php elseif (auth('User')): ?>
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
            </li>
            <li class="list-group-item">
                <button class="nav-link icon-link collapsed d-flex justify-content-between w-100" type="button" data-bs-toggle="collapse" data-bs-target="#Socials-nav-mobile" aria-expanded="false" aria-controls="weekend-getaway" data-bs-parent="#listgroupaccordion">
                    <span class="fs-5">🔔 Social</span>
                    <span><i class='bx bxs-chevron-down'></i></span>
                </button>
                <div id="Socials-nav-mobile" class="accordion-collapse collapse  p-2" data-bs-parent="#listgroupaccordion">
                    <div class="d-flex justify-content-between">
                        <a href="https://www.facebook.com/voyagersBeat/" class="btn fb-bg text-white fs-2"><i class="bx bxl-facebook-circle"></i></a>
                        <a href="https://wa.me/918448591315?text=Hey!%20Voyagers%20Beat%20I%20am%20interested%20in%20your%20trip" class="btn whatsapp-bg fs-2"><i class="bx bxl-whatsapp"></i></a>
                        <a href="https://www.instagram.com/voyagersbeat/" class="btn insta-bg text-white fs-2"><i class="bx bxl-instagram"></i></a>
                        <a href="https://www.youtube.com/@voyagersbeat2534" class="btn youtube-bg text-white fs-2"><i class="bx bxl-youtube"></i></a>
                        <a href="https://www.snapchat.com/add/voyagersbeat" class="btn snapchat-bg text-white fs-2"><i class="bx bxl-snapchat"></i></a>
                        <a href="https://in.linkedin.com/company/voyagers" class="btn linkedin-bg text-white fs-2"><i class="bx bxl-linkedin"></i></a>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <a class="nav-link icon-link d-flex justify-content-between w-100" href="/packages">
                    <span class="fs-5">🧭 All Packages</span>
                    <span><i class='bx bx-link-alt'></i></span>
                </a>
            </li>




        </ul>
    </div>

</div>