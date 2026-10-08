<?php $FAQS = json_decode($FAQS) ?>
<div class="accordion" id="FAQAccordion">
    <?php foreach ($FAQS as $index => $item): ?>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#question-<?= $index ?>" aria-expanded="false" aria-controls="collapseOne">
                    <?= $item->question ?>
                </button>
            </h2>
            <div id="question-<?= $index ?>" class="accordion-collapse collapse" data-bs-parent="#FAQAccordion">
                <div class="accordion-body">
                    <div class="wysiwyg">
                        <?= $item->answer ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>