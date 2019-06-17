<?php
/**
 * Created by fabioconceicao.
 * FILE: User.php
 * User: fabioconceicao
 * Date: 2019-06-17
 * Time: 17:57
 */

class User extends Model
{
    /**
     * @return array
     */
    public function getUsers()
    {
        $sql = "select * from $this->table";

        $users = $this->db->getAll($sql);

        return $users;
    }
}