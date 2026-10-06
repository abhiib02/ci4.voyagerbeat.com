const loader = document.getElementById("form-loader");
const title = document.getElementById("fl-title");
const message = document.getElementById("fl-message");

function showLoader(form) {
  title.textContent = form.dataset.loaderTitle || "Please wait...";
  message.textContent = form.dataset.loaderMessage || "";

  const steps = (form.dataset.loaderSteps || "").split("|").filter(Boolean);
  let i = 0;
  message.textContent = steps[0] || "";

  if (steps.length > 1) {
    timer = setInterval(() => {
      i = Math.min(i + 1, steps.length - 1); // stop on the last step
      message.textContent = steps[i];
    }, 1800);
  }
  loader.classList.add("show");
}

function hideLoader() {
  loader.classList.remove("show");
}

document.addEventListener("submit", function (e) {
  const form = e.target;
  if (e.defaultPrevented) return;
  if (form.dataset.submitting) {
    e.preventDefault();
    return;
  }
  form.dataset.submitting = "1";
  setTimeout(
    () =>
      form
        .querySelectorAll("[type=submit]")
        .forEach((b) => (b.disabled = true)),
    0,
  );
  showLoader(form);
});
