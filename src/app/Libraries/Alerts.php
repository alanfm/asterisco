<?php

namespace App\Libraries;

use HTMLBuilder\ElementFactory as Element;

final class Alerts
{
    private static $html;

    private static function html($alert)
    {
        self::$html = Element::make('div')->attr('class', ['alert', 'alert-'.$alert, 'alert-dismissible'])
                                                   ->attr('role', 'alert');
    }

    public static function render($alert, $message = null)
    {
        self::html($alert);
        self::$html->value(Element::make('button')->attr('type', ['button'])->attr('class', ['close'])->attr('data-dismiss', ['alert'])->value(Element::make('span')->attr('aria-hidden', ['true'])->value('&times;')))
                   ->value(Element::make('strong')->value('Aviso!&nbsp'))
                   ->value(!is_null($message)? $message: self::message($alert));

        return self::$html->render();
    }

    private static function message($alert)
    {
        switch ($alert) {
            case 'success':
            case 'info':
                return 'Registro efetuado com sucesso!';
                break;
            case 'danger':
            case 'warning':
                return 'Erro ao efetuar o registro!';
                break;
            
            default:
                return 'Erro não identificado!';
                break;
        }
    }
}