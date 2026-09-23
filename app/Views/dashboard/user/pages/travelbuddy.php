 <div class="card">
     <div class="card-header">
         <div class="fw-bold">Travel Buddy Bookings</div>
     </div>
     <div class="card-body">
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
                 <?php foreach (($CustomerAsTravelBuddy ?? []) as $tbbooking) { ?>
                     <tr>
                         <td><?php echo $tbbooking->name; ?></td>

                         <td><?php
                                $tbtime = explode(' ', $tbbooking->booking_date_utc);
                                $UTCtime2 = strtotime($tbtime[1]);
                                $INDIANTime2 = date("H:i:s", strtotime('+4 hours 30 minutes', $UTCtime2));
                                echo $tbtime[0] . ' ' . $INDIANTime2;
                                ?></td>

                         <td><?php echo $tbbooking->adults; ?></td>
                         <td>
                             <?php if ($tbbooking->pax_details && $tbbooking->pax_details != "{}"): ?>
                                 <button class="btn btn-sm btn-outline-dark" onclick='showTravelers(<?php echo $tbbooking->pax_details; ?>,<?= $tbbooking->ID ?>)'>Show</button>

                                 <dialog class="border-1 rounded" id="travelers-dialog-<?= $tbbooking->ID ?>">
                                     <div class="card">
                                         <div class="card-header">
                                             <div class="fw-bold"><?= $tbbooking->name; ?>'s Travel Buddies</div>
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
 </div>