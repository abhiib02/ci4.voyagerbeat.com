<div id="packages" class="card">
    <div class="card-header">
        <div class="fw-bold">Packages</div>
    </div>
    <div class="card-body">
        <div>
            <a class="btn btn-sm btn-success" href="/add">Add package</a>
            <a class="btn btn-sm btn-secondary" href="/hidden">Hidden packages</a>
        </div>
        <br>
        <table id="datatable" class="sortable table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>SLUG</th>
                    <th>NAME</th>
                    <th>DESTINATION</th>
                    <th>Last Updated</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Packages as $package) { ?>
                    <tr>
                        <td><a style="text-decoration:underline;color:blue;" target="__blank" href="/package/<?php echo $package->PACKAGE_ID; ?>"><?php echo $package->PACKAGE_ID; ?></a></td>
                        <td><?php echo $package->SLUG; ?></td>
                        <td><?php echo $package->PACKAGE_NAME; ?></td>
                        <td><?php echo $package->LOCATION; ?></td>
                        <td><?php echo $package->updated_at; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>