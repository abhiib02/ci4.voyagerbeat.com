<form action="/UpdateCoupon" method="post"
    style="height:100%;display:flex;flex-direction:column;justify-content:space-between;">
    <div>
        <input name="id" type="hidden" value="<?= $coupon->Coupon_ID; ?>" />
        <div class="">
            <label>Coupon Code</label>

            <input name="code" class="form-control" type="text" value="<?= $coupon->Coupon_Code; ?>" required />
        </div>
        <div class="">
            <label>Coupon Worth (if type is 1 then mention percentage )</label>
            <input name="worth" class="form-control" id="worth" type="number" oninput='checkType()'
                value="<?= $coupon->Coupon_Worth; ?>" required />
        </div>
        <div class="">
            <label>Coupon Type (0 for Amount /1 for Percentage)</label>

            <select name="type" class="form-select" id="type" onchange="checkType()" required>
                <option value="<?= $coupon->Coupon_Type; ?>" selected>
                    <?= ($coupon->Coupon_Type) ? 'Percentage' : 'Amount'; ?></option>
                <option value="0">Amount</option>
                <option value="1">Percentage</option>
            </select>
        </div>
        <div class="">
            <label>Coupon Count (code usage limit)</label>
            <input name="count" class="form-control" type="number" value="<?= $coupon->Coupon_Count; ?>" required />
        </div>
    </div>
    <br>
    <div style="display:flex;justify-content:space-between;">
        <button type="submit" class="btn btn-sm btn-primary white-text"> Update Code</button>
        <button class=" btn btn btn-sm btn-dark white-text" type="button"
            onclick="closeModal('codeupd<?= $coupon->Coupon_ID; ?>');">Close</button>
    </div>
</form>



<script>
    function checkType() {
        const type = document.getElementById('type').value;
        const worthInput = document.getElementById('worth');
        if (type == 0) {
            worthInput.removeAttribute('max');
        }
        if (type == 1) {
            worthInput.setAttribute('max', '90');
        }

    }
</script>