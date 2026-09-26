<div class="scroll-margin">

    <!-- Header -->
    <div class="bgSecondaryTheme text-white py-4 mb-4">
        <div class="container">
            <h1 class="mb-1">Booking Form</h1>
            <h5 class="fw-normal fst-italic mb-0"><?= esc($BookingData->package_name) ?></h5>
            <sub>Agent ID : <?= esc($BookingData->agent) ?></sub>
        </div>
    </div>

    <style>
        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        .buttons {
            margin-top: 20px;
        }

        #progress {
            transition: all 1s ease;
        }
    </style>
    <div class="container">
        <progress value="0" max="100" id="progress" style="width:100%;"></progress>
        <form id="multiStep-booking-confirmation-form" method="post" action="/asd" enctype="multipart/form-data">
            <!-- Step 1: Basic Information -->
            <div class="step active">
                <h2>Basic Information</h2>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="contact">Contact</label>
                            <input
                                type="text"
                                class="form-control"
                                id="contact"
                                name="contact"
                                inputmode="numeric"
                                pattern="\d{1,10}"
                                maxlength="10" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="contact">Contact (* For During Trip)</label>
                            <input
                                type="text"
                                class="form-control"
                                id="contact"
                                name="contact_trip"
                                inputmode="numeric"
                                pattern="\d{1,10}"
                                maxlength="10" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="contact">Alternative Contact (* For Emergency)</label>
                            <input
                                type="text"
                                class="form-control"
                                id="contact"
                                name="contact_alt"
                                inputmode="numeric"
                                pattern="\d{1,10}"
                                maxlength="10" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="" selected disabled>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-success next">Next</button>
            </div>

            <!-- Step 2: Package Information -->
            <div class="step">
                <h2>Package Related Details</h2>

                <div class="form-group">
                    <label for="place">Trip Type</label>
                    <select name="trip_type" id="trip_type" class="form-select" required>
                        <option value="" selected disabled>Choose Trip Type</option>
                        <option value="community">Community trips with Strangers</option>
                        <option value="personalised">Personalised Trip</option>
                    </select>
                </div>

                <div class="form-group hide" id="custom-date">
                    <label for="Date">Date</label>
                    <input type="date" class="form-control" name="date" required>
                </div>

                <div class="form-group hide" id="batch-date">
                    <label for="Batch Dates">Batch Dates</label>
                    <?php if ($PackageData->CUSTOM_TRIP) : ?>
                        <div class="alert alert-danger">No Batch Dates Available For This Package</div>
                        <div class="form-group " id="custom-date">
                            <label for="Batch">Date</label>
                            <input type="date" class="form-control" name="date" required>
                        </div>
                    <?php else: ?>
                        <?php
                        $Dates = explode(",", $PackageData->DATES);
                        $today = new DateTime('today');
                        ?>

                        <select id="date" name="date" class="form-select" required>
                            <option value="" disabled selected>Choose your Date</option>
                            <?php for ($i = 0; $i < (count($Dates)); $i++): ?>
                                <?php
                                $cleandate = explode("|", $Dates[$i])[0];
                                $surcharge = explode("|", $Dates[$i])[1] ?? '';

                                // Fixed positions, same assumption as extract_both_months():
                                // "dd/mm/yyyy - dd/mm/yyyy"
                                $startStr = substr($cleandate, 0, 10);  // dd/mm/yyyy
                                $endStr   = substr($cleandate, 13, 10); // dd/mm/yyyy

                                $startDate = DateTime::createFromFormat('d/m/Y', $startStr);
                                $endDate   = DateTime::createFromFormat('d/m/Y', $endStr);

                                // Skip if parsing failed, or the range has already ended
                                if (!$startDate || !$endDate || $startDate < $today) {
                                    continue;
                                }
                                ?>
                                <option value="<?= $Dates[$i]; ?>"><?= extract_both_months($cleandate); ?> <?= ($surcharge) ? ' |  Surcharge ₹' . $surcharge : ''; ?></option>
                            <?php endfor; ?>
                        </select>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="place">Choose Boarding</label>

                    <select name="travelmode" class="form-select" required>
                        <option value="" Selected disabled>Choose your option</option>
                        <?php if (!empty($PackageData->HEAD_WT2PRICE) && !$PackageData->HEAD_WT2PRICE == 0): ?>
                            <option value="<?= esc(strip_tags($PackageData->HEAD_WT2PRICE)) ?>"><?= esc(strip_tags($PackageData->HEAD_WT2PRICE)) ?></option>
                        <?php endif; ?>
                        <?php if (!empty($PackageData->HEAD_WTPRICE) && !$PackageData->HEAD_WTPRICE == 0): ?>
                            <option value="<?= esc(strip_tags($PackageData->HEAD_WTPRICE)) ?>"><?= esc(strip_tags($PackageData->HEAD_WTPRICE)) ?></option>
                        <?php endif; ?>
                        <?php if (!empty($PackageData->HEAD_PRICE) && !$PackageData->HEAD_PRICE == 0): ?>
                            <option value="<?= esc(strip_tags($PackageData->HEAD_PRICE)) ?>"><?= esc(strip_tags($PackageData->HEAD_PRICE)) ?></option>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="place">Boarding City</label>
                    <input type="text" name="boarding_city" class="form-control" id="Boarding" required>
                </div>


                <div class="form-group">
                    <label for="place">Choose Sharing</label>
                    <select name="sharing" id="Sharing" class="form-select" required>
                        <?php if (!empty($PackageData->INFO_P1) && !$PackageData->INFO_P1 == 0): ?>
                            <option value="<?= esc($PackageData->INFO_P1) ?>"><?= esc($PackageData->INFO_P1) ?></option>
                        <?php endif; ?>
                        <?php if (!empty($PackageData->INFO_P2) && !$PackageData->INFO_P2 == 0): ?>
                            <option value="<?= esc($PackageData->INFO_P2) ?>"><?= esc($PackageData->INFO_P2) ?></option>
                        <?php endif; ?>
                        <?php if (!empty($PackageData->INFO_P3) && !$PackageData->INFO_P3 == 0): ?>
                            <option value="<?= esc($PackageData->INFO_P3) ?>"><?= esc($PackageData->INFO_P3) ?></option>
                        <?php endif; ?>
                        <?php if (!empty($PackageData->INFO_P4) && !$PackageData->INFO_P4 == 0): ?>
                            <option value="<?= esc($PackageData->INFO_P4) ?>"><?= esc($PackageData->INFO_P4) ?></option>
                        <?php endif; ?>
                        <?php if (!empty($PackageData->INFO_P5) && !$PackageData->INFO_P5 == 0): ?>
                            <option value="<?= esc($PackageData->INFO_P5) ?>"><?= esc($PackageData->INFO_P5) ?></option>
                        <?php endif; ?>
                    </select>
                </div>

                <button type="button" class="btn btn-secondary prev">Previous</button>
                <button type="button" class="btn btn-primary next">Next</button>
            </div>

            <?php if ($BookingData->adults > 1): ?>
                <!-- Step 4: Pax Details -->
                <div class="step">

                    <h2>Pax Details</h2>

                    <div id="pax-details-inputs">
                        <?php for ($i = 0; $i < $BookingData->adults; $i++): ?>
                            <div class="traveler">
                                <h5>Traveler <?= $i + 2 ?></h5>
                                <div class="row g-3">
                                    <div class="col-12 col-md-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control name" required>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <label class="form-label">Gender</label>
                                        <select class="form-select gender" required>
                                            <option disabled="" selected="" value="">Choose your option</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <label class="form-label">Contact</label>
                                        <input type="number" inputmode="numeric" class="form-control contact" required>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label class="form-label">Sharing</label>
                                        <select name="" id="Sharing" class="form-select sharing" required>
                                            <?php if (!empty($PackageData->INFO_P1) && !$PackageData->INFO_P1 == 0): ?>
                                                <option value="<?= esc($PackageData->INFO_P1) ?>"><?= esc($PackageData->INFO_P1) ?></option>
                                            <?php endif; ?>
                                            <?php if (!empty($PackageData->INFO_P2) && !$PackageData->INFO_P2 == 0): ?>
                                                <option value="<?= esc($PackageData->INFO_P2) ?>"><?= esc($PackageData->INFO_P2) ?></option>
                                            <?php endif; ?>
                                            <?php if (!empty($PackageData->INFO_P3) && !$PackageData->INFO_P3 == 0): ?>
                                                <option value="<?= esc($PackageData->INFO_P3) ?>"><?= esc($PackageData->INFO_P3) ?></option>
                                            <?php endif; ?>
                                            <?php if (!empty($PackageData->INFO_P4) && !$PackageData->INFO_P4 == 0): ?>
                                                <option value="<?= esc($PackageData->INFO_P4) ?>"><?= esc($PackageData->INFO_P4) ?></option>
                                            <?php endif; ?>
                                            <?php if (!empty($PackageData->INFO_P5) && !$PackageData->INFO_P5 == 0): ?>
                                                <option value="<?= esc($PackageData->INFO_P5) ?>"><?= esc($PackageData->INFO_P5) ?></option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        <?php endfor; ?>
                    </div>
                    <textarea name="pax_details" class="hide" id="pax_details_json" required></textarea>


                    <button type="button" class="btn btn-secondary prev">Previous</button>
                    <button type="button" class="btn btn-primary next">Next</button>
                </div>
            <?php endif; ?>

            <!-- Step 5: Extra Details -->
            <div class="step">
                <h2>Extra Details</h2>
                <div class="form-group">
                    <label for="payment_screenshot_file" class="form-label">Payment Screenshot (Upload):</label>
                    <input class="form-control" type="file" name="payment_screenshot_file" id="payment_screenshot_file">
                </div>

                <div class="form-group">
                    <label for="height">Adhaar Number</label>
                    <input type="number" class="form-control" name="adhaar" id="adhaar" required>
                </div>

                <div class="form-group">
                    <label for="weight">Where did you hear about us?</label>
                    <select class="form-select" name="heard" id="heard" required>
                        <option value="Instagram">Instagram</option>
                        <option value="Facebook">Facebook</option>
                        <option value="Friend_Family">Friend & Family</option>
                        <option value="Website">Website</option>
                        <option value="Repeat">Repeat</option>
                    </select>
                </div>

                <button type="button" class="btn btn-secondary prev">Previous</button>
                <button type="button" class="btn btn-primary next">Next</button>
            </div>

            <!-- Step 6: Preferences -->
            <div class="step">
                <h2>Terms & Condition</h2>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                    <label class="form-check-label" for="checkDefault">
                        <span>I agree to <a href="#">Terms and Conditions</a>.</span>
                    </label>
                    </label>
                </div>
                <label for="tnc-checkbox">
                    <input type="checkbox" name="" id="tnc-checkbox">


                    <button type="button" class="btn btn-secondary prev">Previous</button>
                    <button class="btn btn-success">Submit</button>
            </div>


        </form>
    </div>
</div>

<script id="trip-type-dates">
    const tripType = document.getElementById('trip_type');
    let customDate = document.getElementById('custom-date');
    let batchDate = document.getElementById('batch-date');

    tripType.addEventListener('change', () => {
        if (tripType.value === 'community') {
            batchDate.classList.remove('hide');
            customDate.classList.add('hide');
            customDate.querySelector('input').removeAttribute('required');
            customDate.querySelector('input').removeAttribute('name');

        } else {
            batchDate.classList.add('hide');
            batchDate.querySelector('input').removeAttribute('required');
            batchDate.querySelector('input').removeAttribute('name');
            customDate.classList.remove('hide');

        }
    })
</script>

<script>
    function updateAll() {
        let travelers = document.querySelectorAll(".traveler");
        let data = {};

        travelers.forEach((t, index) => {
            let num = index + 2;
            // Update JSON
            data[`traveler_${num}_name`] = t.querySelector(".name").value;
            data[`traveler_${num}_gender`] = t.querySelector(".gender").value;
            data[`traveler_${num}_contact`] = t.querySelector(".contact").value;
            data[`traveler_${num}_sharing`] = t.querySelector(".sharing").value.toLowerCase();
        });

        document.getElementById("pax_details_json").value = JSON.stringify(data);
    }

    // Auto update on typing
    document.addEventListener("input", updateAll);
</script>
<script>
    const steps = document.querySelectorAll('.step');
    const progress = document.querySelector('#progress');
    let value = 100 / steps.length;

    let currentStep = 0;

    document.querySelectorAll('.next').forEach(button => {
        button.addEventListener('click', () => {
            if (validateStep(currentStep)) {
                steps[currentStep].classList.remove('active');
                currentStep++;
                steps[currentStep].classList.add('active');
                progress.value += value;
            }
        });
    });

    document.querySelectorAll('.prev').forEach(button => {
        button.addEventListener('click', () => {
            steps[currentStep].classList.remove('active');
            currentStep--;
            steps[currentStep].classList.add('active');
            progress.value -= value;
        });
    });

    document.getElementById('submit').addEventListener('click', () => {
        if (validateStep(currentStep)) {

        }
    });

    function validateStep(step) {
        const inputs = steps[step].querySelectorAll('input, select');
        for (let input of inputs) {
            if (!input.checkValidity()) {
                input.reportValidity();
                return false;
            }
        }
        return true;
    }
</script>