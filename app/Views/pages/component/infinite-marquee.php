<?php

/**
 * @var array $Destinations
 */
?>
<?php
$eachArrCount = count($Destinations) / 3;
$firstArr = [];
$secondArr = [];
$thirdArr = [];
foreach ($Destinations as $index => $dest) {
    if ($index < ($eachArrCount * 1)) {
        array_push($firstArr, $dest);
    }
    if (($eachArrCount * 1) < $index && $index < ($eachArrCount * 2)) {
        array_push($secondArr, $dest);
    }
    if (($eachArrCount * 2) < $index && $index < ($eachArrCount * 3)) {
        array_push($thirdArr, $dest);
    }
}
?>
<style>
    .marquee-container {
        overflow: hidden;
        width: 100%;
    }

    .marquee {
        display: flex;
        width: max-content;
        animation: marquee-scroll 240s linear infinite;
        animation-direction: var(--direction, 'normal');

        &:hover {
            animation-play-state: paused;
        }
    }

    .marquee-track {
        display: flex;
        gap: 24px;
        padding: 0 12px;
    }

    @keyframes marquee-scroll {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    /* Text Marquee */
    .text-marquee {
        display: flex;
        gap: 48px;
    }

    .text-marquee-item {
        font-size: 3rem;
        letter-spacing: 0.05em;
        white-space: nowrap;
        color: var(--bg-color);
        -webkit-text-stroke: 3px black;
        paint-order: stroke fill;
        transition: all .3s ease;
        position: relative;
        width: min-content;
        padding-inline: 1rem;

        &:hover {
            -webkit-text-stroke: 3px black;
            color: var(--maincolor);
            text-shadow: none;
        }
    }

    .text-marquee-item {

        .text-marquee-image {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 10px;
            object-fit: cover;
            display: block;
            top: 50%;
            left: 50%;
            translate: -50% -200%;
            opacity: 0;
            transition: all .3s ease;
            mix-blend-mode: color;
            z-index: -1;

        }

        &:hover {
            .text-marquee-image {
                opacity: 1;
                translate: -50% -50%;
            }
        }

    }

    .text-marquee-separator {
        font-size: 4rem;
        color: var(--primary);
        opacity: 0.5;
    }
</style>

<div class="marquee-container">
    <div class="marquee marquee-slow">
        <div class="marquee-track text-marquee">
            <?php foreach ($firstArr as $index => $item): ?>
                <a href="/packages/<?= $item->LOCATION ?>" class="text-decoration-none">
                    <span class="text-marquee-item ">
                        <img class="text-marquee-image" loading="lazy" src="<?= str_replace("\n", "", gdriveImage($item->PACKAGE_IMAGE, 200)) ?>" alt="">
                        <?= $item->LOCATION ?>
                    </span>
                </a>
                <span class="text-marquee-separator">*</span>
            <?php endforeach; ?>
        </div>
        <div class="marquee-track text-marquee" aria-hidden="true">
            <?php foreach ($firstArr as $index => $item): ?>
                <a href="/packages/<?= $item->LOCATION ?>" class="text-decoration-none">
                    <span class="text-marquee-item ">
                        <img class="text-marquee-image" loading="lazy" src="<?= str_replace("\n", "", gdriveImage($item->PACKAGE_IMAGE, 200)) ?>" alt="">
                        <?= $item->LOCATION ?>
                    </span>
                </a>
                <span class="text-marquee-separator">*</span>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="marquee-container">
    <div class="marquee marquee-slow" style="--direction:reverse;">
        <div class="marquee-track text-marquee">
            <?php foreach ($secondArr as $index => $item): ?>
                <a href="/packages/<?= $item->LOCATION ?>" class="text-decoration-none">
                    <span class="text-marquee-item ">
                        <img class="text-marquee-image" loading="lazy" src="<?= str_replace("\n", "", gdriveImage($item->PACKAGE_IMAGE, 200)) ?>" alt="">
                        <?= $item->LOCATION ?>
                    </span>
                </a>
                <span class="text-marquee-separator">*</span>
            <?php endforeach; ?>
        </div>
        <div class="marquee-track text-marquee" aria-hidden="true">
            <?php foreach ($secondArr as $index => $item): ?>
                <a href="/packages/<?= $item->LOCATION ?>" class="text-decoration-none">
                    <span class="text-marquee-item ">
                        <img class="text-marquee-image" loading="lazy" src="<?= str_replace("\n", "", gdriveImage($item->PACKAGE_IMAGE, 200)) ?>" alt="">
                        <?= $item->LOCATION ?>
                    </span>
                </a>
                <span class="text-marquee-separator">*</span>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="marquee-container">
    <div class="marquee marquee-slow">
        <div class="marquee-track text-marquee">
            <?php foreach ($thirdArr as $index => $item): ?>
                <a href="/packages/<?= $item->LOCATION ?>" class="text-decoration-none">
                    <span class="text-marquee-item ">
                        <img class="text-marquee-image" loading="lazy" src="<?= str_replace("\n", "", gdriveImage($item->PACKAGE_IMAGE, 200)) ?>" alt="">
                        <?= $item->LOCATION ?>
                    </span>
                </a>
                <span class="text-marquee-separator">*</span>
            <?php endforeach; ?>
        </div>
        <div class="marquee-track text-marquee" aria-hidden="true">
            <?php foreach ($thirdArr as $index => $item): ?>
                <a href="/packages/<?= $item->LOCATION ?>" class="text-decoration-none">
                    <span class="text-marquee-item ">
                        <img class="text-marquee-image" loading="lazy" src="<?= str_replace("\n", "", gdriveImage($item->PACKAGE_IMAGE, 200)) ?>" alt="">
                        <?= $item->LOCATION ?>
                    </span>
                </a>
                <span class="text-marquee-separator">*</span>
            <?php endforeach; ?>
        </div>
    </div>
</div>