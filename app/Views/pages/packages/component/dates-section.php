<?php if ($package->CUSTOM_TRIP) : ?>
    <h5>Date on Request</h5>
    <hr>
    <h6 class=" ">Customised Trip Available As Per Your Choice & Comfort</h6>
<?php else: ?>
    <h5>Trip Dates</h5>
    <div class="btn-group me-2 mb-2" role="group" aria-label="First group">
        <button type="button" class="btn btn-sm btn-outline-secondary" data-index="0" hidden>All</button>
        <button type="button" class="btn btn-sm btn-outline-secondary" data-index="1" hidden>January</button>
        <button type="button" class="btn btn-sm btn-outline-secondary" data-index="2" hidden>February</button>
        <button type="button" class="btn btn-sm btn-outline-secondary" data-index="3" hidden>March</button>
        <button type="button" class="btn btn-sm btn-outline-secondary" data-index="4" hidden>April</button>
        <button type="button" class="btn btn-sm btn-outline-secondary" data-index="5" hidden>May</button>
        <button type="button" class="btn btn-sm btn-outline-secondary" data-index="6" hidden>June</button>
        <button type="button" class="btn btn-sm btn-outline-secondary" data-index="7" hidden>July</button>
        <button type="button" class="btn btn-sm btn-outline-secondary" data-index="8" hidden>August</button>
        <button type="button" class="btn btn-sm btn-outline-secondary" data-index="9" hidden>September</button>
        <button type="button" class="btn btn-sm btn-outline-secondary" data-index="10" hidden>October</button>
        <button type="button" class="btn btn-sm btn-outline-secondary" data-index="11" hidden>November</button>
        <button type="button" class="btn btn-sm btn-outline-secondary" data-index="12" hidden>December</button>
    </div>
    <div class="row">
        <div class="col-lg-3 col-12">
            <div class=" animate__animated">
                <ul class="list-group list-group-numbered date-viewer">
                </ul>
            </div>
        </div>
    </div>
<?php endif; ?>