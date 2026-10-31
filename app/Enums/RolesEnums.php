<?php

namespace App\Enums;

enum RolesEnums: int
{
    case USER = 0;
    case ADMIN    = 1;
    case EMPLOYEE = 2;
    case MANAGER  = 3;
}
