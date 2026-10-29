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
                height: fit-content;
                background: var(--bg-color-2);

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
                        background: var(--bg-color-2);
                    }
                }
            }
        </style>
        <div class="mb-2 p-2">
            <!-- Layer 1: Room Sharing Options -->
            <em>Choose Sharing</em>
            <div id="sharingOptions" class="options pt-2"></div>
            <!-- Layer 2: Route / Price Options -->
            <em>Choose Boarding/Pickup</em>
            <div id="priceOptions" class="options pt-2"></div>
            <!-- Final Output Section -->
            <div id="output"></div>
            <?php if (!auth('Admin', 'Employee', 'User')): ?>
                <div class="alert alert-secondary text-center py-2 border border-warning">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#LoginPopup"><span class="fw-bold">Login to Book this Package</span></a>
                </div>

            <?php endif; ?>
        </div>

        <script src="/js/util-script.js"></script>
        <?php
        $costing = [];
        for ($i = 1; $i <= 5; $i++) {
            $info = $package->{"INFO_P$i"} ?? '';
            if (!$info) continue;

            $row = ['value' => $info, 'label' => $info];
            $pairs = [
                [$package->HEAD_PRICE,   $package->{"PRICE_$i"}   ?? null],
                [$package->HEAD_WTPRICE, $package->{"WT_PRICE_$i"} ?? null],
                [$package->HEAD_WT2PRICE, $package->{"WT2_PRICE_$i"} ?? null],
            ];
            foreach ($pairs as [$head, $price]) {
                if (!empty($head) && $head != '0' && !empty($price) && $price != 0) {
                    $row[$head] = $price;
                }
            }
            $costing[] = $row;
        }
        ?>


        <script>
            window.COSTING_CONFIG = <?= json_encode([
                                        'packageId' => $package->PACKAGE_ID,
                                        'advance'   => $package->BOOKING_AMOUNT,
                                        'loggedIn'  => (bool) session()->get('logged_in'),
                                        'costing'   => $costing,
                                    ], JSON_HEX_TAG | JSON_HEX_AMP) ?>;
        </script>
        <script src="/js/cost-sidebar.js">

        </script>
    <?php else: ?>
        <p>Pricing will be provided upon request, based on your selected destinations, duration, accommodations, and customization preferences.</p>
    <?php endif; ?>