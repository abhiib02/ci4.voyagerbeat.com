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
        <?= view('dashboard/shared-components/packages-list') ?>
    </div>
</div>