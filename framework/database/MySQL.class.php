<?php
/**
 * Created by fabioconceicao.
 * FILE: MySQL.class.php
 * User: fabioconceicao
 * Date: 2019-06-17
 * Time: 17:41
 */


/**
 *================================================================
 *framework/database/Mysql.class.php
 *Database operation class
 *================================================================
 */
class Mysql
{

    /**
     * @var bool|false|mysqli
     */
    protected $conn = false;  //DB connection resources

    /**
     * @var
     */
    protected $sql;           //sql statement

    /**
     * Constructor, to connect to database, select database and set charset
     *
     * @param array $config string configuration array
     */
    public function __construct($config = array())
    {

        $host = isset($config['host']) ? $config['host'] : 'localhost';

        $user = isset($config['user']) ? $config['user'] : 'root';

        $password = isset($config['password']) ? $config['password'] : '';

        $dbname = isset($config['dbname']) ? $config['dbname'] : '';

        $port = isset($config['port']) ? $config['port'] : '3306';

        $charset = isset($config['charset']) ? $config['charset'] : '3306';


        $this->conn = mysqli_connect("$host:$port", $user, $password) or die('Database connection error');

        mysqli_select_db($dbname) or die('Database selection error');

        $this->setChar($charset);

    }

    /**
     * Set charset
     * @access private
     *
     * @param $charest
     */
    private function setChar($charest)
    {
        $sql = 'set names ' . $charest;

        $this->query($sql);
    }

    /**
     * Execute SQL statement
     * @access public
     *
     * @param $sql string SQL query statement
     *
     * @return resource $result，if succeed, return resrouces; if fail return error message and exit
     */
    public function query($sql)
    {
        $this->sql = $sql;

        // Write SQL statement into log
        $str = $sql . "  [" . date("Y-m-d H:i:s") . "]" . PHP_EOL;

        file_put_contents("log.txt", $str, FILE_APPEND);

        $result = mysqli_query($this->sql, $this->conn);


        if (!$result) {
            die($this->errno() . ':' . $this->error() . '<br />Error SQL statement is ' . $this->sql . '<br />');
        }

        return $result;
    }

    /**
     * Get the first column of the first record
     * @access public
     *
     * @param $sql string SQL query statement
     *
     * @return mixed the value of this column
     */
    public function getOne($sql)
    {
        $result = $this->query($sql);

        $row = mysqli_fetch_row($result);

        if ($row) return $row[0];

        return false;
    }

    /**
     * Get one record
     * @access public
     *
     * @param $sql query statement
     *
     * @return array associative array
     */
    public function getRow($sql)
    {

        if ($result = $this->query($sql)) {

            $row = mysqli_fetch_assoc($result);

            return $row;

        }
        else
        {
            return false;
        }

    }

    /**
     * Get all records
     * @access public
     *
     * @param $sql Mysql query statement
     *
     * @return array $list an 2D array containing all result records
     */
    public function getAll($sql)
    {

        $result = $this->query($sql);

        $list = array();

        while ($row = mysqli_fetch_assoc($result))
        {
            $list[] = $row;
        }

        return $list;
    }

    /**
     * Get the value of a column
     * @access public
     *
     * @param $sql string SQL query statement
     *
     * @return array $list array an array of the value of this column
     */
    public function getCol($sql)
    {

        $result = $this->query($sql);

        $list = array();

        while ($row = mysqli_fetch_row($result))
        {
            $list[] = $row[0];
        }

        return $list;
    }


    /**
     * Get last insert id
     */
    public function getInsertId()
    {
        return mysqli_insert_id($this->conn);
    }

    /**
     * Get error number
     */
    public function errno()
    {
        return mysqli_errno($this->conn);
    }

    /**
     * Get error message
     *
     * @return string
     */
    public function error()
    {
        return mysqli_error($this->conn);
    }

}