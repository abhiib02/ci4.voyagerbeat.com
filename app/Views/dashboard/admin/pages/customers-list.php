<div id="customers" class="card">
    <div class="card-header">
        <div class="fw-bold">Customers</div>
    </div>
    <div class="card-body">
        <table class="table sortable" id="datatable">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Customer Contact</th>
                    <th>Customer Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (($Customers ?? []) as $customer) { ?>
                    <tr>

                        <td><?= $customer->USER_ID ?></td>
                        <td><?= $customer->USER_NAME ?></td>
                        <td><?= $customer->USER_EMAIL ?></td>
                        <td><?= $customer->USER_CONTACT ?></td>
                        <td><?= $customer->STATUS == 1 ? 'Active' : 'Inactive' ?></td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                                <a type="button" class="btn btn-outline-primary" href="/dashboard/all-bookings?customer_id=<?= $customer->USER_ID ?>">See Bookings</a>
                                <a type="button" class="btn btn-outline-primary" href="/makeEmployee/<?= $customer->USER_ID ?>">Make Employee</a>
                                <a type="button" class="btn btn-outline-primary" href="/toggleStatus/<?= $customer->USER_ID ?>/<?= $customer->STATUS ?>?empList=1">
                                    <?= $customer->STATUS == 1 ? 'Deactivate' : 'Activate' ?>
                                </a>
                                <a type="button" class="btn btn-outline-danger" href="/deleteUser/<?= $customer->USER_ID ?>">Delete User</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>