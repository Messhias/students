<?php
/**
 * @author Fabio William Conceição
 */

namespace App\Controllers;

use App\Repository\UserRepository;
use Exception;

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

    /**
     * Add new student function.
     *
     * After add new one if everything's fine it'll redirect you to main entry of application.
     * Otherwise it'll finish the program immediately.
     *
     * @return bool
     * @throws Exception
     */
    public function create()
    {
        try {
            // removing the id from post global.
            unset($_POST['id']);

            // identify if has some empty value.
            foreach ($_POST as $key => $value) {
                if (empty($value)) {
                    echo "You have to fill all the form data!";
                    echo "<a href='/'> Back and fill it again</a>";
                    return false;
                }
            }

            if ($this->getRepository()->create($_POST)) header("Location: /");
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Function to retrieve the student by their ID.
     *
     * @return bool
     * @throws Exception
     */
    public function find()
    {
        try {
            if (!array_key_exists("id", $_POST)) {
                echo json_encode([
                    'error' => true,
                    'message' => "No id provided"
                ]);

                return false;
            }

            echo json_encode([
                'error' => false,
                'data' => $this->getRepository()->find($_POST)
            ]);

            return true;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Update user entry in database.
     *
     * @return bool
     * @throws Exception
     */
    public function update()
    {
        try {
            // identify if has some empty value.
            foreach ($_POST as $key => $value) {
                if (empty($value)) {
                    echo "You have to fill all the form data!";
                    echo "<a href='/'> Back and fill it again</a>";
                    return false;
                }
            }

            if ($this->getRepository()->update($_POST)) header("Location: /");
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete()
    {

        try {
            // identify if has some empty value.
            foreach ($_POST as $key => $value) {
                if (empty($value)) {
                    echo "Not worked!";
                    echo "<a href='/'> Back and try it again</a>";
                    return false;
                }
            }

            if ($this->getRepository()->delete($_POST)) echo true;

            echo false;
        } catch (Exception $e) {
            throw $e;
        }
    }
}