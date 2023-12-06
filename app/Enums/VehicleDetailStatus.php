<?php

namespace App\Enums;

enum VehicleDetailStatus: int
{
    case KEMBALI = 0;
    case PINJAM = 1;

    public function label(): string
    {
        return match ($this) {
            self::KEMBALI => __('Kembali'),
            self::PINJAM => __('Pinjam')
        };
    }
}
