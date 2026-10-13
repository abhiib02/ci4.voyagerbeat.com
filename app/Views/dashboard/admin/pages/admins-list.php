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
                            <div class="Actions-Dropdown">
                                <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded'></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a type="button" class="dropdown-item" href="/dashboard/all-bookings?employee_id=<?= $admin->USER_ID ?>">See Bookings</a></li>
                                    <li><a type="button" class="dropdown-item" href="/makeEmployee/<?= $admin->USER_ID ?>">Make Employee</a></li>
                                    <li><a type="button" class="dropdown-item" href="/toggleStatus/<?= $admin->USER_ID ?>/<?= $admin->STATUS ?>?empList=1">
                                            <?= $admin->STATUS == 1 ? 'Activate' : 'Deactivate' ?></a></li>

                                </ul>
                            </div>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>