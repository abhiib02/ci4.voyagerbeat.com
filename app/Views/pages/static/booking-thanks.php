<div style="background: #19C26F;" class="grid-center  full-vh scroll-margin print-container " id="print-content-wrapper">
    <div class="grid-center container ">
        <br>
        <div class="card w-100 p-3 mt-5">
            <div class="d-flex justify-content-between align-content-center">
                <div>
                    <img src="<?= env('appLogoPath') ?>" width="80px" alt="">
                </div>
                <div class="d-flex gap-2">
                    <div class="text-end">
                        <h6 class="fw-bold">Booking Confirmation Receipt</h6>
                        <hr>
                        <h6><?= env('appName') ?></h6>
                    </div>
                    <div id="qrcode"></div>
                </div>
            </div>
            <hr>
            <div class="row page-1">
                <div class="col-md-6">
                    <h6 class="fw-bold">Customer Details</h6>
                    <table class="table table-bordered">
                        <tr>
                            <td>Name</td>
                            <td><b><?= $bookingData->name ?></b></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><b><?= $bookingData->email ?></b></td>
                        </tr>
                        <tr>
                            <td>Contact</td>
                            <td><b><?= $bookingData->contact ?></b></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold">Booking Details</h6>
                    <table class="table table-bordered">
                        <tr>
                            <td>Booking ID</td>
                            <td><b><?= $bookingData->ID ?></b></td>
                        </tr>
                        <tr>
                            <td>Order ID</td>
                            <td><b><?= $bookingData->order_id ?></b></td>
                        </tr>
                        <tr>
                            <td>Booking Date</td>
                            <td><b><?= $bookingData->created_at ?></b></td>
                        </tr>
                    </table>

                </div>
                <div class="col-lg-6">
                    <h6 class="fw-bold">Package Details</h6>
                    <table class="table table-bordered">
                        <tr>
                            <td>Package ID / Name</td>
                            <td><a href="/packageid/<?= $bookingData->package_id ?>"><b><?= $bookingData->package_id ?></b> / <b><?= $bookingData->package_name ?></b></a></td>
                        </tr>

                        <tr>
                            <td>Package Date of Travel</td>
                            <td><b><?= explode('|', $bookingData->date)[0] ?></b></td>
                        </tr>
                        <tr>
                            <td>Adults</td>
                            <td><b><?= $bookingData->adults ?></b></td>
                        </tr>
                    </table>
                </div>

                <div class="col-lg-6">
                    <h6 class="fw-bold">Payment Details</h6>
                    <table class="table table-bordered">

                        <tr>
                            <td>Total Amount</td>
                            <td><b>₹ <?= number_format($bookingData->total_package_cost, 2) ?? 'Will Be Informed While Boarding' ?></b></td>
                        </tr>
                        <tr>
                            <td>Amount Paid</td>
                            <td><b>₹ <?= number_format($bookingData->amount, 2) ?></b></td>
                        </tr>
                        <tr>
                            <td>Remaining Payable</td>
                            <td>
                                <b>
                                    <?php if (($bookingData->total_package_cost - $bookingData->amount) == 0): ?>
                                        Full Payment Done
                                    <?php elseif (($bookingData->total_package_cost - $bookingData->amount) < 0): ?>
                                        Total Amount will be provided While Boarding
                                    <?php else: ?>
                                        ₹ <?= number_format($bookingData->total_package_cost - $bookingData->amount, 2) ?>
                                    <?php endif; ?>
                                </b>
                            </td>
                        </tr>
                        <?php if (!empty($bookingData->coupon_used)): ?>
                            <tr>
                                <td>Coupon Used</td>
                                <td><b><?= $bookingData->coupon_used ?></b></td>
                            </tr>
                        <?php endif; ?>
                    </table>

                </div>

            </div>
            <div class="row page-2">
                <?php if (!empty($bookingData->pax_details)): ?>
                    <div class="col-lg-12 page-2">
                        <br>
                        <h6 class="fw-bold m-0">Pax Details</h6>
                        <br>

                        <?php $Paxs  = json_decode($bookingData->pax_details); ?>
                        <div class="row ">
                            <?php foreach ($Paxs as $index => $pax): ?>
                                <div class="col-md-6 col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-header fw-bold">Traveler <?= $index + 1 ?></div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span class="text-muted">Name</span>
                                                <span><?= $pax->name ?></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span class="text-muted">Contact</span>
                                                <span><?= $pax->contact  ?></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span class="text-muted">Gender</span>
                                                <span><?= $pax->gender ?></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span class="text-muted">Sharing</span>
                                                <span><?= $pax->sharing ?></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span class="text-muted">Adhaar Number</span>
                                                <span><?= $pax->adhaar ?></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span class="text-muted">Cost </span>
                                                <span><?= $pax->cost ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
            <small>
                * This is a system generated Booking Confirmation Receipt.
            </small>
            <div class="no-print">
                <hr>
                <p class="text-center">
                    For any queries, please contact us at <a href="tel:<?= $defaultContact ?>"><?= $defaultContact ?></a> or Mail us on <a href="mailto:<?= $defaultmails ?>"><?= $defaultmails ?></a>
                </p>

                <div class="noPrint">
                    <hr>
                    <small>
                        * Please check your email this receipt has been sent to your email address as well.
                    </small>
                    <hr>
                </div>
                <div>
                    <button class="noPrint btn btn-primary" onclick="window.print();">Print Receipt</button>
                    <a href="/" class="noPrint btn btn-secondary">Back to Home</a>
                </div>
            </div>

        </div>
    </div>

</div>
<script src="/js/ezToast.js"></script>
<script src="/js/qrcode.min.js"></script>
<script>
    var qrcode = new QRCode("qrcode", {
        text: "<?= env('app.baseURL'); ?>thanks?order_id=<?= $bookingData->order_id ?>",
        width: 80,
        height: 80,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    });
</script>
<?php if (isset($_SESSION['FlashMessage'])) : ?>
    <script>
        runToast('<?= $_SESSION['FlashMessage']['message'] ?>', '<?= $_SESSION['FlashMessage']['status'] ?>');
    </script>
<?php endif; ?>