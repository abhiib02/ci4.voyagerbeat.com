<div id="users" class="card">
    <div class="card-header">
        <div class="fw-bold">Admins</div>
    </div>
    <div class="card-body">
        <div class="overflow-scroll">
            <table class="table sortable" id="datatable">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Admin Name</th>
                        <th>Admin Email</th>
                        <th>Admin Contact</th>
                        <th>role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (($Admins ?? []) as $admin) { ?>
                        <tr>

                            <td><?= $admin->user_id ?></td>
                            <td><?= $admin->user_name ?></td>
                            <td><?= $admin->user_email ?></td>
                            <td><?= $admin->user_contact ?></td>
                            <td><?= $admin->role ?></td>
                            <td>
                                <div class="Actions-Dropdown">
                                    <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class='bx bx-dots-vertical-rounded'></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a type="button" class="dropdown-item" href="/dashboard/all-bookings?employee_id=<?= $admin->user_id ?>">See Bookings</a></li>
                                        <li><a type="button" class="dropdown-item" href="/makeEmployee/<?= $admin->user_id ?>">Make Employee</a></li>
                                        <li><a type="button" class="dropdown-item" href="/toggleStatus/<?= $admin->user_id ?>/<?= $admin->status ?>?empList=1">
                                                <?= $admin->status == 1 ? 'Activate' : 'Deactivate' ?></a></li>

                                    </ul>
                                </div>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>