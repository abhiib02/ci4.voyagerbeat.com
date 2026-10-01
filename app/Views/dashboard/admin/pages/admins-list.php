<div id="users" class="card">
    <div class="card-header">
        <div class="fw-bold">Admins</div>
    </div>
    <div class="card-body">
        <table class="table sortable" id="datatable">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Admin Name</th>
                    <th>Admin Email</th>
                    <th>Admin Contact</th>
                    <th>ROLE</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (($Admins ?? []) as $admin) { ?>
                    <tr>

                        <td><?= $admin->USER_ID ?></td>
                        <td><?= $admin->USER_NAME ?></td>
                        <td><?= $admin->USER_EMAIL ?></td>
                        <td><?= $admin->USER_CONTACT ?></td>
                        <td><?= $admin->ROLE ?></td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                                <a type="button" class="btn btn-outline-primary" href="/dashboard/all-bookings?employee_id=<?= $admin->USER_ID ?>">See Bookings</a>
                                <a type="button" class="btn btn-outline-primary" href="/revokeAdminAndEmployeeRole/<?= $admin->USER_ID ?>">Revoke Roles</a>
                                <a type="button" class="btn btn-outline-primary" href="/toggleStatus/<?= $admin->USER_ID ?>/<?= $admin->STATUS ?>?empList=1">
                                    <?= $admin->STATUS == 1 ? 'Deactivate' : 'Activate' ?>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>