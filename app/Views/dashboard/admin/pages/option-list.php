<?php

/**
 * @var array $Options
 */
?>
<div id="options" class="card">
    <div class="card-header">
        <div class="fw-bold">Options</div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <p>Multiple Value Must be comma seperated</p>
            <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCreateOptionform" aria-controls="offcanvasRight">Create Option</button>
        </div>
        <div class="">
            <table class="table  table-striped">
                <thead>
                    <th>Option Name</th>
                    <th>Option Value</th>
                </thead>
                <?php foreach (($Options ?? []) as $index => $option) : ?>
                    <tr>
                        <td><?= $option->name ?></td>
                        <td>
                            <form action="/option/<?= $option->name ?>" method="post" class="d-flex">
                                <input type="text" name="<?= $option->name ?>" value="<?= $option->value ?>" class="form-control">
                                <button class="btn btn-sm btn-success">Save</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>



<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCreateOptionform" aria-labelledby="offcanvasCreateOptionformLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Create Option</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="/option-create" method="post">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Option Name</span>
                <input type="text" class="form-control" placeholder="Option Name" name="name" required aria-label="Option Name" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Option Value</span>
                <input type="text" class="form-control" placeholder="Option Value" name="value" required aria-label="Option Value" aria-describedby="basic-addon1">
            </div>
            <button class="btn btn-sm btn-success">Create Option</button>
        </form>
    </div>
</div>