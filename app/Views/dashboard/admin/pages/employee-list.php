<div id="customers" class="card">
    <div class="card-header">
        <div class="fw-bold">Employees</div>
    </div>
    <div class="card-body">
        <table class="table sortable" id="datatable">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Employee Name</th>
                    <th>Employee Email</th>
                    <th>Employee Contact</th>
                    <th>Employee Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (($Employees ?? []) as $employee) { ?>
                    <tr>

                        <td><?= $employee->USER_ID ?></td>
                        <td><?= $employee->USER_NAME ?></td>
                        <td><?= $employee->USER_EMAIL ?></td>
                        <td><?= $employee->USER_CONTACT ?></td>
                        <td><?= $employee->STATUS == 1 ? 'Deactivate' : 'Activate' ?></td>
                        <td>
                            <div class="Actions-Dropdown">
                                <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded'></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a type="button" class="dropdown-item" href="/dashboard/all-bookings?employee_id=<?= $employee->USER_ID ?>">See Bookings</a></li>
                                    <li><a type="button" class="dropdown-item" href="/makeAdmin/<?= $employee->USER_ID ?>">Make Admin</a></li>
                                    <li><a type="button" class="dropdown-item" href="/revokeAdminAndEmployeeRole/<?= $employee->USER_ID ?>">Revoke Roles</a></li>
                                    <li><a type="button" class="dropdown-item" href="/toggleStatus/<?= $employee->USER_ID ?>/<?= $employee->STATUS ?>?empList=1">
                                            <?= $employee->STATUS == 1 ? 'Activate' : 'Deactivate' ?></a></li>

                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>