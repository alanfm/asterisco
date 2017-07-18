<?php

/**
 * @package System
 * @subpackage Core
 */
namespace System\Core;

/**
 * Class PHPFunctions
 * @package System\Core
 *
 * Execura as funções nativas do PHP como um método da classe PHPFunctions
 */
class PHPFunctions
{
    public static function __callStatic($function, $arguments)
    {
        return call_user_func_array($function, $arguments);
    }
}