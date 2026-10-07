(function () {
  if (window.PageBar) return; // guard against double execution

  var bar = document.createElement("div");
  bar.id = "pbar";
  document.documentElement.appendChild(bar); // <body> may not exist yet

  var progress = 0,
    active = false,
    trickleTimer,
    hideTimer,
    pending = 0;

  function set(n) {
    progress = n;
    bar.style.transform = "scaleX(" + n + ")";
  }

  function trickle() {
    var inc =
      progress < 0.2
        ? 0.1
        : progress < 0.5
          ? 0.04
          : progress < 0.8
            ? 0.02
            : progress < 0.99
              ? 0.005
              : 0;
    set(Math.min(progress + inc, 0.99));
  }

  function start() {
    if (active) return;
    active = true;
    clearTimeout(hideTimer);
    clearInterval(trickleTimer);
    bar.style.transition = "none"; // reset instantly
    bar.style.opacity = "1";
    set(0);
    void bar.offsetWidth; // force reflow
    bar.style.transition = "";
    set(0.08);
    trickleTimer = setInterval(trickle, 200);
  }

  function done() {
    if (!active) return;
    active = false;
    clearInterval(trickleTimer);
    set(1);
    hideTimer = setTimeout(function () {
      bar.style.opacity = "0";
    }, 200);
  }

  window.PageBar = { start: start, done: done };

  // Page is loading right now
  start();
  window.addEventListener("load", done);
  window.addEventListener("pageshow", done); // back/forward cache restores

  // Leaving the page via link
  document.addEventListener("click", function (e) {
    if (e.defaultPrevented || e.button !== 0) return;
    if (e.ctrlKey || e.metaKey || e.shiftKey || e.altKey) return;
    var a = e.target.closest && e.target.closest("a[href]");
    if (!a) return;
    if (a.target === "_blank" || a.hasAttribute("download")) return;
    if (a.origin !== location.origin) return;
    if (
      a.pathname === location.pathname &&
      a.search === location.search &&
      (a.hash || a.href === location.href + "#")
    )
      return; // in-page anchors
    if (/^(javascript|mailto|tel):/i.test(a.getAttribute("href"))) return;
    start();
  });

  // Leaving the page via form
  document.addEventListener("submit", function (e) {
    if (!e.defaultPrevented) start();
  });

  // Optional: show the bar for fetch() calls too (filters, load more, etc.)
  var origFetch = window.fetch;
  if (origFetch) {
    window.fetch = function () {
      pending++;
      start();
      return origFetch.apply(this, arguments).finally(function () {
        if (--pending === 0) done();
      });
    };
  }
})();
