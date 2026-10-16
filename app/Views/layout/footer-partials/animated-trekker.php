<style>
    .trekker {
        width: 100%;
        background-image: url(/assets/anim/road-mountains.svg);
        background-size: 192px;
        background-repeat: repeat-x;
        background-position: bottom;
    }

    .img-wrapper {
        width: 94px;
        overflow: clip;
        height: 100px;
        background: url(/assets/anim/trekker-illustration.gif);
        background-size: cover;
        background-position: 0px 0px;
        animation: walk 55s infinite linear;
        mix-blend-mode: darken;
    }

    @keyframes walk {
        0% {
            translate: calc(-100px);
        }

        100% {
            translate: calc(100vw + 100px);
        }
    }
</style>
<div class="trekker">
    <div class="img-wrapper">

    </div>
</div>