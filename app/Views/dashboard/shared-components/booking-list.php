<?php

/**
 * @var int $remainingAmount
 * @var array $Bookings
 */
?>
<div class="d-flex justify-content-between">
    <div>
        <?= view('dashboard/shared-components/custom-from-to-date-selector') ?>
    </div>
</div>
<table class="sortable table hover" id="datatable" data-order='[[ 0, "desc" ]]'>
    <thead>
        <tr>
            <!-- <th>ID</th> -->
            <!-- <th>Order ID</th> -->
            <th>Booking Date</th>
            <th>Agent</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Adults</th>
            <th>Pax Details</th>
            <th>Amount Paid</th>
            <th>Total Cost</th>
            <th>Remaining</th>
            <th>Payment Status</th>
            <th>Note</th>
            <th>Customer Filled Form</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php


        foreach (($Bookings ?? []) as $booking) : ?>

            <tr>
                <!-- <td><?= $booking->ID ?></td> -->
                <!-- <td><?= substr($booking->order_id, 0, 20) ?></td> -->
                <td><?= $booking->created_at ?></td>
                <td><?= $booking->agent_name ?></td>
                <td><?= $booking->name ?></td>

                <td><?php if (auth('Admin', 'Manager')): ?>
                        <input type="number" class="form-control form-control-sm" data-field="contact" data-booking-id="<?= $booking->ID; ?>" value="<?= $booking->contact ?>">
                    <?php else: ?>
                        <?= $booking->contact ?>
                    <?php endif; ?>

                </td>
                <td>
                    <?= $booking->adults ?>
                </td>
                <td>
                    <?php if ($booking->pax_details && $booking->pax_details != "{}"): ?>
                        <button class="btn btn-sm btn-outline-dark" data-booking-id="<?= $booking->ID ?>" data-travelers="<?= esc($booking->pax_details, 'attr') ?>" onclick="showTravelersModel()">Show</button>
                        <dialog class="border-1 rounded" id="travelers-dialog-<?= $booking->ID; ?>">
                            <div class="card">
                                <div class="card-header">
                                    <div class="fw-bold"><?= $booking->name ?>'s Travel Buddies</div>
                                </div>
                                <div class="card-body">
                                    <ol class="row" style="width: 80vw;list-style-type: none;" id="output-dialog-<?= $booking->ID; ?>"></ol>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-sm btn-outline-dark" onclick="document.querySelector('#travelers-dialog-<?= $booking->ID ?>').close();">Close</button>
                                </div>
                            </div>
                        </dialog>
                    <?php else: ?>
                        No details available
                    <?php endif; ?>

                </td>
                <td>
                    <?php if (auth('Admin')): ?>
                        <input type="number" class="form-control form-control-sm" data-field="amount" data-booking-id="<?= $booking->ID; ?>" value="<?= $booking->amount ?>">
                    <?php else: ?>
                        <?= $booking->amount ?>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if (auth('Admin')): ?>
                        <input type="number" class="form-control form-control-sm" data-field="total_package_cost" data-booking-id="<?= $booking->ID; ?>" value="<?= $booking->total_package_cost ?>" <?= ($booking->status != 'Pending') ? 'readonly' : ''; ?>>
                    <?php else: ?>
                        <?= $booking->total_package_cost ?>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($booking->status == 'Pending'): ?>
                        <?php
                        $remainingAmount = $booking->total_package_cost - $booking->amount;
                        if ($remainingAmount >= 0): ?>
                            <?= $remainingAmount ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </td>
                <td>

                    <?php if (auth('Admin', 'Manager')): ?>
                        <select data-tpc="<?= esc($booking->total_package_cost) ?>" data-user-id="<?= esc($booking->user_id) ?>" data-field="status" data-status="<?= esc($booking->status) ?>" class="form-select form-select-sm" data-booking-id="<?= esc($booking->ID) ?>" onclick="showStatusWarnings()" onchange="setPaymentStatusClass()">
                            <?php
                            $statuses = ['Pending', 'Complete', 'Complete_no_points', 'Cancel', 'Postponed', 'Failed'];
                            foreach ($statuses as $status):
                            ?>
                                <option class="<?= statusToClass($status) ?>" value="<?= esc($status) ?>" <?= $booking->status === $status ? 'selected' : '' ?>>
                                    <?= esc($status) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    <?php else: ?>
                        <?php if ($booking->status != 'Complete'): ?>
                            <select data-tpc="<?= esc($booking->total_package_cost) ?>" data-user-id="<?= esc($booking->user_id) ?>" data-field="status" data-status="<?= esc($booking->status) ?>" class="form-select form-select-sm" data-booking-id="<?= esc($booking->ID) ?>" onchange="setPaymentStatusClass()">
                                <?php
                                $statuses = ['Pending', 'Complete', 'Complete_no_points', 'Cancel', 'Postponed', 'Failed'];
                                foreach ($statuses as $status):
                                ?>
                                    <option class="<?= statusToClass($status) ?>" value="<?= esc($status) ?>" <?= $booking->status === $status ? 'selected' : '' ?>>
                                        <?= esc($status) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        <?php else: ?>
                            <span class="badge text-bg-success"><?= $booking->status ?></span>
                        <?php endif; ?>
                    <?php endif; ?>

                </td>

                <td>
                    <textarea name="note" data-field="note" class="form-control form-control-sm" data-booking-id="<?= $booking->ID; ?>"><?= esc($booking->note) ?></textarea>
                </td>
                <td>
                    <?php if (auth('Admin')): ?>
                        <select data-field="customer_access" class="form-select form-select-sm" data-booking-id="<?= esc($booking->ID) ?>">
                            <option class="" value="<?= esc($booking->customer_access) ?>"><?= (esc($booking->customer_access)) ? 'No ⏳' : 'Yes ✅'; ?></option>
                            <option class="" value="1">No ⏳</option>
                            <option class="" value="0">Yes ✅</option>
                        </select>
                    <?php else: ?>
                        <?= (esc($booking->customer_access)) ? 'No ⏳' : 'Yes ✅'; ?>
                    <?php endif; ?>

                </td>
                <td>
                    <div class="d-flex gap-1">

                        <button type="button" class=" btn btn-sm btn-outline-dark" onclick="openModel('BookingTableDetail<?= $booking->ID; ?>')"><i class='bx bxs-folder-open'></i></button>
                        <div class="">

                            <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-dots-vertical-rounded'></i>
                            </button>

                            <ul class="dropdown-menu">
                                <?php if (auth('Admin')): ?>
                                    <li><a class="dropdown-item" onclick="openModel('updatePoints-<?= $booking->user_id ?>')"> <i class='bx bx-plus-circle'></i> Update Points</a></li>
                                <?php endif; ?>
                                <?php if (auth('Admin', 'Manager', 'Employee')): ?>
                                    <?php if ($booking->customer_access): ?>
                                        <li><button form="deleteBookingform<?= $booking->ID ?>" type="submit" class="dropdown-item text-danger"><i class='bx bx-trash'></i> Delete Booking</button>
                                            <form id="deleteBookingform<?= $booking->ID ?>" action="/deleteBooking" method="post" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                                <input type="hidden" name="booking_id" value="<?= $booking->ID ?>">
                                            </form>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </ul>

                        </div>
                        <?php if (!str_contains($booking->order_id, 'order_') && $booking->customer_access): ?>
                            <button type="button" id="copyLinkBtn" class=" btn btn-sm btn-outline-dark" data-link="<?= base_url() ?>booking-confirmation-form/<?= $booking->order_id; ?>" onclick="copyLink()">Copy_Link</button>
                        <?php endif; ?>
                    </div>
                    <dialog id="BookingTableDetail<?= $booking->ID ?>">


                        <div class="card">
                            <div class="card-header">
                                Booking Details
                            </div>
                            <div class="card-body">

                                <div class="d-flex">
                                    <table class="table">
                                        <tr>
                                            <th>Order ID</th>
                                            <td><?= $booking->order_id ?></td>
                                        </tr>
                                        <tr>
                                            <th>User ID</th>
                                            <td><?= $booking->user_id ?></td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td><?= $booking->name ?> | <?= $booking->gender ?></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td><?= $booking->email ?></td>
                                        </tr>
                                        <tr>
                                            <th>Contact</th>
                                            <td><?= $booking->contact ?></td>
                                        </tr>
                                        <tr>
                                            <th>Booked Package</th>
                                            <td><a href="/packageid/<?= $booking->package_id; ?>"><?= $booking->package_id ?> | <?= $booking->package_name ?></a></td>
                                        </tr>
                                        <tr>
                                            <th>Adults</th>
                                            <td><?= $booking->adults ?></td>
                                        </tr>
                                        <tr>
                                            <th>Batch Date</th>
                                            <td>
                                                <?php if ($booking->status == 'Postponed'): ?>
                                                    <select name="date"
                                                        data-field="date"
                                                        class="form-select form-control-sm"
                                                        data-booking-id="<?= $booking->ID; ?>"
                                                        onclick="getPackageDates(<?= $booking->package_id; ?>, this)">

                                                        <option value="<?= $booking->date ?>" selected><?= $booking->date ?></option>
                                                        <option value="" disabled>Loading....</option>

                                                    </select>

                                                <?php else: ?>
                                                    <?= $booking->date ?>
                                                <?php endif; ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Coupon Used</th>
                                            <td><?= $booking->coupon_used ?></td>
                                        </tr>
                                        <tr>
                                            <th>Points Used</th>
                                            <td><?= $booking->points_used ?></td>
                                        </tr>
                                        <tr>
                                            <th>Travel Mode / Boarding </th>
                                            <td><?= $booking->travelmode ?></td>
                                        </tr>
                                        <tr>
                                            <th>Paymode</th>
                                            <td><?= $booking->paymode ?></td>
                                        </tr>
                                        <tr>
                                            <th>Customer Access</th>
                                            <td><?= ($booking->customer_access) ? 'Yes' : 'No' ?></td>
                                        </tr>
                                        <tr>
                                            <th>Remaining Amount</th>

                                            <td><?php
                                                $remainingAmount = $booking->total_package_cost - $booking->amount; ?>
                                                <?php if (($remainingAmount) == 0): ?>
                                                    Full Payment Done
                                                <?php elseif (($remainingAmount) < 0): ?>
                                                    Total Amount will be provided While Boarding
                                                <?php else: ?>
                                                    ₹<?= number_format($remainingAmount, 2) ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Booking Link Generated</th>
                                            <th>Booking Last Updated</th>
                                        </tr>
                                        <tr>
                                            <td><?= $booking->created_at ?></td>
                                            <td><?= $booking->updated_at ?></td>
                                        </tr>

                                    </table>
                                    <?php if (!empty($booking->pay_screenshot)): ?>
                                        <div>
                                            <label for=""><b>Payment Screenshot</b></label>
                                            <img style="width:300px;height:fit-content;" src="/upload/bookings/payment_screenshot/<?= esc($booking->pay_screenshot) ?>" alt="">
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button class="btn btn-sm btn-outline-dark" onclick="document.querySelector('#BookingTableDetail<?= $booking->ID; ?>').close();">Close</button>
                            </div>
                        </div>
                    </dialog>
                    <dialog id="updatePoints-<?= $booking->user_id ?>" class="">
                        <div class="card">
                            <div class="card-header">Update Points</div>
                            <div class="card-body">
                                <?= view('dashboard/admin/pages/points-partial/updatePointsForm', ['customer' => $booking]) ?>
                            </div>
                            <div class="card-footer d-flex justify-content-between">

                                <button class=" btn btn-sm btn-dark white-text" type="button" onclick="closeModal('updatePoints-<?= $booking->user_id ?>');">Close</button>
                                <button type="submit" form="pointUpdateForm" class="btn btn-sm btn-success white-text"> Update Points</button>

                            </div>
                        </div>
                    </dialog>
                <?php endforeach; ?>


                <script>
                    async function getPackageDates(packageId, selectElement) {
                        // Prevent re-fetching if options have already been populated
                        if (selectElement.dataset.loaded === 'true') return;

                        try {
                            const response = await fetch(`/api/packageDatesJSON/${packageId}`, {
                                method: 'GET',
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'Content-Type': 'application/json'
                                }
                            });

                            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

                            const data = await response.json();

                            if (!data || !data.DATES) return;

                            // Save the currently selected option value
                            const currentValue = selectElement.value;

                            // Split data by comma into individual date range entries
                            const dateEntries = data.DATES.split(',');

                            // Build document fragment to insert options efficiently
                            const fragment = document.createDocumentFragment();

                            dateEntries.forEach(entry => {
                                // Split entry by pipe '|' to isolate date range and cost modifier
                                const [dateRange, cost] = entry.split('|');

                                if (!dateRange) return;

                                const trimmedDate = dateRange.trim();

                                // Avoid duplicating the already existing selected option
                                if (trimmedDate === currentValue) return;

                                const option = document.createElement('option');
                                option.value = trimmedDate;

                                // Format option label to highlight extra package cost if non-zero
                                const extraCost = parseInt(cost, 10);
                                option.textContent = extraCost > 0 ?
                                    `${trimmedDate} (+₹${extraCost})` :
                                    trimmedDate;

                                fragment.appendChild(option);
                            });

                            selectElement.querySelector('option[disabled]').remove();
                            // Append newly formatted options to the select dropdown
                            selectElement.appendChild(fragment);

                            // Mark as loaded so subsequent clicks don't re-trigger fetch
                            selectElement.dataset.loaded = 'true';

                        } catch (error) {
                            console.error('Error loading package dates:', error);
                        }
                    }
                </script>
                <script>
                    async function copyLink() {

                        // Get the current page URL (or replace with any link string)
                        const button = this.event.target;
                        const link = this.event.target.dataset.link;

                        try {
                            // Copy the text to the clipboard
                            await navigator.clipboard.writeText(link);

                            // Provide temporary visual feedback
                            button.innerText = "Copied!";
                            runToast('Link Copied', 'success');
                            setTimeout(() => {
                                button.innerText = "Copy_Link";
                            }, 3500);
                        } catch (err) {
                            runToast(`Failed To Copy Link due to ${err}`, 'danger');
                        }
                    }
                </script>

                <script>
                    document.querySelectorAll('[data-booking-id][data-field]').forEach(function(el) {
                        el.addEventListener('change', function() {
                            const bookingId = this.dataset.bookingId;
                            const field = this.dataset.field;
                            const value = this.value;
                            const userId = parseInt(this.dataset.userId);
                            const totalPackageCost = parseInt(this.dataset.tpc);

                            fetch(`/bookings-patch/${bookingId}`, {
                                    method: 'PATCH',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        '<?= csrf_header() ?>': '<?= csrf_hash() ?>'
                                    },
                                    body: JSON.stringify({
                                        field: field,
                                        value: value
                                    })
                                })
                                .then(async res => {
                                    const contentType = res.headers.get('content-type');
                                    if (!contentType || !contentType.includes('application/json')) {
                                        const text = await res.text();
                                        console.error('PATCH request returned non-JSON:', text);
                                        throw new Error(`PATCH server error (${res.status}). Check browser console.`);
                                    }
                                    if (!res.ok) throw new Error('PATCH request failed: ' + res.status);
                                    return res.json();
                                })
                                .then(data => {
                                    runToast(`Field saved : ${data.field}`, 'Success');

                                    // Trigger loyalty points GET request after successful update
                                    if (field === 'status' && value === 'Complete') {
                                        if (isNaN(userId) || isNaN(totalPackageCost)) {
                                            throw new Error(`Invalid parameters: userId (${this.dataset.userId}) or tpc (${this.dataset.tpc}) is missing or not a number.`);
                                        }

                                        return fetch(`/points/${userId}/${totalPackageCost}`)
                                            .then(async res => {
                                                const contentType = res.headers.get('content-type');
                                                if (!contentType || !contentType.includes('application/json')) {
                                                    const text = await res.text();
                                                    console.error('GET points request returned non-JSON:', text);
                                                    throw new Error(`Points route error (${res.status}). Check browser console.`);
                                                }
                                                if (!res.ok) throw new Error('GET points request failed: ' + res.status);
                                                return res.json();
                                            })
                                            .then(getData => {
                                                runToast(`Loyalty Points Added`, 'Success');
                                                window.location.reload();
                                            });
                                    }
                                    window.location.reload();
                                })
                                .catch(err => {
                                    console.error(err);
                                    runToast(`Failed: ${err.message || err}`, 'danger');
                                });
                        });
                    });
                </script>

                <script>
                    document.addEventListener('DOMContentLoaded', (event) => {
                        setInitPaymentStatusClass();
                    })

                    function setInitPaymentStatusClass() {
                        let selects = document.querySelectorAll('[data-field="status"]');
                        selects.forEach((select) => {
                            select.classList.add('status-' + select.value.toLowerCase());
                        })
                    }

                    function setPaymentStatusClass() {
                        [...this.event.target.classList].forEach(className => {
                            if (className.includes('status-')) {
                                this.event.target.classList.remove(className);
                            }
                        });

                        this.event.target.classList.add('status-' + this.event.target.value.toLowerCase());
                    }
                </script>