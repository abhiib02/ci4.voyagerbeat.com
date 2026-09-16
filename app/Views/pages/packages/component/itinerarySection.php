<?php $itiArr = json_decode($package->PACK_IT) ?>
<div class="accordion" id="ItineraryAccordion">
    <?php foreach ($itiArr as $index => $day): ?>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#day-<?= $index ?>" aria-expanded="false" aria-controls="collapseOne">
                    <?= $day->dayTitle ?>
                </button>
            </h2>
            <div id="day-<?= $index ?>" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <div class="wysiwyg">
                        <?= $day->dayDesc ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>