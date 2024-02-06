<?php

namespace App\Config;

class NBPConfig
{
    public function getBaseApiURL(): string
    {
        return $_ENV['NPB_BASE_API_URL'];
    }
}
