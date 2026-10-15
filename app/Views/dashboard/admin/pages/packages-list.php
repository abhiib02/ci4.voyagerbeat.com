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
            <a class="btn btn-sm btn-secondary" href="/hidden">Hidden packages</a>
        </div>
        <br>
        <div class="">
            <table id="datatable" class="sortable table" data-order='[[ 5, "desc" ]]'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>SLUG</th>
                        <th>NAME</th>
                        <th>DESTINATION</th>
                        <th>Dates</th>
                        <th>Last Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (($Packages ?? []) as $package) { ?>
                        <tr>
                            <td><a class="btn btn-sm btn-outline-dark" target="__blank" href="/packageid/<?= esc($package->PACKAGE_ID); ?>"><?= esc($package->PACKAGE_ID); ?></a></td>
                            <td><?= esc($package->SLUG); ?></td>
                            <td><?= esc($package->PACKAGE_NAME); ?></td>
                            <td><?= esc($package->LOCATION); ?></td>
                            <?php $lastDate = explode(',', $package->DATES)[0]; ?>
                            <td class="condition-bg" style="--days:<?= isCurrentDateNearRange($lastDate, 1) ?>;"><?= isCurrentDateNearRange($lastDate, 1) ?> Days</td>
                            <td><?= esc($package->updated_at); ?></td>
                            <td><a class="btn btn-sm btn-outline-dark" href="/package-edit/<?= esc($package->PACKAGE_ID); ?>?Adminlist=1" title="Edit"><i class='bx bxs-edit-alt'></i></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- Pagination Links -->
        <?php if (!empty($pager)): ?>
            <div class="pagination">
                <?= $pager->links() ?>
            </div>
        <?php endif; ?>
    </div>
</div>