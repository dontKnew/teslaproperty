<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Auth extends BaseConfig
{
    /*
    |--------------------------------------------------------------------------
    | Authentication settings
    |--------------------------------------------------------------------------
    |
    | This file is for storing the settings related to authentication
    |
    */

    public int $lockoutTime = 3600; // Set the lockout time to 1 hour (in seconds)
    public int $max_login_attempts = 3;
}
