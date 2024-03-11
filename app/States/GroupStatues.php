<?php

namespace App\States;

enum GroupStatues: string
{
    case New = 'new';

    case Pending = 'pending';

    case Confirmed = 'confirmed';

    public static function New(): self
    {
        return self::New;
    }

    public static function Pending(): self
    {
        return self::Pending;
    }

    public static function Confirmed(): self
    {
        return self::Confirmed;
    }
}
