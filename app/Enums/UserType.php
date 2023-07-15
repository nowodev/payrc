<?php

namespace App\Enums;


enum UserType: string
{
    case SUPERADMIN = 'super_admin';
    case ADMIN      = 'admin';
    case EMPLOYEE   = 'employee';
}
