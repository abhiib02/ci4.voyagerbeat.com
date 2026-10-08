function runToast(message, status, duration) {
  let toast = document.createElement("div");
  toast.classList.add("eztoast");

  // checking any toast is on screen already
  if (localStorage.getItem("toast-count") == null) {
    localStorage.setItem("toast-count", "0");
  }

  document.body.appendChild(toast);

  // Increamenting based on previous toast
  let count = parseInt(localStorage.getItem("toast-count"));
  toast.dataset.count = count++;
  localStorage.setItem("toast-count", parseInt(count));

  let statusObject = {
    danger: "#dc3545",
    warning: "#ffc107",
    success: "#198754",
    info: "#0d6efd",
  };
  if (status) {
    toast.style.setProperty("--status", statusObject[status.toLowerCase()]);
  }
  if (duration) {
    toast.style.setProperty("--duration", duration);
  }
  toast.style.setProperty("--index", toast.dataset.count);
  toast.innerHTML = `<p>${message}</p>`;
  toast.classList.add("toast-show");
  toast.addEventListener("animationend", () => {
    document.body.removeChild(toast);
    localStorage.removeItem("toast-count");
  });
}
