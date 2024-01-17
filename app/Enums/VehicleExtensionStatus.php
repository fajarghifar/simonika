<?php

namespace App\Enums;

enum VehicleExtensionStatus: int
{
    case PENDING = 0;
    case APPROVED = 1;
    case REJECTED = 3;

    public function label(): string
    {
        return match ($this) {
            self::PENDING => __('Pending'),
            self::APPROVED => __('Approved'),
            self::REJECTED => __('Rejected')
        };
    }
}
