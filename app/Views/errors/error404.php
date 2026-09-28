<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <?= view('layout/header-partials/header-function') ?>
    <?= view('layout/header-partials/meta-tags') ?>
    <?= view('layout/header-partials/stylesheets') ?>

</head>

<body>

    <!-- As a heading -->
    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="<?= env('app.LogoPath') ?>" alt="Bootstrap" width="50px" height="auto">
            </a>
            <h4>Voyager Beat</h4>
        </div>
    </nav>
    <style>
        .top-layer {
            position: relative;
            z-index: 2;
        }

        .layers-container {
            position: fixed;
            width: 100%;
            height: 100vh;
            top: 0;
            left: 0;
            z-index: 1;
        }

        .layers {
            position: relative;
            width: 100%;
            height: 100vh;
        }

        .layer {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .custom-bg {
            background: var(--url);
            background-size: cover;
            background-repeat: repeat-x;
            background-position: calc(var(--x) * var(--y, 1) * 1px);
            animation: x-val 300s linear infinite;
        }

        @keyframes x-val {
            0% {
                background-position: calc(var(--x, 0) * var(--mul, 1) * 1px);
            }

            100% {
                background-position: calc(var(--x, -1920000) * var(--mul, 1) * 1px);
            }
        }
    </style>
    <div class="top-layer">
        <div class="full-vh grid-center custom-bg">
            <div class="text-center text-shadow">
                <p class="huge-text text-center">
                    <span class="firstColor">4</span>
                    <span class="secondColor">0</span>
                    <span class="thirdColor">4</span>
                </p>
                <h1 class="big-heading text-light">You Found a location where no body stop</h1>
                <br>
                <a href="/" class="btn btn-lg btn-voyager">Back to Home</a>
            </div>
        </div>
    </div>
    <div class="layers-container">
        <div class="layers">
            <div class="layer custom-bg" style="--url:url('/assets/not-found/lbottom.png'); --mul:0;"></div>
            <div class="layer custom-bg" style="--url:url('/assets/not-found/l7.png'); --mul:0;"></div>
            <div class="layer custom-bg" style="--url:url('/assets/not-found/l6.png');--mul:0.001;"></div>
            <div class="layer custom-bg" style="--url:url('/assets/not-found/l5.png');--mul:0.001;"></div>
            <div class="layer custom-bg" style="--url:url('/assets/not-found/l4.png');--mul:0.0015;"></div>
            <div class="layer custom-bg" style="--url:url('/assets/not-found/l3.png');--mul:0.02;"></div>
            <div class="layer custom-bg" style="--url:url('/assets/not-found/l2.png');--mul:0.025;"></div>
            <div class="layer custom-bg" style="--url:url('/assets/not-found/l1.png');--mul:0.035;"></div>
            <div class="layer custom-bg" style="--url:url('/assets/not-found/l0.png');--mul:0.045;"></div>
        </div>
    </div>


    <!-- Global Components -->
    <?= view('layout/footer-partials/js-scripts') ?>
    <?php if (isset($_SESSION['FlashMessage'])) : ?>
        <script>
            runToast('<?= $_SESSION['FlashMessage']['message'] ?>', '<?= $_SESSION['FlashMessage']['status'] ?>');
        </script>
    <?php endif; ?>
    </main>
</body>

</html>