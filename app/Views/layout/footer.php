<?= view('layout/footer-partials/footer-content') ?>
<!-- Global Components -->
<?= view('pages/component/SearchBox') ?>
<?= view('pages/component/login-popup') ?>
<?= view('pages/component/loading-overlay') ?>
<?= view('layout/footer-partials/js-scripts') ?>
<?php if (isset($_SESSION['FlashMessage'])) : ?>
    <script>
        runToast('<?= $_SESSION['FlashMessage']['message'] ?>', '<?= $_SESSION['FlashMessage']['status'] ?>');
    </script>
<?php endif; ?>
</main>
</body>

</html>