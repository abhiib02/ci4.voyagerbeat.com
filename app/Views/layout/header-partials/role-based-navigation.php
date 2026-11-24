<?php if (auth('Admin', 'Manager', 'Employee', 'User')): ?>
    <a aria-label="open Dashboard" class="list-group-item list-group-item-action" href="/userdashboard">
        Dashboard
    </a>
    <a aria-label="LOGOUT" class="list-group-item list-group-item-action text-bg-danger" href="/logout">
        Logout
    </a>
<?php else: ?>
    <a aria-label="Login" class="list-group-item list-group-item-action" href="/login">
        Login
    </a>
    <a aria-label="Signup" class="list-group-item list-group-item-action" href="/signup">
        Signup
    </a>
<?php endif; ?>