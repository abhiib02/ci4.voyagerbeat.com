<?php

/**
 * @var object $BookingData
 * @var object $PackageData
 */
?>
<div class="scroll-margin">
    <!-- Header -->
    <div class="bgSecondaryTheme text-white py-2 mb-4">
        <div class="container">
            <h1 class="mb-1">Booking Confirmation Form</h1>
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
    </style>
    <div class="container">
        <?php if (session('errors')): ?>
            <ul class="alert alert-danger">
                <?php foreach (session('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>


        <form id="multiStep-booking-confirmation-form" method="post" action="/booking-confirmation-process" enctype="multipart/form-data"
            data-loader
            data-loader-title="Booking Confirmation In Progress"
            data-loader-steps="Validating your details...|Updating in Database... |Sending Email... |Generating Reciept... |Almost done...">

            <input type="hidden" name="package_id" value="<?= esc($BookingData->package_id) ?>">
            <input type="hidden" name="order_id" value="<?= esc($BookingData->order_id) ?>">
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <!-- Step 1: Basic Information -->
            <div class="step active">
                <div class="card">
                    <div class="card-header">Basic Information</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="name" id="name" required>
                                    <label for="name">Name:</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating mb-3">
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="email"
                                        name="email" required>
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating">


                                    <select class="form-control" id="gender" name="gender" required>
                                        <option value="" selected disabled>Choose One</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <label for="gender">Gender:</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating">

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="contact_trip"
                                        name="contact_trip"
                                        inputmode="numeric"
                                        pattern="\d{1,10}"
                                        minlength="10" maxlength="10" required>
                                    <label for="contact_trip">Contact (For During Trip)</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating mb-3">

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="contact_alt"
                                        name="contact_alt"
                                        inputmode="numeric"
                                        pattern="\d{1,10}"
                                        minlength="10" maxlength="10" required>
                                    <label for="contact_alt">Alternative Contact (For Emergency Purpose)</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="form-floating mb-3">

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="address"
                                        name="address"
                                        required>
                                    <label for="address">Address</label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-success next">Next</button>
                    </div>
                </div>

            </div>

            <!-- Step 2: Package Information -->
            <div class="step">
                <div class="card">
                    <div class="card-header">
                        Package Related Details
                    </div>
                    <div class="card-body">
                        <div class="form-floating mb-3">

                            <select name="trip_type" id="trip_type" class="form-select" required>
                                <option value="" selected disabled>Choose Trip Type</option>
                                <option value="community">Community trips with Strangers</option>
                                <option value="personalised">Personalised Trip</option>
                            </select>
                            <label for="place">Trip Type</label>
                        </div>

                        <div class="form-floating hide" id="custom-date">
                            <input type="date" class="form-control" name="date" min="<?= date("Y-m-d"); ?>" required>
                            <label for="Date">Date</label>
                        </div>

                        <div class="form-floating hide mb-3" id="batch-date">

                            <?php if ($PackageData->CUSTOM_TRIP) : ?>
                                <div class="alert alert-danger">No Batch Dates Available For This Package</div>
                                <div class="form-floating " id="custom-date">
                                    <input type="date" class="form-control" name="date" min="<?= date("Y-m-d"); ?>" required>
                                    <label for="Batch">Date</label>
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
                                <label for="Batch Dates">Batch Dates</label>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3">


                            <select name="travelmode" class="form-select" required>
                                <option value="" Selected disabled>Choose your option</option>
                                <?php if (!empty($PackageData->HEAD_WT2PRICE) && !$PackageData->HEAD_WT2PRICE == 0): ?>
                                    <option value="1|<?= esc(strip_tags($PackageData->HEAD_WT2PRICE)) ?>"><?= esc(strip_tags($PackageData->HEAD_WT2PRICE)) ?></option>
                                <?php endif; ?>
                                <?php if (!empty($PackageData->HEAD_WTPRICE) && !$PackageData->HEAD_WTPRICE == 0): ?>
                                    <option value="2|<?= esc(strip_tags($PackageData->HEAD_WTPRICE)) ?>"><?= esc(strip_tags($PackageData->HEAD_WTPRICE)) ?></option>
                                <?php endif; ?>
                                <?php if (!empty($PackageData->HEAD_PRICE) && !$PackageData->HEAD_PRICE == 0): ?>
                                    <option value="3|<?= esc(strip_tags($PackageData->HEAD_PRICE)) ?>"><?= esc(strip_tags($PackageData->HEAD_PRICE)) ?></option>
                                <?php endif; ?>
                            </select>
                            <label for="place">Choose Any One</label>
                        </div>



                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-secondary prev">Previous</button>
                        <button type="button" class="btn btn-primary next">Next</button>
                    </div>
                </div>
            </div>


            <!-- Step 4: Pax Details -->
            <div class="step">
                <div class="card">
                    <div class="card-header">Pax Details</div>
                    <div class="card-body">
                        <div id="pax-details-inputs">
                            <?php for ($i = 0; $i < ($BookingData->adults); $i++): ?>
                                <div class="traveler">
                                    <h5>Traveler <?= $i + 1 ?></h5>
                                    <div class="row g-3">
                                        <div class="col-12 col-md-3">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control name" required>
                                                <label class="form-label">Name</label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <div class="form-floating mb-3">

                                                <select class="form-select gender" required>
                                                    <option disabled="" selected="" value="">Choose your option</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                <label class="form-label">Gender</label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3">

                                            <div class="form-floating mb-3">
                                                <input type="tel" inputmode="numeric" class="form-control contact" inputmode="numeric"
                                                    pattern="\d{1,10}"
                                                    minlength="10" maxlength="10" required>
                                                <label class="form-label">Mobile No.</label>
                                            </div>

                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control boarding_city" id="boardingCity" required>
                                                <label for="boardingCity">Boarding City</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control drop_point" id="dropPoint" required>
                                                <label for="dropPoint">Drop Point</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control adhaar_number" id="adhaarNumber" minlength="12" maxlength="12" required>
                                                <label for="adhaarNumber">Adhaar Card Number</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="form-floating mb-3">

                                                <input class="form-control adhaarCard_file" type="file" name="adhaarCard_file[]" id="adhaarCard_file" accept=".jpg, .jpeg, .png, .webp" required>
                                                <label for="adhaarCard_file" class="form-label">Upload Adhaar Card Image (Max 4MB | .jpg, .jpeg, .png, .webp) :</label>
                                                <p id="errorMessage" style="color: red; font-weight: bold;"></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                            <?php endfor; ?>
                        </div>
                        <textarea name="pax_details" class="hide" id="pax_details_json" required></textarea>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-secondary prev">Previous</button>
                        <button type="button" class="btn btn-primary next">Next</button>
                    </div>
                </div>

            </div>

            <!-- Step 5: Extra Details -->
            <div class="step">
                <div class="card">
                    <div class="card-header">
                        Payment Details
                    </div>
                    <div class="card-body">
                        <div class="form-floating mb-3">

                            <input class="form-control" type="file" name="payment_screenshot_file" accept=".jpg, .jpeg, .png, .webp" id="payment_screenshot_file">
                            <label for="payment_screenshot_file" class="form-label">Upload Payment Screenshot (Max 4MB | .jpg, .jpeg, .png, .webp):</label>
                        </div>


                        <div class="form-floating mb-3">

                            <select class="form-select" name="heard" id="heard" required>
                                <option value="" selected disabled>Choose Any One</option>
                                <option value="Instagram">Instagram</option>
                                <option value="Facebook">Facebook</option>
                                <option value="Friend_Family">Friend & Family</option>
                                <option value="Website">Website</option>
                                <option value="Repeat">Repeat</option>
                            </select>
                            <label for="heard">Where did you hear about us?</label>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checkDefault" required>
                        <label class="form-check-label" for="checkDefault">
                            <span>I agree to <a href="#" data-bs-toggle="modal" data-bs-target="#tncmodal">Terms and Conditions</a>.</span>
                        </label>
                        </label>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-secondary prev">Previous</button>
                        <button type="submit" id="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="tncmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Terms & Condition</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <p>
                                    For Booking Record Purpose, Please fill the Details carefully. it will not editable, Connect for Any doubt : 9667711660 (Mohit)
                                </p>
                                <p>
                                    This is a professional revision of the agreement. It maintains the rigorous legal protections required for high-risk activities while improving clarity, structure, and tone.
                                </p>
                                <p>
                                    RELEASE OF LIABILITY, WAIVER OF CLAIMS, ASSUMPTION OF RISK, AND INDEMNITY AGREEMENT
                                    WARNING: By signing this document, you waive certain legal rights, including the right to sue for damages or injury, however caused. Please read carefully.
                                </p>
                                <p>
                                    TO: Voyagers Beat, its directors, officers, employees, representatives, and agents (collectively, the "Releasees").
                                </p>
                                <p>
                                    1. Participation Agreement
                                    As a condition of my participation in events organized by Voyagers Beat and/or the Releasees—including but not limited to wilderness hiking, trekking, trail running, mountain biking, paddling, whitewater rafting, fixed-rope activities, rock climbing, motorcycle touring, bicycle trips, social events, and group travel (collectively, the "Activities")—I hereby agree to be bound by the terms of this Release of Liability, Waiver of Claims, Assumption of Risk, and Indemnity Agreement (the "Agreement").
                                </p>
                                <p>
                                    2. Assumption of Inherent Risks
                                    I acknowledge that the Activities involve significant inherent risks and dangers, including the potential for serious bodily injury, permanent disability, and death. I fully understand the nature of these risks and voluntarily elect to participate, accepting all such risks entirely at my own hazard.
                                </p>
                                <p>
                                    3. Representations of Fitness and Equipment
                                    I certify that I am physically, emotionally, and mentally capable of participating in the Activities. I further represent that any personal equipment I provide is appropriate, well-maintained, and safe for use in the program.
                                </p>
                                <p>
                                    4. Adherence to Safety Protocols
                                    I agree to follow all applicable rules, instructions, and safety protocols. I acknowledge that the ultimate responsibility for my personal safety remains solely with me at all times.
                                </p>
                                <p>
                                    5. Duty to Withdraw
                                    I agree to immediately cease participation and notify the nearest official if:
                                    I observe any unusual hazard or unsafe condition.
                                    I experience a deterioration in my physical or mental fitness.
                                    I feel that the activity has exceeded my personal comfort level or the capability of my equipment.
                                </p>
                                <p>
                                    6. Waiver and Release of Liability
                                    I hereby waive any and all claims and release the Releasees from any liability for personal injury, death, property damage, or any other loss sustained during the Activities. This release applies to any cause whatsoever, including but not limited to negligence, breach of contract, or breach of any statutory or other duty of care on the part of the Releasees.
                                </p>
                                <p>
                                    7. Media Consent and Usage
                                    I grant irrevocable and unconditional consent to Voyagers Beat and its affiliates to use, edit, publish, and copyright my name, likeness, photograph, and voice (the "Applicant Information") in any media for advertising, promotional, or administrative purposes. This right is granted in perpetuity (or for a minimum of 10 years where prescribed by law) without further compensation or approval.
                                </p>
                                <p>
                                    ACKNOWLEDGMENT AND EXECUTION
                                    I CONFIRM THAT I AM 18 YEARS OF AGE OR OLDER. I have read and understood this Agreement in its entirety. I am aware that by signing this document, I am waiving substantial legal rights, including the right to sue Voyagers Beat and the Releasees.
                                </p>
                                <p>
                                    If I am signing as a parent or legal guardian, I execute this Agreement on behalf of the minor participant and agree to be bound by its terms. I sign this document voluntarily and without any inducement.
                                </p>
                                <p>
                                    Booking Amount is not Refundable or Adjustable in any case
                                </p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>
    <br>
    <br>
</div>
<?= view('pages/booking/booking-shared-script'); ?>