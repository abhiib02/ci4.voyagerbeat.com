<?php if (count($packages) > 0) : ?>
    <div class="container-fluid pt-5 bg-black text-light">
        <div class="container py-5 text-center">
            <h1 class="huge-heading text-capitalize "><?= isset($name) ? $name : 'All '; ?> Packages</h1>
            <?php if (isset($meta_desc)): ?><p><?= $meta_desc; ?></p><?php endif; ?>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-sm btn-outline-light" disabled><?= $TotalPackageCount ?> Packages</button>
                &nbsp;
                <button type="button" class="btn btn-sm btn-outline-light showFav" onclick="showFavOnly()"><i class="bx bxs-heart text-red"></i> Show Favorites</button>
                &nbsp;
                <a href="/travelerFavorites" type="button" class="btn btn-sm btn-outline-light">Traveler Favorites</a>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="seperator"></div>
<section class="">
    <div class="container">
        <div class="py-3">
            <label>Filter by Month</label>
            <select class="form-select " name="Month" id="month_filter">
                <option value="All">All</option>
                <option value="Jan">January</option>
                <option value="Feb">February</option>
                <option value="Mar">March</option>
                <option value="Apr">April</option>
                <option value="May">May</option>
                <option value="Jun">June</option>
                <option value="Jul">July</option>
                <option value="Aug">August</option>
                <option value="Sep">September</option>
                <option value="Oct">October</option>
                <option value="Nov">November</option>
                <option value="Dec">December</option>
            </select>
        </div>
        <div class="flex_wrap_section ">
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
        <!-- Pagination Links -->
        <?php if (isset($pager)): ?>
            <div class="pagination">
                <?= $pager->links() ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<script src="/js/month-filter.js"></script>