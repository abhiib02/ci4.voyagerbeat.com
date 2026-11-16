<?php

/**
 * @var object $package
 */
?>
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [{
                "@type": "ListItem",
                "position": 1,
                "name": "Home",
                "item": "<?= base_url() ?>"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "<?= $package->LOCATION ?>",
                "item": "<?= base_url() ?>packages/<?= $package->LOCATION ?>"
            },
            {
                "@type": "ListItem",
                "position": 3,
                "name": "<?= $package->PACKAGE_NAME ?>"
            }
        ]
    }
</script>
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "TouristTrip",
        "name": "<?= $package->PACKAGE_NAME ?>",
        "description": "<?= $package->META_DESC ?>",
        "touristType": [
            "<?= $package->PACKAGE_TYPE ?>"
        ],
        "tripOrigin": {
            "@type": "Place",
            "name": "<?= $package->LOCATION ?>, <?= $package->STATE ?>, <?= $package->COUNTRY ?>"
        },
        "itinerary": {
            "@type": "ItemList",
            <?php $itiArr = json_decode($package->PACK_IT) ?> "numberOfItems": <?= count($itiArr) ?>,
            "itemListElement": [
                <?php foreach ($itiArr as $index => $day): ?> {
                        "@type": "ListItem",
                        "position": <?= $index + 1 ?>,
                        "item": {
                            "@type": "Place",
                            "name": "<?= $day->dayTitle ?>",
                            "description": "<?= $day->dayTitle ?>"
                        }
                    }
                    <?php if (($index + 1) == count($itiArr)): ?>

                    <?php else: ?>,
                    <?php endif; ?>
                <?php endforeach; ?>
            ]
        }
    }
</script>