<?php

namespace app\Models;

use core\Model;
use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class User extends Model
{

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM students');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
