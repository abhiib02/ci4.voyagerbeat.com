    <?php

    /**
     * @var array $similarPackages
     */
    ?>
    <style>
        :root {
            --SimilarCardHeight: calc(1.44 * 235px);
            --SimilarCardWidth: 100px
        }

        .carousel-cards-stack {
            position: relative;
            perspective: 150vw;
            perspective-origin: center;
            height: calc(2rem + var(--SimilarCardHeight));
            width: 100%;
        }

        .carousel-card {
            position: absolute;
            transform-style: preserve-3d;
            transition: all 1s ease;
            background: white;
            opacity: 0;
        }

        .carousel-card:has(+.carousel-card +.carousel-card +.carousel-card-active) {
            transform: translateX(600px) rotateY(45deg);
            opacity: 0;
            scale: 1;
            z-index: 1;
        }

        .carousel-card:has(+.carousel-card +.carousel-card-active) {
            transform: translateX(400px) rotateY(45deg);
            opacity: 0;
            scale: 1;
            z-index: 1;
        }

        .carousel-card:has(+.carousel-card-active) {
            transform: translateX(200px) rotateY(30deg);
            opacity: 1;
            scale: 1;
            z-index: 2;
        }

        .carousel-card-active {
            opacity: 1;
            scale: 1.1;
            z-index: 3;
        }

        .carousel-card-active+.carousel-card {
            transform: translateX(-200px) rotateY(-30deg);
            opacity: 1;
            scale: 1;
            z-index: 2;
        }

        .carousel-card-active+.carousel-card+.carousel-card {
            transform: translateX(-400px) rotateY(-45deg);
            opacity: 0;
            scale: 1;
            z-index: 1;
        }

        .carousel-card-active+.carousel-card+.carousel-card+.carousel-card {
            transform: translateX(-600px) rotateY(-45deg);
            opacity: 0;
            scale: 1;
            z-index: 1;
        }
    </style>
    <div class="carousel-cards-stack grid-center">
        <?php foreach ($similarPackages as $index => $similarpackage): ?>
            <div class="carousel-card outline-card <?= ($index == 3) ? 'carousel-card-active' : '' ?>">
                <?= view('pages/component/packageCardSimple', ['package' => $similarpackage]) ?>
            </div>
        <?php endforeach; ?>
    </div>