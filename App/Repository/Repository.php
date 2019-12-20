<?php
/**
 * @author Fabio William Conceição
 * @email messhias@gmail.com
 */

namespace App\Repository;

use Core\Model;

/**
 * This class it's the layer of abstraction between the model and controller.
 *
 * The main role of the class it's protect the model for the controller issues and also
 * encapsulate all the necessary built-in default models operations into an repository.
 *
 * Class Repository
 * @package App\Repository
 */
abstract class Repository extends Model
{
    /**
     * Set up the repository and initiate the model into the repository
     * application context.
     *
     * Repository constructor
     */
    public function __construct()
    {
        $this->model();
    }

    /**
     * The model only can be accessible by the classes which extends it.
     *
     * @var $model
     */
    protected $model;

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Function responsible to set up the model in each repository
     *
     * @return mixed
     */
    abstract protected function model();
}