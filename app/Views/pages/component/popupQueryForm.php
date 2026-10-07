<style>
    #popup-form {
        position: fixed;
        width: 50%;
        min-height: 65vh;
        max-height: 65vh;
        overflow: clip;
        border-radius: var(--theme-border-radius);
        background-color: white;
        inset: 0;
        margin: auto;

        @media(width < 992px) {
            width: 100%;
        }

        &::backdrop {
            background-color: rgba(0, 0, 0, 0.9);
        }
    }
</style>
<dialog id="popup-form">

    <div class="">
        <div class="d-flex">
            <div style="flex:1;" class="hide-on-mobile">
                <img width="100%" style="height:100%;object-fit:cover;object-position:bottom;" src="<?= $MainFormImage ?>" alt="">
            </div>
            <div style="flex:1;" class="p-2 align-content-center">
                <button type="button" class="btn-close" style="position:absolute;top:10px;right:10px;" onclick="closeModal('popup-form')"></button>
                <div class="">
                    <h3 class="text-center">Plan Your Trip with Voyagers Beat</h3>
                    <div class=" p-2">
                        <form id="package-form" method="post" class="d-flex flex-column gap-3">

                            <!-- Name -->
                            <div class="form-floating">
                                <input type="text" class="form-control rounded-3 border-secondary " name="name" id="name" placeholder="Name" required>
                                <label for="name" class=" fw-semibold">Name</label>
                            </div>
                            <div class="form-floating">
                                <input type="email" class="form-control rounded-3 border-secondary " name="email" id="email" placeholder="email" required>
                                <label for="email" class=" fw-semibold">Email</label>
                            </div>

                            <!-- Contact No -->
                            <div class="form-floating">
                                <input type="number" class="form-control rounded-3 border-secondary " name="contact" id="contact" placeholder="Contact No" required>
                                <label for="contact" class=" fw-semibold">Contact No</label>
                            </div>

                            <!-- Date of Travel -->
                            <div class="form-floating">
                                <input type="date" class="form-control rounded-3 border-secondary " name="dateoftravel" id="travelDate" placeholder="Date of Travel" required>
                                <label for="travelDate" class=" fw-semibold">Date of Travel</label>
                            </div>

                            <!-- Destination -->
                            <div class="form-floating">
                                <input type="text" class="form-control rounded-3 border-secondary " name="destination" id="destination" placeholder="Destination" required>
                                <label for="destination" class=" fw-semibold">Destination</label>
                            </div>

                            <!-- No of Person -->
                            <div class="form-floating">
                                <input type="number" class="form-control rounded-3 border-secondary " name="adults" id="persons" placeholder="No of Person" min="1" required>
                                <label for="persons" class=" fw-semibold">No of Person</label>
                            </div>
                            <input type="hidden" name="human">

                            <!-- Submit Button -->
                            <div class="mt-2">
                                <button type="submit" class="btn btn-theme btn-voyager fw-bold text-dark px-4 py-2 text-uppercase rounded-3">
                                    <span class="spinner-border spinner-border-sm" aria-hidden="true" hidden></span>

                                    <span role="status">Get a Free Quote</span>

                                </button>
                                <span id="error"></span>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</dialog>
<script src="/js/dialogScript.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        var popup = document.querySelector('#popup-form');


        function openMainPopup() {
            if (!sessionStorage.getItem('popup') && window.location.pathname === '/') {
                sessionStorage.setItem('popup', 1);
                popup.showModal();
            }
        }
        setTimeout(openMainPopup, 3000);
        //// pop up logic///
    });
</script>

<script src="/js/querySavetoGoogleSheet.js"></script>