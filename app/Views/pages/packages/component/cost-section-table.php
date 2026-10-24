    <?php

    /**
     * @var object $package
     */
    ?>
    <h5>Trip Cost</h5>
    <hr>
    <?php if (!$package->REQUEST_PRICE): ?>

        <table class="table outline-card rounded-3">

            <thead style="background:var(--maincolor-lite);">

                <tr>

                    <th class="padding">Sharing</th>

                    <?php if ($package->HEAD_PRICE != '0'): ?>

                        <th><?= $package->HEAD_PRICE; ?></th>

                    <?php endif; ?>



                    <?php if ($package->HEAD_WTPRICE != '0' && $package->HEAD_WTPRICE != 'N/A'): ?>

                        <th><?= $package->HEAD_WTPRICE; ?></th>

                    <?php endif; ?>



                    <?php if (!empty($package->HEAD_WT2PRICE)): ?>

                        <th><?= $package->HEAD_WT2PRICE; ?></th>

                    <?php endif; ?>



                </tr>

            </thead>

            <tbody>

                <?php if (($package->INFO_P1 != null) && ($package->PRICE_1 > 0)) { ?>

                    <tr>

                        <td><?= $package->INFO_P1; ?></td>

                        <td><?= ($package->S_PRICE_1) ? '<del>₹' . $package->S_PRICE_1 . '</del>' : ''; ?><b><?= ' ₹' . $package->PRICE_1; ?></b></td>

                        <?php if ($package->WT_PRICE_1 != 0): ?><td><?= ($package->WT_PRICE_1 == 0) ? "Not Available" : '<del>₹' . ((int)$package->WT_PRICE_1 + 2500) . '</del> ' . '<b>₹' . $package->WT_PRICE_1; ?></b></td><?php endif; ?>

                        <?php if ($package->WT2_PRICE_1 != 0): ?><td><?= ($package->WT2_PRICE_1 == 0) ? "" : '<del>₹' . ((int)$package->WT2_PRICE_1 + 2500) . '</del> ' . '<b>₹' . $package->WT2_PRICE_1; ?></b></td><?php endif; ?>

                    </tr>

                <?php } ?>

                <?php if (($package->INFO_P2 != null) && ($package->PRICE_2 > 0)) { ?>

                    <tr>

                        <td><?= $package->INFO_P2; ?></td>

                        <td><?= ($package->S_PRICE_2) ? '<del>₹' . $package->S_PRICE_2 . '</del>' : ''; ?><b><?= ' ₹' . $package->PRICE_2; ?></b></td>

                        <?php if ($package->WT_PRICE_2 != 0): ?><td><?= ($package->WT_PRICE_2 == 0) ? "Not Available" : '<del>₹' . ((int)$package->WT_PRICE_2 + 2500) . '</del> ' . '<b>₹' . $package->WT_PRICE_2; ?></b></td><?php endif; ?>

                        <?php if ($package->WT2_PRICE_2 != 0): ?><td><?= ($package->WT2_PRICE_2 == 0) ? "" : '<del>₹' . ((int)$package->WT2_PRICE_2 + 2500) . '</del> ' . '<b>₹' . $package->WT2_PRICE_2; ?></b></td><?php endif; ?>

                    </tr>

                <?php } ?>

                <?php if (($package->INFO_P3 != null) && ($package->PRICE_3 > 0)) { ?>

                    <tr>

                        <td><?= $package->INFO_P3; ?></td>

                        <td><?= ($package->S_PRICE_3) ? '<del>₹' . $package->S_PRICE_3 . '</del>' : ''; ?><b><?= ' ₹' . $package->PRICE_3; ?></b></td>

                        <?php if ($package->WT_PRICE_3 != 0): ?><td><?= ($package->WT_PRICE_3 == 0) ? "Not Available" : '<del>' . ((int)$package->WT_PRICE_3 + 2500) . '</del> ' . '<b>₹' . $package->WT_PRICE_3; ?></b></td><?php endif; ?>

                        <?php if ($package->WT2_PRICE_3 != 0): ?><td><?= ($package->WT2_PRICE_3 == 0) ? "" : '<del>₹' . ((int)$package->WT2_PRICE_3 + 2500) . '</del> ' . '<b>₹' . $package->WT2_PRICE_3; ?></b></td><?php endif; ?>

                    </tr>

                <?php } ?>

                <?php if (($package->INFO_P4 != null) && ($package->PRICE_4 > 0)) { ?>

                    <tr>

                        <td><?= $package->INFO_P4; ?></td>

                        <td><?= ($package->S_PRICE_4) ? '<del>₹' . $package->S_PRICE_4 . '</del>' : ''; ?><b><?= ' ₹' . $package->PRICE_4; ?></b></td>

                        <?php if ($package->WT_PRICE_4 != 0): ?><td><?= ($package->WT_PRICE_4 == 0) ? "Not Available" : '<del>₹' . ((int)$package->WT_PRICE_4 + 2500) . '</del> ' . '<b>₹' . $package->WT_PRICE_4; ?></b></td><?php endif; ?>

                        <?php if ($package->WT2_PRICE_4 != 0): ?><td><?= ($package->WT2_PRICE_4 == 0) ? "" : '<del>₹' . ((int)$package->WT2_PRICE_4 + 2500) . '</del> ' . '<b>₹' . $package->WT2_PRICE_4; ?></b></td><?php endif; ?>

                    </tr>

                <?php } ?>

                <?php if (($package->INFO_P5 != null) && ($package->PRICE_5 > 0)) { ?>

                    <tr>

                        <td><?= $package->INFO_P5; ?></td>

                        <td><?= ($package->S_PRICE_5) ? '<del>₹' . $package->S_PRICE_5 . '</del>' : ''; ?><b><?= ' ₹' . $package->PRICE_5; ?></b></td>

                        <?php if ($package->WT_PRICE_5 != 0): ?><td><?= ($package->WT_PRICE_5 == 0) ? "Not Available" : '<del>₹' . ((int)$package->WT_PRICE_5 + 2500) . '</del> ' . '<b>₹' . $package->WT_PRICE_5; ?></b></td><?php endif; ?>

                        <?php if ($package->WT2_PRICE_5 != 0): ?><td><?= ($package->WT2_PRICE_5 == 0) ? "" : '<del>₹' . ((int)$package->WT2_PRICE_5 + 2500) . '</del> ' . '<b>₹' . $package->WT2_PRICE_5; ?></b></td><?php endif; ?>

                    </tr>

                <?php } ?>

            </tbody>

        </table>

        <br>

    <?php else: ?>

        <b>Price on Request</b>

        <hr>

        <h6>Pricing will be provided upon request, based on your selected destinations, duration, accommodations, and customization preferences.</h6>

    <?php endif; ?>