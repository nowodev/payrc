<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum UserRole: string
{
    case SUPERADMIN = 'super_admin';
    case ADMIN      = 'admin';
    case EMPLOYEE   = 'employee';

    public static function options(): array
    {
        $cases   = static::cases();
        $options = [];

        foreach ($cases as $case) {
            $label = $case->name;

            if (Str::contains($label, '_')) {
                $label = Str::replace('_', ' ', $label);
            }

            $options[] = [
                'value' => $case->value,
                'label' => Str::title($label)
            ];
        }

        return $options;
    }
}
