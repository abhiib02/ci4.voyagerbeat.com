<!-- Vue 3 -->
<script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
<link rel="stylesheet" href="/css/coupon.css">
<style>
    #details-right {
        position: sticky;
        top: 1rem;
    }
</style>


<div id="app" class="scroll-margin">

    <!-- Header -->
    <div class="bgSecondaryTheme text-white py-4 mb-4">
        <div class="container">
            <h1 class="mb-1">Booking Form</h1>
            <h5 class="fw-normal fst-italic mb-0">{{ pkg.PACKAGE_NAME }}</h5>
        </div>
    </div>

    <form id="bookingForm" action="/booking-payment" method="POST" @submit="onSubmit" novalidate>

        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

        <input type="hidden" name="id" :value="pkg.PACKAGE_ID" required>
        <input type="hidden" name="package_name" :value="pkg.PACKAGE_NAME" required>
        <input type="hidden" name="bookingamount" :value="pkg.BOOKING_AMOUNT" required>
        <input type="hidden" name="amounttopay" :value="payNowAmount" required>
        <input type="hidden" name="points_used" :value="usePoints ? pointsDiscount : 0" required>
        <textarea name="pax_details" hidden id="" required>{{paxDetailsJson}}</textarea>

        <div class="container mb-5">
            <div class="row g-2">

                <!-- LEFT COLUMN -->
                <div class="col-12 col-lg-8">

                    <div class="accordion" id="bookingAccordion">

                        <!-- Traveler Details -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" :class="{collapsed: openIndex !== 0}" type="button" @click="openAccordion(0)">
                                    Details Section
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse scroll-margin" :class="{show: openIndex === 0}" ref="section0">
                                <div class="accordion-body">

                                    <h6 class="fw-bold mb-3">Account Holder</h6>
                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-md-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control" value="<?= session()->get('name') ?>" readonly>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <label class="form-label">Gender</label>
                                            <input type="text" name="gender" class="form-control" value="<?= session()->get('gender') ?>" readonly>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <label class="form-label">Contact No</label>
                                            <input type="text" name="mobile" class="form-control" value="<?= session()->get('contact') ?>" readonly>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" value="<?= session()->get('email') ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-6 col-md-4">
                                            <label class="form-label fw-bold">Number of Adults</label>
                                            <input type="number" name="adults" class="form-control-plaintext fw-bold" :value="adults" readonly>
                                        </div>
                                    </div>
                                    <hr>



                                    <div v-for="(t, i) in travelers" :key="t.id" class="border-top pt-3 mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="fw-bold fs-6">Traveler {{ i + 2 }}</span>
                                            <button type="button" class="btn btn-sm btn-danger" @click="removeTraveler(i)">Remove</button>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-12 col-md-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" class="form-control" v-model.trim="t.name" required>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <label class="form-label">Gender</label>
                                                <select class="form-select" v-model="t.gender" required>
                                                    <option value="" disabled selected>Choose your option</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <label class="form-label">Contact</label>
                                                <input type="number" inputmode="numeric" class="form-control" v-model="t.contact" required>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="form-label">Boarding City</label>
                                                <input type="text" class="form-control" v-model.trim="t.boarding_city" required>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="form-label">Sharing</label>
                                                <select class="form-select" name="sharing[]" v-model="t.sharing" required>
                                                    <option value="" disabled selected>Choose Sharing</option>
                                                    <option v-for="opt in sharingOptions" :key="opt.value" :value="opt.value">{{ opt.label }}</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-theme btn-voyager text-white" @click="addTraveler">+ Add Traveler</button>

                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="button" class="btn btn-theme btn-voyager text-white" @click="openAccordion(1)">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dates Section -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" :class="{collapsed: openIndex !== 1}" type="button" @click="openAccordion(1)">
                                    Dates Section
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse scroll-margin" :class="{show: openIndex === 1}" ref="section1">
                                <div class="accordion-body">

                                    <template v-if="dateList.length === 0">
                                        <p class="text-danger mb-0">
                                            No upcoming batch dates are available for this package right now.
                                            Please contact us to check for new dates.
                                        </p>
                                        <br>
                                        <label class="form-label">Select Date</label>
                                        <input type="date" name="date" class="form-control" :class="{'is-invalid': errors.date}" v-model="selectedDate" required>
                                    </template>

                                    <template v-else-if="dateList.length > 0">
                                        <label class="form-label">Batch Dates</label>
                                        <select name="date" class="form-select" v-model="selectedDate" required>
                                            <option value="" disabled selected>Choose your option</option>
                                            <option v-for="(d, i) in dateList" :key="i" :value="d.raw">
                                                {{ d.label }}<template v-if="d.surcharge"> | Surcharge ₹{{ d.surcharge }}</template>
                                            </option>
                                        </select>
                                    </template>

                                    <template v-else-if="pkg.CUSTOM_TRIP === 1">
                                        <label class="form-label">Select Date</label>
                                        <input type="date" name="date" class="form-control" v-model="selectedDate" required>
                                    </template>

                                    <template v-else>
                                        <label class="form-label">Batch Dates</label>
                                        <select name="date" class="form-select" v-model="selectedDate" required>
                                            <option value="" disabled selected>Choose your option</option>
                                            <option :value="dateList[0].raw">{{ dateList[0].label }}</option>
                                        </select>
                                    </template>

                                    <div class="d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-outline-secondary" @click="openAccordion(0)">Back</button>
                                        <button type="button" class="btn btn-theme btn-voyager text-white" @click="openAccordion(2)">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Travel Section -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" :class="{collapsed: openIndex !== 2}" type="button" @click="openAccordion(2)">
                                    Travel Section
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse scroll-margin" :class="{show: openIndex === 2}" ref="section2">
                                <div class="accordion-body">
                                    <label class="form-label">Travel Mode / Pickup Point</label>
                                    <select name="travelmode" class="form-select" v-model="travelMode" required>
                                        <option value="" disabled selected>Choose your option</option>
                                        <option v-for="opt in travelModeOptions" :key="opt.value" :value="opt.value + '|' + opt.label">{{opt.value}}.{{ opt.label }}</option>
                                    </select>

                                    <div class="d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-outline-secondary" @click="openAccordion(1)">Back</button>
                                        <a href="#details-right" class="btn btn-theme btn-voyager text-white">Next</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- RIGHT COLUMN: SUMMARY -->
                <div class="col-12 col-lg-4 hide-on-mobile">

                    <div id="details-right" class="card scroll-margin">
                        <div class="card-header">
                            Costing Structure
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless mb-0 align-middle">
                                <tbody>
                                    <tr>
                                        <td>Amount</td>
                                        <td class="text-end">
                                            <del v-if="calc.ready && calc.amountStruck" class="fw-bold text-muted">₹ {{ calc.amountStruck }}</del>
                                            <span class="fw-bold">{{ calc.ready ? '₹ ' + calc.amount : '...' }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>High Season Surcharge</td>
                                        <td class="fw-bold text-end">{{ calc.ready ? '₹ ' + calc.dateSurcharge : '...' }}</td>
                                    </tr>
                                    <tr>
                                        <td>GST 5%</td>
                                        <td class="fw-bold text-end">{{ calc.ready ? '₹ ' + calc.gst : '...' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Offer Applied on</td>
                                        <td class="fw-bold text-end">{{ calc.ready ? '₹' + calc.offerAppliedOn : '...' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Special Offer <template v-if="pkg.SPACIAL_OFFER">: {{ pkg.SPACIAL_OFFER }}%</template></td>
                                        <td class="fw-bold text-end">{{ calc.ready ? '- ₹ ' + calc.specialOfferAmount : '...' }}</td>
                                    </tr>
                                    <tr class="border-top">
                                        <td>Grand Total</td>
                                        <td class="fw-bold text-end">{{ calc.ready ? '₹ ' + calc.grandTotal : '...' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fs-5">Amount To Pay</td>
                                        <td class="fw-bold fs-5 text-end">{{ calc.ready ? '₹ ' + calc.amountToPay : '...' }}</td>
                                    </tr>
                                    <tr v-show="calc.ready && calc.saved > 0">
                                        <td>You Save</td>
                                        <td class="fw-bold text-success text-end">₹ {{ calc.saved }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label class="form-label">Coupon Code</label>
                                            <div class="input-group">
                                                <input type="text" name="coupon_code" class="form-control" v-model.trim="couponCode" :readonly="couponApplied">
                                                <button type="button" class="btn btn-theme btn-voyager text-white" :disabled="couponApplied" @click="applyCode">Apply code</button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr v-if="couponApplied">
                                        <td>Coupon Applied</td>
                                        <td class="text-end"><b>{{ couponCode }}</b></td>
                                    </tr>
                                    <tr v-if="couponApplied">
                                        <td>Final Amount</td>
                                        <td class="text-end">
                                            <b>₹{{ calc.amountToPay }}</b> - <b class="text-success">₹{{ couponDiscount }}</b><br>
                                            <span class="text-success"><b>₹ {{ finalPayable }}</b></span>
                                        </td>
                                    </tr>
                                    <tr v-if="calc.ready && UsablePoints > 0">
                                        <td>
                                            <label for="points">
                                                <input type="checkbox" id="points" v-model="usePoints">
                                                <i class='bx bx-star'></i> Use {{ UsablePoints }} Loyalty Points
                                                <span v-if="usePoints" class="text-success">(−₹{{ pointsDiscount }})</span>
                                            </label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-success" type="button" data-bs-toggle="offcanvas" data-bs-target="#couponsDrawer">View Available Coupons</button>
                            </div>
                            <br>
                            <div class="offcanvas offcanvas-bottom" tabindex="-1" id="couponsDrawer" aria-labelledby="offcanvasBottomLabel" style="--bs-offcanvas-height:60vh;">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasBottomLabel">Available Coupons</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body small">
                                    <div v-if="!couponApplied" class="coupon-container invisible-scrollbar">
                                        <div class="coupon" v-for="c in availableCoupons" :key="c.code" role="button" @click="selectCoupon(c.Coupon_Code)">
                                            <article>
                                                <aside>
                                                    <svg viewBox="0 0 172 64" preserveAspectRatio="none" aria-hidden="true">
                                                        <path d="M -6 60 Q 70 -4 180 34" fill="none" stroke="rgba(255,255,255,.3)"
                                                            stroke-width="1.6" stroke-dasharray="3 6" stroke-linecap="round" />
                                                        <circle cx="14" cy="47" r="3" fill="rgba(255,255,255,.55)" />
                                                    </svg>
                                                    <strong>₹{{ c.Coupon_Worth }}</strong>
                                                    <span>off</span>
                                                </aside>
                                                <section>
                                                    <h2>Flat ₹{{ c.Coupon_Worth }} off your booking</h2>
                                                    <p>Applies to bookings of ₹{{ Number(c.Coupon_Worth) + 2500 }} or more.</p>
                                                    <div>
                                                        <code>{{ c.Coupon_Code }}</code>
                                                        <button type="button" @click="selectCoupon(c.Coupon_Code)" data-code="{{ c.Coupon_Code }}">Apply</button>
                                                    </div>

                                                </section>
                                            </article>
                                        </div>

                                    </div>
                                    <div v-if="couponApplied">
                                        <p class="text-success text-center fs-2">{{couponCode}} Applied of <b class="text-success">₹{{ couponDiscount }}</b></p>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <table class="table table-borderless mb-0 align-middle">
                                <tbody>
                                    <tr class="border-top">
                                        <td colspan="2" class="fw-bold fs-2">{{ calc.ready ? '₹ ' + payNowAmount : '...' }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="small text-muted">{{ perPersonText }}</td>
                                    </tr>
                                    <tr v-if="calc.ready && earnedPoints > 0">
                                        <td colspan="2" class="small text-success">
                                            <i class='bx bx-star'></i> You'll earn <b>{{ earnedPoints }}</b> loyalty points on this booking
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-primary fw-bold">Booking Amount per person</td>
                                        <td class="fw-bold text-end">₹{{ pkg.BOOKING_AMOUNT || 3000 }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label class="form-label">How much you want to pay?</label>
                                            <select name="paymode" v-model="paymode" class="form-select">
                                                <option value="" disabled>Choose your option</option>
                                                <option value="full">1. Full Payment</option>
                                                <option value="booking">2. Booking Amount</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="d-grid">
                                            <input type="submit" value="Pay Now" class="btn btn-theme btn-voyager text-white btn-lg" :disabled="!calc.ready || overLimit">
                                        </td>
                                    </tr>
                                    <tr v-if="errorMessage">
                                        <td colspan="2" class="text-danger fw-bold small">{{ errorMessage }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>



</div>
<script>
    function parsePaxDetails(json) {
        const raw = typeof json === 'string' ? JSON.parse(json) : json;
        const travelersMap = {};

        Object.entries(raw).forEach(([key, value]) => {
            // "traveler_2_name" -> num=2, field="name"
            const match = key.match(/^traveler_(\d+)_(.+)$/);
            if (!match) return;
            const [, num, field] = match;
            if (!travelersMap[num]) travelersMap[num] = {
                traveler: num
            };
            travelersMap[num][field] = value;
        });

        return Object.values(travelersMap)
            .filter(t => t.name) // drop empty placeholder travelers (e.g. traveler_3 with all blanks)
            .sort((a, b) => a.traveler - b.traveler);
    }
</script>
<script>
    const {
        createApp,
        reactive,
        ref,
        computed,
        watch,
        onMounted
    } = Vue;

    createApp({
        setup() {
            // ---------------------------------------------------------------
            // Package data — in a real integration this comes from the backend
            // (replace this object with data injected server-side, e.g. via
            // a JSON blob rendered into the page, an API call on mount, etc.)
            // ---------------------------------------------------------------
            const MONTH_ABBR = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const pkg = reactive({
                PACKAGE_ID: <?= $package->PACKAGE_ID ?>,
                PACKAGE_NAME: '<?= $package->PACKAGE_NAME ?>',
                BOOKING_AMOUNT: <?= $package->BOOKING_AMOUNT ?: 3000 ?>,
                SPACIAL_OFFER: <?= $package->SPACIAL_OFFER ?>,
                CUSTOM_TRIP: <?= $package->CUSTOM_TRIP ?>,
                DATES: '<?= $package->DATES ?>',

                // Sharing labels — P5..P1 map to index 0..4
                INFO_P5: '<?= $package->INFO_P5 ?>',
                INFO_P4: '<?= $package->INFO_P4 ?>',
                INFO_P3: '<?= $package->INFO_P3 ?>',
                INFO_P2: '<?= $package->INFO_P2 ?>',
                INFO_P1: '<?= $package->INFO_P1 ?>',

                S_PRICE_5: <?= $package->S_PRICE_5 ?>,
                S_PRICE_4: <?= $package->S_PRICE_4 ?>,
                S_PRICE_3: <?= $package->S_PRICE_3 ?>,
                S_PRICE_2: <?= $package->S_PRICE_2 ?>,
                S_PRICE_1: <?= $package->S_PRICE_1 ?>,
                // Inclusive-of-travel pricing (used when travelmode = 3)
                PRICE_5: <?= $package->PRICE_5 ?>,
                PRICE_4: <?= $package->PRICE_4 ?>,
                PRICE_3: <?= $package->PRICE_3 ?>,
                PRICE_2: <?= $package->PRICE_2 ?>,
                PRICE_1: <?= $package->PRICE_1 ?>,
                HEAD_PRICE: '<?= strip_tags($package->HEAD_PRICE) ?>',


                // Without-travel pricing option 1 (travelmode = 2)
                WT_PRICE_5: <?= $package->WT_PRICE_5 ?>,
                WT_PRICE_4: <?= $package->WT_PRICE_4 ?>,
                WT_PRICE_3: <?= $package->WT_PRICE_3 ?>,
                WT_PRICE_2: <?= $package->WT_PRICE_2 ?>,
                WT_PRICE_1: <?= $package->WT_PRICE_1 ?>,
                HEAD_WTPRICE: '<?= strip_tags($package->HEAD_WTPRICE) ?>',

                // Without-travel pricing option 2 (travelmode = 1)
                WT2_PRICE_5: <?= $package->WT2_PRICE_5 ?>,
                WT2_PRICE_4: <?= $package->WT2_PRICE_4 ?>,
                WT2_PRICE_3: <?= $package->WT2_PRICE_3 ?>,
                WT2_PRICE_2: <?= $package->WT2_PRICE_2 ?>,
                WT2_PRICE_1: <?= $package->WT2_PRICE_1 ?>,
                HEAD_WT2PRICE: '<?= strip_tags($package->HEAD_WT2PRICE) ?>',

            });

            const priceArr = [pkg.PRICE_5, pkg.PRICE_4, pkg.PRICE_3, pkg.PRICE_2, pkg.PRICE_1];
            const sellPriceArr = [pkg.S_PRICE_5, pkg.S_PRICE_4, pkg.S_PRICE_3, pkg.S_PRICE_2, pkg.S_PRICE_1];
            const wtPriceArr = [pkg.WT_PRICE_5, pkg.WT_PRICE_4, pkg.WT_PRICE_3, pkg.WT_PRICE_2, pkg.WT_PRICE_1];
            const wt2PriceArr = [pkg.WT2_PRICE_5, pkg.WT2_PRICE_4, pkg.WT2_PRICE_3, pkg.WT2_PRICE_2, pkg.WT2_PRICE_1];
            const sharingLabels = [pkg.INFO_P5, pkg.INFO_P4, pkg.INFO_P3, pkg.INFO_P2, pkg.INFO_P1];

            const GST = 0.05;
            const MAX_ONLINE_AMOUNT = 500000;
            const availableCoupons = <?= json_encode($ValidCoupons) ?>;

            // Server-injected loyalty points balance for this logged-in user
            const UsablePoints = ref(<?= (int)$UsablePoints ?>);



            // ---------------- Form state ----------------

            const travelers = reactive([]);
            let travelerSeq = 1;

            const adults = computed(() => travelers.length);

            const selectedDate = ref('');
            const travelMode = ref('');

            const paymode = ref('full');
            const couponCode = ref('');
            const couponApplied = ref(false);
            const couponDiscount = ref(0);

            const openIndex = ref(0);
            const errors = reactive({
                date: false,
            });
            const errorMessage = ref('');
            const toastMsg = ref('');
            let toastTimer = null;

            //-----------------Loyalty Point state

            const usePoints = ref(false);
            const POINT_VALUE = 1; // adjust if 1 point isn't worth exactly ₹1

            const pointsDiscount = computed(() => {
                if (!usePoints.value || !calc.value.ready) return 0;
                const maxUsable = Math.min(UsablePoints.value * POINT_VALUE, calc.value.amountToPay);
                return Math.round(maxUsable);
            });

            //---------------- earning loyalty point 
            const POINTS_EARN_RATE = 0.05; // 5%

            const earnedPoints = computed(() => {
                if (!calc.value.ready) return 0;
                // Based on the total package cost before any coupon/points deduction
                return Math.round(calc.value.amountToPay * POINTS_EARN_RATE);
            });



            // ---------------- Derived Pax Details lists ----------------
            const parsedTravelers = computed(() => parsePaxDetails(paxDetailsJson.value));
            // ---------------- Derived option lists ----------------
            const sharingOptions = computed(() => {
                const opts = [];
                sharingLabels.forEach((label, idx) => {
                    if (label) opts.push({
                        value: `${idx}|${label}`,
                        label
                    });
                });
                return opts;
            });

            const travelModeOptions = computed(() => {
                const opts = [];
                if (pkg.WT2_PRICE_1) opts.push({
                    value: '1',
                    label: pkg.HEAD_WT2PRICE || 'Self Travel Price 2'
                });
                if (pkg.WT_PRICE_1) opts.push({
                    value: '2',
                    label: pkg.HEAD_WTPRICE || 'Self Travel Price'
                });
                opts.push({
                    value: '3',
                    label: pkg.HEAD_PRICE || 'Voyagers Beat Transport'
                });
                return opts;
            });

            const dateList = computed(() => {
                const today = new Date();
                today.setHours(0, 0, 0, 0); // ignore time, compare by calendar day
                function formatDDMonYYYY(dateStr) {
                    const [day, month, year] = dateStr.trim().split('/').map(Number);
                    return `${String(day).padStart(2, '0')}/${MONTH_ABBR[month - 1]}/${year}`;
                }

                function formatDateRangeLabel(rawLabel) {
                    // "04/09/2026 - 09/09/2026" -> "04/Sep/2026 - 09/Sep/2026"
                    // Also handles a single date with no range.
                    return rawLabel
                        .split('-')
                        .map(part => formatDDMonYYYY(part))
                        .join(' - ');
                }
                return pkg.DATES.split(',')
                    .map(entry => {
                        const [raw, surcharge] = entry.split('|');
                        const rawLabel = raw.trim();

                        // "04/09/2026 - 09/09/2026" -> use the first date to test "is this upcoming?"
                        const startStr = rawLabel.split('-')[0].trim();
                        const [day, month, year] = startStr.split('/').map(Number);
                        const startDate = new Date(year, month - 1, day);

                        return {
                            raw: entry,
                            label: formatDateRangeLabel(rawLabel),
                            surcharge: parseInt(surcharge || '0', 10),
                            startDate,
                        };
                    })
                    .filter(d => d.startDate >= today);
            });

            // ---------------- Traveler management ----------------
            function addTraveler() {
                travelerSeq++;
                travelers.push({
                    id: travelerSeq,
                    name: '',
                    gender: '',
                    contact: '',
                    sharing: '',
                    boarding_city: ''
                });
            }

            function removeTraveler(index) {
                travelers.splice(index, 1);
            }



            // ---------------- Pricing helpers ----------------
            function sharingPrice(sharingIndex, tmode) {
                if (tmode === 1) return wt2PriceArr[sharingIndex] || 0;
                if (tmode === 2) return wtPriceArr[sharingIndex] || 0;
                if (tmode === 3) return priceArr[sharingIndex] || 0;
                return 0;
            }

            function sharingSellPrice(sharingIndex, tmode) {
                // Mirrors the original page's "strike-through" price used to show savings.
                if (tmode === 3) return sellPriceArr[sharingIndex] || 0;
                return (wtPriceArr[sharingIndex] || wt2PriceArr[sharingIndex] || 0) + 2500;
            }

            function parseSharingIndex(val) {
                if (!val) return null;
                const idx = parseInt(String(val).split('|')[0], 10);
                return isNaN(idx) ? null : idx;
            }

            // ---------------- Main calculation ----------------
            const calc = computed(() => {
                const tmode = parseInt(travelMode.value, 10);
                const allSharing = [...travelers.map(t => t.sharing)];
                const indices = allSharing.map(parseSharingIndex);

                const ready = travelers.every(t => t.sharing) &&
                    !!selectedDate.value &&
                    !isNaN(tmode) &&
                    indices.every(i => i !== null);

                if (!ready) return {
                    ready: false
                };

                let amount = 0;
                let amountStruck = 0;
                indices.forEach(i => {
                    amount += sharingPrice(i, tmode);
                    amountStruck += sharingSellPrice(i, tmode);
                });

                const dateSurcharge = (parseInt(String(selectedDate.value).split('|')[1] || '0', 10) || 0) * adults.value;
                const gst = Math.round((amount + dateSurcharge) * GST * 100) / 100;
                const offerAppliedOn = Math.round((amount + gst + dateSurcharge) * 100) / 100;

                let running = offerAppliedOn;
                const specialOfferAmount = Math.round(running * (pkg.SPACIAL_OFFER / 100) * 100) / 100;
                running = Math.round((running - specialOfferAmount) * 100) / 100;

                const grandTotal = running;
                const amountToPay = Math.round(grandTotal);
                const saved = (amountStruck === 0 ? amount : amountStruck) - amountToPay;

                return {
                    ready: true,
                    amount,
                    amountStruck: amountStruck === amount ? 0 : amountStruck,
                    dateSurcharge,
                    gst,
                    offerAppliedOn,
                    specialOfferAmount,
                    grandTotal,
                    amountToPay,
                    saved,
                };
            });

            function selectCoupon(code) {
                if (couponApplied.value) {
                    runToast('Only One Coupon Can Be Applied', 'danger');
                    return;
                }
                couponCode.value = code;
                applyCode();

                const el = document.getElementById('couponsDrawer');
                const instance = bootstrap.Offcanvas.getOrCreateInstance(el);
                instance.hide();
            }
            const finalPayable = computed(() => {
                if (!calc.value.ready) return 0;
                let amount = calc.value.amountToPay;
                if (couponApplied.value) amount -= couponDiscount.value;
                if (usePoints.value) amount -= pointsDiscount.value;
                return Math.max(amount, 0);
            });

            const payNowAmount = computed(() => {
                if (!calc.value.ready) return 0;
                return paymode.value === 'booking' ?
                    pkg.BOOKING_AMOUNT * adults.value // booking mode: fixed amount per adult, coupon/points don't apply
                    :
                    finalPayable.value; // full mode: full price minus coupon discount and points (if used)
            });

            const perPersonText = computed(() => {
                if (!calc.value.ready || paymode.value !== '1') return '';
                const perPerson = (payNowAmount.value / adults.value).toFixed(0);
                return `₹${payNowAmount.value} / ${adults.value} = ₹${perPerson} per person`;
            });

            const overLimit = computed(() => calc.value.ready && payNowAmount.value >= MAX_ONLINE_AMOUNT);

            // JSON blob for the hidden pax_details field, kept in sync automatically
            // since it's a computed value re-evaluated whenever travelers change.
            const paxDetailsJson = computed(() => {
                return JSON.stringify(
                    travelers.map(t => ({
                        name: t.name,
                        gender: t.gender,
                        contact: t.contact,
                        boarding_city: t.boarding_city,
                        sharing: (t.sharing.split('|')[1] || '').toLowerCase(),
                    }))
                );
            });

            const storageKey = `voyager_booking_${pkg.PACKAGE_ID}`;

            function saveFormState() {
                const state = {
                    travelers: travelers.map(t => ({
                        ...t
                    })),
                    travelerSeq,
                    selectedDate: selectedDate.value,
                    travelMode: travelMode.value,
                    paymode: paymode.value,
                    couponCode: couponCode.value,
                    couponApplied: couponApplied.value,
                    couponDiscount: couponDiscount.value,
                    openIndex: openIndex.value,
                };
                try {
                    sessionStorage.setItem(storageKey, JSON.stringify(state));
                } catch (e) {
                    /* storage full or blocked — fail silently */
                }
            }

            function restoreFormState() {
                try {
                    const raw = sessionStorage.getItem(storageKey);
                    if (!raw) return;
                    const state = JSON.parse(raw);

                    Object.assign(lead, state.lead || {});
                    travelers.splice(0, travelers.length, ...(state.travelers || []));
                    travelerSeq = state.travelerSeq || (1 + travelers.length);

                    selectedDate.value = state.selectedDate || '';
                    travelMode.value = state.travelMode || '';
                    paymode.value = state.paymode || 'full';
                    couponCode.value = state.couponCode || '';
                    couponApplied.value = state.couponApplied || false;
                    couponDiscount.value = state.couponDiscount || 0;
                    openIndex.value = state.openIndex ?? 0;
                } catch (e) {
                    /* corrupt/old data — ignore */
                }
            }

            restoreFormState();

            // Save on every change to any of these — deep watch covers nested
            // traveler objects and lead fields.

            if (dateList.value.length > 0) {
                const stillValid = dateList.value.some(d => d.raw === selectedDate.value);
                if (!stillValid) selectedDate.value = '';
            }
            watch(
                [travelers, selectedDate, travelMode, paymode, couponCode, couponApplied, couponDiscount, openIndex],
                saveFormState, {
                    deep: true
                }
            );

            watch(overLimit, (val) => {
                errorMessage.value = val ?
                    `Maximum Amount is ${MAX_ONLINE_AMOUNT / 100000} Lac for Online Payment. Contact Us @ +91-<?= $defaultContact ?> for Offline Payment.` :
                    '';
            });
            watch(selectedDate, (val) => {
                if (val) errors.date = false;
            });
            // ---------------- Coupon ----------------
            async function applyCode() {
                if (!calc.value.ready) {
                    runToast('Fill in traveler, date and travel details first', 'danger');
                    return;
                }
                if (!couponCode.value) {
                    runToast('Enter a coupon code', 'danger');
                    return;
                }
                try {
                    const res = await fetch(`${window.location.protocol}//${window.location.hostname}/couponCode/${encodeURIComponent(couponCode.value)}`);
                    const data = await res.json();

                    const codeData = data && data[0];

                    if (!codeData || codeData.Coupon_Count == 0) {
                        runToast('Coupon expired or invalid', 'danger');
                        return;
                    }
                    const worth = parseFloat(codeData.Coupon_Worth);
                    const type = parseInt(codeData.Coupon_Type, 10); // 0 = flat, 1 = percent
                    const base = calc.value.amountToPay; // always the full amount, not payNowAmount
                    couponDiscount.value = type === 1 ? Math.round(base * (worth / 100)) : worth;
                    couponApplied.value = true;
                    runToast('Coupon applied!', 'success');
                } catch (e) {
                    runToast('Invalid coupon code', 'danger');
                }
            }

            // ---------------- Accordion ----------------
            const section0 = ref(null),
                section1 = ref(null),
                section2 = ref(null);

            function openAccordion(index) {
                openIndex.value = index;
                Vue.nextTick(() => {
                    const refs = [section0, section1, section2];
                    refs[index]?.value?.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                });
            }

            // ---------------- Validation 


            function validate() {
                errors.name = !lead.name;
                errors.gender = !lead.gender;
                errors.mobile = !lead.mobile;
                errors.email = !lead.email;
                errors.sharing = !lead.sharing;
                errors.date = !selectedDate.value;

                const firstError = Object.entries(errors).find(([, v]) => v);
                if (firstError) {
                    runToast(`Please fill "${firstError[0]}"`, 'danger');
                    return false;
                }
                if (!selectedDate.value) {
                    runToast('Please choose a date', 'danger');
                    return false;
                }
                if (!travelMode.value) {
                    runToast('Please choose a travel mode', 'danger');
                    return false;
                }
                if (travelers.some(t => !t.name || !t.gender || !t.contact || !t.email || !t.sharing)) {
                    runToast('Please complete all traveler details', 'danger');
                    return false;
                }
                return true;
            }


            function onSubmit(e) {
                // Only block the browser's normal POST when something is invalid.
                // If everything checks out, we do NOT call e.preventDefault(), so the
                // <form action="/payment/pay" method="POST"> submits natively — same
                // as the original PHP form — carrying every named/hidden field above.
                if (!validate() || overLimit.value) {
                    e.preventDefault();
                }
            }

            return {
                pkg,
                travelers,
                adults,
                selectedDate,
                travelMode,
                paymode,
                UsablePoints,
                usePoints,
                pointsDiscount,
                earnedPoints,
                couponCode,
                couponApplied,
                couponDiscount,
                finalPayable,
                payNowAmount,
                perPersonText,
                overLimit,
                errors,
                errorMessage,
                toastMsg,
                sharingOptions,
                travelModeOptions,
                dateList,
                calc,
                paxDetailsJson,
                addTraveler,
                removeTraveler,
                applyCode,
                openAccordion,
                openIndex,
                onSubmit,
                section0,
                section1,
                section2,
                availableCoupons,
                selectCoupon,
                parsedTravelers
            };
        }
    }).mount('#app');
</script>