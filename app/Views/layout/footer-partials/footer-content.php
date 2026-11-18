<div>
    <div class="hide-on-mobile">
        <?= view('layout/footer-partials/animated-trekker'); ?>
    </div>
    <footer class="bg-black text-white py-3 no-print hide-on-mobile">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 ">
                    <h4 class="text-theme">Address</h4>
                    <h5>Head Office</h5>
                    <address>2nd Floor, C 2/13, Phase 2, Ashok Vihar, Delhi, 110052 </address>
                    <h5>Branch Office</h5>
                    <address>H7, 210 2nd Floor, Aggrawal Plaza Netaji Subhash Place, Delhi 110033</address>
                </div>
                <div class="col-lg-3">
                    <h4 class="text-theme">Contact Us</h4>
                    <ul class="list-unstyled">
                        <li><a class="text-light" href="tel:+919667711660">+91 9667711660</a></li>
                        <li><a class="text-light" href="tel:+919667711662">+91 9667711662</a></li>
                        <li><a class="text-light" href="tel:+918448591315">+91 8448591315</a></li>
                        <li><a class="text-light" href="tel:+919266352828">+91 9266352828</a></li>
                        <li><a class="text-light" href="mailto:info@voyagersbeat.com">info@voyagersbeat.com</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4 class="text-theme">Resource</h4>
                    <ul class="list-unstyled">
                        <li><a class="text-light" href="/privacy-policy">Privacy Policy</a> </li>
                        <li><a class="text-light" href="/term-conditions">Terms and Conditions</a></li>
                        <li><a class="text-light" href="/blogs/write-for-us">Write for Us</a></li>
                        <!-- <li><a class="text-light" data-bs-toggle="modal" data-bs-target="#cancellationModal">Cancellation Policy</a></li> -->
                        <li><a class="text-light" href="/cancellation-policy">Cancellation Policy</a></li>
                        <li><a class="text-light" href="/sitemap.xml">Sitemap</a></li>
                        <li><a class="text-light" href="/blogs">Blogs</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4 class="text-theme">Important Links</h4>
                    <ul class="list-unstyled">
                        <li><a class="text-light" href="/about">Introduction</a></li>
                        <li><a class="text-light" href="/career">Join the team</a></li>
                        <li><a class="text-light" href="/about">Who are we?</a></li>
                        <?= view('layout/footer-partials/role-based-navigation') ?>
                    </ul>
                </div>
            </div>
        </div>
        <hr>
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center fw-bold">
                    <p>&copy; <?= date("Y"); ?> <?= env('app.name') ?>. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center  fw-bold">
                    <p><a href="https://bhardwaj.netlify.app/" class="text-decoration-none text-white">Designed and Developed By</a> <a href="https://www.maplecomputers.in/">Maple Computers</a></p>
                </div>
            </div>
        </div>
    </footer>
</div>