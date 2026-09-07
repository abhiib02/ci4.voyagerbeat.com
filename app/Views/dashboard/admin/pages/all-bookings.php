<div id="bookings" class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fw-bold">Bookings</div>
            <a class="fw-bold btn btn-success" target="_blank" href="https://docs.google.com/spreadsheets/d/16alRGAwiWdj3F5B0852nTssBJwTOoeEJSM_SaE2l28E/edit?usp=sharing">&#9871; Open Google Sheet</a>
        </div>

    </div>
    <div class="card-body">
        <table class="sortable table" id="">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Order ID</th>
                    <th>Booking Date (UTC+1 converted IST)</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Booked Package ID</th>
                    <th>Adults</th>
                    <th>Pax Details</th>
                    <th>Sharing(Ignore starting Number)</th>
                    <th>Coupon Used</th>
                    <th>Dates</th>
                    <th>Travel Mode</th>
                    <th>Pay Mode</th>
                    <th>Amount Paid</th>
                    <th>Total Package Cost</th>

                </tr>
            </thead>
            <tbody>
                <?php


                foreach ($Bookings as $booking) { ?>
                    <tr>
                        <td><?= $booking->ID; ?></td>
                        <td><?= $booking->order_id; ?></td>
                        <td><?php
                            $time = explode(' ', $booking->booking_date_utc);
                            echo $time[0] . ' ' . $time[1]
                            ?></td>
                        <td><?= $booking->name; ?></td>
                        <td><?= $booking->email; ?></td>
                        <td><?= $booking->contact; ?></td>
                        <td><a href="/package/<?= $booking->package_id; ?>"></a></td>
                        <td><?= $booking->adults; ?></td>
                        <td>
                            <?php if ($booking->pax_details && $booking->pax_details != "{}"): ?>
                                <button class="btn btn-sm  btn-outline-dark" onclick='showTravelers(<?= $booking->pax_details; ?>,<?= $booking->ID; ?>)'>Show</button>
                                <dialog class="border-1 rounded" id="travelers-dialog-<?= $booking->ID; ?>">
                                    <p class="fs-4"><?= $booking->name; ?>'s Travel Buddies</p>

                                    <hr>
                                    <ol class="list-group list-group-numbered" id="output-dialog-<?= $booking->ID; ?>">

                                    </ol>
                                    <hr>
                                    <button class="btn btn-dark" onclick="document.querySelector('#travelers-dialog-<?= $booking->ID; ?>').close();">Close</button>
                                </dialog>
                            <?php else: ?>
                                No details available
                            <?php endif; ?>

                        </td>
                        <td><?= $booking->sharing; ?></td>
                        <td><?= $booking->coupon_used; ?></td>
                        <td><?= $booking->date; ?></td>
                        <td><?= $booking->travelmode; ?></td>
                        <td><?= $booking->paymode; ?></td>
                        <td><?= $booking->amount; ?></td>
                        <td><?= $booking->total_package_cost; ?></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- Pagination Links -->
        <div class="pagination">
            <?= $pager->links() ?>
        </div>
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