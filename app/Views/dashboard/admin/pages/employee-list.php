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
                        <td>
                            <button class="btn btn-sm " disabled>... Actions Button Will Come Here</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>