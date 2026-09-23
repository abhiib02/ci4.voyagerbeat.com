<div id="users" class="card">
    <div class="card-header">
        <div class="fw-bold">Users</div>
    </div>
    <div class="card-body">
        <table class="table sortable" id="datatable">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>User Contact</th>
                    <th>ROLE</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (($Users ?? []) as $user) { ?>
                    <tr>

                        <td><?= $user->USER_ID ?></td>
                        <td><?= $user->USER_NAME ?></td>
                        <td><?= $user->USER_EMAIL ?></td>
                        <td><?= $user->USER_CONTACT ?></td>
                        <td><?= $user->ROLE ?></td>
                        <td>
                            <button class="btn btn-sm btn-primary" onclick='editUserRole(<?= $user->USER_ID ?>)'><?= ($user->ROLE == 0) ? 'Make Admin' : 'Make Customer'; ?></button>
                            <button onclick="deleteUserconfirm(<?= $user->USER_ID; ?>)" class="btn btn-sm btn-danger mx-1">Delete</button>
                            <form action="<?= ($user->ROLE == 0) ? '/makeAdmin' : '/removeAdmin' ?>" id="editUserRole<?= $user->USER_ID; ?>" method="post">
                                <input type="hidden" name="id" value="<?= $user->USER_ID; ?>">
                            </form>
                            <form action="/delete-user" id="deluser<?= $user->USER_ID; ?>" method="post">
                                <input type="hidden" name="id" value="<?= $user->USER_ID; ?>">
                            </form>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function deleteUserconfirm(id) {
        let form = document.querySelector(`#deluser${id}`);
        if (confirm('Do You Really Want to Delete this User ?')) {
            form.submit();
        }
    }

    function editUserRole(id) {
        let form = document.querySelector(`#editUserRole${id}`);
        if (confirm('Do you really want to change the role of user?')) {
            form.submit();
        }
    }
</script>