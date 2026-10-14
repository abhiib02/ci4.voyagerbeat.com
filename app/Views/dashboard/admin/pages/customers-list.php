<div id="customers" class="card">
    <div class="card-header">
        <div class="fw-bold">Customers</div>
    </div>
    <div class="card-body">
        <div class="overflow-scroll">
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
                                        <li><a type="button" class="dropdown-item" href="/makeEmployee/<?= $customer->user_id ?>">Make Employee</a></li>
                                        <li><a type="button" class="dropdown-item" href="/toggleStatus/<?= $customer->user_id ?>/<?= $customer->status ?>?empList=1">
                                                <?= $customer->status == 1 ? 'Activate' : 'Deactivate' ?></a></li>
                                        <li><a type="button" class="dropdown-item text-bg-danger" onclick="deleteCustomer()" data-href="/deleteUser/<?= $customer->user_id ?>">Delete User</a></li>

                                    </ul>
                                </div>
                                <dialog id="updatePoints-<?= $customer->user_id ?>" class="">
                                    <div class="card">
                                        <div class="card-header">Update Points</div>
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
        </div>
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