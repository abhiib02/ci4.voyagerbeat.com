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
                            <button class="btn btn-sm " disabled>... Actions Button Will Come Here</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>