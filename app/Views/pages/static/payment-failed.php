
<div style="background:rgb(211, 42, 42);" class="grid-center  vh100" >
<div class="grid-center container " >
    <div class="card w-100 p-5">
        <h1>Payment Failed / Payment Process Closed</h1>
        <p class="text-danger">Your Payment Process has failed.</p>
        <div>
        <a href="/" class="noPrint btn btn-secondary">Back to Home</a>
        </div>
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
