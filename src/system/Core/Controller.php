<?php

/**
 * @package System
 * @subpackage Core
 */
namespace System\Core;

use Symfony\Component\Routing\Exception\InvalidParameterException;
use System\Core\View;
use ActiveRecord\Model;
/**
 * Class Controller
 * 
 * Classe base para um controller do projeto
 * usando o padrão MVC
 * 
 * @author Alan Freire - Alan Freire
 */

class Controller
{
    /**
     * @var object
     * @access protected
     * 
     * recebe um objeto view
     */
    protected $view;

    /**
     * @var mix
     * @access protected
     *
     * recebe os valores a ser passados para a view
     */
    protected $data;

    /**
     * Method __construct
     * @access public
     * 
     * Define as configurações do controller
     */
    public function __construct()
    {
        $this->data['app_title'] = getenv('APP_TITLE');
        $this->data['app_url'] = getenv('APP_URL');
        $this->view = new View();
    }
    
    /**
     * Method getView
     * @access protected
     * 
     * Recebe o endereço do arquivo de view e
     * retorna o objeto view
     * 
     * @param string
     * @param array
     * 
     * @return object
     */
    protected function view($template = null, array $data = [])
    {
        if ($template) {
            $this->view->template($template);
        }

        if (count($data)) {
            $this->view->data($data);
        }

        return $this->view;
    }

    /**
     * Method show
     * @access public
     * 
     * Metodo padrão para impressão do template na tela
     * 
     * @return object
     */

    public function render()
    {
        $this->view()->render();

        return $this;
    }

    /**
     * Method JSON
     * @access public
     * 
     * Recebe um array como parametro e 
     * retorna os dados no formato JSON
     *
     * @throws \Exception
     * Parametro deve ser um array
     *
     * @param array
     * @return Controller
     */
    public function JSON(array $data)
    {
        if (!is_array($data)) {
            throw new \Exception("Parametro inválido. Atribua um vetor como parametro.");         
        }

        header('Content-Type: application/json');
        echo json_encode($data);

        return $this;
    }
}