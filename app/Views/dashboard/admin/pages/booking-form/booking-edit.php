<?php

/**
 * @var object $BookingData
 * @var string $ValidCoupons
 */
?>

<div class="scroll-margin">

    <!-- Header -->
    <div class="bgSecondaryTheme text-white py-2 mb-4">
        <div class="container">
            <h1 class="mb-1">Edit Booking</h1>
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


        <form id="multiStep-booking-confirmation-form" method="post" action="/editBookingProcess"
            data-loader
            data-loader-title="Booking Confirmation In Progress"
            data-loader-steps="Validating your details...|Updating in Database... |Sending Email... |Generating Reciept... |Almost done...">
            <input type="hidden" name="ID" value="<?= esc($BookingData->ID) ?>">
            <input type="hidden" name="package_id" value="<?= esc($BookingData->package_id) ?>">
            <input type="hidden" name="order_id" value="<?= esc($BookingData->order_id) ?>">
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <!-- Step 1: Basic Information -->

            <div class="step active">
                <div class="card">
                    <div class="card-header">Basic Information</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="name" id="name" required value="<?= esc($BookingData->name) ?>">
                                    <label for="name">Name:</label>
                                </div>
                            </div>
                            <div class="col-6 col-md-6">
                                <div class="form-floating mb-3">
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="email"
                                        name="email" required value="<?= esc($BookingData->email) ?>">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating mb-3">

                                    <input type="hidden" name="gender" value="<?= esc($BookingData->gender) ?>">
                                    <select class="form-control" id="gender" name="gender" required>
                                        <option value="<?= esc($BookingData->gender) ?>" selected><?= esc($BookingData->gender) ?></option>
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
                                        value="<?= $BookingData->contact ?>"
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
                                        value="<?= $BookingData->contact_alt ?>"
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
                            <div class="col-12 col-md-6">
                                <div class="form-floating mb-3">

                                    <input
                                        value="<?= $BookingData->address ?>"
                                        type="text"
                                        class="form-control"
                                        id="address"
                                        name="address"
                                        required>
                                    <label for="address">Address</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating mb-3">

                                    <input
                                        value="<?= $BookingData->agent ?>"
                                        type="text"
                                        class="form-control"
                                        id="agent"
                                        name="agent"
                                        required>
                                    <label for="address">Agent</label>
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
                                <option value="<?= esc($BookingData->trip_type) ?>" selected><?= esc($BookingData->trip_type) ?></option>
                                <option value="community">Community trips with Strangers</option>
                                <option value="personalised">Personalised Trip</option>
                            </select>
                            <label for="trip_type">Trip Type</label>
                        </div>

                        <div class="form-floating mb-3" id="custom-date">

                            <input type="text" name="date" class="form-control" value="<?= esc($BookingData->date) ?>" required>
                            <label for="Date">Date</label>
                        </div>

                        <div class="form-floating">

                            <input type="text" name="travelmode" class="form-control" value="<?= esc($BookingData->travelmode) ?>" required>

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
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="form-floating mb-3" id="Adults">
                                    <input type="number" name="adults" class="form-control" value="<?= esc($BookingData->adults) ?>" required>
                                    <label for="Date">Adults</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-floating mb-3" id="perPersonCost">
                                    <input type="text" name="perPersonCost" class="form-control" value="<?= esc($BookingData->perPersonCost) ?>" required>
                                    <label for="Date">perPersonCost</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-floating mb-3" id="perPersonSharing">
                                    <input type="text" name="perPersonSharing" class="form-control" value="<?= esc($BookingData->perPersonSharing) ?>" required>
                                    <label for="Date">perPersonSharing</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-floating mb-3" id="Amount">
                                    <input type="text" name="amount" class="form-control" value="<?= esc($BookingData->amount) ?>" required>
                                    <label for="Date">Amount Paid</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-floating mb-3" id="Adults">
                                    <input type="text" name="total_package_cost" class="form-control" value="<?= esc($BookingData->total_package_cost) ?>" required>
                                    <label for="Date">Total Package Cost</label>
                                </div>
                            </div>
                        </div>




                        <div id="pax-details-inputs">

                        </div>
                        <textarea name="pax_details" class="form-control json-input" style="field-sizing: content;" id="codemirror-editor" required><?= $BookingData->pax_details ?></textarea>
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
<?= view('dashboard/shared-script'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.js" integrity="sha512-4i/wqLBUQRN1JXTwHTYjnZXUVi57tiOAMehaWWLqCXJpaIz9tgtOKJuEPUuBZ0+G7Bh/XJIsU/+gTCHBOWlFTw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/addon/display/autorefresh.min.js" integrity="sha512-vAsKB7xXQAWMn5kcwda0HkFVKUxSYwrmrGprVhmbGFNAG1Ij+2epT3zzdwjHTJyDsKXsiEdrUdhIxh7loHyX+A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // Convert the textarea into a CodeMirror instance
    var editor = CodeMirror.fromTextArea(document.getElementById("codemirror-editor"), {
        lineNumbers: true, // Show line numbers
        autoRefresh: true,
        mode: "javascript", // Set programming language syntax
        theme: "dracula", // Apply the loaded dark theme
        tabSize: 4, // Tab indentation spacing
        lineWrapping: true // Wrap long lines
    });
</script>