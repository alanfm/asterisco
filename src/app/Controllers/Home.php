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

    public function index($id = null)
    {
        $id = is_null($id)? 1: filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $this->view->template('home/home.twig')->data(['pagination'=> Pagination::render(11*16, $id, 'home'),
                                                       'app_title'=>getenv('APP_TITLE'),
                                                       'app_url'=>getenv('URL_BASE')])->render();
    }
}