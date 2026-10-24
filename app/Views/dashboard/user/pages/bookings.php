<?php

/**
 * @var int $remainingAmount
 * @var array $Bookings
 */
?>
<div id="bookings" class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fw-bold">Your Past Bookings</div>
            <div class="fw-bold">Date Desc ⬇</div>
        </div>

    </div>
    <div class="card-body">
        <div class="hide-on-mobile">
            <table class="sortable table hover" id="datatable" data-order='[[ 0, "desc" ]]'>
                <thead>
                    <tr>
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php


                    foreach ($Bookings as $booking) : ?>

                        <tr>

                            <td><?= esc($booking->created_at) ?></td>
                            <td><?= esc($booking->agent_name) ?></td>
                            <td><?= esc($booking->name) ?></td>

                            <td><?= esc($booking->contact) ?></td>
                            <td>
                                <?= esc($booking->adults) ?>
                            </td>
                            <td>
                                <?php if ($booking->pax_details && $booking->pax_details != "{}"): ?>
                                    <button class="btn btn-sm btn-outline-dark" data-booking-id="<?= esc($booking->ID) ?>" data-travelers="<?= esc($booking->pax_details, 'attr') ?>" onclick="showTravelersModel()">Show</button>
                                    <dialog class="border-1 rounded" id="travelers-dialog-<?= esc($booking->ID) ?>">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="fw-bold"><?= esc($booking->name) ?>'s Travel Buddies</div>
                                            </div>
                                            <div class="card-body">
                                                <ol class="list-group list-group-numbered" id="output-dialog-<?= esc($booking->ID) ?>"></ol>
                                            </div>
                                            <div class="card-footer">
                                                <button class="btn btn-sm btn-outline-dark" onclick="document.querySelector('#travelers-dialog-<?= esc($booking->ID) ?>').close();">Close</button>
                                            </div>
                                        </div>
                                    </dialog>
                                <?php else: ?>
                                    No details available
                                <?php endif; ?>

                            </td>
                            <td class="text-capitalize"><?= esc($booking->paymode) ?></td>
                            <td>
                                <?= esc($booking->amount) ?>
                            </td>
                            <td>
                                <?= esc($booking->total_package_cost) ?>
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
                                <div class="d-flex gap-1">
                                    <button type="button" class="waves-effect  btn btn-sm btn-outline-dark" onclick="openModel('BookingTableDetail<?= esc($booking->ID) ?>')"><i class='bx bxs-folder-open'></i></button>
                                </div>
                                <dialog id="BookingTableDetail<?= esc($booking->ID) ?>">


                                    <div class="card">
                                        <div class="card-header">
                                            Booking Details
                                        </div>
                                        <div class="card-body">

                                            <div class="d-flex">
                                                <table class="table">
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <td><?= esc($booking->order_id) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>User ID</th>
                                                        <td><?= esc($booking->user_id) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Name</th>
                                                        <td><?= esc($booking->name) ?> | <?= esc($booking->gender) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Email</th>
                                                        <td><?= esc($booking->email) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Contact</th>
                                                        <td><?= esc($booking->contact) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Booked Package</th>
                                                        <td><a href="/packageid/<?= esc($booking->package_id) ?>"><?= esc($booking->package_id) ?> | <?= esc($booking->package_name) ?></a></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Adults</th>
                                                        <td><?= esc($booking->adults) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Batch Date</th>
                                                        <td><?= esc($booking->date) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Coupon Used</th>
                                                        <td><?= esc($booking->coupon_used) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Travel Mode / Boarding </th>
                                                        <td><?= esc($booking->travelmode) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Paymode</th>
                                                        <td><?= esc($booking->paymode) ?></td>
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
                                                        <td><?= esc($booking->created_at) ?></td>
                                                        <td><?= esc($booking->updated_at) ?></td>
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
                                            <button class="btn btn-sm btn-outline-dark" onclick="document.querySelector('#BookingTableDetail<?= esc($booking->ID) ?>').close();">Close</button>
                                        </div>
                                    </div>


                                <?php endforeach; ?>
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
        <div class="show-on-mobile">
            <ul class="list-group">
                <?php foreach (($Bookings ?? []) as $booking) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-start border-start ">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold"><?= esc($booking->package_name) ?></div>
                            <p class="m-0"><?= esc($booking->adults) ?> Pax • Total Cost : ₹<?= esc($booking->total_package_cost) ?></p>

                            <sub>
                                <b><?= esc($booking->created_at) ?></b>
                            </sub>
                        </div>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>


    </div>

</div>