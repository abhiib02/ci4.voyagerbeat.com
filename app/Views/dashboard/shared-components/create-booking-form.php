<dialog class="border-1 rounded" id="create-booking">
    <div class="card">
        <div class="card-header">
            <div class="fw-bold">Create New Booking</div>
        </div>
        <div class="card-body">
            <form action="/create-booking" method="post" id="create-booking-form">
                <div class="row ">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="package_id" class="form-label fw-bold">Package ID</label>
                            <input
                                type="number"
                                class="form-control"
                                id="package_id"
                                name="package_id"
                                min="1"
                                step="1"
                                required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="adults" class="form-label fw-bold">Adults</label>
                            <input
                                type="number"
                                class="form-control"
                                id="adults"
                                name="adults"
                                min="1"
                                step="1"
                                required>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="contact" class="form-label fw-bold">Contact No</label>
                            <input
                                type="text"
                                class="form-control"
                                id="contact"
                                name="contact"
                                inputmode="numeric"
                                pattern="\d{1,10}"
                                maxlength="10"
                                required>
                            <div class="form-text">Up to 10 digits, numbers only.</div>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="amount" class="form-label fw-bold">Amount Paid</label>
                            <input
                                type="number"
                                class="form-control"
                                id="amount"
                                name="amount"
                                min="0"
                                step="0.01"
                                required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="amount" class="form-label fw-bold">Total Amount</label>
                            <input
                                type="number"
                                class="form-control"
                                id="total_package_cost"
                                name="total_package_cost"
                                min="0"
                                step="0.01"
                                required>
                        </div>
                    </div>



                </div>






                <input type="hidden" name="agent" id="agent" value="<?= session()->get('id') ?>">



            </form>
        </div>
        <div class="card-footer">
            <button class="btn btn-sm btn-success" form="create-booking-form">Create Link</button>
            <button class="btn btn-sm btn-outline-dark" onclick="document.querySelector('#create-booking').close();">Close</button>
        </div>
    </div>
</dialog>