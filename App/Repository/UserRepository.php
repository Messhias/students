<?php


namespace App\Repository;

use App\Models\User;
use Exception;
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
     * @throws Exception
     */
    public function create($data = [])
    {

        try {
            $columns = [];
            $values = [];

            // removing the id index.
            unset($data['id']);

            foreach ($data as $key => $value) {
                if ($key === "classroom") $key = "class";
                $columns[] = $key;
                if ($key == "year_joined") $values[] = "'" . date("Y-m-d H:m:s", strtotime($value)) . "'";
                else $values[] = "'" . $value . "'";
            }

            $columns = join(",", $columns);
            $values = join(",", $values);

            $query = "insert into {$this->model->getTable()}({$columns}) values({$values})";

            $stmt = $this->getDbRepo();
            $stmt->beginTransaction();
            $stmt->exec($query);
            $stmt->commit();

            return true;
        } catch (Exception $e) {
            $stmt->rollback();
            print_r($query);
            throw $e;
        }
    }

    /**
     * Find by ID.
     *
     * If the ID doesn't exist in the array collection returns false.
     *
     * @param array $data
     *
     * @return bool
     * @throws Exception
     */
    public function find($data = [])
    {
        try {
            if (!array_key_exists('id', $data)) return false;

            $id = $data["id"];
            $query = "select * from {$this->model->getTable()} where id = {$id}";
            $stmt = $this->getDbRepo()->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update student entry in database.
     *
     * @param array $data
     *
     * @return bool
     * @throws Exception
     */
    public function update($data = [])
    {
        try {
            if (!array_key_exists('id', $data)) return false;
            $update = [];

            $id = $data["id"];
            $data['date_updated'] = date("Y-m-d H:m:s");
            unset($data['id']);

            foreach ($data as $key => $value) {
                if ($key == "classroom") $key = "class";

                $update[] = $key . " = '" . $value . "'";
            }

            $values = join(",", $update);
            $query = "update {$this->model->getTable()} set {$values} where id = {$id}";

            $stmt = $this->getDbRepo();
            $stmt->beginTransaction();
            $stmt->exec($query);
            $stmt->commit();

            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete($data = [])
    {
        try {
            if (!array_key_exists('id', $data)) return false;

            $id = $data["id"];

            $query = "delete from {$this->model->getTable()} where id = {$id}";

            $stmt = $this->getDbRepo();
            $stmt->beginTransaction();
            $stmt->exec($query);
            $stmt->commit();

            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

}