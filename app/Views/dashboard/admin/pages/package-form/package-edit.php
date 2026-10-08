<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<style>
    .date_input_group {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: flex-start;
        gap: 10px 10px;
        margin: 1rem 0;
        max-height: 200px;
        overflow-y: scroll;
    }
</style>
<div class="container">
    <h1 class="py-4">Editing <?= $package->PACKAGE_NAME ?> Package</h1>
    <form action="/updatePackageProcess" method="post" enctype="multipart/form-data">
        <input type="hidden" name="PACKAGE_ID" value="<?= $package->PACKAGE_ID ?>">
        <?= csrf_field() ?>
        <div class="p-1 sticky-top d-flex justify-content-between" style="top: -3px;">
            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                <a type="button" href="#Summaryadd" class="btn btn-primary">Summary</a>
                <a type="button" href="#highlight" class="btn btn-primary">Highlight</a>
                <a type="button" href="#Inclusionadd" class="btn btn-primary">Inclusion</a>
                <a type="button" href="#Exclusionadd" class="btn btn-primary">Exclusion</a>
                <a type="button" href="#Itineraryadd" class="btn btn-primary">Itinerary</a>
                <a type="button" href="#Datesadd" class="btn btn-primary">Trips Dates</a>
                <a type="button" href="#Costadd" class="btn btn-primary">Sharing</a>
                <a type="button" href="#Miscupdate" class="btn btn-primary">Misc</a>
                <a type="button" href="#Terms" class="btn btn-primary">Terms & Condition</a>
                <a type="button" href="#Faq" class="btn btn-primary">FAQ</a>
            </div>
            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                <input type="submit" id="add_pack_btn" value="Update package" class="btn btn-success">

                <?php if (request()->getGet('Adminlist') == '1'): ?>
                    <a href="/dashboard/packages-list" class="btn  btn-danger">Cancel</a>
                <?php else: ?>
                    <a href="/package/<?= $package->SLUG ?>" class="btn btn-danger">Cancel</a>
                <?php endif; ?>

            </div>
        </div>

        <div class="container">
            <div class="row">
                <hr>
                <div id="Summaryadd" class="scroll-margin-top col-lg-12">
                    <div class="row">
                        <h3>Package Detail</h3>

                        <div class="col-lg-3">
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" id="package_name" name="package_name" placeholder="" value="<?= $package->PACKAGE_NAME ?>" required />
                                <label for="first_name">Package Name *</label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="package_slug" type="text" name="slug" placeholder="" value="<?= $package->SLUG ?>" required />
                                <label for="package_slug">Package Slug *</label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-floating mb-3">
                                <select name="days" class="form-select" id="" required>
                                    <option value="<?= $package->PACKAGE_DAYS ?>" selected><?= $package->PACKAGE_DAYS ?></option>
                                    <hr>
                                    <?php for ($i = 1; $i <= 15; $i++): ?>
                                        <option value="<?= $i ?> <?= ($i == 1) ? 'Night' : 'Nights' ?> / <?= $i + 1 ?> Days"><?= $i ?> <?= ($i == 1) ? 'Night' : 'Nights' ?> / <?= $i + 1 ?> Days</option>
                                    <?php endfor; ?>
                                </select>

                                <label for="days">Package days *</label>
                            </div>
                        </div>
                        <div class="col-lg-3 d-flex">
                            <div class="form-floating mb-3">
                                <input class="form-control" type="file" id="pdf" name="pdf">
                                <label for="Itinerary" id="linked_pdf" class="form-label">(Current PDF :<?= $package->PACKAGE_PDF ?>)</label>
                            </div>
                            <input class="form-control" id="package_pdf" type="hidden" value="<?= $package->PACKAGE_PDF ?>" name="pdf_old">
                            <button type="button" class="btn btn-sm btn-danger mb-3" onclick="unlinkPDF()">Unlink PDF</button>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" value="<?= $package->WHATSAPP_LINK ?>" placeholder="paste link here"
                                    name="WHATSAPP_LINK" />
                                <label for="days">Whatsapp_link</label>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" value="<?= $package->PICKNDROP ?>" name="PICKNDROP" placeholder="PICK TO DROP" />
                                <label for="days">Pick and drop</label>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-floating mb-3">
                                <input class="form-control" type="number" value="<?= $package->DURATION ?>" name="duration"
                                    placeholder="Package Duration" />
                                <label for="days">Package Duration</label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" placeholder="" value="<?= $package->LOCATION ?>" name="Location"
                                    list="DestinationList" />
                                <datalist id="DestinationList">
                                    <option value="Delhi">Delhi</option>
                                    <option value="Kareri">Kareri</option>
                                    <option value="Kasol">Kasol</option>
                                    <option value="Manali">Manali</option>
                                    <option value="Jaisalmer">Jaisalmer</option>
                                    <option value="Pushkar">Pushkar</option>
                                    <option value="Mcleodganj">Mcleodganj</option>
                                    <option value="Leh">Leh</option>
                                    <option value="Goa">Goa</option>
                                    <option value="Chopta">Chopta</option>
                                    <option value="Tirthan">Tirthan</option>
                                    <option value="Narkanda">Narkanda</option>
                                    <option value="Prashar">Prashar</option>
                                    <option value="Spiti">Spiti</option>
                                    <option value="Rishikesh">Rishikesh</option>
                                    <option value="Kedarnath">Kedarnath</option>
                                    <option value="Uttarakhand">Uttarakhand</option>
                                    <option value="Kedarkantha">Kedarkantha</option>
                                </datalist>
                                <label for="Location">City *</label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-floating mb-3">
                                <select id="state" class="form-select" name="State" required>
                                    <option value="<?= $package->STATE ?>" selected><?= $package->STATE ?></option>
                                    <option value="International">------------ International ------------</option>
                                    <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                    <option value="Assam">Assam</option>
                                    <option value="Bihar">Bihar</option>
                                    <option value="Chandigarh">Chandigarh</option>
                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                    <option value="damananddiu">Dadra and Nagar Haveli and Daman and Diu</option>
                                    <option value="Delhi">Delhi</option>
                                    <option value="Goa">Goa</option>
                                    <option value="Gujarat">Gujarat</option>
                                    <option value="Haryana">Haryana</option>
                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                    <option value="Jammu_Kashmir">Jammu & Kashmir</option>
                                    <option value="Jharkhand">Jharkhand</option>
                                    <option value="Karnataka">Karnataka</option>
                                    <option value="Kerala">Kerala</option>
                                    <option value="Ladakh">Ladakh</option>
                                    <option value="Lakshadweep">Lakshadweep</option>
                                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                                    <option value="Maharashtra">Maharashtra</option>
                                    <option value="Manipur">Manipur</option>
                                    <option value="Meghalaya">Meghalaya</option>
                                    <option value="Mizoram">Mizoram</option>
                                    <option value="Nagaland">Nagaland</option>
                                    <option value="Odisha">Odisha</option>
                                    <option value="Puducherry">Puducherry</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Rajasthan">Rajasthan</option>
                                    <option value="Sikkim">Sikkim</option>
                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                    <option value="Telangana">Telangana</option>
                                    <option value="Tripura">Tripura</option>
                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                    <option value="Uttarakhand">Uttarakhand</option>
                                    <option value="West Bengal">West Bengal</option>
                                </select>
                                <label for="state">State</label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="Country" value="<?= $package->COUNTRY ?>" placeholder="" id="Country"
                                    list="CountryList" />
                                <datalist id="CountryList">
                                    <?php foreach ($Countries as $country): ?>
                                        <option value="<?= $country ?>"><?= $country ?></option>
                                    <?php endforeach; ?>
                                </datalist>

                                <label for="Country">Country</label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-floating mb-3">
                                <select id="type" class="form-select" name="type" required>
                                    <option value="<?= $package->PACKAGE_TYPE ?>" selected><?= $package->PACKAGE_TYPE ?></option>
                                    <option value="" disabled>------------Select Type------------</option>
                                    <option value="Bike">Bike</option>
                                    <option value="Road">Road Trip</option>
                                    <option value="Party">Party</option>
                                    <option value="xmas-new-year">Xmas & New Year</option>
                                    <option value="Treks">Treks</option>
                                    backpack
                                    <option value="Backpack">backpack</option>
                                    <option value="Corporate">Corporate</option>
                                    <option value="ChilledOut">Chill Out</option>
                                    <option value="family-trip">Family trip</option>
                                    <option value="spiritual">Spiritual Trip</option>
                                    <option value="honeymoon">Honeymoon</option>
                                </select>
                                <label for="type">Trip Type *</label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-floating mb-3">

                                <select id="Hidden" class="form-select" name="HIDDEN">
                                    <option value="<?= $package->HIDDEN ?>" selected><?= ($package->HIDDEN) ? 'Yes' : 'No' ?></option>
                                    <option value="0">Default (NO)</option>
                                    <option value="1">YES</option>
                                    <option value="0">NO</option>
                                </select>
                                <label for="Hidden">Hide Package</label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-floating mb-3">
                                <select id="c_date" class="form-select" name="CUSTOM_TRIP">
                                    <option value="<?= $package->CUSTOM_TRIP ?>" selected><?= ($package->CUSTOM_TRIP) ? 'Yes' : 'No' ?></option>
                                    <option value="0">Default (NO)</option>
                                    <option value="1">YES</option>
                                    <option value="0">NO</option>
                                </select>
                                <label for="c_date">Custom Dates Availiable</label>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-floating mb-3">
                                <select id="WEEKEND" class="form-select" name="WEEKEND" required>
                                    <option value="<?= $package->WEEKEND ?>" selected><?= ($package->WEEKEND) ? 'Yes' : 'No' ?></option>
                                    <option value="" disabled>Yes or No</option>
                                    <option value="Yes">YES</option>
                                    <option value="No">NO</option>
                                </select>
                                <label for="WEEKEND">WEEKEND Trips *</label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-floating mb-3">
                                <select id="UPCOMING" class="form-select" name="UPCOMING" required>
                                    <option value="<?= $package->UPCOMING ?>" selected><?= ($package->UPCOMING) ? 'Yes' : 'No' ?></option>
                                    <option value="" disabled>Yes or No</option>
                                    <option value="1">YES</option>
                                    <option value="0">NO</option>
                                </select>
                                <label for="UPCOMING">Upcoming Trips *</label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-floating mb-3">
                                <input class="form-control" type="number" id="BookingAmount" value="<?= $package->BOOKING_AMOUNT ?>" placeholder="BookingAmount"
                                    name="BOOKING_AMOUNT" />
                                <label for="BookingAmount">Booking Amount (Default 2500)</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" value="<?= $package->PACKAGE_IMAGE ?>" placeholder="paste link here" name="image"
                                    required />
                                <label for="IMAGE_1">Package image *</label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" placeholder="" value="<?= $package->PACKAGE_THUMBNAIL ?>" readonly />
                                <label for="badge">Package Thumbnail (Read only) </label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-floating mb-3">
                                <input class="form-control" type="number" placeholder="SPACIAL_OFFER"
                                    name="SPACIAL_OFFER" value="<?= $package->SPACIAL_OFFER ?>" />
                                <label for="SPACIAL_OFFER">SPACIAL_OFFER ( % )</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" minlength="70" maxlength="150" type="text"
                                    placeholder="meta_desc" value="<?= $package->META_DESC ?>" name="META_DESC" required />
                                <label for="meta_desc">Meta Description *</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text"
                                    placeholder="HOTEL_IMG_LINK" name="HOTEL_IMG_LINK" value="<?= $package->HOTEL_IMG_LINK ?>" />
                                <label for="HOTEL_IMG_LINK">Hotel Image Drive Link</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" id="tags" placeholder="tag1,tag2,tag3, .." value="<?= $package->TAGS ?>" name="tags" />
                                <label for="tags">Tags</label>
                            </div>
                            <small>
                                Used Tags (For New Tag add Comma and Just Type) Example : tag1,tag2,New tag3
                            </small>
                            <br>
                            <div>

                                <?php foreach ($UsedTags as $TAG) : ?>
                                    <span class="badge rounded-pill text-bg-dark tag" onclick="addTag('<?= $TAG ?>');" role="button"><?= $TAG ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" id="badge" placeholder="Badge" value="<?= $package->BADGE ?>" name="badge" />
                                <label for="badge">Badge</label>
                            </div>
                            <small>
                                Used Badges (For New Badge Just Type)
                            </small>
                            <br>
                            <div>
                                <?php foreach ($UsedBadges as $BADGE) : ?>
                                    <span class="badge rounded-pill text-bg-dark" onclick="addBadge('<?= $BADGE ?>');" role="button"><?= $BADGE ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>

                    </div>
                    <hr>
                </div>

                <div id="highlight" class="scroll-margin-top col-lg-12">
                    <h3>Trip Highlight</h3>

                    <textarea style="resize: none;" class="materialize-textarea" rows="40" cols="50"
                        placeholder="ex. trip highlight 1^trip highlight 1" name="TRIP_HIGHLIGHT"><?= $package->TRIP_HIGHLIGHT ?></textarea>
                    <br>
                </div>
                <hr>
                <div id="Inclusionadd" class="scroll-margin-top col-lg-6">
                    <h3>Trip Inclusion *</h3>

                    <textarea style="resize: none;" class="materialize-textarea" rows="40" cols="50"
                        placeholder="ex. inclusion1^Inclusion2" name="Inclusion"><?= $package->INCLUSION ?></textarea><br>
                </div>
                <div id="Exclusionadd" class="scroll-margin-top col-lg-6">
                    <h3>Trip Exclusion *</h3>


                    <textarea style="resize: none;" class="materialize-textarea" rows="40" cols="50"
                        placeholder="ex. Exclusion1^Exclusion2" name="Exclusion"><?= $package->EXCLUSION ?></textarea><br>
                </div>
                <hr>
                <div id="Itineraryadd" class="scroll-margin-top col-lg-12">

                    <h3>Trip Itinerary *</h3>
                    <?php if (!str_contains($package->PACK_IT, 'dayTitle')): ?>
                        <div class="alert alert-danger">
                            Itinerary Format Changed Please Convert Itinerary Format by clicking the button below.
                        </div>
                        <button type="button" onclick="convertItineraryFormat()">Convert Format</button>
                        <pre id="output"></pre>
                    <?php endif; ?>
                    <textarea style="resize: none;" rows="20" cols="50" name="it" id="add-package-itinerary" class="<?= (str_contains($package->PACK_IT, 'dayTitle') ? '' : '') ?>"
                        placeholder="Ex. DAY1^DAY2^DAY3" <?= (str_contains($package->PACK_IT, 'dayTitle') ? 'hidden' : '') ?>><?= $package->PACK_IT ?></textarea><br>
                    <textarea id="iti" style="display:none;"><?= $package->PACK_IT ?></textarea>
                    <div id="day_inputs" class="row"></div>
                    <br>
                    <button class="btn btn-primary" type="button" onclick="addDay()">Add Day</button>
                    <button class="btn btn-secondary" type="button" onclick="removeDay()">Remove Days</button>

                    <br>
                    <br>
                </div>
                <hr>
                <div id="Datesadd" class="scroll-margin-top col-lg-12">
                    <h3>Trip Dates </h3>

                    <div class="row">
                        <div>
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <button type="button" class="submit btn btn-primary">Refresh Dates</button>
                                <button type="button" class="add btn btn-success">Add Date</button>
                                <button type="button" class="remove btn btn-secondary">Remove Date</button>
                            </div>
                        </div>
                        <div class="date_input_group"></div>
                        <details>
                            <summary>Open Dates Textarea</summary>
                            <textarea name="DATES" required="" class="dates_string form-control" style="height: auto;" rows="2" cols="24"><?= $package->DATES ?></textarea>
                        </details>
                    </div>
                    <br>
                </div>
                <hr>
                <div id="Costadd" class="scroll-margin-top col-lg-12">
                    <h3>Sharing </h3>

                    <label for="">Price On Request</label>
                    <select id="REQUEST_PRICE" class="form-select" name="REQUEST_PRICE" required>
                        <option value="<?= $package->REQUEST_PRICE ?>" selected><?= ($package->REQUEST_PRICE) ? 'Yes' : 'No'; ?></option>
                        <option value="0">------------Price On Request ( Default No)------------</option>
                        <option value="1">YES</option>
                        <option value="0">NO</option>
                    </select>
                    <br>
                    <div class="row">
                        <div class="col-lg-2">
                            <label for="">Disabled</label>
                            <input class="form-control" type="text" disabled>

                            <select name="INFO_P1" class="form-select" required>
                                <option value="<?= $package->INFO_P1 ?>" selected><?= $package->INFO_P1 ?></option>
                                <option value="Quad Sharing">Quad Sharing (4 Persons in 1 Room)</option>
                                <option value="Triple Sharing">Triple Sharing (3 Persons in 1 Room)</option>
                                <option value="Double Sharing">Double Sharing (2 Persons in 1 Room)</option>
                                <option value="Solo Sharing">Solo Sharing (1 Person in 1 Room)</option>
                                <option value="Group Sharing">Group Sharing</option>
                            </select>

                            <select name="INFO_P2" class="form-select">
                                <option value="<?= $package->INFO_P2 ?>" selected><?= $package->INFO_P2 ?></option>
                                <option value="Quad Sharing">Quad Sharing (4 Persons in 1 Room)</option>
                                <option value="Triple Sharing">Triple Sharing (3 Persons in 1 Room)</option>
                                <option value="Double Sharing">Double Sharing (2 Persons in 1 Room)</option>
                                <option value="Solo Sharing">Solo Sharing (1 Person in 1 Room)</option>
                                <option value="Group Sharing">Group Sharing</option>
                            </select>
                            <select name="INFO_P3" class="form-select">
                                <option value="<?= $package->INFO_P3 ?>" selected><?= $package->INFO_P3 ?></option>
                                <option value="Quad Sharing">Quad Sharing (4 Persons in 1 Room)</option>
                                <option value="Triple Sharing">Triple Sharing (3 Persons in 1 Room)</option>
                                <option value="Double Sharing">Double Sharing (2 Persons in 1 Room)</option>
                                <option value="Solo Sharing">Solo Sharing (1 Person in 1 Room)</option>
                                <option value="Group Sharing">Group Sharing</option>
                            </select>
                            <select name="INFO_P4" class="form-select">
                                <option value="<?= $package->INFO_P4 ?>" selected><?= $package->INFO_P4 ?></option>
                                <option value="Quad Sharing">Quad Sharing (4 Persons in 1 Room)</option>
                                <option value="Triple Sharing">Triple Sharing (3 Persons in 1 Room)</option>
                                <option value="Double Sharing">Double Sharing (2 Persons in 1 Room)</option>
                                <option value="Solo Sharing">Solo Sharing (1 Person in 1 Room)</option>
                                <option value="Group Sharing">Group Sharing</option>
                            </select>
                            <select name="INFO_P5" class="form-select">
                                <option value="<?= $package->INFO_P5 ?>" selected><?= $package->INFO_P5 ?></option>
                                <option value="Quad Sharing">Quad Sharing (4 Persons in 1 Room)</option>
                                <option value="Triple Sharing">Triple Sharing (3 Persons in 1 Room)</option>
                                <option value="Double Sharing">Double Sharing (2 Persons in 1 Room)</option>
                                <option value="Solo Sharing">Solo Sharing (1 Person in 1 Room)</option>
                                <option value="Group Sharing">Group Sharing</option>
                            </select>


                        </div>
                        <div class="col-lg-2">
                            <label for="">Selling Price</label>
                            <input class="form-control" type="text" placeholder="Selling Price" name="" disabled>

                            <input class="form-control" type="number" id="s1" placeholder="S_PRICE_1" name="S_PRICE_1" value="<?= $package->S_PRICE_1 ?>">


                            <input class="form-control" type="number" id="s2" placeholder="S_PRICE_2" name="S_PRICE_2" value="<?= $package->S_PRICE_2 ?>">


                            <input class="form-control" type="number" id="s3" placeholder="S_PRICE_3" name="S_PRICE_3" value="<?= $package->S_PRICE_3 ?>">


                            <input class="form-control" type="number" id="s4" placeholder="S_PRICE_4" name="S_PRICE_4" value="<?= $package->S_PRICE_4 ?>">


                            <input class="form-control" type="number" id="s5" placeholder="S_PRICE_5" name="S_PRICE_5" value="<?= $package->S_PRICE_5 ?>">

                        </div>
                        <div class="col-lg-3">
                            <label for="HEAD_PRICE">Offer Price *</label>
                            <input class="form-control" type="text" placeholder="Column Name" value="<?= $package->HEAD_PRICE ?>"
                                name="HEAD_PRICE" required>

                            <input class="form-control" type="number" id="p1" placeholder="PRICE_1 *" name="PRICE_1" value="<?= $package->PRICE_1 ?>" required>

                            <input class="form-control" type="number" id="p2" placeholder="PRICE_2" name="PRICE_2" value="<?= $package->PRICE_2 ?>">

                            <input class="form-control" type="number" id="p3" placeholder="PRICE_3" name="PRICE_3" value="<?= $package->PRICE_3 ?>">

                            <input class="form-control" type="number" id="p4" placeholder="PRICE_4" name="PRICE_4" value="<?= $package->PRICE_4 ?>">

                            <input class="form-control" type="number" id="p5" placeholder="PRICE_5" name="PRICE_5" value="<?= $package->PRICE_5 ?>">
                        </div>
                        <div class="col-lg-3">
                            <label for="HEAD_PRICE">Self Travel Price *</label>
                            <input class="form-control" type="text" placeholder="Column Name" value="<?= $package->HEAD_WTPRICE ?>"
                                name="HEAD_WTPRICE" required>

                            <input class="form-control" type="number" placeholder="WT_PRICE_1 " value="<?= $package->WT_PRICE_1 ?>"
                                name="WT_PRICE_1" required>

                            <input class="form-control" type="number" placeholder="WT_PRICE_2" value="<?= $package->WT_PRICE_2 ?>"
                                name="WT_PRICE_2">

                            <input class="form-control" type="number" placeholder="WT_PRICE_3" value="<?= $package->WT_PRICE_3 ?>"
                                name="WT_PRICE_3">

                            <input class="form-control" type="number" placeholder="WT_PRICE_4" value="<?= $package->WT_PRICE_4 ?>"
                                name="WT_PRICE_4">

                            <input class="form-control" type="number" placeholder="WT_PRICE_5" value="<?= $package->WT_PRICE_5 ?>"
                                name="WT_PRICE_5">


                        </div>
                        <div class="col-lg-2">
                            <label for="HEAD_PRICE">Self Travel Price 2 </label>
                            <input class="form-control" type="text" placeholder="Column Name" value="<?= $package->HEAD_WT2PRICE ?>"
                                name="HEAD_WT2PRICE">

                            <input class="form-control" type="number" placeholder="WT2_PRICE_1 " value="<?= $package->WT2_PRICE_1 ?>"
                                name="WT2_PRICE_1">

                            <input class="form-control" type="number" placeholder="WT2_PRICE_2" value="<?= $package->WT2_PRICE_2 ?>"
                                name="WT2_PRICE_2">

                            <input class="form-control" type="number" placeholder="WT2_PRICE_3" value="<?= $package->WT2_PRICE_3 ?>"
                                name="WT2_PRICE_3">

                            <input class="form-control" type="number" placeholder="WT2_PRICE_4" value="<?= $package->WT2_PRICE_4 ?>"
                                name="WT2_PRICE_4">

                            <input class="form-control" type="number" placeholder="WT2_PRICE_5" value="<?= $package->WT2_PRICE_5 ?>"
                                name="WT2_PRICE_5">


                        </div>
                    </div>
                    <br>
                </div>
                <hr>
                <div id="Miscupdate" class="">
                    <h3>Misc Info </h3>

                    <div class="row">
                        <div class="col-lg-6">
                            <textarea style="resize: none;" rows="20" cols="50" name="PACKAGE_MISC"
                                class="materialize-textarea" placeholder="MISC INFO"><?= $package->PACKAGE_MISC ?></textarea>
                        </div>

                        <div class="col-lg-6">

                            <label for="IMAGE_1">Package photo/video(youtube) link 1</label>
                            <input class="form-control" type="text" placeholder="paste link here" name="IMAGE_1" value="<?= $package->IMAGE_1 ?>">

                            <label for="IMAGE_2">Package photo/video(youtube) link 2</label>
                            <input class="form-control" type="text" placeholder="paste link here" name="IMAGE_2" value="<?= $package->IMAGE_2 ?>">

                            <label for="IMAGE_3">Package photo/video(youtube) link 3</label>
                            <input class="form-control" type="text" placeholder="paste link here" name="IMAGE_3" value="<?= $package->IMAGE_3 ?>">

                            <label for="IMAGE_4">Package photo/video(youtube) link 4</label>
                            <input class="form-control" type="text" placeholder="paste link here" name="IMAGE_4" value="<?= $package->IMAGE_4 ?>">

                        </div>
                    </div>
                    <br>
                </div>
                <hr>


                <div id="Terms" class="">
                    <div class="">
                        <h3>Terms & Condition</h3>

                        <textarea style="resize: none;" rows="20" cols="50" name="PACKAGE_TNC" class="materialize-textarea" placeholder="Terms & Condition"><?= $package->PACKAGE_TNC ?></textarea>
                    </div>
                    <br>
                </div>
                <div id="Faq" class="">

                    <div class="">
                        <div class="d-flex justify-content-between">
                            <h3>Frequently Asked Question</h3>
                            <button type="button" class="btn btn-primary" onclick="addQuestion()">Add Question</button>
                        </div>
                        <hr>
                        <textarea id="faq_textarea" name="PACKAGE_FAQ" hidden><?= $package->PACKAGE_FAQ ?></textarea>
                        <div id="faq_inputs">

                        </div>

                    </div>

                    <br>

                </div>

            </div>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.2/tinymce.min.js" referrerpolicy="no-referrer"></script>

<script src="/js/unlinkpdf.js"></script>

<script src="/js/tinymce_init_script.js"></script>
<script src="/js/date_input_script.js"></script>
<script src="/js/slug_script.js"></script>
<script src="/js/selling_price_script.js"></script>
<script src="/js/faq_script.js"></script>
<script src="/js/itinerary_script.js"></script>
<script src="/js/tags_badges_script.js"></script>
<script src="/js/json_util__script.js"></script>