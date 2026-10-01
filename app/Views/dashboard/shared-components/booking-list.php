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
            <th>Pay Mode</th>
            <th>Amount Paid</th>
            <th>Total Package Cost</th>
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

                <td><?= $booking->contact ?></td>
                <td>
                    <?php if ($isAdmin): ?>
                        <input type="number" class="form-control form-control-sm" data-field="adults" data-booking-id="<?= $booking->ID; ?>" value="<?= $booking->adults ?>">
                    <?php else: ?>
                        <?= $booking->adults ?>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($booking->pax_details && $booking->pax_details != "{}"): ?>
                        <button class="btn btn-sm  btn-outline-dark" onclick='showTravelers(<?= $booking->pax_details ?>,<?= $booking->ID ?>)'>Show</button>
                        <dialog class="border-1 rounded" id="travelers-dialog-<?= $booking->ID; ?>">
                            <div class="card">
                                <div class="card-header">
                                    <div class="fw-bold"><?= $booking->name ?>'s Travel Buddies</div>
                                </div>
                                <div class="card-body">
                                    <ol class="list-group list-group-numbered" id="output-dialog-<?= $booking->ID; ?>"></ol>
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
                <td class="text-capitalize"><?= $booking->paymode ?></td>
                <td>
                    <?php if ($isAdmin): ?>
                        <input type="number" class="form-control form-control-sm" data-field="amount" data-booking-id="<?= $booking->ID; ?>" value="<?= $booking->amount ?>">
                    <?php else: ?>
                        <?= $booking->amount ?>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($isAdmin): ?>
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


                    <select data-field="status" class="form-select form-select-sm" data-booking-id="<?= esc($booking->ID) ?>" onchange="setPaymentStatusClass()">
                        <?php
                        $statuses = ['Pending', 'Complete', 'Cancel', 'Failed / Unknown'];
                        foreach ($statuses as $status):
                        ?>
                            <option class="<?= statusToClass($status) ?>" value="<?= esc($status) ?>" <?= $booking->status === $status ? 'selected' : '' ?>>
                                <?= esc($status) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                </td>

                <td>
                    <textarea name="note" data-field="note" class="form-control form-control-sm" data-booking-id="<?= $booking->ID; ?>"><?= esc($booking->note) ?></textarea>
                </td>
                <td>
                    <?php if ($isAdmin): ?>
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
                        <button type="button" class="waves-effect  btn btn-sm btn-outline-dark" onclick="openModel('BookingTableDetail<?= $booking->ID; ?>')"><i class='bx bxs-folder-open'></i></button>
                        <?php if (!str_contains($booking->order_id, 'order_') && $booking->customer_access): ?>
                            <button type="button" id="copyLinkBtn" class="waves-effect  btn btn-sm btn-outline-dark" data-link="<?= base_url() ?>booking-confirmation-form/<?= $booking->order_id; ?>" onclick="copyLink()">Copy Link</button>
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
                                            <th>Adhaar Number</th>
                                            <td><?= $booking->adhaar_number ?></td>
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
                                            <td><?= $booking->date ?></td>
                                        </tr>
                                        <tr>
                                            <th>Coupon Used</th>
                                            <td><?= $booking->coupon_used ?></td>
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


                    <?php endforeach; ?>



                    <script>
                        async function copyLink() {
                            const button = document.getElementById('copyLinkBtn');
                            // Get the current page URL (or replace with any link string)
                            const link = button.dataset.link;

                            try {
                                // Copy the text to the clipboard
                                await navigator.clipboard.writeText(link);

                                // Provide temporary visual feedback
                                button.innerText = "Copied!";
                                runToast('Link Copied', 'success');
                                setTimeout(() => {
                                    button.innerText = "Copy Link";
                                }, 3500);
                            } catch (err) {
                                runToast('Failed To Copy Link', 'danger');
                            }
                        }
                    </script>

                    <script>
                        document.querySelectorAll('[data-booking-id][data-field]').forEach(function(el) {
                            el.addEventListener('change', function() {
                                const bookingId = this.dataset.bookingId;
                                const field = this.dataset.field;
                                const value = this.value;

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
                                    .then(res => {
                                        if (!res.ok) throw new Error('Request failed: ' + res.status);
                                        return res.json();
                                    })
                                    .then(data => {

                                        runToast(`Field saved : ${data.field}`, 'Success');
                                    })
                                    .catch(err => {

                                        runToast(`Failed to save field ${err}`, 'danger');
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