<?php if (auth('Admin')): ?>
    <li><a href="/dashboard">Dashboard</a></li>
    <li><a href="/logout">Logout</a></li>
<?php elseif (auth('Manager')): ?>
    <li><a href="/manager-dashboard">Dashboard</a></li>
    <li><a href="/logout">Logout</a></li>
<?php elseif (auth('Employee')): ?>
    <li><a href="/employee-dashboard">Dashboard</a></li>
    <li><a href="/logout">Logout</a></li>
<?php elseif (auth('User')): ?>
    <li><a href="/account">You Profile</a></li>
    <li><a href="/logout">Logout</a></li>
<?php else: ?>
    <li><a href="/login">Login</a></li>
<?php endif; ?>