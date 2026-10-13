`<script src="/js/dialogScript.js"></script>
<script src="/js/eztoast.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-3.0.3/datatables.min.js" integrity="sha384-U3G//lYwFPbrDV7w5uhOUSxHgb+hj1XYov+neDtWPWsO+xB38Puvo2sTlUSNw/bj" crossorigin="anonymous"></script>

<script>
    // Initialise a DataTable
    const table = new DataTable('#datatable', {
        // Options
    });
</script>
<script src="/js/dialogScript.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const currentPath = window.location.pathname;

        const menuLinks = document.querySelectorAll('.nav-pills>.nav-link[href]');

        menuLinks.forEach(link => {
            link.classList.remove('active');
            link.removeAttribute('aria-current');

            const linkPath = link.getAttribute('href');

            if (linkPath === currentPath) {
                link.classList.add('active');
                link.setAttribute('aria-current', 'true');
            }
        });
    });
</script>
<script>
    function showTravelersModel() {
        showTravelers(this.event.target.dataset.travelers, this.event.target.dataset.bookingId);
    }

    function showTravelers(data, id) {
        document.getElementById(`travelers-dialog-${id}`).showModal();
        // Group data
        const TravelersData = JSON.parse(data);
        let result = "";
        TravelersData.forEach((traveler) => {

            result += `
                  <li class="list-group-item d-flex justify-content-between align-items-start ">
                     <div class="ms-2 me-auto">
                        <div class="fw-bold fs-6">${traveler.name || ''}</div>
                        ${(traveler.gender || '').toLowerCase()} • <a href="tel:${traveler.contact || ''}">${traveler.contact || ''}</a>
                        <p class="m-0">Sharing Basis : ${traveler.sharing.split('|')[1] || traveler.sharing}</p>
                        <p class="m-0">Adhaar Number : ${traveler.adhaar}</p>
                        <p class="m-0">Cost : ${traveler.cost ?? ''}</p>
                        <button class="btn btn-sm btn-outline-dark" onclick="openModel('Trav-${traveler.contact}_${traveler.adhaar}')">Open Adhaar Card </button>
                        <dialog class="border-1 rounded" id="Trav-${traveler.contact}_${traveler.adhaar}">
                        <div class="card">
                        <img width="auto" height="500px" src="/upload/adhaar/${traveler.adhaarCard_file}">
                        <div class="card-footer">
                                    <button class="btn btn-sm btn-outline-dark" onclick="document.querySelector('#Trav-${traveler.contact}_${traveler.adhaar}').close();">Close</button>
                                </div>
                                </div>
                        </dialog>
                     </div>
                  </li>
         `;
        });
        document.getElementById(`output-dialog-${id}`).innerHTML = result;
    }
</script>



<?php if (isset($_SESSION['FlashMessage'])) : ?>
    <script>
        runToast('<?= $_SESSION['FlashMessage']['message'] ?>', '<?= $_SESSION['FlashMessage']['status'] ?>');
    </script>
<?php endif; ?>