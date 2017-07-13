<?php

namespace System;

class Utilities
{
    public static function token()
    {
        if (!isset($_SESSION['token'])) {        
            $_SESSION['token'] = md5(uniqid(rand(), true));
        }
        
        return $_SESSION['token'];
    }

    /**
     * @method redirect()
     * @access public
     * 
     * Redireciona para a pagina passada por paramentro
     * 
     * @param string
     */
    public static function redirect($url)
    {
        header('Location: ' . URL_BASE . $url);
        exit();
    }

    public static function sanitize($var, $type = null)
    {
        switch ($type) {
            case 'int':
            case 'integer':
                $var = (int)$var;
                break;
            case 'float':
            case 'real':
                $var = (float)$var;
                break;
            default:
                $var = (string)$var;
                break;
        }
        
        return filter_var($var, self::filter($var));
    }

    private static function filter($var)
    {
        if (is_int($var)) {
            return FILTER_SANITIZE_NUMBER_INT;
        }
        
        return FILTER_SANITIZE_STRING;
    }

    public static function mask($val, $mask)
    {
        $val = (string) $val;
        $maskared = '';
        $k = 0;
        for($i = 0; $i <= strlen($mask) - 1; $i++) {
            if($mask[$i] == '#') {
                if(isset($val[$k])) {
                    $maskared .= $val[$k++];
                }
            } else {
                if(isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }
            }
        }

        return $maskared;
    }
}