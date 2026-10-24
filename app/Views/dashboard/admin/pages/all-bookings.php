<div id="bookings" class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fw-bold">Bookings</div>
            <div>
                <button class="fw-bold btn btn-success" onclick="openModel('create-booking')">Create Booking</button>
            </div>
            <?= view('dashboard/shared-components/create-booking-form') ?>
        </div>

    </div>
    <div class="card-body">
        <div class="">
            <?= view('dashboard/shared-components/booking-list') ?>
        </div>
    </div>
</div>