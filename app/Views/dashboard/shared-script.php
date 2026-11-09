<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
    // Initialize all tooltips on a page
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
</script>
<script src="/js/dialogScript.js"></script>
<script src="/js/eztoast.js"></script>
<script src="/js/formSubmittingLoader.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-3.0.3/datatables.min.js" integrity="sha384-U3G//lYwFPbrDV7w5uhOUSxHgb+hj1XYov+neDtWPWsO+xB38Puvo2sTlUSNw/bj" crossorigin="anonymous"></script>

<script>
    // Initialise a DataTable
    const isMobile = window.matchMedia("(pointer: coarse)").matches;
    let scrollYVar;
    if (isMobile) {
        scrollYVar = window.innerHeight / 6;
    } else {
        scrollYVar = window.innerHeight - (window.innerHeight * 0.35);
    }
    const table = new DataTable('#datatable', {
        // Options
        fixedHeader: {
            header: true,
            footer: true
        },
        paging: false,
        scrollCollapse: false,
        scrollX: true,
        scrollY: scrollYVar
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
                  <li class="col-3 border rounded-3">
                     <div class="ms-2 me-auto">
                      <table class="table table-sm table-borderless">
                      <tr>
                        <td>Name</td>
                        <td class="fw-bold">${traveler.name}</td>
                    </tr>
                        <tr>
                            <td>Contact</td>
                            <td class="fw-bold"><a href="tel:${traveler.contact}">${traveler.contact}</a></td>
                        </tr>   
                        <tr>
                            <td>Sharing</td>
                            <td class="fw-bold">${traveler.sharing.split('|')[1] || traveler.sharing}</td>
                        </tr>
                        <tr>
                            <td>Pickup / Drop </td>
                            <td class="fw-bold"><b>${traveler.boarding_city}</b> / <b>${traveler.drop_point}</b></td>
                        </tr>
                        <tr>
                            <td>Cost </td>
                            <td class="fw-bold">${traveler.cost ?? ''}</b></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td class="fw-bold">${(traveler.gender || '').toLowerCase()}</td>
                        </tr>
                        <tr>
                            <td>Adhaar Card</td>
                            <td class="fw-bold">${traveler.adhaar}</td>
                        </tr>
                        <tr>
                            <td>Adhaar Card File</td>
                            <td><button class="btn btn-sm btn-outline-dark" onclick="openModel('Trav-${traveler.contact}_${traveler.adhaar}')">Open Adhaar Card </button></td>
                        </tr>
                      </table>
                       
                        
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
<script>
    // Select all textareas with the class '.json-input'
    const textareas = document.querySelectorAll('.json-input');

    textareas.forEach(textarea => {
        textarea.addEventListener('input', () => {
            const value = textarea.value.trim();

            // Clear styling if the specific textarea is empty
            if (value === '') {
                textarea.classList.remove('json-invalid', 'json-valid');
                return;
            }

            try {
                JSON.parse(value);
                textarea.classList.remove('json-invalid');
                textarea.classList.add('json-valid');
            } catch (e) {
                textarea.classList.remove('json-valid');
                textarea.classList.add('json-invalid');
            }
        });
    });
</script>


<?php if (isset($_SESSION['FlashMessage'])) : ?>
    <script>
        runToast('<?= $_SESSION['FlashMessage']['message'] ?>', '<?= $_SESSION['FlashMessage']['status'] ?>');
    </script>
<?php endif; ?>