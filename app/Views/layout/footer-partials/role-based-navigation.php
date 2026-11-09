<?php if (auth('Admin', 'Manager', 'Employee', 'User')): ?>
    <li><a href="/userdashboard">Dashboard</a></li>
    <li><a href="/logout">Logout</a></li>
<?php else: ?>
    <li><a href="/login">Login</a></li>
<?php endif; ?>