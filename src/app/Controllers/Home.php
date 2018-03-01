<?php

/**
 * @package App
 * @subpackage Controllers
 */
namespace App\Controllers;

use System\Core\Controller;
use App\Libraries\Bootstrap\Pagination;

final class Home extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($id = 1)
    {
        // Foi feito uma gambiarra para validação de pagina atual
        $this->data['pagination'] = Pagination::render(12*16, intval($id), 'home');

        $this->view->template('home/home.twig')->data($this->data)->render();
    }
}