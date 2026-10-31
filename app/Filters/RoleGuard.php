<?php

namespace App\Filters;

use App\Enums\RolesEnums;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please log in.');
        }

        $userRole = RolesEnums::tryFrom((int) session()->get('role'));

        // Turn the arguments ('admin', 'employee') into enum cases
        $allowed = [];
        foreach ((array) $arguments as $name) {
            $case = constant(RolesEnums::class . '::' . strtoupper($name));
            $allowed[] = $case;
        }

        if (! in_array($userRole, $allowed, true)) {
            return redirect()->to('/')->with('error', 'You are not allowed to access this page.');
        }
    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
