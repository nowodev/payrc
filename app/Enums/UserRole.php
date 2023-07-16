<?php

namespace App\Enums;


enum UserRole: string
{
    case SUPERADMIN = 'super_admin';
    case ADMIN      = 'admin';
    case EMPLOYEE   = 'employee';

    public function label(): string
    {
        return match ($this) {
            UserRole::SUPERADMIN => 'Super Admin',
            UserRole::ADMIN      => 'Admin',
            UserRole::SUPERADMIN => 'Employee'
        };
    }
}
