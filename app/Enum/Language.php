<?php

namespace App\Enum;

enum Language: string
{
    case EN = 'English';
    case DE = 'German';
    case HU = 'Hungarian';
    case ES = 'Spanish';

    public static function languages(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}

