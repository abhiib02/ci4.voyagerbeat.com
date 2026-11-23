<style>
    .condition-bg {
        background-color: color-mix(in srgb, #F6465D, #2EBD85 calc(var(--days)*1%)) !important;
    }
</style>
<div id="packages" class="card ">
    <div class="card-header">
        <div class="fw-bold">Packages</div>
    </div>
    <div class="card-body">
        <div>
            <a class="btn btn-sm btn-success" href="/dashboard/package-create">Add package</a>
            <a class="btn btn-sm btn-secondary" href="?hidden=1">Show Hidden packages</a>
        </div>
        <br>
        <?= view('dashboard/shared-components/packages-list') ?>
    </div>
</div>