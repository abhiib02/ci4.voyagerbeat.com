/**
 * costing-sidebar.js
 *
 * Expects, loaded BEFORE this file:
 *   - /js/util-script.js  (provides getSharingTermNumber() and stripTags())
 *   - window.COSTING_CONFIG = {
 *       packageId: number,
 *       advance:   number,   // advance booking amount, 0 = hide "Pay Advance"
 *       loggedIn:  boolean,
 *       costing:   [{ value, label, "<price heading>": "<price>", ... }, ...]
 *     }
 *
 * Expects these elements in the page:
 *   #sharingOptions, #priceOptions, #output
 */
(function () {
  "use strict";

  const config = window.COSTING_CONFIG;
  if (!config || !Array.isArray(config.costing) || config.costing.length === 0) {
    return;
  }

  const { packageId, advance, loggedIn, costing } = config;
  const GST_RATE = 0.05;

  const sharingDiv = document.getElementById("sharingOptions");
  const priceDiv = document.getElementById("priceOptions");
  const outputDiv = document.getElementById("output");
  if (!sharingDiv || !priceDiv || !outputDiv) return;

  // Price rows for the currently selected sharing option: [{ key, price }]
  let currentPrices = [];

  /* ------------------------------------------------------------------ */
  /* Helpers                                                            */
  /* ------------------------------------------------------------------ */

  // "Quad (4 persons in 1 room)" -> { title: "Quad", subtitle: "4 persons in 1 room" }
  function parseLabel(label) {
    const match = label.match(/^([^\s]+).*\(([^)]+)\)/);
    return {
      title: match ? match[1] : label,
      subtitle: match ? match[2] : label,
    };
  }

  function bedDots(count) {
    return '<span class="bed-dot"></span>'.repeat(count);
  }

  // Price headings may contain "<br>", e.g. "Ex Delhi<br>By Train".
  // The button shows only the part after the break.
  function priceButtonText(key) {
    return key.split("<br>")[1] ?? key;
  }

  function bookingLink() {
    return loggedIn
      ? `href="/book/${packageId}"`
      : 'href="#" data-bs-toggle="modal" data-bs-target="#LoginPopup"';
  }

  /* ------------------------------------------------------------------ */
  /* Templates                                                          */
  /* ------------------------------------------------------------------ */

  function sharingOptionHTML(item, index) {
    const { title, subtitle } = parseLabel(item.label);
    const beds = getSharingTermNumber(item.label.split(" ")[0].toLowerCase());
    const checked = index === 0 ? "checked" : "";

    return `
      <label class="btn btn-outline-voyagers cost-sidebar-radio flex-fill ">
        <span>${title}</span>
        <!--<br>
        ${bedDots(beds)}-->
        <br>
        <input type="radio" name="sharing" value="${index}" ${checked}>
        <span class="">${subtitle}</span>
      </label>`;
  }

  function priceOptionHTML(row, index) {
    const checked = index === 0 ? "checked" : "";

    return `
      <label class="btn btn-outline-voyagers cost-sidebar-radio flex-fill">
        <i class="bx bx-transfer-alt text-theme"></i>
        <input type="radio" name="pricing" value="${index}" ${checked}>
        ${priceButtonText(row.key)}
      </label>`;
  }

  function summaryHTML(label, cost, gst, total) {
    return `
      <em>Costing summary</em>
      <div class="pt-2">
        <p class="d-flex justify-content-between m-0 pb-2 tiny-text">
          <span class="text-secondary">${label}</span>
          <span class="fw-bold">₹${cost}</span>
        </p>
        <p class="d-flex justify-content-between m-0 pb-2  tiny-text">
          <span class="text-secondary">GST @ ${GST_RATE * 100}%</span>
          <span class="fw-bold">₹${gst}</span>
        </p>
        <p class="d-flex justify-content-between m-0 pb-2  tiny-text">
          <span class="text-secondary">Total per person</span>
          <span class="fw-bold">₹${total}</span>
        </p>
      </div>`;
  }

  function payButtonHTML(caption, amount, btnClass) {
    return `
      <a ${bookingLink()} class="card btn ${btnClass} px-2 flex-fill tiny-text">
        <div>
          <span class="text-secondary">${caption}</span>
          <span class="fw-bold">₹${amount}</span>
        </div>
      </a>`;
  }

  function payButtonsHTML(total) {
    const full = payButtonHTML("Pay Full", total, "btn-theme-2 btn-voyager tiny-text");
    const adv =
      Number(advance) === 0
        ? ""
        : payButtonHTML("Pay Advance", advance, "btn-outline-dark");

    return `<div class="d-flex justify-content-between py-1 gap-2">${full}${adv}</div>`;
  }

  /* ------------------------------------------------------------------ */
  /* Rendering                                                          */
  /* ------------------------------------------------------------------ */

  function renderSharing() {
    sharingDiv.innerHTML = costing.map(sharingOptionHTML).join("");
  }

  function renderPrices(sharingIndex) {
    const item = costing[sharingIndex];
    if (!item) return;

    currentPrices = Object.keys(item)
      .filter((key) => key !== "value" && key !== "label")
      .map((key) => ({ key, price: item[key] }));

    priceDiv.innerHTML = currentPrices.map(priceOptionHTML).join("");
    updateOutput();
  }

  function updateOutput() {
    const checked = priceDiv.querySelector('input[name="pricing"]:checked');
    const row = checked ? currentPrices[Number(checked.value)] : null;

    if (!row) {
      outputDiv.innerHTML = "";
      return;
    }

    const cost = Number(row.price);
    const gst = Math.round(cost * GST_RATE);
    const total = Math.round(cost + gst);

    outputDiv.innerHTML =
      summaryHTML(stripTags(row.key), cost, gst, total) + payButtonsHTML(total);
  }

  /* ------------------------------------------------------------------ */
  /* Init                                                               */
  /* ------------------------------------------------------------------ */

  sharingDiv.addEventListener("change", (e) => {
    renderPrices(Number(e.target.value));
  });
  priceDiv.addEventListener("change", updateOutput);

  renderSharing();
  renderPrices(0);
})();