let deferredPrompt;

// Detect iOS devices
const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;

// Check if app is already running as an installed PWA
const isStandalone =
  window.navigator.standalone ||
  window.matchMedia("(display-mode: standalone)").matches;

// 1. iOS FLOW (Show manual instructions)
window.addEventListener("DOMContentLoaded", () => {
  const hasBeenShown = sessionStorage.getItem("pwaInstallPromptShown");

  if (isIOS && !isStandalone && !hasBeenShown) {
    const installInstructions = document.getElementById("installInstructions");
    const installBtn = document.getElementById("installAppBtn");

    // Replace text with iOS specific instructions
    installInstructions.innerHTML = `
      <p class="mb-2">To install <strong>Voyagers Beat</strong> on your iPhone:</p>
      <ol class="text-start ms-3 me-3 small">
        <li>Tap the <strong>Share</strong> icon (square with arrow pointing up) at the bottom of Safari.</li>
        <li>Scroll down the menu and tap <strong>Add to Home Screen</strong>.</li>
      </ol>
    `;

    // Hide the native install button because iOS cannot trigger it
    installBtn.style.display = "none";

    // Open the offcanvas
    const offcanvasElement = document.getElementById("installOffcanvas");
    const bsOffcanvas = new bootstrap.Offcanvas(offcanvasElement);
    bsOffcanvas.show();

    sessionStorage.setItem("pwaInstallPromptShown", "true");
  }
});

// 2. ANDROID / DESKTOP FLOW (Use native prompt)
window.addEventListener("beforeinstallprompt", (e) => {
  e.preventDefault();
  deferredPrompt = e;

  const hasBeenShown = sessionStorage.getItem("pwaInstallPromptShown");

  if (!hasBeenShown) {
    const offcanvasElement = document.getElementById("installOffcanvas");
    const bsOffcanvas = new bootstrap.Offcanvas(offcanvasElement);
    bsOffcanvas.show();
    sessionStorage.setItem("pwaInstallPromptShown", "true");
  }
});

// Install button click handler for Android / Desktop
document.getElementById("installAppBtn").addEventListener("click", async () => {
  if (deferredPrompt) {
    deferredPrompt.prompt();
    const { outcome } = await deferredPrompt.userChoice;
    deferredPrompt = null;

    const offcanvasElement = document.getElementById("installOffcanvas");
    const bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvasElement);
    if (bsOffcanvas) {
      bsOffcanvas.hide();
    }
  }
});
