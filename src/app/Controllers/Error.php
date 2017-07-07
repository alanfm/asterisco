<?php

/**
 * @package App
 * @subpackage Controllers
 */
namespace App\Controllers;

use System\Core\Controller;

final class Error extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(int $error)
    {
        $error = filter_var($error, FILTER_SANITIZE_NUMBER_INT);

        $this->view('error/'.$error)->render();
    }
}