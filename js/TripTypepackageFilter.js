const btns = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.travel_card_new');

    btns.forEach((btn) => {
        btn.addEventListener('click', () => {
            // Remove active from all
            btns.forEach((b) => {
                b.classList.remove('activeFilter');
            });

            // Add active to clicked
            btn.classList.add('activeFilter');

            if (!document.startViewTransition) {
                filterImages(btn.dataset.filter);
            }

            document.startViewTransition(() => {
                filterImages(btn.dataset.filter);
            });

        })
    })

    function filterImages(filterCategory) {
        cards.forEach((card, index) => {
            if (card.dataset.filter.includes(filterCategory) || filterCategory == "all") {
                card.removeAttribute('hidden');
            } else {
                card.setAttribute('hidden', '');
            }
        })
    }