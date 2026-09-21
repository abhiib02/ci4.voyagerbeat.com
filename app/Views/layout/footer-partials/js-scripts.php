<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="/js/util-script.js"></script>
<script src="/js/eztoast.js"></script>
<script src="/js/autoFocus.js"></script>
<script src="/js/ImgPlaceholder.js"></script>
<script src="/js/add_to_favorite.js"></script>
<script src="/js/downloadPDF.js"></script>
<script src="https://unpkg.com/lenis@1.1.2/dist/lenis.min.js"></script>
<script>
    const lenis = new Lenis()

    lenis.on('scroll', (e) => {

    })

    function raf(time) {
        lenis.raf(time)
        requestAnimationFrame(raf)
    }

    requestAnimationFrame(raf)
</script>