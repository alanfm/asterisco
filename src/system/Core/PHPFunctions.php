<?php

namespace System\Core;

class PHPFunctions
{
    public static function __callStatic($function, $arguments)
    {
        return call_user_func_array($function, $arguments);
    }
}