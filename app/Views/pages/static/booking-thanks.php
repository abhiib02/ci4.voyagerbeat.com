<div style="background: #19C26F;" class="grid-center  vh100">
    <div class="grid-center container ">
        <br>
        <div class="card w-100 p-3 mt-5">
            <div class="d-flex justify-content-between align-content-center">
                <div>
                    <img src="<?=env('appLogoPath')?>" width="80px" alt="">
                </div>
                <div class="d-flex gap-2">
                <div class="text-end">
                    <h6 class="fw-bold">Booking Confirmation Receipt</h6>
                    <hr>
                    <h6><?=env('appName')?></h6>
                </div>
                <div id="qrcode"></div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <h6 class="fw-bold">Customer Details</h6>
                    <table class="table table-bordered">
                        <tr>
                            <td>Name</td>
                            <td><b><?=$bookingData->NAME?></b></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><b><?=$bookingData->EMAIL?></b></td>
                        </tr>
                        <tr>
                            <td>Contact</td>
                            <td><b><?=$bookingData->CONTACT?></b></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold">Booking Details</h6>
                    <table class="table table-bordered">
                        <tr>
                            <td>Booking ID</td>
                            <td><b><?=$bookingData->BOOKING_ID?></b></td>
                        </tr>
                        <tr>
                            <td>Payment ID</td>
                            <td><b><?=$bookingData->RAZORPAY_PAYMENT_ID?></b></td>
                        </tr>
                        <tr>
                            <td>Booking Date</td>
                            <td><b><?=$bookingData->CREATED_AT?></b></td>
                        </tr>
                    </table>

                </div>
                <div class="col-lg-6">
                    <h6 class="fw-bold">Package Details</h6>
                    <table class="table table-bordered">
                        <tr>
                            <td>Package ID</td>
                            <td><b><?=$bookingData->BOOKED_PACKAGE_ID?></b></td>
                        </tr>
                        <tr>
                            <td>Package Name</td>
                            <td><b><?=$bookingData->BOOKED_PACKAGE_NAME?></b></td>
                        </tr>
                        <tr>
                            <td>Package Date of Travel</td>
                            <td><b><?=$bookingData->BOOKED_DATE_OF_TRAVEL?></b></td>
                        </tr>
                        <tr>
                            <td>Adults</td>
                            <td><b><?=$bookingData->ADULTS?></b></td>
                        </tr>
                        <tr>
                            <td>Sharing Basis</td>
                            <td><b><?=$bookingData->SHARING?></b></td>
                        </tr>
                    </table>
                </div>

                <div class="col-lg-6">                    
                    <h6 class="fw-bold">Payment Details</h6>
                    <table class="table table-bordered">
                        <tr>
                            <td>Booking Amount</td>
                            <td><b>₹ <?=number_format($bookingData->BOOKING_AMOUNT,2)?></b></td>
                        </tr>
                        <tr>
                            <td>Total Amount</td>
                            <td><b>₹ <?=number_format($bookingData->TOTAL_AMOUNT,2)?></b></td>
                        </tr>
                        <tr>
                            <td>Amount Paid</td>
                            <td><b>₹ <?=number_format($bookingData->AMOUNT_PAID,2)?></b></td>
                        </tr>
                        <tr>
                            <td>Remaining Payable</td>
                            <td><b><?=(($bookingData->TOTAL_AMOUNT - $bookingData->AMOUNT_PAID)==0) ? 'Full Payment Done' : '₹ '.number_format($bookingData->TOTAL_AMOUNT - $bookingData->AMOUNT_PAID,2)?></b></td>
                        </tr>
                        <?php if(!empty($bookingData->COUPON_USED)):?>
                        <tr>
                            <td>Coupon Used</td>
                            <td><b><?=$bookingData->COUPON_USED?></b></td>
                        </tr>
                        <?php endif;?>
                    </table>

                    <?php if(($bookingData->ADDITIONAL_MESSAGE != 0) && ($bookingData->ADDITIONAL_MESSAGE != null)):?>
                    <hr>
                    <h6 class="fw-bold">Customer Message</h6>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <?=$bookingData->ADDITIONAL_MESSAGE?>
                            </td>
                        </tr>
                    </table>
                    <?php endif;?>
                </div>

            </div>
            <small>
                * This is a system generated Booking Confirmation Receipt.
            </small>
            <hr>
            <p class="text-center">
                For any queries, please contact us at <a href="tel:<?=$Contact?>"><?=$Contact?></a> or Mail us on <a
                    href="mailto:<?=$mails?>"><?=$mails?></a>.
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
<script src="/js/ezToast.js"></script>
<script src="/js/qrcode.min.js"></script>
<script>
    var qrcode = new QRCode("qrcode", {
    text: "<?=env('app.baseURL');?>thanks?payment_id=<?=$bookingData->RAZORPAY_PAYMENT_ID?>",
    width: 80,
    height: 80,
    colorDark : "#000000",
    colorLight : "#ffffff",
    correctLevel : QRCode.CorrectLevel.H
});
</script>
<?php if (isset($_SESSION['FlashMessage'])) : ?>
<script>
    runToast('<?= $_SESSION['FlashMessage']['message'] ?>', '<?= $_SESSION['FlashMessage']['status'] ?>');
</script>
<?php endif; ?>