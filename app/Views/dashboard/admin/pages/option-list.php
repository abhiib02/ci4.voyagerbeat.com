<div class="container-fluid custom-bg vh40 vertical-center">
    <div class="container">
        <div class="text-light ">
            <h1 class="">Options</h1>
        </div>
    </div>
</div>
<div class="container p-2">

    <p>Multiple Value Must be comma seperated</p>
    <table class="table  table-striped">
        <thead>
            <th>Option Name</th>
            <th>Option Value</th>
        </thead>
        <?php foreach ($Options as $index => $option) : ?>
            <tr>
                <td><?= $option->name ?></td>
                <td>
                    <form action="/option/<?= $option->name ?>" method="post" class="d-flex">
                        <input type="text" name="<?= $option->name ?>" value="<?= $option->value ?>" class="form-control" required>
                        <button class="btn btn-sm btn-success">Save</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>