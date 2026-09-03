
<?= $this->include('layout/footer-partials/footer-content') ?>
<?= $this->include('layout/footer-partials/js-scripts') ?>
<?php if (isset($_SESSION['FlashMessage'])) : ?>
    <script>
        runToast('<?= $_SESSION['FlashMessage']['message'] ?>', '<?= $_SESSION['FlashMessage']['status'] ?>');
    </script>
<?php endif; ?>
</main>
</body>
</html>