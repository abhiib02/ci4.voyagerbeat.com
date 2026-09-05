</div>
</div>
<script src="https://cdn.datatables.net/v/bs5/dt-3.0.3/datatables.min.js" integrity="sha384-U3G//lYwFPbrDV7w5uhOUSxHgb+hj1XYov+neDtWPWsO+xB38Puvo2sTlUSNw/bj" crossorigin="anonymous"></script>

<script>
    // Initialise a DataTable
    const table = new DataTable('#datatable', {
        // Options
    });
</script>

<script src="/js/eztoast.js"></script>
<?php if (isset($_SESSION['FlashMessage'])) : ?>
    <script>
        runToast('<?= $_SESSION['FlashMessage']['message'] ?>', '<?= $_SESSION['FlashMessage']['status'] ?>');
    </script>
<?php endif; ?>

</body>