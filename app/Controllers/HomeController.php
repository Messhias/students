<?php

namespace app\Controllers;

use app\Models\User;
use core\Controller;
use core\View;

/**
 * HomeController controller
 *
 * PHP version 7.0
 */
class HomeController extends Controller
{
    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        print_r(User::getAll());
        View::renderTemplate('Home/index.html');
    }
}
