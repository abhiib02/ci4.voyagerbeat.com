const observer = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        whatsappBtn.classList.add("wobble-hor-bottom");
        callBtn.classList.add("wobble-hor-bottom");
        whatsappBtn.classList.add("active");
        callBtn.classList.add("active");
        // Add your active class or action here
      } else {
        whatsappBtn.classList.remove("wobble-hor-bottom");
        callBtn.classList.remove("wobble-hor-bottom");
        whatsappBtn.classList.remove("active");
        callBtn.classList.remove("active");
      }
    });
  },
  {
    threshold: 0.1, // Triggers when 10% of the element is visible
  },
);

// Target your element
const whatsappBtn = document.querySelector("#whatsapp-nav-mobile-btn");
const callBtn = document.querySelector("#call-nav-mobile-btn");
const triggerDiv = document.querySelector("#trigger-nav-menu-animation");
observer.observe(triggerDiv);
