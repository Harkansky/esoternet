<?php

declare(strict_types=1);

namespace App\Enum;

enum UserAccountStatusEnum: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case PENDING = 'pending';
    case BLOCKED = 'blocked';
    CASE BANNED = 'banned';
}
