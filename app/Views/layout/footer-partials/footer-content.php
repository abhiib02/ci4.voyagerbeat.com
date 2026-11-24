<div>
    <div class="hide-on-mobile">
        <?= view('layout/footer-partials/animated-trekker'); ?>
    </div>
    <footer class="bg-black text-white py-3 no-print hide-on-mobile">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 ">
                    <p class="text-theme fs-4 m-0">Address</p>
                    <p class="text-theme fs-5 m-0">Head Office</p>
                    <address>2nd Floor, C 2/13, Phase 2, Ashok Vihar, Delhi, 110052 </address>
                    <p class="text-theme fs-5 m-0">Branch Office</p>
                    <address>H7, 210 2nd Floor, Aggrawal Plaza Netaji Subhash Place, Delhi 110033</address>
                </div>
                <div class="col-lg-3">
                    <p class="text-theme fs-4">Contact Us</p>
                    <ul class="list-unstyled">
                        <li class="p-2"><a aria-label="Call Destination Expert" class="text-light" href="tel:+919667711660">+91 9667711660</a></li>
                        <li class="p-2"><a aria-label="Call Destination Expert" class="text-light" href="tel:+919667711662">+91 9667711662</a></li>
                        <li class="p-2"><a aria-label="Call Destination Expert" class="text-light" href="tel:+918448591315">+91 8448591315</a></li>
                        <li class="p-2"><a aria-label="Call Destination Expert" class="text-light" href="tel:+919266352828">+91 9266352828</a></li>
                        <li class="p-2"><a class="text-light" href="mailto:info@voyagersbeat.com">info@voyagersbeat.com</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <p class="text-theme fs-4 m-0">Resource</p>
                    <ul class="list-unstyled">
                        <li class="p-2"><a aria-label="open privacy Policy" class="text-light" href="/privacy-policy">Privacy Policy</a> </li>
                        <li class="p-2"><a aria-label="open terms & condition" class="text-light" href="/term-conditions">Terms and Conditions</a></li>
                        <li class="p-2"><a aria-label="open write for us" class="text-light" href="/blogs/write-for-us">Write for Us</a></li>
                        <!-- <li><a class="text-light" data-bs-toggle="modal" data-bs-target="#cancellationModal">Cancellation Policy</a></li> -->
                        <li class="p-2"><a aria-label="open Cancellation Policy" class="text-light" href="/cancellation-policy">Cancellation Policy</a></li>
                        <li class="p-2"><a aria-label="open Sitemap" class="text-light" href="/sitemap.xml">Sitemap</a></li>
                        <li class="p-2"><a aria-label="open Blogs" class="text-light" href="/blogs">Blogs</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <p class="text-theme fs-4 m-0">Important Links</p>
                    <ul class="list-unstyled">
                        <li class="p-2"><a aria-label="open Introduction" class="text-light" href="/about">Introduction</a></li>
                        <li class="p-2"><a aria-label="open Career Page" class="text-light" href="/career">Join the team</a></li>
                        <li class="p-2"><a aria-label="open Who We are?" class="text-light" href="/about">Who are we?</a></li>
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