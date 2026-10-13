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
                    <th>Balance Points</th>
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
                        <td><?= $customer->POINTS ?></td>
                        <td><?= $customer->STATUS == 1 ? 'Active' : 'Inactive' ?></td>
                        <td>
                            <div class="Actions-Dropdown">
                                <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded'></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a type="button" class="dropdown-item" href="/dashboard/all-bookings?customer_id=<?= $customer->USER_ID ?>">See Bookings</a></li>
                                    <li><a type="button" class="dropdown-item" onclick="openModel('updatePoints')">Update Points</a></li>
                                    <li><a type="button" class="dropdown-item" href="/makeEmployee/<?= $customer->USER_ID ?>">Make Employee</a></li>
                                    <li><a type="button" class="dropdown-item" href="/toggleStatus/<?= $customer->USER_ID ?>/<?= $customer->STATUS ?>?empList=1">
                                            <?= $customer->STATUS == 1 ? 'Activate' : 'Deactivate' ?></a></li>
                                    <li><a type="button" class="dropdown-item text-bg-danger" onclick="deleteCustomer()" data-href="/deleteUser/<?= $customer->USER_ID ?>">Delete User</a></li>

                                </ul>
                            </div>
                            <dialog id="updatePoints" class="">
                                <div class="card">
                                    <div class="card-header">Update Points</div>
                                    <div class="card-body">
                                        <?= view('dashboard/admin/pages/points-partial/updatePointsForm', ['customer' => $customer]) ?>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between">

                                        <button class=" btn btn-sm btn-dark white-text" type="button" onclick="closeModal('updatePoints');">Close</button>
                                        <button type="submit" form="pointUpdateForm" class="btn btn-sm btn-success white-text"> Update Points</button>

                                    </div>
                                </div>
                            </dialog>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function deleteCustomer() {

        let deleteConfirm = window.confirm('Are You Sure Do you want to Delete This Customer ?');
        if (deleteConfirm) {
            window.location.href = this.event.target.dataset.href;
        }
        return;
    }
</script>