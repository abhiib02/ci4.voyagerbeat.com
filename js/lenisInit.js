 const lenis = new Lenis()
    // Works for #SearchBox, #LoginPopup and any future modal
    document.addEventListener('show.bs.modal', () => lenis.stop());

    document.addEventListener('hidden.bs.modal', () => {
        // only resume if no other modal is still open
        if (!document.querySelector('.modal.show')) lenis.start();
    });

    function raf(time) {
        lenis.raf(time)
        requestAnimationFrame(raf)
    }

    requestAnimationFrame(raf)