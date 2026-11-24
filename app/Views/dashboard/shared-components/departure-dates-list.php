<?php

/**
 * @var array $Departures
 */
?>
<div class="d-flex justify-content-between">
    <div>
        <?= view('dashboard/shared-components/custom-from-to-date-selector') ?>
    </div>
</div>

<div class="table-responsive border rounded">
    <table class="table table-hover" id="" data-order='[[ 0, "desc" ]]'>
        <thead class="table-light">
            <tr>
                <th>Start - End Date</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Adults</th>
                <th>Pax Details</th>
            </tr>
        </thead>
        <tbody>

            <?php if (!empty($Departures)): ?>
                <?php foreach (($Departures ?? []) as $departure) : ?>
                    <tr>
                        <td><?= $departure->date ?></td>
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
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No records found</td>
                </tr>
            <?php endif; ?>

        </tbody>
    </table>
</div>