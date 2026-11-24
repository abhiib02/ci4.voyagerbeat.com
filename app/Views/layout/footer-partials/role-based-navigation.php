<?php if (auth('Admin', 'Manager', 'Employee', 'User')): ?>
    <li class="p-2"><a aria-label="Open Dashboard" class="text-light" href="/userdashboard">Dashboard</a></li>
    <li class="p-2"><a aria-label="Logout" class="text-light" href="/logout">Logout</a></li>
<?php else: ?>
    <li class="p-2"><a aria-label="Login" class="text-light" href="/login">Login</a></li>
<?php endif; ?>