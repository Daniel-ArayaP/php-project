<?php

namespace App\Enums;

class EmailNotificationResult
{
    public const SEND = 0;
    public const NOT_SEND = 1;
    public const INTERNAL_ERROR = 2;
}