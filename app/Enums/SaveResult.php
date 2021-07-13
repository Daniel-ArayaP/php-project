<?php

namespace App\Enums;

class SaveResult
{
    public const SUCCESS = 0;
    public const DATES_ERROR = 1;
    public const INTERNAL_ERROR = 2;
    public const EXISTING_DATA = 3;
}