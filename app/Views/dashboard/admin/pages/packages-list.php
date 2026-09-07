<div id="packages" class="card">
    <div class="card-header">
        <div class="fw-bold">Packages</div>
    </div>
    <div class="card-body">
        <div>
            <a class="btn btn-sm btn-success" href="/dashboard/package-create">Add package</a>
            <a class="btn btn-sm btn-secondary" href="/hidden">Hidden packages</a>
        </div>
        <br>
        <table id="" class="sortable table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>SLUG</th>
                    <th>NAME</th>
                    <th>DESTINATION</th>
                    <th>Last Updated</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Packages as $package) { ?>
                    <tr>
                        <td><a class="btn btn-sm btn-outline-dark" target="__blank" href="/packageid/<?= esc($package->PACKAGE_ID); ?>"><?= esc($package->PACKAGE_ID); ?></a></td>
                        <td><?= esc($package->SLUG); ?></td>
                        <td><?= esc($package->PACKAGE_NAME); ?></td>
                        <td><?= esc($package->LOCATION); ?></td>
                        <td><?= esc($package->updated_at); ?></td>
                        <td><a class="btn btn-sm btn-outline-dark" href="/package-edit/<?= esc($package->PACKAGE_ID); ?>?Adminlist=1" title="Edit"><i class='bx bxs-edit-alt'></i></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- Pagination Links -->
        <div class="pagination">
            <?= $pager->links() ?>
        </div>
    </div>
</div>