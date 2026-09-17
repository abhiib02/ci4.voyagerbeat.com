
<div style="background:rgb(211, 152, 42);" class="grid-center  vh100" >
<div class="grid-center container " >
    <div class="card w-100 p-5">
        <h1>Maximum Amount is ₹500000 Through Online Payment</h1>
        <p class="text-danger">Please Contact us Directly for Offline Payments</p>
        <div class="">
            <img src="/assets/svg/payment-failed.svg" class="img-fluid" alt="">
            <p class="heading">We are sorry for the inconvenience.</p>

        <a href="/" class="noPrint btn btn-secondary">Back to Home</a>
        </div>
    </div>
</div>

</div>
<script src="/js/ezToast.js"></script>

<?php if (isset($_SESSION['FlashMessage'])) : ?>
    <script>
        runToast('<?= $_SESSION['FlashMessage']['message'] ?>', '<?= $_SESSION['FlashMessage']['status'] ?>');
    </script>
<?php endif; ?>
