document.querySelectorAll("form").forEach((form) => {
  form.addEventListener("submit", () => {
    document.getElementById("loader").classList.remove("hide");
  });
});
