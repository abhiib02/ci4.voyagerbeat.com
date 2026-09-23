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
                        <td>
                            <button class="btn btn-sm " disabled>... Actions Button Will Come Here</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>