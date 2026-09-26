<div id="bookings" class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fw-bold">Bookings</div>
            <button class="fw-bold btn btn-success" onclick="openModel('create-booking')">Create Booking</button>
            <?= view('dashboard/shared-components/create-booking-form') ?>
        </div>

    </div>
    <div class="card-body">
        <table class="sortable table hover" id="datatable" data-order='[[ 3, "desc" ]]'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Order ID</th>
                    <th>Booking Date</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Pax Details</th>
                    <th>Pay Mode</th>
                    <th>Amount Paid</th>
                    <th>Total Package Cost</th>
                    <th>Payment Status</th>
                    <th>Note</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php


                foreach (($AgentBookings ?? []) as $booking) { ?>

                    <tr>
                        <td><?= $booking->ID ?></td>
                        <td><?= substr($booking->order_id, 0, 20) ?></td>
                        <td><?= $booking->created_at ?></td>
                        <td><?= $booking->name ?></td>
                        <td><?= $booking->contact ?></td>
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
                        <td><?= $booking->amount ?></td>
                        <td>
                            <input type="number" class="form-control form-control-sm" data-field="total_package_cost" data-booking-id="<?= $booking->ID; ?>" value="<?= $booking->total_package_cost ?>">
                        </td>
                        <td>


                            <select data-field="status" class="form-select form-select-sm" data-booking-id="<?= esc($booking->ID) ?>">
                                <?php
                                $statuses = ['Pending', 'Complete', 'Cancel', 'Failed / Unknown'];
                                foreach ($statuses as $status):
                                ?>
                                    <option class="<?= statusToClass($status) ?>" value="<?= esc($status) ?>" <?= $booking->status === $status ? 'selected' : '' ?>>
                                        <?= esc($status) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php
                            $remainingAmount = $booking->total_package_cost - $booking->amount;
                            if ($remainingAmount >= 0): ?>
                                <span class="btn btn-sm fw-bold" disabled>Remaining : ₹<?= $remainingAmount ?></span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <textarea name="note" data-field="note" class="form-control form-control-sm" data-booking-id="<?= $booking->ID; ?>"><?= esc($booking->note) ?></textarea>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <button type="button" class="waves-effect  btn btn-sm btn-outline-dark" onclick="openModel('BookingTableDetail<?= $booking->ID; ?>')"><i class='bx bxs-folder-open'></i></button>
                                <?php if (!str_contains($booking->order_id, 'order_')): ?>
                                    <button type="button" id="copyLinkBtn" class="waves-effect  btn btn-sm btn-outline-dark" data-link="<?= base_url() ?>booking-confirmation-form/<?= $booking->order_id; ?>" onclick="copyLink()">Copy Link</button>
                                <?php endif; ?>
                            </div>
                            <dialog id="BookingTableDetail<?= $booking->ID ?>">
                                <div class="card">
                                    <div class="card-header">
                                        Booking Details
                                    </div>
                                    <div class="card-body">
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
                                                <th>Booked Package</th>
                                                <td><a href="/packageid/<?= $booking->package_id; ?>"><?= $booking->package_id ?> | <?= $booking->package_name ?></a></td>
                                            </tr>
                                            <tr>
                                                <th>Adults</th>
                                                <td><?= $booking->adults ?></td>
                                            </tr>
                                            <tr>
                                                <th>Customer Sharing</th>
                                                <td><?= substr($booking->sharing, 2) ?></td>
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
                                                <td><?= substr($booking->travelmode, 2) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Paymode</th>
                                                <td><?= $booking->paymode ?></td>
                                            </tr>
                                            <tr>
                                                <th>Remaining Amount</th>

                                                <td><?php
                                                    $remainingAmount = $booking->total_package_cost - $booking->amount;
                                                    if ($remainingAmount >= 0): ?>

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
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-sm btn-outline-dark" onclick="document.querySelector('#BookingTableDetail<?= $booking->ID; ?>').close();">Close</button>
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
                    console.log('Field saved', data);
                    runToast(`Field saved : ${data.field}`, 'Success');
                })
                .catch(err => {
                    console.error('Failed to save field', err);
                    runToast(`Failed to save field ${err}`, 'danger');
                });
        });
    });
</script>

<script>
    function showTravelers(data, id) {
        document.getElementById(`travelers-dialog-${id}`).showModal();
        let travelers = {};

        // Group data
        for (let key in data) {
            let match = key.match(/traveler_(\d+)_(\w+)/);

            if (match) {
                let num = match[1];
                let field = match[2];

                if (!travelers[num]) {
                    travelers[num] = {};
                }

                travelers[num][field] = data[key];
            }
        }

        // Output result
        let result = "";

        for (let num in travelers) {
            let t = travelers[num];

            result += `
                  <li class="list-group-item d-flex justify-content-between align-items-start ">
                     <div class="ms-2 me-auto">
                        <div class="fw-bold fs-6">${t.name || ''}</div>
                        ${(t.gender || '').toLowerCase()} • <a href="tel:${t.contact || ''}">${t.contact || ''}</a> • <a href="mail:${t.email || ''}">${t.email || ''}</a>
                        <p>Sharing Basis : ${t.sharing.split('|')[1] || ''}</p>
                     </div>
                  </li>
         `;
        }
        // Show output
        document.getElementById(`output-dialog-${id}`).innerHTML = result;
    }
</script>