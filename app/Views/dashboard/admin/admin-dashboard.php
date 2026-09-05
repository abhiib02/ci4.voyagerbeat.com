<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <?php
    // This Condition Checks if page name is not exist in directory then show default not error 404
    if (isset($pagename) && in_array($pagename, $pagenames ?? [], true)): ?>
        <?= view('dashboard/admin/pages/' . $pagename) ?>
    <?php else: ?>
        this is admin Dashboard
    <?php endif; ?>
</main>