<div class=" style-border outline-card p-2">
    <form action="#" method="post" class="d-flex flex-column gap-3">

        <!-- Name -->
        <div class="form-floating">
            <input type="text" class="form-control rounded-3 border-secondary " id="name" placeholder="Name" required>
            <label for="name" class=" fw-semibold">Name</label>
        </div>

        <!-- Contact No -->
        <div class="form-floating">
            <input type="number" class="form-control rounded-3 border-secondary " id="contact" placeholder="Contact No" required>
            <label for="contact" class=" fw-semibold">Contact No</label>
        </div>

        <!-- Date of Travel -->
        <div class="form-floating">
            <input type="date" class="form-control rounded-3 border-secondary " id="travelDate" placeholder="Date of Travel" required>
            <label for="travelDate" class=" fw-semibold">Date of Travel</label>
        </div>

        <!-- Destination -->
        <div class="form-floating">
            <input type="text" class="form-control rounded-3 border-secondary " id="destination" placeholder="Destination" required>
            <label for="destination" class=" fw-semibold">Destination</label>
        </div>

        <!-- No of Person -->
        <div class="form-floating">
            <input type="number" class="form-control rounded-3 border-secondary " id="persons" placeholder="No of Person" min="1" required>
            <label for="persons" class=" fw-semibold">No of Person</label>
        </div>

        <!-- Submit Button -->
        <div class="mt-2">
            <button type="submit" class="btn btn-theme fw-bold text-dark px-4 py-2 text-uppercase rounded-3">
                Get a Free Quote
            </button>
        </div>

    </form>
</div>