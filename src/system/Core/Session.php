<?php

namespace System\Core;

use System\Core\PHPFunctions as PHP;
use System\Core\Security;

class Session extends PHP
{
    public static function start()
    {
        if (self::actived()) {
            PHP::session_name(PHP::md5(PHP::getenv('SECURITY_KEY').$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']));
            PHP::session_cache_expire(PHP::getenv('SESSION_EXPIRE'));
            PHP::session_start();
            PHP::session_regenerate_id();
        }
    }

    public static function actived()
    {
        return PHP::session_status() !== PHP_SESSION_DISABLED;
    }

    public static function set($name, $value)
    {
        if (PHP::is_null($name)) {
            die('Nome inválido para a sessão');
        }

        $_SESSION[PHP::filter_var($name)] = $value;
    }

    public static function get($name)
    {
        return $_SESSION[PHP::filter_var($name)] ?? null;
    }
}