<?php


namespace App\Repository;

use App\Models\User;
use PDO;

/**
 * Repository class to represent the abstraction of the user model.
 *
 * Class UserRepository
 * @package App\Repository
 */
class UserRepository extends Repository
{
    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public function get()
    {
        $db = static::getDB();
        $query = "select * from {$this->model->getTable()}";
        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Function responsible to set up the model in each repository
     *
     * @return mixed
     */
    protected function model()
    {
        $this->model = new User();
    }
}