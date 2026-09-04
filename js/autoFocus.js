document.addEventListener("shown.bs.modal", function (event) {
  const autofocusInput = event.target.querySelector("[autofocus]");
  if (autofocusInput) {
    autofocusInput.focus();
  }
});
