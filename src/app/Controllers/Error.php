<?php

/**
 * @package App
 * @subpackage Controllers
 */
namespace App\Controllers;

use System\Core\Controller;
use System\Utilities;

final class Error extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(int $error)
    {
        $link = new \stdClass;
        $link->current_url = Utilities::url($_SERVER['REQUEST_URI']);
        $link->home = Utilities::url('/home');

        $this->data['link'] = $link;
        $this->data['app_title'] = 'Erro 404 - '.getenv('APP_TITLE');

        $this->view('error/'.$error.'.twig')->data($this->data)->render();
    }
}