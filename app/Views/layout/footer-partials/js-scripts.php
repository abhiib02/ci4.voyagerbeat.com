<script src="/js/ImgPlaceholder.js" defer></script>
<script src="https://unpkg.com/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous" defer></script>
<script src="/js/util-script.js" defer></script>
<script src="/js/formSubmittingLoader.js" defer></script>
<script src="/js/eztoast.js" defer></script>
<script src="/js/autoFocus.js" defer></script>
<script src="/js/add_to_favorite.js" defer></script>
<script src="/js/downloadPDF.js" defer></script>
<script src="/js/dialogScript.js" defer></script>
<!-- Swiper JS -->
<script src="https://unpkg.com/swiper@14.0.1/swiper-bundle.min.js" defer></script>
<script src="/js/swiperInit.js" defer></script>

<script src="/js/pageProgress.js" defer></script>


<noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=1518876064819476&ev=PageView&noscript=1" /></noscript>
<script>
    (function() {
        var loaded = false;

        function loadTrackers() {
            if (loaded) return;
            loaded = true;

            // Google tag
            var g = document.createElement('script');
            g.src = 'https://www.googletagmanager.com/gtag/js?id=G-45Y01Q8SRL';
            g.async = true;
            document.head.appendChild(g);
            window.dataLayer = window.dataLayer || [];
            window.gtag = function() {
                dataLayer.push(arguments);
            };
            gtag('js', new Date());
            gtag('config', 'G-45Y01Q8SRL');

            // Facebook Pixel: paste your existing pixel snippet here


            ! function(f, b, e, v, n, t, s) {
                if (f.fbq) return;
                n = f.fbq = function() {
                    n.callMethod ?
                        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq) f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '1518876064819476');
            fbq('track', 'PageView');

        }

        ['scroll', 'mousemove', 'touchstart', 'keydown'].forEach(function(e) {
            window.addEventListener(e, loadTrackers, {
                once: true,
                passive: true
            });
        });
        window.addEventListener('load', function() {
            setTimeout(loadTrackers, 4000);
        });
    })();
</script>