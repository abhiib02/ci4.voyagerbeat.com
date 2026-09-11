const prevBtn = document.getElementById("carousel-prevBtn");
const nextBtn = document.getElementById("carousel-nextBtn");

function updateActiveCard(direction) {
  const activeCard = document.querySelector(
    ".carousel-card.carousel-card-active",
  );
  if (!activeCard) return;

  let targetCard = null;

  if (direction === "next") {
    targetCard = activeCard.nextElementSibling;
  } else if (direction === "prev") {
    targetCard = activeCard.previousElementSibling;
  }

  if (targetCard && targetCard.classList.contains("carousel-card")) {
    activeCard.classList.remove("carousel-card-active");
    targetCard.classList.add("carousel-card-active");
  }
}

nextBtn.addEventListener("click", () => updateActiveCard("next"));
prevBtn.addEventListener("click", () => updateActiveCard("prev"));
