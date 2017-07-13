<?php

/**
 * @package App
 * @subpackage Libraries\Bootstrap
 */
namespace App\Libraries\Bootstrap;

/**
 * @dependences HTMLBuilder\ElementFactory
 */
use HTMLBuilder\ElementFactory as Element;

/**
 * @class Pagination
 * 
 * Interface para criação de paginação em html e
 * framework css Bootstrap
 * 
 * @author Alan Freire <alan_freire@msn.com>
 * @version 1.0
 * @copyright MIT 2017 Alan Freire
 */
final class Pagination
{
    /**
     * @var HTMLBuilfer\Element
     * @access private
     */
    private static $ul;

    /**
     * @var intger
     * @access private
     */
    private static $limit;

    /**
     * @var string
     * @access private
     */
    private static $uri;

    /**
     * @var integer
     * @access private
     */
    private static $count_li = 4;

    /**
     * @method render()
     * 
     * Cria um código HTML de uma lista para paginação
     * 
     * @param integer $count
     * @param integer $current
     * @param string $url
     * 
     * @return string
     */
    public static function render(int $count, int $current, string $uri)
    {
        // Seta a quantidade de registro por página
        self::$limit = $count / getenv('APP_LIMIT_PAGINATION');
        // Seta a uri do app
        self::$uri = $uri;
        // Cria a tag ul
        $ul = Element::make('ul')->attr('class', ['pagination', 'pagination-sm']);

        // Adiciona a seta de voltar
        $ul->value(self::previous($count, $current, $uri));
        
        $i = self::firstPageIterator($current);
        do {
            if (self::$limit < 3) {
                break;
            }

            $li = Element::make('li');

            if (($i + 1) == $current) {
                $li->attr('class', ['active'])->value(self::link($i + 1, null, true));
            } else {
                $li->value(self::link($i+1));
            }

            $ul->value($li);

            $i++;
        } while ($i < self::lastPageIterator($current));

        // Adiciona a seta de avançar
        $ul->value(self::next($count, $current, $uri));

        return Element::make('nav')->attr('aria-label', ['Page navigation'])->value($ul)->render();
    }

    /**
     * @method previous
     * 
     * Cria os primeiros elementos da lista para paginação
     * 
     * @param integer $count
     * @param integer $current
     * 
     * @return array
     */
    private static function previous(int $count, int $current)
    {
        $text = Element::make('i')->attr('aria-hidden', ['true'])->attr('class', ['fa', 'fa-chevron-left', 'fa-lg']);
        $li = Element::make('li');

        if ($current <= 1) {
            return [$li->attr('class', ['disabled'])->value(self::link('', $text, true)), self::firstLi($current)];
        }

        return [$li->value(self::link($current - 1, $text)), self::firstLi($current)];
    }

    /**
     * @method firstLi()
     * 
     * Cria o primeiro item da lista
     * e o deixa fixo no início junto com a seta para
     * voltar a página, inserindo também as reticenças
     * caso seja necessário
     * 
     * @param integer $current
     * 
     * @return mix
     */
    private static function firstLi(int $current)
    {
        $li = Element::make('li')->value(self::link(1));

        if ($current == 1) {
            return $li->attr('class', ['active']);
        }

        if ((self::firstPageIterator($current) + self::$count_li) > (self::$count_li + 1)) {
            return [$li, self::reticence()];
        }

        return $li;
    }

    /**
     * @method next()
     * 
     * Adiciona os elementos do final da lista de links da pagináção
     * 
     * @param integer $count
     * @param integer $current
     * 
     * @return array
     */
    private static function next(int $count, int $current)
    {
        $text = Element::make('i')->attr('aria-hidden', ['true'])->attr('class', ['fa', 'fa-chevron-right', 'fa-lg']);
        $li = Element::make('li');

        if ($current >= self::$limit) {
            return [self::lastLi($current), $li->attr('class', ['disabled'])->value(self::link('', $text, true))];
        }

        return [self::lastLi($current), $li->value(self::link($current + 1, $text))];
    }   

    /**
     * @method lastLi()
     * 
     * Cria o ultimo item da lista
     * e o deixa fixo no final junto com a seta para
     * avançar a página, inserindo também as reticenças
     * caso seja necessário
     * 
     * @param integer $current
     * 
     * @return mix
     */
    private static function lastLi(int $current)
    {
        if (self::$limit == 1) {
            return;
        }

        $li = Element::make('li')->value(self::link(self::$limit));
        
        if ($current == self::$limit) {
            return $li->attr('class', ['active']);
        }

        if ((self::lastPageIterator($current) + self::$count_li) <= (self::$limit + 2)) {
            return [self::reticence(), $li];
        }

        return $li;
    }

    private static function firstPageIterator(int $current)
    {
        if (($current - self::$count_li) > 0) {
            return $current - self::$count_li;
        }

        return self::$limit == 1? null: 1;
    }

    private static function lastPageIterator(int $current)
    {        
        if (($current + self::$count_li) < self::$limit) {
            return ($current + self::$count_li) - 1;
        }

        return self::$limit > 1? self::$limit - 1: 1;
    }

    private static function reticence()
    {
        return Element::make('li')->attr('class',['disabled'])->value(self::link('', '...', true));
    }

    private static function link(string $page, $text = null, bool $disabled = false)
    {
        $a = Element::make('a')->attr('href', [$disabled? 'javascript:void()': getenv('URL_BASE').self::$uri.'/'.$page]);

        if ($text == null) {
            return $a->value($page);
        }

        return $a->value($text);
    }
}