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
        $error = filter_var($error, FILTER_SANITIZE_NUMBER_INT);

        $link = new \stdClass;
        $link->current_url = Utilities::url($_SERVER['REQUEST_URI']);
        $link->home = Utilities::url('/home');

        $this->view('error/'.$error.'.twig')->data(['link'=>$link])->render();
    }
}