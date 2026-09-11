function getMonth(n) {
  return [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "May",
    "Jun",
    "Jul",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec",
  ][n - 1];
}

function getMonthNumber(n) {
  const months = {
    Jan: 1,
    Feb: 2,
    Mar: 3,
    Apr: 4,
    May: 5,
    Jun: 6,
    Jul: 7,
    Aug: 8,
    Sep: 9,
    Oct: 10,
    Nov: 11,
    Dec: 12,
  };

  return months[n] || null;
}

function getSharingTermNumber(Term) {
  const SharingTerm = {
    quad: 4,
    triple: 3,
    double: 2,
  };

  return SharingTerm[Term] || 1;
}

function stripTags(htmlString) {
  const tempDiv = document.createElement("div");
  tempDiv.innerHTML = htmlString;
  return tempDiv.textContent || tempDiv.innerText || "";
}
