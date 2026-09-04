
<?= view('layout/footer-partials/footer-content') ?>
<!-- Global Components -->
<?= view('pages/component/SearchBox') ?>
<?= view('layout/footer-partials/js-scripts') ?>
<?php if (isset($_SESSION['FlashMessage'])) : ?>
    <script>
        runToast('<?= $_SESSION['FlashMessage']['message'] ?>', '<?= $_SESSION['FlashMessage']['status'] ?>');
    </script>
<?php endif; ?>
</main>
</body>
</html>