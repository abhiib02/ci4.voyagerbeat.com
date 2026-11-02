<?php if (auth('User', 'Admin', 'Employee', 'Manager')): ?>
    <a class="list-group-item list-group-item-action" href="/userdashboard">
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