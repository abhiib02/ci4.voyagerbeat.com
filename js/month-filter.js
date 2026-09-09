let month_filter = document.querySelector("#month_filter");
month_filter.addEventListener("change", (e) => {
  showSelectMonth(e.target.value);
});

let travel2_cards = document.querySelectorAll(".travel_card_new"),
  upcoming_months = [],
  month_to_card = [[], [], [], [], [], [], [], [], [], [], [], [], []];

function showSelectMonth(e) {
  for (i = 0; i < travel2_cards.length; i++)
    upcoming_months[i] = travel2_cards[i].querySelectorAll(".mon-pill");
  for (i = 0; i < upcoming_months.length; i++)
    for (let l = 0; l < upcoming_months[i].length; l++)
      "undefined" !== upcoming_months[i][l].innerText ||
        ((upcoming_months[i][l].innerText = "All"),
        console.log("Modified Array"));
  travel2_cards.forEach((e, l) => {
    ((upcoming_months[l] = e.querySelectorAll(".mon-pill")),
      e.classList.remove("hide"));
  });
  for (let n = 0; n < upcoming_months.length; n++)
    for (let t = 0; t < upcoming_months[n].length; t++) {
      let o = getMonthNumber(upcoming_months[n][t].innerText);
      null != o ? month_to_card[o].push(n) : month_to_card[0].push(n);
    }
  for (i = 0; i < travel2_cards.length; i++)
    -1 !== month_to_card[getMonthNumber(e)].indexOf(i) ||
      travel2_cards[i].classList.add("hide");
}
