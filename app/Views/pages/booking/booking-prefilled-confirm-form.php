<?php

/**
 * @var object $BookingData
 * @var string $ValidCoupons
 * @var int $prefill
 */
?>
<?php if ($prefill != 1): ?>
    <ul class="alert alert-danger">
        Dont Try to be Smart Go Back
    </ul>
    <?php exit; ?>
<?php endif; ?>
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

        #progress {
            transition: all 1s ease;
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
            <input type="hidden" name="prefill" value="1">
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <textarea name="pax_details" id="" hidden><?= esc($BookingData->pax_details) ?></textarea>
            <!-- Step 1: Basic Information -->

            <div class="step active">
                <div class="card">
                    <div class="card-header">Basic Information</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control-plaintext" name="name" id="name" required value="<?= esc($BookingData->name) ?>" readonly>
                                    <label for="name">Name:</label>
                                </div>
                            </div>
                            <div class="col-6 col-md-6">
                                <div class="form-floating mb-3">
                                    <input
                                        type="email"
                                        class="form-control-plaintext"
                                        id="email"
                                        name="email" required value="<?= esc($BookingData->email) ?>" readonly>
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating mb-3">

                                    <input type="hidden" name="gender" value="<?= esc($BookingData->gender) ?>">
                                    <select class="form-control-plaintext" id="gender" name="gender" required disabled>
                                        <option value="" selected disabled><?= esc($BookingData->gender) ?></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <label for="gender">Gender:</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating mb-3">

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
                    <div class="card-header">Package Related Details</div>
                    <div class="card-body">
                        <div class="form-floating mb-3">


                            <select name="trip_type" id="trip_type" class="form-select" required>
                                <option value="" selected disabled>Choose One</option>
                                <option value="community">Community trips with Strangers</option>
                                <option value="personalised">Personalised Trip</option>
                            </select>
                            <label for="trip_type">Trip Type</label>
                        </div>

                        <div class="form-floating mb-3" id="custom-date">

                            <input type="hidden" name="date" value="<?= esc($BookingData->date) ?>" required>
                            <select id="date" name="date" class="form-select" required disabled>
                                <option value="" disabled selected><?= esc($BookingData->date) ?></option>
                            </select>
                            <label for="Date">Date</label>
                        </div>

                        <div class="form-floating">

                            <input type="hidden" name="travelmode" value="<?= esc($BookingData->travelmode) ?>" required>
                            <select name="travelmode" id="travelmode" class="form-select" required disabled>
                                <option value="" Selected disabled><?= esc($BookingData->travelmode) ?></option>

                            </select>
                            <label for="travelmode">Travel Mode</label>
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
                    <div class="card-header">Pax Important Details</div>
                    <div class="card-body">
                        <div id="pax-details-inputs">
                            <?php $Paxs = json_decode($BookingData->pax_details); ?>

                            <?php foreach ($Paxs as $index => $pax): ?>
                                <div class="traveler">
                                    <h5>Traveler <?= $index + 1 ?></h5>
                                    <div class="row g-3">
                                        <div class="col-12 col-md-3">
                                            <div class="form-floating mb-3">

                                                <input type="text" class="form-control-plaintext name" required value="<?= $pax->name ?>" readonly>
                                                <label class="form-label">Name</label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <div class="form-floating mb-3">

                                                <input type="hidden" class="form-control-plaintext gender" required value="<?= $pax->gender ?>" readonly>
                                                <select class="form-select gender" id="gender" disabled>
                                                    <option disabled="" selected="" value=""><?= $pax->gender ?></option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                <label class="gender">Gender</label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <div class="form-floating mb-3">
                                                <input type="number" inputmode="numeric" class="form-control-plaintext contact" value="<?= $pax->contact ?>" required readonly>
                                                <label class="form-label">Mobile No.</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="form-floating mb-3">

                                                <input type="hidden" class="form-control-plaintext sharing" required value="<?= $pax->sharing ?>" readonly>
                                                <select id="Sharing" class="form-select sharing" required disabled>
                                                    <option value="" selected><?= $pax->sharing ?></option>
                                                </select>
                                                <label class="form-label">Sharing</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control-plaintext boarding_city" required value="<?= $pax->boarding_city ?>" readonly>
                                                <label for="place">Boarding City</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control adhaar_number" minlength="12" maxlength="12" id="" required>
                                                <label for="place">Adhaar Card Number</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" type="file" name="adhaarCard_file[]" id="adhaarCard_file" accept="image/*" required>
                                                <label for="adhaarCard_file" class="form-label">Adhaar Card (Upload):</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                            <?php endforeach; ?>
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
                    <div class="card-header">Extra Details</div>
                    <div class="card-body">
                        <div class="form-floating mb-3">
                            <input class="form-control" type="file" name="payment_screenshot_file" id="payment_screenshot_file">
                            <label for="payment_screenshot_file" class="form-label">Payment Screenshot (Upload):</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" name="heard" id="heard" required>
                                <option value="Instagram">Instagram</option>
                                <option value="Facebook">Facebook</option>
                                <option value="Friend_Family">Friend & Family</option>
                                <option value="Website">Website</option>
                                <option value="Repeat">Repeat</option>
                                <label for="weight">Where did you hear about us?</label>
                            </select>
                            <label for="heard">Where did you hear about us?</label>
                        </div>
                    </div>
                    <div class="card-footer"><button type="button" class="btn btn-secondary prev">Previous</button>
                        <button type="button" class="btn btn-primary next">Next</button>
                    </div>
                </div>
            </div>

            <!-- Step 6: Preferences -->
            <div class="step">
                <div class="card">
                    <div class="card-header">Terms & Condition</div>
                    <div class="card-body">
                        <div class="border rounded-3 p-2">
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
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="checkDefault" required>
                            <label class="form-check-label" for="checkDefault">
                                <span>I agree to <a href="#">Terms and Conditions</a>.</span>
                            </label>
                            </label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-secondary prev">Previous</button>
                        <button type="submit" id="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>


        </form>
    </div>
    <br>
    <br>
</div>

<?= view('pages/booking/booking-shared-script'); ?>