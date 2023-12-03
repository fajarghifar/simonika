<?php

namespace App\Enums;

enum BrandCategory: int
{
    case ELEKTRONIK = 1;
    case OTOMOTIF = 2;

    public function label(): string
    {
        return match ($this) {
            self::ELEKTRONIK => __('Elektronik'),
            self::OTOMOTIF => __('Otomotif')
        };
    }
}
