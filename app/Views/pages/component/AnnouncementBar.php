<?php

/**
 * @var string $defaultContact
 * @var string $defaultmails
 */
?>
<style>
    .announcement_bar {
        background: linear-gradient(to right, var(--secondaryColor), var(--maincolor));
        min-height: 100%;
        width: 100vw;
        align-items: center;
        padding: 8px;
    }
</style>
<?php if (!empty($AnnouncementLink) && !empty($AnnouncementText)): ?>


    <div class="announcement_bar hide-on-mobile">
        <div class="container d-flex justify-content-between">

            <ul class="navbar-nav d-flex flex-row gap-1">
                <li class="">
                    <a class="btn btn-sm btn-outline-dark rounded-5" aria-label="contact" href="tel:+91<?= $defaultContact ?>"><i class='bx bxs-phone-call'></i> <?= $defaultContact ?></a>
                </li>
                <li class="">
                    <a class="btn btn-sm btn-outline-dark rounded-5" aria-label="open mail" href="mail:<?= $defaultmails ?>"><i class='bx bxs-envelope'></i> <?= $defaultmails ?></a>
                </li>
                <li class="">
                    <a class="btn btn-sm btn-outline-dark rounded-5" aria-label="open instagram" href="https://www.instagram.com/voyagersbeat/"><i class='bx bxl-instagram-alt'></i> @voyagersbeat</a>
                </li>
            </ul>

            <ul class="navbar-nav d-flex flex-row gap-1">
                <li class="">
                    <a class="btn btn-sm btn-outline-dark rounded-5 animated-promo-btn" aria-label="<?= esc($AnnouncementText) ?>" href="<?= esc($AnnouncementLink) ?>"><?= esc($AnnouncementText) ?></a>
                </li>
                <li class="">
                    <a class="btn btn-sm btn-outline-dark rounded-5" aria-label="contact" href="tel:+91<?= $defaultContact ?>"><i class='bx bxs-phone-call'></i> Call Now</a>
                </li>
            </ul>


        </div>
    </div>
<?php endif; ?>