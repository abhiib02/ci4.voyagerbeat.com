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

                        <td><?= $employee->user_id ?></td>
                        <td><?= $employee->user_name ?></td>
                        <td><?= $employee->user_email ?></td>
                        <td><?= $employee->user_contact ?></td>
                        <td><?= $employee->status == 1 ? 'Deactivate' : 'Activate' ?></td>
                        <td>
                            <div class="Actions-Dropdown">
                                <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded'></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a type="button" class="dropdown-item" href="/dashboard/all-bookings?employee_id=<?= $employee->user_id ?>">See Bookings</a></li>
                                    <li><a type="button" class="dropdown-item" href="/makeAdmin/<?= $employee->user_id ?>">Make Admin</a></li>
                                    <li><a type="button" class="dropdown-item" href="/revokeAdminAndEmployeeRole/<?= $employee->user_id ?>">Revoke Roles</a></li>
                                    <li><a type="button" class="dropdown-item" href="/toggleStatus/<?= $employee->user_id ?>/<?= $employee->status ?>?empList=1">
                                            <?= $employee->status == 1 ? 'Activate' : 'Deactivate' ?></a></li>

                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>