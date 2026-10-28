    <?php

    /**
     * @var object $package
     */
    ?>
    <?php if ($package->CUSTOM_TRIP) : ?>
        <h6 class=" ">Customised Trip Available As Per Your Choice & Comfort</h6>
    <?php else: ?>
        <div class="btn-group me-2 mb-2 w-100 gap-1" role="group" aria-label="First group">
            <button type="button" class="btn btn-sm btn-outline-voyagers2" data-index="0" hidden>All</button>
            <button type="button" class="btn btn-sm btn-outline-voyagers2" data-index="1" hidden>Jan</button>
            <button type="button" class="btn btn-sm btn-outline-voyagers2" data-index="2" hidden>Feb</button>
            <button type="button" class="btn btn-sm btn-outline-voyagers2" data-index="3" hidden>Mar</button>
            <button type="button" class="btn btn-sm btn-outline-voyagers2" data-index="4" hidden>Apr</button>
            <button type="button" class="btn btn-sm btn-outline-voyagers2" data-index="5" hidden>May</button>
            <button type="button" class="btn btn-sm btn-outline-voyagers2" data-index="6" hidden>Jun</button>
            <button type="button" class="btn btn-sm btn-outline-voyagers2" data-index="7" hidden>Jul</button>
            <button type="button" class="btn btn-sm btn-outline-voyagers2" data-index="8" hidden>Aug</button>
            <button type="button" class="btn btn-sm btn-outline-voyagers2" data-index="9" hidden>Sep</button>
            <button type="button" class="btn btn-sm btn-outline-voyagers2" data-index="10" hidden>Oct</button>
            <button type="button" class="btn btn-sm btn-outline-voyagers2" data-index="11" hidden>Nov</button>
            <button type="button" class="btn btn-sm btn-outline-voyagers2" data-index="12" hidden>Dec</button>
        </div>
        <ul class="list-group list-group-numbered date-viewer">
            <em>
                Click Months to see the Trip dates of that Month
            </em>
        </ul>
    <?php endif; ?>