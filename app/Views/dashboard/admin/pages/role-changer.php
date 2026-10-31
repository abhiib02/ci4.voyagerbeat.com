<div id="RoleChanger" class="card">
    <div class="card-header">
        <div class="fw-bold">Role Changer</div>
    </div>
    <div class="card-body">
        <form action="/roleChange" method="post">
            <label for="">User ID</label>
            <input type="number" name="user_id" class="form-control mb-2" id="">

            <label for="Role">Role</label>
            <select name="role" class="form-select mb-2" id="">
                <option value="" selected disabled>Choose Role</option>
                <option value="0">User (Customer)</option>
                <option value="1">Admin</option>
                <option value="2">Employee</option>
                <option value="3">Manager</option>
            </select>
            <button type="submit" class="btn btn-info">Change Role</button>
        </form>
    </div>
</div>
</div>