<?php

namespace App\Enums;

enum Role: int
{
    case ADMIN = 1;
    case USER = 2;

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => __('Admin'),
            self::USER => __('User')
        };
    }
}
