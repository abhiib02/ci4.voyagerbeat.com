<?php

/**
 * @var string $defaultContact
 * @var string $defaultmails
 */
?>
<div style="background:rgb(211, 42, 42);" class="grid-center  full-vh">
    <div class="grid-center container ">
        <div class="card w-100 p-5">
            <div class="card border-danger shadow-sm my-4">
                <div class="card-body p-4 text-center">

                    <!-- Icon & Header -->
                    <div class="mb-3">
                        <i class="bi bi-x-circle-fill text-danger display-4"></i>
                    </div>
                    <h1>Payment Failed / Payment Process Closed</h1>
                    <p class="text-danger">
                        <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= esc(session()->getFlashdata('error')) ?>
                    </div>
                <?php endif; ?>
                </p>

                <!-- Explanatory Text -->
                <p class="text-secondary mb-4">
                    We were unable to complete your payment. Any deducted funds are usually refunded automatically by your bank within 3–5 business days.
                </p>

                <!-- Support Details Box -->
                <div class="bg-light border rounded p-3 text-start mx-auto mb-4" style="max-width: 480px;">
                    <h6 class="fw-bold mb-2 text-dark">Need help completing your reservation?</h6>
                    <p class="small text-muted mb-3">
                        Contact our support team directly and we'll help you finalize your booking:
                    </p>

                    <ul class="list-unstyled mb-0 small">
                        <li class="mb-2">
                            <strong>Phone / WhatsApp:</strong>
                            <a href="tel:+91<?= $defaultContact ?>" class="text-decoration-none">+91-<?= $defaultContact ?></a>
                        </li>
                        <li class="mb-2">
                            <strong>Email:</strong>
                            <a href="mailto:<?= $defaultmails ?>" class="text-decoration-none"><?= $defaultmails ?></a>
                        </li>
                        <li>
                            <strong>Hours:</strong> 24/7 Support Available
                        </li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-center gap-2">
                    <a href="/contact" class="btn btn-danger px-4">Contact Support</a>
                </div>

                </div>
            </div>
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