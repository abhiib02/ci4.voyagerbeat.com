<footer class="bg-light py-3 no-print hide-on-mobile">
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
        <?= view('layout/footer-partials/role-based-navigation') ?>

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