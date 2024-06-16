<?php

namespace App\Enums;

enum Role
{
    case ADMIN;
    case STAFF;
    case OPERATOR;

    public function status(): string
    {
        return match ($this) {
            self::ADMIN => 'admin',
            self::OPERATOR => 'operator',
            self::STAFF => 'staff',
        };
    }
}
