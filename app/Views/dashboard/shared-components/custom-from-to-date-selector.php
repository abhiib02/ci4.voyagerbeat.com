<?php

/**
 * @var string $startdate
 * @var string $enddate
 */
?>
<form method="get" class="d-flex">
    <?php foreach ($_GET as $key => $value): ?>
        <?php // Skip 'start' and 'end' so they don't duplicate or conflict with the date inputs 
        ?>
        <?php if (!in_array($key, ['start', 'end'])): ?>
            <?php if (is_array($value)): ?>
                <?php foreach ($value as $arrayKey => $arrayVal): ?>
                    <input type="hidden" name="<?= esc($key) ?>[<?= esc($arrayKey) ?>]" value="<?= esc($arrayVal) ?>">
                <?php endforeach; ?>
            <?php else: ?>
                <input type="hidden" name="<?= esc($key) ?>" value="<?= esc($value) ?>">
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    <div class="mb-3">
        <label for="">Start Date</label>
        <input type="date" class="form-control" value="<?= esc($startdate) ?>" name="start" id="" onchange="this.form.submit()">
    </div>
    <div class="mb-3">
        <label for="">End Date</label>
        <input type="date" class="form-control" value="<?= esc($enddate) ?>" name="end" id="" onchange="this.form.submit()">
    </div>

</form>