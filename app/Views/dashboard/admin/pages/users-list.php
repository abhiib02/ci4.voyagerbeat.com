<?php

/**
 * @var array $Customers
 * @var array $Employees
 * @var array $Managers
 * @var array $Admins
 */
?>
<?php
$roles = ['Customers', 'Employees', 'Managers', 'Admins'];
$rolesEmojis = ['🧳', '🧑‍💼', '👔', '👑'];
?>
<div id="Users-list" class="card">
    <div class="card-header">
        <div class="fw-bold">Users</div>
    </div>
    <div class="card-body">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <?php foreach ($roles as $index => $role): ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?= ($index == 0) ? 'active' : '' ?>" id="<?= $role ?>-tab" data-bs-toggle="tab" data-bs-target="#<?= $role ?>-tab-pane" type="button" role="tab"><span class="fs-3"><?= $rolesEmojis[$index] ?></span><br><?= $role ?> | <span class="badge rounded-pill text-bg-primary"><?= count($$role) ?></span></button>
                </li>
            <?php endforeach; ?>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="Customers-tab-pane" role="tabpanel" tabindex="0">
                <section id="Customer-list">
                    <table class="table sortable table-hover" id="datatable">
                        <thead class="table-light">
                            <tr>
                                <th>User ID</th>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Customer Contact</th>
                                <th>Balance Points</th>
                                <th>Customer Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (($Customers ?? []) as $customer) { ?>
                                <tr>

                                    <td><?= $customer->user_id ?></td>
                                    <td><?= $customer->user_name ?></td>
                                    <td><?= $customer->user_email ?></td>
                                    <td><?= $customer->user_contact ?></td>
                                    <td><?= $customer->POINTS ?></td>
                                    <td><?= $customer->status == 1 ? 'Active' : 'Inactive' ?></td>
                                    <td>
                                        <div class="Actions-Dropdown">
                                            <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class='bx bx-dots-vertical-rounded'></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a type="button" class="dropdown-item" href="/dashboard/all-bookings?customer_id=<?= $customer->user_id ?>">See Bookings</a></li>
                                                <li><a type="button" class="dropdown-item" onclick="openModel('updatePoints-<?= $customer->user_id ?>')">Update Points</a></li>

                                                <li><a type="button" class="dropdown-item" href="/toggleStatus/<?= $customer->user_id ?>/<?= $customer->status ?>?empList=1">
                                                        <?= $customer->status == 1 ? 'Deactivate' : 'Activate' ?></a></li>
                                                <li><a type="button" class="dropdown-item text-bg-danger" onclick="deleteCustomer()" data-href="/deleteUser/<?= $customer->user_id ?>">Delete User</a></li>

                                            </ul>
                                        </div>
                                        <dialog id="makeEmployeedialog-<?= $customer->user_id ?>" class="">
                                            <div class="card">
                                                <div class="card-header d-flex justify-content-between">
                                                    <div class=" align-content-center">Make Employee</div>
                                                    <div>
                                                        <button class="btn btn-sm btn-outline-dark" onclick="document.querySelector('#makeEmployeedialog-<?= $customer->user_id ?>').close();"><i class='bx bx-x'></i></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <form action="/makeEmployee" id="makeEmployeeform-<?= $customer->user_id ?>" method="post">
                                                        <input type="hidden" name="id" value="<?= $customer->user_id ?>" required>
                                                        <div class="mb-3">
                                                            <label for="confirmation-text" class="form-label">To Confirm, Type "<?= $customer->user_name ?>" in the box Below</label>
                                                            <input type="text" class="form-control" name="name" id="confirmation-text">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="card-footer d-flex justify-content-between">

                                                    <button class=" btn btn-sm btn-dark white-text" type="button" onclick="closeModal('makeEmployeedialog-<?= $customer->user_id ?>');">Close</button>
                                                    <button type="submit" form="makeEmployeeform-<?= $customer->user_id ?>" class="btn btn-sm btn-success white-text"> Make Employee</button>

                                                </div>
                                            </div>
                                        </dialog>
                                        <dialog id="updatePoints-<?= $customer->user_id ?>" class="">
                                            <div class="card">

                                                <div class="card-header d-flex justify-content-between">
                                                    <div class=" align-content-center">Update Points</div>
                                                    <div>
                                                        <button class="btn btn-sm btn-outline-dark" onclick="document.querySelector('#updatePoints-<?= $customer->user_id ?>').close();"><i class='bx bx-x'></i></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <?= view('dashboard/admin/pages/points-partial/updatePointsForm', ['customer' => $customer]) ?>
                                                </div>
                                                <div class="card-footer d-flex justify-content-between">

                                                    <button class=" btn btn-sm btn-dark white-text" type="button" onclick="closeModal('updatePoints-<?= $customer->user_id ?>');">Close</button>
                                                    <button type="submit" form="pointUpdateForm-<?= $customer->user_id ?>" class="btn btn-sm btn-success white-text"> Update Points</button>

                                                </div>
                                            </div>
                                        </dialog>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <script>
                        function deleteCustomer() {

                            let deleteConfirm = window.confirm('Are You Sure Do you want to Delete This Customer ?');
                            if (deleteConfirm) {
                                window.location.href = this.event.target.dataset.href;
                            }
                            return;
                        }
                    </script>
                </section>
            </div>
            <div class="tab-pane fade" id="Employees-tab-pane" role="tabpanel" tabindex="0">
                <section id="Employee-list">
                    <table class="table sortable" id="datatable">
                        <thead class="table-light">
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
                                    <td><?= $employee->status == 1 ? 'Activate' : 'Deactivate' ?></td>
                                    <td>
                                        <div class="Actions-Dropdown">
                                            <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class='bx bx-dots-vertical-rounded'></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a type="button" class="dropdown-item" href="/dashboard/all-bookings?employee_id=<?= $employee->user_id ?>">See Bookings</a></li>
                                                <li><a type="button" class="dropdown-item" href="/revokeAdminAndEmployeeRole/<?= $employee->user_id ?>">Revoke Roles</a></li>
                                                <li><a type="button" class="dropdown-item" onclick="openchangePasswordDialog(<?= $employee->user_id ?>)">Change password</a></li>
                                                <li><a type="button" class="dropdown-item" href="/toggleStatus/<?= $employee->user_id ?>/<?= $employee->status ?>?empList=1">
                                                        <?= $employee->status == 1 ? 'Deactivate' : 'Activate' ?></a></li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </section>
            </div>
            <div class="tab-pane fade" id="Managers-tab-pane" role="tabpanel" tabindex="0">
                <section id="Managers-list">
                    <table class="table sortable" id="datatable">
                        <thead class="table-light">
                            <tr>
                                <th>User ID</th>
                                <th>Manager Name</th>
                                <th>Manager Email</th>
                                <th>Manager Contact</th>
                                <th>Manager Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (($Managers ?? []) as $manager) { ?>
                                <tr>

                                    <td><?= $manager->user_id ?></td>
                                    <td><?= $manager->user_name ?></td>
                                    <td><?= $manager->user_email ?></td>
                                    <td><?= $manager->user_contact ?></td>
                                    <td><?= $manager->status == 1 ? 'Activate' : 'Deactivate' ?></td>
                                    <td>
                                        <div class="Actions-Dropdown">
                                            <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class='bx bx-dots-vertical-rounded'></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a type="button" class="dropdown-item" href="/dashboard/all-bookings?employee_id=<?= $manager->user_id ?>">See Bookings</a></li>
                                                <li><a type="button" class="dropdown-item" href="/revokeAdminAndEmployeeRole/<?= $manager->user_id ?>">Revoke Roles</a></li>
                                                <li><a type="button" class="dropdown-item" onclick="openchangePasswordDialog(<?= $manager->user_id ?>)">Change password</a></li>
                                                <li><a type="button" class="dropdown-item" href="/toggleStatus/<?= $manager->user_id ?>/<?= $manager->status ?>?empList=1">
                                                        <?= $manager->status == 1 ? 'Deactivate' : 'Activate' ?></a></li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </section>
            </div>
            <div class="tab-pane fade" id="Admins-tab-pane" role="tabpanel" tabindex="0">
                <section id="Admins-list">
                    <table class="table sortable" id="datatable">
                        <thead class="table-light">
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
                                                <form action="/makeEmployee" method="post" id="makeEmployeeForm-<?= $admin->user_id ?>">
                                                    <input type="hidden" name="id" value="<?= $admin->user_id ?>" required>
                                                    <input type="hidden" name="name" value="<?= $admin->user_name ?>" required>
                                                </form>
                                                <li><a type="button" class="dropdown-item" onclick="openchangePasswordDialog(<?= $admin->user_id ?>)">Change password</a></li>

                                                <li><a type="button" class="dropdown-item" href="/toggleStatus/<?= $admin->user_id ?>/<?= $admin->status ?>?empList=1">
                                                        <?= $admin->status == 1 ? 'Deactivate' : 'Activate' ?></a></li>

                                            </ul>
                                        </div>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>
</div>
</div>
<dialog id="passwordChange">
    <div class="card">

        <div class="card-header d-flex justify-content-between">
            <div class=" align-content-center">Set New Password</div>
            <div>
                <button class="btn btn-sm btn-outline-dark" onclick="document.querySelector('#passwordChange').close();"><i class='bx bx-x'></i></button>
            </div>
        </div>
        <div class="card-body">
            <form action="/change-password" method="post" id="passwordChangeForm">
                <label for="">User ID</label>
                <input type="text" class="form-control" name="user_id" id="passwordChange-user_id" readonly required>
                <label for="">New Password</label>
                <input type="text" class="form-control" name="password" id="" required>
            </form>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <button onclick="closeModal('passwordChange')" class="btn btn-sm btn-outline-dark"><i class='bx bx-x'></i></button>
            <button type="submit" class="btn btn-sm btn-success" form="passwordChangeForm">Change Password</button>
        </div>
    </div>

</dialog>
<script>
    function openchangePasswordDialog(id) {
        const dialog = document.getElementById('passwordChange');
        document.getElementById('passwordChange-user_id').value = id;
        dialog.showModal();
    }
</script>