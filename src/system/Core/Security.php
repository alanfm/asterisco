<?php

namespace System\Core;

use System\Core\PHPFunctions as PHP;
use HTMLBuilder\ElementFactory as Element;

class Security
{
    public static function crsfToken($input = null)
    {
        if (!Session::get('CRSFToken')) {
            Session::set('CRSFToken', PHP::hash('sha256', PHP::md5(PHP::getenv('SECURITY_KEY') . PHP::uniqid(PHP::rand(), true))));
        }

        if (!PHP::is_null($input)) {
            return Element::make('input')->attr('type', ['hidden'])->attr('value',[Session::get('CRSFToken')])->render();
        }

        return Session::get('CRSFToken');
    }
}