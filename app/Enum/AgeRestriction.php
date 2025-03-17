<?php

namespace App\Enum;

enum AgeRestriction: int
{
    case SIX = 6;
    case TWELVE = 12;
    case SIXTEEN = 16;
    case EIGHTEEN = 18;

    public static function ageRestrictions(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
