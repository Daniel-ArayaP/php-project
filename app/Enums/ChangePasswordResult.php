<?php

namespace App\Enums;

class ChangePasswordResult
{
    public const SUCCESS = 0;
    public const OLDPASSWORD_ERROR = -1;
    public const INTERNAL_ERROR = -2;
}