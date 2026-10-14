<div id="bookings" class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fw-bold">Bookings</div>
            <div>
                <a class="fw-bold btn btn-success" target="_blank" href="https://docs.google.com/spreadsheets/d/16alRGAwiWdj3F5B0852nTssBJwTOoeEJSM_SaE2l28E/edit?usp=sharing">&#9871; Open Google Sheet</a>
                <button class="fw-bold btn btn-success" onclick="openModel('create-booking')">Create Booking</button>
            </div>
            <?= view('dashboard/shared-components/create-booking-form') ?>
        </div>

    </div>
    <div class="card-body">
        <div class="overflow-auto">
            <?= view('dashboard/shared-components/booking-list') ?>
        </div>
    </div>
</div>