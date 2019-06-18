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
     * @var mixed
     */
    private $db;

    /**
     * Set up the class constructor and call the parent class constructor.
     *
     * UserRepository constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setDb(static::getDB());
    }

    /**
     * @return mixed
     */
    public function getDbRepo()
    {
        return $this->db;
    }

    /**
     * @param mixed $db
     */
    public function setDb($db): void
    {
        $this->db = $db;
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

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public function get()
    {
        $query = "select * from {$this->model->getTable()} order by id desc";
        $stmt = $this->getDbRepo()->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Add new data in repository.
     *
     * just pass pair array with key / value and function it'll transpile it for sql statement for you.
     *
     * @param array $data
     *
     * @return bool
     * @throws \Exception
     */
    public function create($data = [])
    {
        $columns = [];
        $values = [];

        foreach ($data as $key => $value) {
            if ($key === "classroom") $key = "class";
            $columns[] = $key;
            if ($key == "year_joined") $values[] = "'" . date("Y-m-d H:m:s", $value) . "'";
            else $values[] = "'" . $value . "'";
         }
        $columns = join(",", $columns);
        $values = join(",", $values);
        $query = "insert into students({$columns}) values({$values})";
        $stmt = $this->getDbRepo();

        try {
            $stmt->beginTransaction();
            $stmt->exec($query);
            $stmt->commit();

            return true;
        } catch (\Exception $e) {
            $stmt->rollback();
            print_r($query);
            throw $e;
        }
    }
}