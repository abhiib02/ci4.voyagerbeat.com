// document.addEventListener(
//   "error",
//   function (e) {
//     const img = e.target;
//     if (img.tagName !== "IMG" || img.dataset.fallback) return;
//     img.dataset.fallback = "1"; // prevents loops
//     img.srcset = ""; // clear srcset if used
//     img.src = "/assets/img/vb-placeholder.png";
//   },
//   true,
// );
