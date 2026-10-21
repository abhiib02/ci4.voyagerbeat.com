<link rel="stylesheet" href="/css/bg3dwall.css">
<section>

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
                    <div class="">
                        <div class="input-group mb-3 bg-white rounded-pill p-2" data-bs-toggle="modal" data-bs-target="#SearchBox">
                            <input type="text" class="form-control rounded-pill border-0" placeholder="Where do you want to go?" aria-label="Where do you want to go?" aria-describedby="button-addon2" readonly>
                            <button class="btn btn-theme btn-voyager rounded-pill" type="submit" role="button" id="search-explore">Explore</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


</section>




<script>
    let layers = document.querySelector('.layers');
    layers.addEventListener('mousemove', (e) => {
        let x = e.clientX - (window.innerWidth / 2);
        let y = e.clientY - (window.innerHeight / 2);
        layers.style.setProperty('--x', x);
        layers.style.setProperty('--y', y);
    })
</script>
<?php if ($PopupSwitch): ?>
    <?= view('pages/component/popupQueryForm') ?>
<?php endif; ?>