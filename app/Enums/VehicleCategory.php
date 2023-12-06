<?php

namespace App\Enums;

enum VehicleCategory: int
{
    case MOTOR = 1;
    case MOBIL = 2;

    public function label(): string
    {
        return match ($this) {
            self::MOTOR => __('Motor'),
            self::MOBIL => __('Mobil'),
        };
    }
}
