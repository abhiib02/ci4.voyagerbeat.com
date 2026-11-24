<?php

/**
 * @var array $Departures
 * @var string $todaydate
 */
?>
<div class="d-flex justify-content-between">
    <div>
        <form method="get" class="d-flex">
            <div class="mb-3">
                <label for="">Start Date</label>
                <input type="date" class="form-control" value="<?= esc($todaydate) ?>" name="start" id="" onchange="this.form.submit()">
            </div>
        </form>
    </div>
</div>

<div class="table-responsive border rounded">
    <table class="table table-hover" id="datatable" data-order='[[ 0, "desc" ]]'>
        <thead class="table-light">
            <tr>
                <th>Start - End Date</th>
                <th>Package Name</th>
                <th>Pick and Drop (Ignore first number)</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Adults</th>
                <th>Pax Details</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php if (!empty($Departures)): ?>
                <?php foreach (($Departures ?? []) as $departure) : ?>
                    <tr>
                        <td><?= $departure->date ?></td>
                        <td><?= $departure->package_name ?></td>
                        <td><?= $departure->travelmode ?></td>
                        <td><?= $departure->name ?></td>
                        <td><?= $departure->contact ?></td>
                        <td><?= $departure->adults ?></td>
                        <td>
                            <?php if ($departure->pax_details && $departure->pax_details != "{}"): ?>
                                <button class="btn btn-sm btn-outline-dark" data-booking-id="<?= $departure->ID ?>" data-travelers="<?= esc($departure->pax_details, 'attr') ?>" onclick="showTravelersModel()">Show</button>
                                <dialog class="border-1 rounded" id="travelers-dialog-<?= $departure->ID; ?>">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between">
                                            <div class=" align-content-center">
                                                <div class="fw-bold"><?= $departure->name ?>'s Travel Buddies</div>
                                            </div>
                                            <div>
                                                <button class="btn btn-sm btn-outline-dark" onclick="document.querySelector('#travelers-dialog-<?= $departure->ID; ?>').close();"><i class='bx bx-x'></i></button>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <ol class="row" style="width: 80vw;list-style-type: none;padding:0;" id="output-dialog-<?= $departure->ID; ?>"></ol>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-sm btn-outline-dark" onclick="document.querySelector('#travelers-dialog-<?= $departure->ID ?>').close();">Close</button>
                                        </div>
                                    </div>
                                </dialog>
                            <?php else: ?>
                                No details available
                            <?php endif; ?>

                        </td>
                        <?php if (auth('Admin')): ?>
                            <td><a class="btn btn-sm btn-outline-dark" href="/dashboard/all-bookings?customer_id=<?= $departure->user_id ?>">See Booking</a></td>
                        <?php endif; ?>
                        <?php if (auth('Manager')): ?>
                            <td><a class="btn btn-sm btn-outline-dark" href="/manager-dashboard/bookings-list?customer_id=<?= $departure->user_id ?>">See Booking</a></td>
                        <?php endif; ?>


                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td>Nothing</td>
                    <td>Nothing</td>
                    <td>Nothing</td>
                    <td>Nothing</td>
                    <td>Nothing</td>
                    <td>Nothing</td>
                    <td>Nothing</td>
                    <td>Nothing</td>
                </tr>
            <?php endif; ?>

        </tbody>
    </table>
</div>