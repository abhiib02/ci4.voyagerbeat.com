<div id="coupons" class="card">
    <div class="card-header">
        <div class="fw-bold">Coupons</div>
    </div>
    <div class="card-body">
        <button type="button" class="waves-effect  btn btn-sm btn-success  white-text" onclick="openModel('codeCreate')">Create Code</button>
        <dialog id="codeCreate" class="">
            <div class="card">
                <div class="card-header">Create Coupon Code</div>
                <div class="card-body">
                    <?= view('dashboard/admin/pages/coupon-partials/coupon-create') ?>
                </div>
            </div>




        </dialog>
        <div class="">
            <table class="sortable table" id="datatable" data-order='[[ 4, "desc" ]]'>
                <thead>
                    <tr>
                        <th>Coupon ID</th>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Worth</th>
                        <th>Count</th>
                        <th>Created On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (($Coupons ?? []) as $coupon) { ?>
                        <tr>
                            <td><?php echo $coupon->Coupon_ID; ?></td>
                            <td><?php echo $coupon->Coupon_Code; ?></td>
                            <td><?php echo $coupon->Coupon_Type; ?></td>
                            <td><?php echo $coupon->Coupon_Worth; ?></td>
                            <td><?php echo $coupon->Coupon_Count; ?></td>
                            <td><?php echo $coupon->Coupon_Created_at; ?></td>
                            <td>

                                <button type="button" class="waves-effect  btn btn-sm btn-primary white-text" onclick="openModel('codeupd<?php echo $coupon->Coupon_ID; ?>')">Update Code</button>
                                <button onclick="deleteCodeconfirm(<?= $coupon->Coupon_ID; ?>)" class="btn btn-sm btn-danger mx-1">Delete</button>

                                <dialog id="codeupd<?php echo $coupon->Coupon_ID; ?>">
                                    <div class="card">
                                        <div class="card-header">Update Coupon Code</div>
                                        <div class="card-body">
                                            <?= view('dashboard/admin/pages/coupon-partials/coupon-update', ['coupon' => $coupon]) ?>
                                        </div>
                                    </div>
                                </dialog>

                                <form action="/deleteCoupon" id="delcode<?= $coupon->Coupon_ID ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $coupon->Coupon_ID ?>">
                                </form>


                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function deleteCodeconfirm(id) {
        let form = document.querySelector(`#delcode${id}`);
        if (confirm('Do You Really Want to Delete this Code ?')) {
            form.submit();
        }
    }
</script>