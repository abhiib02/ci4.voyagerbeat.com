<script src="/js/ImgPlaceholder.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="/js/util-script.js"></script>
<script src="/js/formSubmittingLoader.js"></script>
<script src="/js/eztoast.js"></script>
<script src="/js/autoFocus.js"></script>
<script src="/js/add_to_favorite.js"></script>
<script src="/js/downloadPDF.js"></script>
<script src="/js/dialogScript.js"></script>
<script src="https://unpkg.com/lenis@1.1.2/dist/lenis.min.js"></script>

<script>
    const lenis = new Lenis()
    // Works for #SearchBox, #LoginPopup and any future modal
    document.addEventListener('show.bs.modal', () => lenis.stop());

    document.addEventListener('hidden.bs.modal', () => {
        // only resume if no other modal is still open
        if (!document.querySelector('.modal.show')) lenis.start();
    });
    lenis.on('scroll', (e) => {

    })

    function raf(time) {
        lenis.raf(time)
        requestAnimationFrame(raf)
    }

    requestAnimationFrame(raf)
</script>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@14.0.1/swiper-bundle.min.js"></script>
<script src="/js/swiperInit.js"></script>