<?php

/**
 * @package App
 * @subpackage Controllers
 */
namespace App\Controllers;

use System\Core\Controller;

final class Home extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->template('home/home.twig')->render();
    }
}