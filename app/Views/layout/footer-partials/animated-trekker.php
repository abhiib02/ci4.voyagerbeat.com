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
        <lord-icon
            src="/assets/anim/wired-flat-661-person-hiking.json"
            trigger="loop"
            style="width: 100px; height: 100px;">
        </lord-icon>
    </div>
</div>
<script src="https://cdn.lordicon.com/lordicon.js"></script>