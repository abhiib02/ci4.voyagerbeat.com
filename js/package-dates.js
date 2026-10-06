////// Monthly Dates ////////
const dateElements = PackageDates.split(",");
const dateViewer = document.querySelector(".date-viewer");
const buttons = document.querySelectorAll("[data-index]");

const groupedDates = {};

// Group dates by month index
dateElements.forEach((element) => {
  const dateText = element;
  const onlyDate = dateText.split("|")[0].trim(); // Get the date part before '|'
  const DateSurcharge = dateText.split("|")[1]?.trim();
  const parts = onlyDate.split("/");
  const monthIndex = parseInt(parts[1]);

  if (!groupedDates[monthIndex]) {
    groupedDates[monthIndex] = [];
  }
  let dateWithSurcharge = {
    date: onlyDate,
    surcharge: DateSurcharge,
  };
  if (onlyDate != null) {
    groupedDates[monthIndex].push(dateWithSurcharge);
  }
});
// Enable available month buttons
Object.keys(groupedDates).forEach((monthIndex) => {
  if (buttons[monthIndex] != undefined) {
    buttons[monthIndex].removeAttribute("hidden");
  }
});

// Button click events
buttons.forEach((button, index) => {
  button.addEventListener("click", () => {
    // Animation
    dateViewer.classList.add("animate__fadeInUp");

    setTimeout(() => {
      dateViewer.classList.remove("animate__fadeInUp");
    }, 900);

    // Active button
    buttons.forEach((btn) => btn.classList.remove("active"));

    button.classList.add("active");
    button.removeAttribute("hidden");

    // Clear viewer
    dateViewer.innerHTML = "";

    // No dates for this month
    if (!groupedDates[index]) return;

    // Render dates
    groupedDates[index].forEach((data) => {
      let parts = data.date.split("/");

      parts[1] = getMonth(parts[1]);
      parts[3] = getMonth(parts[3]);

      const formattedDate = parts.join(" ");

      dateViewer.innerHTML += `
            <li class="list-group-item d-flex justify-content-between align-items-start date-anim">
                <div class="ms-2 me-auto">
                <div class="fw-bold">${formattedDate}</div>
                ${data.surcharge != 0 ? "Surcharge Cost : ₹" + data.surcharge : ""}
                </div>
            </li>
            `;
    });
  });
});
