<?php

namespace App\Enums;

enum InventoryCategory: int
{
    case LAPTOP = 1;
    case KOMPUTER = 2;
    case PRINTER = 3;

    public function label(): string
    {
        return match ($this) {
            self::LAPTOP => __('Laptop'),
            self::KOMPUTER => __('Komputer'),
            self::PRINTER => __('Printer')
        };
    }
}
