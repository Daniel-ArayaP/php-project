<?php

namespace App\Enums;

class CompanyRegisterResult
{
    public const SUCCESS = 0;
    public const ALREADY_REGISTERED = 1;
    public const NO_DATA = 2;
    public const INTERNAL_ERROR = 3;
}