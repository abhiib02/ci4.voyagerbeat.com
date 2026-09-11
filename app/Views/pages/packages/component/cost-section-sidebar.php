<?php if (!$package->REQUEST_PRICE): ?>
    <style>
        .options {
            display: flex;
            gap: 10px;
            margin-top: 2px;
            margin-bottom: 10px;

            & .option {
                flex: 1;

                & label {
                    width: 100%;
                }
            }
        }



        .option label {
            cursor: pointer;
        }

        #priceResult {
            display: none;
        }

        #priceOptions {
            display: none;
        }

        .option>label>input[type="radio"] {
            visibility: hidden;
            display: none;
        }

        .bed-dot {
            width: 6px;
            height: 14px;
            border-radius: 2px;
            background: var(--secondaryColor);
            display: inline-block;
            margin: 0 1px;
            transition: all 0.5s ease;
            transition-delay: calc(sibling-index() * 100ms);
            translate: 0;
            opacity: 1;
        }


        @starting-style {
            .bed-dot {
                transition: all 0.3s ease;
                transition-delay: calc(sibling-index() * 10ms);
                translate: 0 100%;
                opacity: 0;
            }

        }

        /* .option>label:has(input[name="sharing"]:checked) {
            color: var(--bs-btn-hover-color);
            background-color: var(--bs-btn-hover-bg);
            border-color: var(--bs-btn-hover-border-color);
        }


        .option>label:has(input[name="priceType"]:checked) {
            color: var(--bs-btn-hover-color);
            background-color: var(--bs-btn-hover-bg);
            border-color: var(--bs-btn-hover-border-color);
        } */
    </style>


    <div class="outline-card style-border mb-2 p-2">

        <div class="section">
            <em>Choose your room sharing</em>
            <div id="sharingOptions" class="options"></div>
        </div>

        <div id="priceOptions" class="section">
            <em>Choose Boarding</em>
            <div id="priceTypeOptions" class="options"></div>
        </div>

        <div id="priceResult" class="">
        </div>
    </div>

    <script src="/js/util-script.js"></script>
    <script>
        const PackageID = <?= $package->PACKAGE_ID ?>;
        const AdvanceBookingAmount = <?= $package->BOOKING_AMOUNT ?>;
        const CostingObject = [
            <?php
            $info_blocks = [];

            for ($i = 1; $i <= 5; $i++) {
                $info_key = "INFO_P{$i}";
                $price_key = "PRICE_{$i}";
                $wt_price_key = "WT_PRICE_{$i}";
                $wt2_price_key = "WT2_PRICE_{$i}";

                if (!empty($package->$info_key)) {
                    $block = [
                        '"value": "' . $package->$info_key . '"',
                        '"label": "' . $package->$info_key . '"'
                    ];

                    // Primary Price
                    if (!empty($package->HEAD_PRICE) && $package->HEAD_PRICE != '0' && isset($package->$price_key) && $package->$price_key != 0 && $package->$price_key !== '') {
                        $block[] = '"' . $package->HEAD_PRICE . '": "' . $package->$price_key . '"';
                    }

                    // WT Price
                    if (!empty($package->HEAD_WTPRICE) && $package->HEAD_WTPRICE != '0' && isset($package->$wt_price_key) && $package->$wt_price_key != 0 && $package->$wt_price_key !== '') {
                        $block[] = '"' . $package->HEAD_WTPRICE . '": "' . $package->$wt_price_key . '"';
                    }

                    // WT2 Price
                    if (!empty($package->HEAD_WT2PRICE) && $package->HEAD_WT2PRICE != '0' && isset($package->$wt2_price_key) && $package->$wt2_price_key != 0 && $package->$wt2_price_key !== '') {
                        $block[] = '"' . $package->HEAD_WT2PRICE . '": "' . $package->$wt2_price_key . '"';
                    }

                    $info_blocks[] = "{\n  " . implode(",\n  ", $block) . "\n}";
                }
            }

            echo implode(",\n", $info_blocks);
            ?>
        ];


        const sharingOptions = document.getElementById("sharingOptions");
        const priceOptions = document.getElementById("priceOptions");
        const priceTypeOptions = document.getElementById("priceTypeOptions");
        const priceResult = document.getElementById("priceResult");


        // Create first-level radio buttons
        CostingObject.forEach((item, index) => {

            const wrapper = document.createElement("div");
            let sharingName = item.label.split(' ')[0].toLowerCase();
            wrapper.className = "option";

            let beddot = '';
            const count = getSharingTermNumber(sharingName);
            for (let i = 0; i < count; i++) {
                beddot += '<span class="bed-dot"></span>';
            }

            wrapper.innerHTML = `
                <label class="btn btn-outline-voyagers sharing">
                    <div>
                    ${beddot ?? ''}
                    </div>
                    <input
                        type="radio"
                        name="sharing"
                        value="${index}"
                    >
                    ${item.label.split(' ')[0]}
                </label>
            `;

            sharingOptions.appendChild(wrapper);
        });


        // When sharing is selected
        sharingOptions.addEventListener("change", function(event) {
            document.querySelector('label.sharing.active')?.classList.remove('active');
            const selectedIndex = event.target.value;
            const selectedObject = CostingObject[selectedIndex];
            event.target.parentElement.classList.add('active');
            // Clear previous price options
            priceTypeOptions.innerHTML = "";
            priceResult.style.display = "none";

            // Get all keys except value and label
            Object.keys(selectedObject).forEach(key => {

                if (key === "value" || key === "label") {
                    return;
                }

                const wrapper = document.createElement("div");
                wrapper.className = "option";

                wrapper.innerHTML = `
                
                    <label class="btn btn-outline-voyagers btn-sm priceType">
                        <i class='bx bx-transfer-alt fs-3 text-theme-secondary'></i>
                        <br>
                        <input
                            type="radio"
                            name="priceType"
                            value="${key}"
                        >
                        ${key.split('<br>')[1] ?? ''}
                    </label>
                `;

                priceTypeOptions.appendChild(wrapper);
            });

            priceOptions.style.display = "block";
        });


        // When price type is selected
        priceTypeOptions.addEventListener("change", function(event) {

            document.querySelector('label.priceType.active')?.classList.remove('active');
            const selectedIndex = document.querySelector(
                'input[name="sharing"]:checked'
            ).value;
            document.querySelector('label:has(input[name="priceType"]:checked)')?.classList.add('active');
            const selectedObject = CostingObject[selectedIndex];

            const selectedKey = event.target.value;
            const selectedPrice = Number(selectedObject[selectedKey]);
            const selectedPriceWithGST = Math.round(selectedPrice + (selectedPrice * 0.05));
            const OnlyGST = Math.round(selectedPrice * 0.05);
            priceResult.innerHTML = `
            <em>Costing summary</em>
            <div class="border rounded-3 p-3 m-2">
                <p class="d-flex justify-content-between border-bottom m-0 py-2">
                    <span class="text-secondary">${stripTags(selectedKey)}</span>
                    <span class="fw-bold">₹${selectedPrice}</span>
                </p>
                <p class="d-flex justify-content-between border-bottom  m-0 py-2">
                    <span class="text-secondary">GST @ 5%</span>
                    <span class="fw-bold">₹${OnlyGST}</span>
                </p>
                <p class="d-flex justify-content-between m-0 py-2 fs-5">
                    <span class="text-secondary">Total per person</span>
                    <span class="fw-bold">₹${selectedPriceWithGST}</span>
                </p>
            </div>
            
                
            <div class="d-flex justify-content-between py-1 gap-2">
                <a href="/book/${PackageID}" class="card btn btn-theme-2 btn-voyager px-2  flex-fill">
                    <div>
                        <em class="text-secondary">Pay Full</em><br>
                        <span class="fw-bold fs-3">
                        ₹${selectedPriceWithGST}</span>
                    </div>
                    </a>
                ${(AdvanceBookingAmount == 0) ? `` : `
                <a href="/book/${PackageID}" class="card px-2 card btn btn-outline-dark  flex-fill">
                    <div>
                        <em class="text-secondary">Pay Advance</em><br>
                        <span class="fw-bold fs-3">₹${AdvanceBookingAmount}</span>
                    </div>
                    </a>
                `}
                
            </div>
            `;

            priceResult.style.display = "block";
        });
    </script>

<?php endif; ?>


<!--
<ul class="nav nav-pills nav-fill gap-2 p-1 small  rounded-3" id="CostsTabNav" role="tablist">
            phpStartTag : if (!empty($package->INFO_P1)):  : phpEndTag
                <li class="nav-item" role="presentation">
                    <button class="nav-link active rounded-3 border" id="info_p1_tab" data-bs-toggle="tab" data-bs-target="#info_p1" type="button" role="tab" aria-selected="true">
                         phpEchoTag :  explode(' ', $package->INFO_P1)[0]  : phpEndTag
                    </button>
                </li>
            phpStartTag : endif;  : phpEndTag
            phpStartTag : if (!empty($package->INFO_P2)):  : phpEndTag
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-3 border" id="info_p2_tab" data-bs-toggle="tab" data-bs-target="#info_p2" type="button" role="tab" aria-selected="false">
                         phpEchoTag :  explode(' ', $package->INFO_P2)[0]  : phpEndTag
                    </button>
                </li>
            phpStartTag : endif;  : phpEndTag
            phpStartTag : if (!empty($package->INFO_P3)):  : phpEndTag
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-3 border" id="info_p3_tab" data-bs-toggle="tab" data-bs-target="#info_p3" type="button" role="tab" aria-selected="false">
                         phpEchoTag :  explode(' ', $package->INFO_P3)[0]  : phpEndTag
                    </button>
                </li>
            phpStartTag : endif;  : phpEndTag
            phpStartTag : if (!empty($package->INFO_P4)):  : phpEndTag
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-3 border" id="info_p4_tab" data-bs-toggle="tab" data-bs-target="#info_p4" type="button" role="tab" aria-selected="false">
                         phpEchoTag :  explode(' ', $package->INFO_P4)[0]  : phpEndTag
                    </button>
                </li>
            phpStartTag : endif;  : phpEndTag
            phpStartTag : if (!empty($package->INFO_P5)):  : phpEndTag
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-3 border" id="info_p5_tab" data-bs-toggle="tab" data-bs-target="#info_p5" type="button" role="tab" aria-selected="false">
                         phpEchoTag :  explode(' ', $package->INFO_P5)[0]  : phpEndTag
                    </button>
                </li>
            phpStartTag : endif;  : phpEndTag
        </ul>
        <hr>
        <div class="tab-content px-3" id="CostsTabNavContent">
            <div class="tab-pane fade active show" id="info_p1" role="tabpanel" aria-labelledby="info_p1-tab" tabindex="0">
                phpStartTag : if (!empty($package->HEAD_PRICE)):  : phpEndTag
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="m-0"> phpEchoTag :  strip_tags($package->HEAD_PRICE)  : phpEndTag</p>
                        <p class="fw-bold fs-3 m-0">₹ phpEchoTag :  $package->PRICE_1 ?? ''  : phpEndTag</p>
                    </div>
                phpStartTag : endif;  : phpEndTag
                phpStartTag : if (!empty($package->HEAD_WTPRICE)):  : phpEndTag
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="m-0"> phpEchoTag :  strip_tags($package->HEAD_WTPRICE)  : phpEndTag</p>
                        <p class="fw-bold fs-3 m-0">₹ phpEchoTag :  $package->WT_PRICE_1 ?? ''  : phpEndTag</p>
                    </div>
                phpStartTag : endif;  : phpEndTag
                phpStartTag : if (!empty($package->HEAD_WT2PRICE)):  : phpEndTag
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="m-0"> phpEchoTag :  strip_tags($package->HEAD_WT2PRICE)  : phpEndTag</p>
                        <p class="fw-bold fs-3 m-0">₹ phpEchoTag :  $package->WT2_PRICE_1 ?? ''  : phpEndTag</p>
                    </div>
                phpStartTag : endif;  : phpEndTag

            </div>
            <div class="tab-pane fade" id="info_p2" role="tabpanel" aria-labelledby="info_p2-tab" tabindex="0">
                phpStartTag : if (!empty($package->HEAD_PRICE)):  : phpEndTag
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="m-0"> phpEchoTag :  strip_tags($package->HEAD_PRICE)  : phpEndTag</p>
                        <p class="fw-bold fs-3 m-0">₹ phpEchoTag :  $package->PRICE_2 ?? ''  : phpEndTag</p>
                    </div>
                phpStartTag : endif;  : phpEndTag
                phpStartTag : if (!empty($package->HEAD_WTPRICE)):  : phpEndTag
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="m-0"> phpEchoTag :  strip_tags($package->HEAD_WTPRICE)  : phpEndTag</p>
                        <p class="fw-bold fs-3 m-0">₹ phpEchoTag :  $package->WT_PRICE_2 ?? ''  : phpEndTag</p>
                    </div>
                phpStartTag : endif;  : phpEndTag
                phpStartTag : if (!empty($package->HEAD_WT2PRICE)):  : phpEndTag
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="m-0"> phpEchoTag :  strip_tags($package->HEAD_WT2PRICE)  : phpEndTag</p>
                        <p class="fw-bold fs-3 m-0">₹ phpEchoTag :  $package->WT2_PRICE_2 ?? ''  : phpEndTag</p>
                    </div>
                phpStartTag : endif;  : phpEndTag

            </div>
            <div class="tab-pane fade" id="info_p3" role="tabpanel" aria-labelledby="info_p3-tab" tabindex="0">
                phpStartTag : if (!empty($package->HEAD_PRICE)):  : phpEndTag
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="m-0"> phpEchoTag :  strip_tags($package->HEAD_PRICE)  : phpEndTag</p>
                        <p class="fw-bold fs-3 m-0">₹ phpEchoTag :  $package->PRICE_3 ?? ''  : phpEndTag</p>
                    </div>
                phpStartTag : endif;  : phpEndTag
                phpStartTag : if (!empty($package->HEAD_WTPRICE)):  : phpEndTag
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="m-0"> phpEchoTag :  strip_tags($package->HEAD_WTPRICE)  : phpEndTag</p>
                        <p class="fw-bold fs-3 m-0">₹ phpEchoTag :  $package->WT_PRICE_3 ?? ''  : phpEndTag</p>
                    </div>
                phpStartTag : endif;  : phpEndTag
                phpStartTag : if (!empty($package->HEAD_WT2PRICE)):  : phpEndTag
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="m-0"> phpEchoTag :  strip_tags($package->HEAD_WT2PRICE)  : phpEndTag</p>
                        <p class="fw-bold fs-3 m-0">₹ phpEchoTag :  $package->WT2_PRICE_3 ?? ''  : phpEndTag</p>
                    </div>
                phpStartTag : endif;  : phpEndTag

            </div>
            <div class="tab-pane fade" id="info_p4" role="tabpanel" aria-labelledby="info_p4-tab" tabindex="0">
                phpStartTag : if (!empty($package->HEAD_PRICE)):  : phpEndTag
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="m-0"> phpEchoTag :  strip_tags($package->HEAD_PRICE)  : phpEndTag</p>
                        <p class="fw-bold fs-3 m-0">₹ phpEchoTag :  $package->PRICE_4 ?? ''  : phpEndTag</p>
                    </div>
                phpStartTag : endif;  : phpEndTag
                phpStartTag : if (!empty($package->HEAD_WTPRICE)):  : phpEndTag
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="m-0"> phpEchoTag :  strip_tags($package->HEAD_WTPRICE)  : phpEndTag</p>
                        <p class="fw-bold fs-3 m-0">₹ phpEchoTag :  $package->WT_PRICE_4 ?? ''  : phpEndTag</p>
                    </div>
                phpStartTag : endif;  : phpEndTag
                phpStartTag : if (!empty($package->HEAD_WT2PRICE)):  : phpEndTag
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="m-0"> phpEchoTag :  strip_tags($package->HEAD_WT2PRICE)  : phpEndTag</p>
                        <p class="fw-bold fs-3 m-0">₹ phpEchoTag :  $package->WT2_PRICE_4 ?? ''  : phpEndTag</p>
                    </div>
                phpStartTag : endif;  : phpEndTag

            </div>
            <div class="tab-pane fade" id="info_p5" role="tabpanel" aria-labelledby="info_p5-tab" tabindex="0">
                phpStartTag : if (!empty($package->HEAD_PRICE)):  : phpEndTag
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="m-0"> phpEchoTag :  $package->HEAD_PRICE  : phpEndTag</p>
                        <p class="fw-bold fs-3 m-0">₹ phpEchoTag :  $package->PRICE_5 ?? ''  : phpEndTag</p>
                    </div>
                phpStartTag : endif;  : phpEndTag
                phpStartTag : if (!empty($package->HEAD_WTPRICE)):  : phpEndTag
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="m-0"> phpEchoTag :  strip_tags($package->HEAD_WTPRICE)  : phpEndTag</p>
                        <p class="fw-bold fs-3 m-0">₹ phpEchoTag :  $package->WT_PRICE_5 ?? ''  : phpEndTag</p>
                    </div>
                phpStartTag : endif;  : phpEndTag
                phpStartTag : if (!empty($package->HEAD_WT2PRICE)):  : phpEndTag
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="m-0"> phpEchoTag :  strip_tags($package->HEAD_WT2PRICE)  : phpEndTag</p>
                        <p class="fw-bold fs-3 m-0">₹ phpEchoTag :  $package->WT2_PRICE_5 ?? ''  : phpEndTag</p>
                    </div>
                phpStartTag : endif;  : phpEndTag

            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center px-3">
            <p></p>
            <p class="fw-bold text-secondary">+ 5% GST</p>
        </div>
-->