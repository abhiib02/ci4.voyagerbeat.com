 <?php

    /**
     * @var array $CustomerAsTravelBuddy
     */
    ?>
 <div class="card">
     <div class="card-header">
         <div class="fw-bold">You as TravelBuddy</div>
     </div>
     <div class="card-body">
         <div class=" hide-on-mobile">
             <table class="table" id="datatable">
                 <thead>
                     <tr>
                         <th>Booked By</th>
                         <th>Booked On</th>
                         <th>Adults</th>
                         <th>Pax Details</th>
                         <th>Sharing(Ignore starting Number)</th>
                         <th>Dates</th>
                         <th>Pay Mode</th>
                         <th>Amount Paid</th>
                         <th>Total Package Cost</th>

                     </tr>
                 </thead>
                 <tbody>
                     <?php foreach ($CustomerAsTravelBuddy as $tbbooking) { ?>
                         <tr>
                             <td><?= esc($tbbooking->name) ?></td>

                             <td><?= esc($tbbooking->created_at) ?>

                             <td><?php echo $tbbooking->adults; ?></td>
                             <td>
                                 <?php if ($tbbooking->pax_details && $tbbooking->pax_details != "{}"): ?>
                                     <button class="btn btn-sm btn-outline-dark" onclick='showTravelers(<?php echo $tbbooking->pax_details; ?>,<?= $tbbooking->ID ?>)'>Show</button>

                                     <dialog class="border-1 rounded" id="travelers-dialog-<?= $tbbooking->ID ?>">
                                         <div class="card">
                                             <div class="card-header d-flex justify-content-between">
                                                 <div class=" align-content-center">
                                                     <div class="fw-bold"><?= $tbbooking->name; ?>'s Travel Buddies</div>
                                                 </div>
                                                 <div>
                                                     <button class="btn btn-sm btn-outline-dark" onclick="document.querySelector('#travelers-dialog-<?= $tbbooking->ID ?>').close();"><i class='bx bx-x'></i></button>
                                                 </div>
                                             </div>
                                             <div class="card-body">
                                                 <ol class="list-group list-group-numbered" id="output-dialog-<?= $tbbooking->ID ?>"></ol>
                                             </div>
                                             <div class="card-footer">
                                                 <button class="btn btn-sm btn-outline-dark" onclick="document.querySelector('#travelers-dialog-<?= $tbbooking->ID ?>').close();">Close</button>
                                             </div>
                                     </dialog>
                                 <?php else: ?>
                                     No details available
                                 <?php endif; ?>

                             </td>
                             <td><?php echo $tbbooking->sharing; ?></td>
                             <td><?php echo $tbbooking->date; ?></td>
                             <td><?php echo $tbbooking->paymode; ?></td>
                             <td><?php echo $tbbooking->amount; ?></td>
                             <td><?php echo $tbbooking->total_package_cost; ?></td>

                         </tr>
                     <?php } ?>
                 </tbody>
             </table>
         </div>
         <div class="show-on-mobile">
             <ul class="list-group">
                 <?php foreach (($CustomerAsTravelBuddy ?? []) as $tbbooking) : ?>
                     <li class="list-group-item d-flex justify-content-between align-items-start border-start ">
                         <div class="ms-2 me-auto">
                             <div class="fw-bold"><?= esc($tbbooking->package_name) ?></div>

                             <p class="m-0">Booked By <?= esc($tbbooking->name) ?> • <?= esc($tbbooking->adults) ?> Pax</p>

                             <sub>
                                 <b><?= esc($tbbooking->created_at) ?></b>
                             </sub>
                         </div>
                     </li>
                 <?php endforeach; ?>

             </ul>
         </div>
     </div>
 </div>