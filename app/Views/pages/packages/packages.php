<?php if (count($packages) > 0) : ?>
    <div class="container-fluid py-5 bg-black text-light">
        <div class="container py-5 text-center">
            <h1 class="huge-heading text-capitalize "><?= isset($name) ? $name : 'All '; ?> Packages</h1>
            <?php if (isset($meta_desc)): ?><p><?= $meta_desc; ?></p><?php endif; ?>
        </div>
    </div>
<?php endif; ?>
<div class="seperator"></div>
<section class="">
    <div class="container  my-2">
        <div class="flex_wrap_section">
            <?php if (count($packages) > 0) : ?>
                <?php foreach ($packages as $package) : ?>
                    <?= view('pages/component/packageCard', ['package' => $package]) ?>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="vh100 center overflow-clip relative">

                    <?php if (isset($pageBannerText)) : ?>
                        <h1 class="big-heading style-text-theme">Currently No Packages Found</h1>
                    <?php else : ?>
                        <h1 class="big-heading style-text-theme">No Packages Found</h1>
                    <?php endif; ?>
                    <br>
                    <a href="/" class="btn btn-lg btn-dark">Back to Home</a>




                </div>
            <?php endif; ?>
        </div>
    </div>
</section>