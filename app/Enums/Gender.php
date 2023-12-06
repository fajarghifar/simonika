<?php

namespace App\Enums;

enum Gender: int
{
    case MALE = 1;
    case FEMALE = 2;

    public function label(): string
    {
        return match ($this) {
            self::MALE => __('Laki-laki'),
            self::FEMALE => __('Perempuan')
        };
    }
}
