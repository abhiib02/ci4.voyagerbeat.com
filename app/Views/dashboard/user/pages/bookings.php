<div class="card">
    <div class="card-header">
        <div class="fw-bold">Your Past Bookings</div>
    </div>
    <div class="card-body">
        <table class="table" id="datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Order ID</th>
                    <th>Booking Date (UTC+1 converted IST)</th>
                    <th>Booked Package ID</th>
                    <th>Adults</th>
                    <th>Sharing(Ignore starting Number)</th>
                    <th>Dates</th>
                    <th>Travel Mode</th>
                    <th>Pay Mode</th>
                    <th>Amount Paid</th>
                    <th>Total Package Cost</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach (($CustomerBookings ?? []) as $cbooking) { ?>
                    <tr>
                        <td><?php echo $cbooking->ID; ?></td>
                        <td><?php echo $cbooking->order_id; ?></td>
                        <td><?php
                            $time = explode(' ', $cbooking->booking_date_utc);
                            $UTCtime = strtotime($time[1]);
                            $INDIANTime = date("H:i:s", strtotime('+4 hours 30 minutes', $UTCtime));
                            echo $time[0] . ' ' . $INDIANTime;
                            ?></td>

                        <td><?php echo $cbooking->package_id; ?></td>
                        <td><?php echo $cbooking->adults; ?></td>
                        <td><?php echo $cbooking->sharing; ?></td>
                        <td><?php echo $cbooking->date; ?></td>
                        <td><?php echo $cbooking->travelmode; ?></td>
                        <td><?php echo $cbooking->paymode; ?></td>
                        <td><?php echo $cbooking->amount; ?></td>
                        <td><?php echo $cbooking->total_package_cost; ?></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>