<?php
/**
 * Created by fabioconceicao.
 * FILE: StudentsController.php
 * User: fabioconceicao
 * Date: 2019-06-18
 * Time: 02:25
 */

namespace App\Controllers;

use App\Repository\UserRepository;

/**
 * Class StudentsController
 * @package App\Controllers
 */
class StudentsController extends ResourceController
{
    /**
     * HomeController constructor.
     *
     * @param $route_params
     */
    public function __construct($route_params)
    {
        $this->setRepository(new UserRepository());
        parent::__construct($route_params);
    }

    /**
     * @return mixed
     */
    public function get()
    {
        echo (json_encode($this->getRepository()->get()));
    }

    public function create()
    {
        // identify if has some empty value.
        foreach ($_POST as $key => $value) {
            if (empty($value)) {
                echo "You have to fill all the form data!";
                echo "<a href='/'> Back and fill it again</a>";
                return false;
            }
        }

        if ($this->getRepository()->create($_POST)) header("Location: /");

        // stop function.
        die();
    }
}