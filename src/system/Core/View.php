<?php

/**
 * @package System
 * @subpackage Core
 * 
 * Pacate onde está a classe View
 */
namespace System\Core;

/**
 * Class View
 * 
 * Define uma interface de integração entre os
 * arquivos da visão com os controladores
 * 
 * @author Alan Freire - alan_freire@msn.com
 */

use System\Utilities;

class View
{
    /**
     * @var string
     * 
     * Recebe o caminho do arquivo do template
     */
    private $template;

    /**
     * @var array
     * 
     * Variáveis que pode ser visualizadas no template
     */

    private $data;

    /**
     * Method getTemplate
     * 
     * Retorna o nome do template
     *
     * @throws \Exception
     * O templete deve ser definido previamente
     * 
     * @return string
     */
    protected function getTemplate()
    {
        if (empty($this->template)) {
            throw new \Exception('Não foi definido o nome do template.');
        }

        return $this->template;
    }

    /**
     * Method setTemplate
     * 
     * Atribui um valor para o nome do template
     *
     * @throws \Exception
     * Nome do template deve ser uma string
     *
     * @throws \Exception
     * O valor do parametro deve ser um arquivo na pasta view
     * 
     * @param string
     * @return object
     */
    public function template($template)
    {
        if (!is_string($template)) {
            throw new \Exception('Nome do template inserido é inválido.');
        }

        $this->template = ROOT_DIR . getenv('APP_DIR_VIEW') . $template . '.php';

        if (!is_file($this->template)) {
            throw new \Exception('O parametro não corresponde a um arquivo do View.');
        }

        return $this;
    }

    /**
     * Method getData
     * 
     * Retorna o vetor com os valores que
     * poderam ser visualizados pelo template
     * 
     * @return array
     */
    protected function getData()
    {
        return $this->data;
    }

    /**
     * Method setData
     * 
     * Atribui um valor para o vetor de variáveis
     * que podem ser usadas no template
     *
     * @throws \Exception
     * O parametro deve ser um array
     * 
     * @param array
     * @return object
     */
    public function data($data)
    {
        if (!is_array($data)) {
            throw new \Exception('O valor passado é inválido.');
        }

        $this->data = $data;

        return $this;
    }

    /**
     * Method render
     * 
     * Imprime o template na tela
     * 
     * @return object
     */
    public function render()
    {
        if (count($this->getData()) > 0) {
            extract($this->getData(), EXTR_OVERWRITE);
        }
        
        include $this->getTemplate();

        return $this;
    }    

    public static function link($uri)
    {
        return getenv('URL_BASE') . $uri;
    }
    
    /**
     * @method correntUrl()
     * @access public
     * 
     * Retorna a url da página atual
     * 
     * @return string
     */
    public static function currentURL()
    {
        return 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
}