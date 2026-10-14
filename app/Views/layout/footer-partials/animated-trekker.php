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
        background: url(/assets/anim/trekker.gif);
        background-size: cover;
        background-position: -38px 0px;
        animation: walk 35s infinite linear;
        filter: brightness(0);
    }

    @keyframes walk {
        0% {
            translate: 0%;
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