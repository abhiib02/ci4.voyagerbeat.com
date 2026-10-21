<link rel="stylesheet" href="/css/bg3dwall.css">
<link rel="stylesheet" href="/css/home.css">
<section id="hero">

    <div class="perspective">
        <div class="img-cylinder" id="img-cylinder-home">
            <?php foreach ($AllPackagesNameAndID ?? [] as $index => $Package): ?>
                <?php if ($index < 90): ?>
                    <img class="image" style="--i:<?= $index ?>" src="<?= $Package->PACKAGE_IMAGE ?>" alt="" width="256" height="256" decoding="async" fetchpriority="low" loading="lazy">
                <?php endif; ?>
            <?php endforeach; ?>

        </div>
        <div class="overlayLayer"></div>
        <div class="content">
            <div class="grid-center text-white">
                <div class="text-center">
                    <p>EXPLORE • EXPERIENCE • ESCAPE</p>
                    <h1 class="display-2">Pack your <span class="style-font display-1 text-warning">Bags</span><br> Let us do the <span class="style-font display-1text-warning">Rest</span></h1>
                    <p>From weekend getaways to unforgettable adventures, <br>discover handpicked trips designed to make your next journey effortless.</p>
                    <div class="d-flex">
                        <div class="input-group mb-3 bg-white rounded-pill p-2" data-bs-toggle="modal" data-bs-target="#SearchBox">
                            <input type="text" class="form-control rounded-pill border-0" placeholder="Where do you want to go?" aria-label="Where do you want to go?" aria-describedby="button-addon2" readonly>
                            <button class="btn btn-theme btn-voyager rounded-pill" type="submit" role="button" id="search-explore">Explore</button>
                        </div>
                    </div>
                </div>
                <em>Since 2016 · 70,000+ travellers · 4.6★ Google · 45K Happy Travelers · 300+ itineraries.</em>
            </div>

        </div>

    </div>


</section>
<section id="explore" class="py-5">
    <div class="container py-5">
        <div class="">
            <h1 class="display-3"><span>Explore</span><span class="style-font "> Voyagers Beat</span> </h1>
            <p>
                Many ways to travel with us, from weekend escapes to long expeditions in Spiti Mountains.
            </p>
        </div>
        <div class="explore-container">
            <div class="Weekend"></div>
            <div class="Bike"></div>
            <div class="Treks"></div>
            <div class="Party"></div>
            <div class="Backpacking"></div>
            <div class="Family"></div>
            <div class="Honeymoon"></div>
            <div class="Corporate"></div>
        </div>
    </div>

</section>
<?php if ($PopupSwitch): ?>
    <?= view('pages/component/popupQueryForm') ?>
<?php endif; ?>