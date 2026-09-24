<?php if ($isAdmin ?? false): ?>
    <a href="/dashboard">Dashboard</a> |
    <a href="/logout">Logout</a>
<?php elseif ($isEmployee ?? false): ?>
    <a href="/employee-dashboard">Employee Dashboard</a> |
    <a href="/logout">Logout</a>
<?php elseif ($isUser ?? false): ?>
    <a href="/account">Account</a> |
    <a href="/logout">Logout</a>
<?php else: ?>
    <a href="/login">Login</a>
<?php endif; ?>