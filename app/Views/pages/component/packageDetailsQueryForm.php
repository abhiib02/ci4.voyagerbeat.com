<div class=" style-border outline-card p-2">
    <form id="package-form" action="/submit" method="post" class="d-flex flex-column gap-3">

        <!-- Name -->
        <div class="form-floating">
            <input type="text" class="form-control rounded-3 border-secondary " name="name" id="name" placeholder="Name" required>
            <label for="name" class=" fw-semibold">Name</label>
        </div>

        <!-- Contact No -->
        <div class="form-floating">
            <input type="number" class="form-control rounded-3 border-secondary " name="phone" id="contact" placeholder="Contact No" required>
            <label for="contact" class=" fw-semibold">Phone No</label>
        </div>

        <!-- Date of Travel -->
        <div class="form-floating">
            <input type="date" class="form-control rounded-3 border-secondary " name="checkin" id="travelDate" placeholder="Date of Travel" required>
            <label for="travelDate" class=" fw-semibold">Date of Travel (Check In)</label>
        </div>

        <!-- Date of Travel -->
        <div class="form-floating">
            <input type="date" class="form-control rounded-3 border-secondary " name="checkout" id="travelDate" placeholder="Date of Travel" required>
            <label for="travelDate" class=" fw-semibold">Check Out</label>
        </div>

        <!-- Destination -->
        <div class="form-floating">
            <input type="text" class="form-control rounded-3 border-secondary " name="destination" id="destination" placeholder="Destination" required>
            <label for="destination" class=" fw-semibold">Destination</label>
        </div>

        <!-- No of Person -->
        <div class="form-floating">
            <input type="number" class="form-control rounded-3 border-secondary " name="totalpax" id="persons" placeholder="No of Person" min="1" required>
            <label for="persons" class=" fw-semibold">No of Person</label>
        </div>
        <input type="hidden" name="human">
        <input type="hidden" name="email" value="Inner-package-form">

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

<!-- <script src="/js/querySavetoGoogleSheet.js"></script> -->