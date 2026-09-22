<footer class="bg-light py-3 no-print">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="d-flex justify-content-center">
                    <a href="https://www.facebook.com/voyagersBeat/" target="_blank" class="me-3 icon" style="--color:#0866FF;">
                        <i class="lab la-facebook fs-3"></i>
                    </a>
                    <a href="https://wa.me/" target="_blank" class="me-3 icon" style="--color:#25D366;">
                        <i class="lab la-whatsapp fs-3"></i>
                    </a>
                    <a href="https://www.instagram.com/voyagersbeat/" target="_blank" class="me-3 icon" style="--color:#833AB4;">
                        <i class="lab la-instagram fs-3"></i>
                    </a>
                    <a href="https://www.youtube.com/@voyagersbeat2534" target="_blank" class="me-3 icon" style="--color:#ff0000;">
                        <i class="lab la-youtube fs-3"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <br>
    <div class="text-center">
        <a href="/">Home</a> |
        <a href="/about">About Us</a> |
        <a href="/destinations">Destinations</a> |
        <?php if ($isAdmin): ?>
            <a href="/dashboard">Dashboard</a> |
            <a href="/logout">Logout</a>
        <?php elseif ($isUser): ?>
            <a href="/account">Account</a> |
            <a href="/logout">Logout</a>
        <?php else: ?>
            <a href="/login">Login</a>
        <?php endif; ?>
    </div>
    <br>

    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center fw-bold">
                <p>&copy; <?php echo date("Y"); ?> <?= env('app.name') ?>. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center  fw-bold">
                <p><a href="https://bhardwaj.netlify.app/" class="text-decoration-none text-dark">Designed and Developed By</a> Abhishek</p>
            </div>
        </div>
    </div>
</footer>

<div class="offcanvas offcanvas-bottom" tabindex="-1" id="installOffcanvas" aria-labelledby="installOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="installOffcanvasLabel">Install Voyagers Beat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body text-center">
        <p>Install our app for faster booking and easy access to your trips!</p>
        <button class="btn btn-theme btn-voyager w-100 mt-2" id="installAppBtn">Install App</button>
        <br>
        <br>
    </div>
</div>
<script src="/js/appInstallPopup.js"></script>