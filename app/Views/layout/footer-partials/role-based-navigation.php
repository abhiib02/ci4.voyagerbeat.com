<?php if (auth('Admin')): ?>
    <a href="/dashboard">Dashboard</a> |
    <a href="/logout">Logout</a>
<?php elseif (auth('Employee')): ?>
    <a href="/employee-dashboard">Employee Dashboard</a> |
    <a href="/logout">Logout</a>
<?php elseif (auth('User')): ?>
    <a href="/account">Account</a> |
    <a href="/logout">Logout</a>
<?php else: ?>
    <a href="/login">Login</a>
<?php endif; ?>