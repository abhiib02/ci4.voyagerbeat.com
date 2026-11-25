<?php

/**
 * @var array $Packages
 */
?>
<div class="border rounded">
    <table id="datatable" class="sortable table table-hover" data-order='[[ 5, "desc" ]]'>
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>SLUG</th>
                <th>NAME</th>
                <th>DESTINATION</th>
                <th>Dates</th>
                <th>Custom Dates</th>
                <th>Last Updated</th>
                <th>VISITS</th>
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
                    <?php
                    $datesArr = explode(',', $package->DATES);
                    $lastkey = array_key_last($datesArr);
                    $lastDate = $datesArr[$lastkey] ?? null;
                    ?>
                    <td class="condition-bg" style="--days:<?= isCurrentDateNearRange($lastDate, 1) ?>;"><?= isCurrentDateNearRange($lastDate, 1) ?><?= (is_int(isCurrentDateNearRange($lastDate, 1))) ? ' Days' : '' ?> </td>
                    <td><?= ($package->CUSTOM_TRIP == 1) ? "✅" : "❌" ?></td>
                    <td><?= esc($package->updated_at); ?></td>
                    <td><?= esc($package->VISIT_COUNT); ?></td>
                    <?php if (auth('Admin')): ?>
                        <td><a class="btn btn-sm btn-outline-dark" href="/package-edit/<?= esc($package->PACKAGE_ID); ?>?Adminlist=1" title="Edit"><i class='bx bxs-edit-alt'></i></a></td>
                    <?php else: ?>
                        <td></td>
                    <?php endif; ?>
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