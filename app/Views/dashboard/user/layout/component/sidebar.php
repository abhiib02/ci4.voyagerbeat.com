<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">



    <div class="list-group">
        <div class="list-group-item list-group-item-action d-flex align-items-center justify-content-between" href="#">
            <div>
                <div class="rounded me-2 bgColorTheme grid-center fw-bold fs-5" style="width:32px;height:32px;"><?= substr($name, 0, 1) ?></div>
                <span><strong><?= esc($name) ?></strong></span><br>
                <span><?= esc($email) ?></span>
            </div>
            <a href="/logout" class="btn btn-sm btn-danger fw-bold"><i class='bx bx-log-out'></i></a>
        </div>

        <a href="/account" class="list-group-item list-group-item-action active" aria-current="true">
            account
        </a>
        <?php foreach ($pagenames as $page): ?>
            <a href="/account/<?= $page ?>" class="list-group-item list-group-item-action"><?= $page ?></a>
        <?php endforeach; ?>
    </div>
</div>