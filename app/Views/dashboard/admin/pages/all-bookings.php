<div id="bookings" class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fw-bold">Bookings</div>
            <a class="fw-bold btn btn-success" target="_blank" href="https://docs.google.com/spreadsheets/d/16alRGAwiWdj3F5B0852nTssBJwTOoeEJSM_SaE2l28E/edit?usp=sharing">&#9871; Open Google Sheet</a>
        </div>

    </div>
    <div class="card-body">
        <table class="sortable table" id="datatable" data-order='[[ 2, "desc" ]]'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Order ID</th>
                    <th>Booking Date</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Pax Details</th>
                    <th>Pay Mode</th>
                    <th>Amount Paid</th>
                    <th>Total Package Cost</th>
                    <th>Payment Status</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
                <?php


                foreach (($Bookings ?? []) as $booking) { ?>
                    <tr>
                        <td><?= $booking->ID ?></td>
                        <td><?= $booking->order_id ?></td>
                        <td><?= $booking->booking_date_utc ?></td>
                        <td><?= $booking->name ?></td>
                        <td><?= $booking->email ?></td>
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
                            <span><?= $booking->total_package_cost ?>
                                <button class="btn btn-sm"><i class='bx bxs-edit-alt'></i></button>
                            </span>
                        </td>
                        <td>
                            <?php switch ($booking->status) {
                                case 'Complete': ?>
                                    <span class="badge text-bg-success"><?= $booking->status ?></span>
                                    <?php
                                    $remainingAmount = $booking->total_package_cost - $booking->amount;
                                    if ($remainingAmount): ?>
                                        <span class="btn btn-sm fw-bold" disabled>Remaining : ₹<?= $remainingAmount ?></span>
                                    <?php endif; ?>
                                <?php break;
                                case 'Pending': ?>
                                    <span class="badge text-bg-warning"><?= $booking->status ?></span>
                                <?php break;
                                case 'Cancel': ?>
                                    <span class="badge text-bg-secondary"><?= $booking->status ?></span>
                                <?php break;
                                case 'Cancelled': ?>
                                    <span class="badge text-bg-secondary"><?= $booking->status ?></span>
                                <?php break;
                                default: ?>
                                    <span class="badge text-bg-danger">Failed / Unknown</span>
                            <?php break;
                            } ?>


                        </td>
                        <td>
                            <button type="button" class="waves-effect  btn btn-sm btn-primary white-text" onclick="openModel('BookingTableDetail<?= $booking->ID; ?>')"><i class='bx bxs-folder-open'></i></button>

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
                                                <td><a href="/packageid/<?= $booking->package_id; ?>"><?= $booking->package_id ?></a></td>
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
                                                <td>₹<?= $booking->total_package_cost - $booking->amount ?></td>
                                            </tr>
                                            <tr>
                                                <th>Booked on</th>
                                                <td><?= $booking->booking_date_utc ?></td>
                                            </tr>

                                        </table>
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