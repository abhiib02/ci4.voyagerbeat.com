<script src="https://cdn.datatables.net/v/bs5/dt-3.0.3/datatables.min.js" integrity="sha384-U3G//lYwFPbrDV7w5uhOUSxHgb+hj1XYov+neDtWPWsO+xB38Puvo2sTlUSNw/bj" crossorigin="anonymous"></script>

<script>
    // Initialise a DataTable
    const table = new DataTable('#datatable', {
        // Options
    });
</script>
<script>
    function openModel(id) {
        let dialog = document.getElementById(id);
        dialog.showModal();
    };

    function closeModal(id) {
        let dialog = document.getElementById(id);
        dialog.close();
    };
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const currentPath = window.location.pathname;

        const menuLinks = document.querySelectorAll('.nav-pills>.nav-link[href]');

        menuLinks.forEach(link => {
            link.classList.remove('active');
            link.removeAttribute('aria-current');

            const linkPath = link.getAttribute('href');
            console.log(linkPath);
            if (linkPath === currentPath) {
                link.classList.add('active');
                link.setAttribute('aria-current', 'true');
            }
        });
    });
</script>
<script>
    function showTravelers(data, id) {
        document.getElementById(`travelers-dialog-${id}`).showModal();
        let travelers = {};

        // Group data
        for (let key in data) {
            let match = key.match(/traveler_(\d+)_(\w+)/);

            if (match) {
                let num = match[1];
                let field = match[2];

                if (!travelers[num]) {
                    travelers[num] = {};
                }

                travelers[num][field] = data[key];
            }
        }

        // Output result
        let result = "";

        for (let num in travelers) {
            let t = travelers[num];

            result += `
                  <li class="list-group-item d-flex justify-content-between align-items-start ">
                     <div class="ms-2 me-auto">
                        <div class="fw-bold fs-6">${t.name || ''}</div>
                        ${(t.gender || '').toLowerCase()} • <a href="tel:${t.contact || ''}">${t.contact || ''}</a> • <a href="mail:${t.email || ''}">${t.email || ''}</a>
                        <p>Sharing Basis : ${t.sharing.split('|')[1] || ''}</p>
                     </div>
                  </li>
         `;
        }
        // Show output
        document.getElementById(`output-dialog-${id}`).innerHTML = result;
    }
</script>

<script src="/js/eztoast.js"></script>

<?php if (isset($_SESSION['FlashMessage'])) : ?>
    <script>
        runToast('<?= $_SESSION['FlashMessage']['message'] ?>', '<?= $_SESSION['FlashMessage']['status'] ?>');
    </script>
<?php endif; ?>