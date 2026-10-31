<?php

if (! function_exists('auth')) {
    /**
     * auth('Admin')
     * auth('Admin', 'Employee')
     */
    function auth(string ...$roles): bool
    {
        $definedRoles = [
            'User'     => 0,
            'Admin'    => 1,
            'Employee' => 2,
            'Manager'  => 3,
        ];

        $session = session();

        if (!$session->get('logged_in')) {
            return false;
        }

        if (empty($roles)) {
            return true; // just logged in, like plain @auth
        }

        // Map requested role names to their numeric values, ignoring unknown names
        $allowed = array_map(
            fn(string $r) => $definedRoles[$r] ?? null,
            $roles
        );
        $allowed = array_filter($allowed, fn($v) => $v !== null);

        // Cast to int: session values are often stored as strings ("1"),
        // which would fail a strict comparison against int 1
        return in_array((int) $session->get('role'), $allowed, true);
    }
}
if (! function_exists('loggedInUser')) {
    function loggedInUser()
    {
        return session()->get('id');
    }
}
if (! function_exists('loggedInUsername')) {
    function loggedInUsername()
    {
        return session()->get('name');
    }
}
