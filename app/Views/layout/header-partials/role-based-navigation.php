<?php if ($isAdmin): ?>
    <a class="list-group-item list-group-item-action" href="/dashboard">
        Admin Dashboard
    </a>
    <a class="list-group-item list-group-item-action text-bg-danger" href="/logout">
        Logout
    </a>
<?php elseif ($isEmployee): ?>
    <a class="list-group-item list-group-item-action" href="/employee-dashboard">
        Employee Dashboard
    </a>
    <a class="list-group-item list-group-item-action text-bg-danger" href="/logout">
        Logout
    </a>
<?php elseif ($isUser): ?>
    <a class="list-group-item list-group-item-action" href="/account">
        Your Profile
    </a>
    <a class="list-group-item list-group-item-action text-bg-danger" href="/logout">
        Logout
    </a>
<?php else: ?>
    <a class="list-group-item list-group-item-action" href="/login">
        Login
    </a>
    <a class="list-group-item list-group-item-action" href="/Signup">
        Signup
    </a>
<?php endif; ?>