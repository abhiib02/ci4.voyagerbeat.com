<form action="/createCoupon" method="post"
    style="height:100%;display:flex;flex-direction:column;justify-content:space-between;">
    <div>

        <table>
            <tbody>
                <tr>
                    <td><label>Coupon Code</label>
                        <input name="code" class="form-control" type="text" required />
                    </td>
                    <td><label>Coupon Worth (if type is 1 then mention percentage )</label>
                        <input name="worth" class="form-control" type="number" id="worth" required />
                    </td>

                </tr>

                <tr>
                    <td> <label>Coupon Type (0 for Amount /1 for Percentage)</label>
                        <select name="type" id="type" class="form-select" onchange="checkType()" required>
                            <option value="0" selected>Amount</option>
                            <option value="1">Percentage</option>
                        </select>

                    </td>
                    <td><label>Coupon Count (code usage limit)</label>
                        <input name="count" class="form-control" type="number" required />
                    </td>

                </tr>

            </tbody>
        </table>
    </div>
    <div style="display:flex;justify-content:space-between;">
        <button type="submit" class="btn btn-sm btn-success white-text"> Create Code</button>
        <button class=" btn btn-sm btn-dark white-text" type="button" onclick="closeModal('codeCreate');">Close</button>
    </div>
</form>

<script>
    function checkType() {
        const type = document.getElementById('type');
        console.log(type);
        const worthInput = document.getElementById('worth');
        if (type.value == 0) {
            worthInput.removeAttribute("max");
        }
        if (type.value == 1) {
            worthInput.setAttribute('max', '90');
            worthInput.value = "0";
        }

    }
</script>