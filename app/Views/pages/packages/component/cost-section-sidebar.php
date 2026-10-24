    <?php

    /**
     * @var object $package
     */
    ?>
<?php if (!$package->REQUEST_PRICE): ?>

    <style>
        .cost-sidebar-radio {
            position: relative;
            width: fit-content;

            &>input[type="radio"] {
                position: absolute;
                top: 5px;
                right: 5px;
                visibility: hidden;
            }

            &:has(input[type="radio"]:checked) {
                outline: 2px solid var(--secondaryColor);
            }
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

        .options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 2px;
            margin-bottom: 10px;

            & .option {
                flex: auto;

                & label {
                    width: 100%;
                }
            }
        }
    </style>
    <div class="outline-card style-border mb-2 p-2">
        <!-- Layer 1: Room Sharing Options -->
         <em>Choose your room sharing</em>
        <div id="sharingOptions" class="options "></div>
        <hr>
        <!-- Layer 2: Route / Price Options -->
         <em>Choose Boarding</em>
        <div id="priceOptions" class="options"></div>
        <!-- Final Output Section -->
        <div id="output"></div>
    </div>

    <script src="/js/util-script.js"></script>
    <script>
        const PackageID = <?= $package->PACKAGE_ID ?>;
        const AdvanceBookingAmount = <?= $package->BOOKING_AMOUNT ?>;
        const LoggedInUser = <?= json_encode(session()->get('logged_in')) ?>;
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
        const sharingDiv = document.getElementById("sharingOptions");
        const priceDiv = document.getElementById("priceOptions");
        const outputDiv = document.getElementById("output");

        // Function to render Layer 2 & output
        function renderPrices(objIndex) {
            const obj = CostingObject[objIndex];
            const keys = Object.keys(obj).filter(k => k !== "value" && k !== "label");

            priceDiv.innerHTML = keys.map((key, i) => `
        <label class="btn btn-outline-voyagers cost-sidebar-radio flex-fill">
        <i class='bx bx-transfer-alt fs-3 text-theme-secondary'></i>
                        <br>
          <input type="radio" name="pricing" data-key="${key}" value="${obj[key]}" ${i === 0 ? 'checked' : ''}>
          ${key.split('<br>')?.[1] ?? key}
        </label>
      `).join('');

            updateOutput();
        }

        // Function to update the final output text
        
        // quad sharing (4 persons in 1 room)
        // ----         ---------------------
        //  [1]                    [2]
        // item.label.match(/^([^\s]+).*\(([^)]+)\)/)[1]
        // item.label.match(/^([^\s]+).*\(([^)]+)\)/)[2]

        // Render Layer 1 (Sharing options)
        sharingDiv.innerHTML = CostingObject.map((item, i) => `
      <label class="btn btn-outline-voyagers cost-sidebar-radio flex-fill">
        <span>${item.label.match(/^([^\s]+).*\(([^)]+)\)/)?.[1] ?? item.label}</span>
        <br>
        ${Array.from({ length: getSharingTermNumber(item.label.split(' ')[0].toLowerCase()) }, (_, i) => `<span class="bed-dot"></span>`).join('')}
        <br>
        
        <input type="radio" name="sharing" value="${i}" ${i === 0 ? 'checked' : ''} class="">
        <span class="tiny-text">${item.label.match(/^([^\s]+).*\(([^)]+)\)/)?.[2] ?? item.label}</span>
      </label>
    `).join('');

        // Event delegation for radio changes
        sharingDiv.addEventListener("change", e => renderPrices(e.target.value));
        priceDiv.addEventListener("change", updateOutput);

        // Initialize with first item

        function updateOutput() {
            const checkedPrice = priceDiv.querySelector('input[name="pricing"]:checked');
            if (checkedPrice) {
                let Cost = checkedPrice.value;
                let GSTonCost = Math.round(checkedPrice.value*0.05);
                let CostWithGST = Math.round(Number(Cost) + Number(GSTonCost));
                outputDiv.innerHTML = `
                <em>Costing summary</em>
            <div class="border rounded-3 p-3 m-2">
                <p class="d-flex justify-content-between border-bottom m-0 py-2">
                    <span class="text-secondary">${stripTags(checkedPrice.dataset.key)}</span>
                    <span class="fw-bold">₹${Cost}</span>
                </p>
                <p class="d-flex justify-content-between border-bottom  m-0 py-2">
                    <span class="text-secondary">GST @ 5%</span>
                    <span class="fw-bold">₹${GSTonCost}</span>
                </p>
                <p class="d-flex justify-content-between m-0 py-2 fs-5">
                    <span class="text-secondary">Total per person</span>
                    <span class="fw-bold">₹${CostWithGST}</span>
                </p>
            </div>
            
            
            <div class="d-flex justify-content-between py-1 gap-2">
                <a ${LoggedInUser ? `href="/book/${PackageID}"` : 'href="#" data-bs-toggle="modal" data-bs-target="#LoginPopup"'} class="card btn btn-theme-2 btn-voyager px-2  flex-fill">
                    <div>
                        <em class="text-secondary">Pay Full</em><br>
                        <span class="fw-bold fs-3">
                        ₹${CostWithGST}</span>
                    </div>
                    </a>
                ${(AdvanceBookingAmount == 0 ) ? `` : `
                <a ${LoggedInUser ? `href="/book/${PackageID}"` : 'href="#" data-bs-toggle="modal" data-bs-target="#LoginPopup"'} class="card px-2 card btn btn-outline-dark  flex-fill">
                    <div>
                        <em class="text-secondary">Pay Advance</em><br>
                        <span class="fw-bold fs-3">₹${AdvanceBookingAmount}</span>
                    </div>
                    </a>
                `}
                
            </div>`;
            }
        }

        renderPrices(0);
    </script>

<?php endif; ?>

