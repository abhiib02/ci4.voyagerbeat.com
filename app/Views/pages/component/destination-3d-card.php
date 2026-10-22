<a class="card-3d-perspective" href="<?= $destination['link'] ?? '#' ?>">
    <div class="card-3d">
        <img class="layer l1" src="<?= $destination['image_l1'] ?? '../../assets/dest_int/tashkent.webp?v=2' ?>" alt="">
        <img class="layer l2" src="<?= $destination['image_l2'] ?? '../../assets/dest_int/tashkent-3d.webp?v=2' ?>" alt="">
        <div class="card-3d-text">
            <?= $destination['name'] ?? 'No Title' ?> </div>
    </div>
</a>