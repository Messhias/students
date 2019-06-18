<?php

namespace App\Controllers;

use App\Repository\UserRepository;
use Core\View;

/**
 * HomeController controller
 *
 * PHP version 7.0
 */
class HomeController extends ResourceController
{
    public function __construct($route_params)
    {
        $this->setRepository(new UserRepository());
        parent::__construct($route_params);
    }

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('Home/index.php', [
            "students" => $this->getRepository()->get(),
        ]);
    }
}
