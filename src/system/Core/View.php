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
     * @var object
     * 
     * Instância do Templete Engine Twig
     */
    private $twig;

    public function __construct()
    {
        $this->twig = new \Twig_Environment(new \Twig_Loader_Filesystem(ROOT_DIR.'/src/app/Views'));
        $this->data = [];
    }

    /**
     * Method setTemplate
     * 
     * Atribui um valor para o nome do template
     *
     * @throws \Exception
     * Nome do template deve ser uma string
     *
     * 
     * @param string
     * @return object
     */
    public function template($template)
    {
        if (!is_string($template)) {
            throw new \Exception('Nome do template inserido é inválido.');
        }

        $this->template = $template;

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
        if (is_null($this->template)) {
            throw new Exception("Template não definido!");            
        }

        echo $this->twig->render($this->template, $this->data);
    }
}