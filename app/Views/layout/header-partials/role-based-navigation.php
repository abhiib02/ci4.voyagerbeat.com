<?php if (auth('Admin')): ?>
    <a class="list-group-item list-group-item-action" href="/dashboard">
        Dashboard
    </a>
    <a class="list-group-item list-group-item-action text-bg-danger" href="/logout">
        Logout
    </a>
<?php elseif (auth('Manager')): ?>
    <a class="list-group-item list-group-item-action" href="/manager-dashboard">
        Dashboard
    </a>
    <a class="list-group-item list-group-item-action text-bg-danger" href="/logout">
        Logout
    </a>
<?php elseif (auth('Employee')): ?>
    <a class="list-group-item list-group-item-action" href="/employee-dashboard">
        Dashboard
    </a>
    <a class="list-group-item list-group-item-action text-bg-danger" href="/logout">
        Logout
    </a>
<?php elseif (auth('User')): ?>
    <a class="list-group-item list-group-item-action" href="/account">
        Dashboard
    </a>
    <a class="list-group-item list-group-item-action text-bg-danger" href="/logout">
        Logout
    </a>
<?php else: ?>
    <a class="list-group-item list-group-item-action" href="/login">
        Login
    </a>
    <a class="list-group-item list-group-item-action" href="/signup">
        Signup
    </a>
<?php endif; ?>