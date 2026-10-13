<form action="/updatePoints" method="post"
    style="height:100%;display:flex;flex-direction:column;justify-content:space-between;" id="pointUpdateForm">

    <div class="mb-3">
        <div class="row">
            <div class="col-6">
                <label>User ID</label>
                <input name="user_id" class="form-control-plaintext" type="number" value="<?= $customer->USER_ID ?? $customer->user_id ?>" required readonly />
            </div>
            <div class="col-6">
                <label>Points Balance</label>
                <a href="/dashboard/customers-list?customerID=<?= $customer->USER_ID ?? $customer->user_id ?>" class="form-control-plaintext" type="text" value=""><?= $customer->POINTS ?? 'See on Customer List' ?></a>

            </div>
        </div>

    </div>
    <div class="mb-3">
        <input type="radio" class="btn-check" name="action" id="btn-check-action-1" value="increase" required>
        <label class="btn btn-sm btn-outline-success" for="btn-check-action-1"><i class='bx bx-plus-circle'></i> Increase Points</label>

        <input type="radio" class="btn-check " name="action" id="btn-check-action-2" value="decrease" required>
        <label class="btn btn-sm btn-outline-danger" for="btn-check-action-2"><i class='bx bx-minus-circle'></i> Decrease Points</label>
    </div>
    <div>
        <label>Points</label>
        <br>
        <input type="number" class="form-control" inputmode="numeric" name="points" id="points" min="0" max="10000" autocomplete="off" required>



    </div>


</form>