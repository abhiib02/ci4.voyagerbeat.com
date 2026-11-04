<?php

/**
 * @var array $Packages
 */
?>
<div class="card">
    <div class="card-header">Assign Points</div>
    <div class="card-body">


        <form action="" class="d-flex">
            <div class="">
                <input type="text" list="Packages" class="form-control form-control-sm" placeholder="Filter by package..." name="package" value="<?= isset($_GET['package']) ? esc($_GET['package']) : '' ?>" onchange="this.form.submit()">
                <datalist id="Packages">
                    <?php foreach ($Packages as $package) : ?>
                        <option value="<?= esc($package->PACKAGE_NAME) ?>">
                        <?php endforeach; ?>
                </datalist>
            </div>
            <div class="mx-2">
                <input type="date" class="form-control form-control-sm" name="date" value="<?= isset($_GET['date']) ? esc($_GET['date']) : '' ?>" onchange="this.form.submit()">
            </div>
            <a class="btn btn-sm btn-secondary" href="?notrips=1">Show Customers without Trips</a>
        </form>
        <hr>

        <form action="<?= base_url('giveaway-points-process') ?>" method="post" id="point-giveaway-form"
            data-loader
            data-loader-title="Giving Away Points..."
            data-loader-steps="Validating...|Processing...|Complete">
            <?= csrf_field() ?>
            <div class="modal-body">
                <!-- Points Input -->
                <div class="mb-3">
                    <label for="points" class="form-label font-weight-bold">Points to Giveaway (Max: 1000)</label>
                    <input type="number" class="form-control form-control-sm" name="points" id="points" required placeholder="e.g. 100" max="1000" min="1">
                </div>

                <!-- Select All Checkbox -->
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="selectAllCustomers">
                    <label class="form-check-label text-muted" for="selectAllCustomers">
                        Select All Customers
                    </label>
                </div>

                <!-- Scrollable Customer List Table inside Modal -->
                <div class="table-responsive border rounded">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th style="width: 50px;">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Last Package Booked</th>
                                <th>Last Booking Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($Customers)): ?>
                                <?php foreach ($Customers as $customer): ?>
                                    <tr>
                                        <td class="text-center">
                                            <input class="form-check-input customer-checkbox" type="checkbox" name="customer_ids[]" value="<?= is_object($customer) ? $customer->user_id : $customer['user_id'] ?>">
                                        </td>
                                        <td><?= esc($customer->user_name ?? '') ?></td>
                                        <td><?= esc($customer->user_email ?? '') ?></td>
                                        <td><?= esc($customer->user_contact ?? '-') ?></td>
                                        <td><?= esc($customer->package_name ?? '-') ?></td>
                                        <td><?= esc($customer->last_travel_date ?? '-') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No customers found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </form>
    </div>
    <div class="card-footer d-flex justify-content-end gap-2">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" form="point-giveaway-form" class="btn btn-success">
            Giveaway Points
        </button>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('selectAllCustomers');
        const customerCheckboxes = document.querySelectorAll('.customer-checkbox');

        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                customerCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });
        }
    });
</script>
<script>
    handleShowLoad('hidden', 'remove', true);
</script>