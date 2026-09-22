<style>
    .fullvh {
        height: 100vh;
        font-family: sans-serif;
    }

    .grid-center {
        display: grid;
        place-items: center;
    }
</style>
<div class="fullvh grid-center" id="loader">
    <div class="text-center">
        <img width="200px" src="/assets/images/payment_process.gif" alt=""><br>
        <h4>Please Wait...</h4>
        <h4>Payment is in process</h4>
        <h4>Do Not Close This Page</h2>
    </div>
</div>

<button id="rzp-button1" style="display:none;">Pay with Razorpay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
<form name='razorpayform' action="<?= env('app.baseURL') ?>verify-payment" method="POST">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_signature" id="razorpay_signature">

    <?php $details = json_encode($data);
    $details = json_decode($details, true);
    ?>

    <input type="hidden" name="name" value="<?php echo $details['prefill']['name'] ?>">
    <input type="hidden" name="email" value="<?php echo $details['prefill']['email'] ?>">
    <input type="hidden" name="gender" value="<?php echo $details['prefill']['gender'] ?>">
    <input type="hidden" name="contact" value="<?php echo $details['prefill']['contact'] ?>">
    <input type="hidden" name="package_id" value="<?php echo $details['prefill']['package_id'] ?>">
    <input type="hidden" name="travelmode" value="<?php echo $details['prefill']['travelmode'] ?>">
    <input type="hidden" name="sharing" value="<?php echo $details['prefill']['sharing'] ?>">
    <input type="hidden" name="coupon_used" value="<?php echo $details['prefill']['coupon_used'] ?>">
    <input type="hidden" name="adults" value="<?php echo $details['prefill']['adults'] ?>">
    <textarea type="hidden" name="pax_details"><?php echo $details['prefill']['pax_details'] ?></textarea>
    <input type="hidden" name="date" value="<?php echo $details['prefill']['date'] ?>">
    <input type="hidden" name="paymode" value="<?php echo $details['prefill']['paymode'] ?>">
    <input type="hidden" name="total_amount" value="<?php echo $details['prefill']['total_amount'] ?>">

</form>
<script>
    // Checkout details as a json
    var options = <?php echo json_encode($data); ?>;
    /**
     * The entire list of Checkout fields is available at
     * https://docs.razorpay.com/docs/checkout-form#checkout-fields
     */
    options.handler = function(response) {
        document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
        document.getElementById('razorpay_signature').value = response.razorpay_signature;
        document.razorpayform.submit();
    };
    // Boolean whether to show image inside a white frame. (default: true)
    options.theme.image_padding = true;
    options.modal = {
        ondismiss: function() {
            //console.log("Dismissed Payment");
            alert("Payment Process Closed");
            window.location.replace("/payment-failed");
        },
        // Boolean indicating whether pressing escape key 
        // should close the checkout form. (default: true)
        escape: true,
        // Boolean indicating whether clicking translucent blank
        // space outside checkout form should close the form. (default: false)
        backdropclose: false
    };
    var rzp = new Razorpay(options);
    $(document).ready(function() {
        $("#rzp-button1").click();
        rzp.open();
        e.preventDefault();
        $("#loader").removeClass("hide");
    });
</script>