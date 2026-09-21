<style>
    .announcement_bar {
        background: linear-gradient(to right, var(--secondaryColor), var(--maincolor));
        min-height: 100%;
        width: 100%;
        align-items: center;
        padding: 8px;
        margin-top: 8px;
        border-radius: var(--theme-border-radius);
    }
</style>
<?php if ((!empty($AnnouncementLink) && !empty($AnnouncementText)) || ($AnnouncementLink != '0' && $AnnouncementText != '0')): ?>


    <div class="announcement_bar">
        <div class="container d-flex justify-content-center">
            <ul class="navbar-nav d-flex flex-row gap-1">
                <li class="">
                    <a class="btn btn-sm btn-outline-dark rounded-5 animated-promo-btn" href="<?= esc($AnnouncementLink) ?>"><?= esc($AnnouncementText) ?></a>
                </li>

            </ul>


        </div>
    </div>
<?php endif; ?>