<?php

namespace App\Controllers;


use Core\Controller;

/**
 * This class is responsible to set up dynamically all the necessaries built in default
 * methods, objects for controllers.
 *
 * Class ResourceController
 * @package App\Controllers
 */
class ResourceController extends Controller
{
    /**
     * @var mixed
     */
    protected $repository;

    /**
     * @return mixed
     */
    protected function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param mixed $repository
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
    }
}