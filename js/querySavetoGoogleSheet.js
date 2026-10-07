const scriptURL_Package =
  "https://script.google.com/macros/s/AKfycbyrS0rb1L01QBB0tANsDdnmX3x5UyJaxlcdIaBkmsmVjEhyACweSl9xdHZSuDP4YgFO/exec";

document
  .getElementById("package-form")
  .addEventListener("submit", function (e) {
    e.preventDefault();

    // var elemento = document.querySelector('#thankyou_modal');
    // var instance = M.Modal.getInstance(elemento);

    const status = document.querySelector('[role="status"]');
    const spinner = document.querySelector(".spinner-border");
    spinner.removeAttribute("hidden");

    const formData = new FormData(this);
    const data = {};

    formData.forEach((value, key) => {
      data[key] = value;
    });
    if (data["human"] !== "") {
      // If the human field is filled, it's likely a bot
      return;
    } else {
      fetch(scriptURL_Package, {
        method: "POST",
        body: JSON.stringify(data),
      })
        .then((response) => response.json())
        .then((result) => {
          spinner.setAttribute("hidden", "");
          status.textContent = "Query Submitted Successfully";
          document.getElementById("package-form").innerHTML =
            `<div class="alert alert-success" role="alert">Query Submitted Successfully</div>`;
        })
        .catch((error) => {
          spinner.setAttribute("hidden", "");
          status.textContent = "Some Error Occured";
          document.getElementById("package-form").reset();
        });
    }
  });
